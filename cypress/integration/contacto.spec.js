/// <reference types="cypress" />
/**
 * Con:
 * type(parametro)                          :Metodo para escribir en un campo de texto, y se escribira los argumentos que se envien
 * select(parametro)                        :POdemos seleccionar una etiqueta, segun el parametro enviado, usado para las etiqueteas <select>
 * check                                    :Selecciona un radio button
 * submit                                   :Precionara el boton de tipo ( submit )
 * and                                      :Verificamos mas d euna clase o elemento a comparar
 */

describe('Prueba el Formulario de Contacto', () => {
    it('Prueba la página de contacto y el envio de emails', () => {
        cy.visit('contacto');
        cy.get('[data-cy="heading-contacto"]').should('exist');
        cy.get('[data-cy="heading-contacto"]').invoke('text').should('equal','Contacto');
        cy.get('[data-cy="heading-contacto"]').invoke('text').should('not.equal','Formulario de Contacto');

        cy.get('[data-cy="heading-formulario"]').should('exist');
        cy.get('[data-cy="heading-formulario"]').invoke('text').should('equal', 'Llene el Formulario de Contacto');
        cy.get('[data-cy="heading-formulario"]').invoke('text').should('not.equal', 'Llene el formulario');

        cy.get('[data-cy="formulario-contacto"]').should('exist');
    });

    it('Llena los campos del formulario', () => {
        cy.get('[data-cy="input-nombre"]').type('David');
        cy.get('[data-cy="mensaje"]').type('Deseo comprar una casa');
        cy.get('[data-cy="input-opciones"]').select('Compra');
        cy.get('[data-cy="input-precio"]').type('1234567');
        //Radio button mail
        cy.get('[data-cy="forma-contacto"]').eq(1).check();

        cy.wait(3000);
        //Radio button telefono
        cy.get('[data-cy="forma-contacto"]').eq(0).check();
        cy.get('[data-cy="input-telefono"]').type('0987654321');
        cy.get('[data-cy="input-fecha"]').type('2021-11-22');
        cy.get('[data-cy="input-hora"]').type('12:30');

        //Formulario contacto
        cy.get('[data-cy="formulario-contacto"]').submit();
        cy.get('[data-cy="alerta-envio-formulario"]').should('exist');
        // cy.get('[data-cy="alerta-envio-formulario"]').invoke('text').should('equal','Mensaje Enviado Correctamente');
        cy.get('[data-cy="alerta-envio-formulario"]').should('have.class','alerta');
        //Probamos multiples clases
        //cy.get('[data-cy="alerta-envio-formulario"]').should('have.class','alerta').and('have.class','exito');
        //cy.get('[data-cy="alerta-envio-formulario"]').should('have.class','alerta').and('have.class','exito').and('not.have.class','error');

    });
});