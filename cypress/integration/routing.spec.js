/// <reference types="cypress" />
/**Explicaciones se ciertos metodos, parametros, etc
 *  eq(indice):                     NOs retorna un tipo de arreglo, con las pociciones empezando desde el 0, y el (indice), es el valor que vamos a testear
 */

describe('Prueba la navegación y ROuting del Header y Footer', () =>{
    it('Prueb la navegación del Header', () => {
        cy.visit('/');

        //Pruebas a la navegación Header
        cy.get('[data-cy="navegacion-header"]').should('exist');
        cy.get('[data-cy="navegacion-header"]').find('a').should('have.length', 5);
        cy.get('[data-cy="navegacion-header"]').find('a').should('not.have.length', 4);
        cy.get('[data-cy="navegacion-header"]').find('a').should('not.have.length', 6);
        //Revisar que los enlaces sean correctos
        cy.get('[data-cy="navegacion-header"]').find('a').eq(0).invoke('attr', 'href').should('equal','nosotros');
        cy.get('[data-cy="navegacion-header"]').find('a').eq(0).invoke('text').should('equal','Nosotros');

        cy.get('[data-cy="navegacion-header"]').find('a').eq(1).invoke('attr', 'href').should('equal','propiedades');
        cy.get('[data-cy="navegacion-header"]').find('a').eq(1).invoke('text').should('equal','Propiedades');

        cy.get('[data-cy="navegacion-header"]').find('a').eq(2).invoke('attr', 'href').should('equal','blog');
        cy.get('[data-cy="navegacion-header"]').find('a').eq(2).invoke('text').should('equal','Blog');

        cy.get('[data-cy="navegacion-header"]').find('a').eq(3).invoke('attr', 'href').should('equal','contacto');
        cy.get('[data-cy="navegacion-header"]').find('a').eq(3).invoke('text').should('equal','Contacto');

        cy.get('[data-cy="navegacion-header"]').find('a').eq(4).invoke('attr', 'href').should('equal','login');
        cy.get('[data-cy="navegacion-header"]').find('a').eq(4).invoke('text').should('equal','Iniciar Sesión');
    });

    it('Prueba la navegación del Footer', () => {
        //Pruebas a la navegación Footer
        cy.get('[data-cy="navegacion-footer"]').should('exist');
        cy.get('[data-cy="navegacion-footer"]').should('have.prop','class').should('equal','navegacion');
        cy.get('[data-cy="navegacion-footer"]').find('a').should('have.length', 4);
        cy.get('[data-cy="navegacion-footer"]').find('a').should('not.have.length', 3);
        cy.get('[data-cy="navegacion-footer"]').find('a').should('not.have.length', 5);
        //Revisar que los enlaces sean correctos
        cy.get('[data-cy="navegacion-footer"]').find('a').eq(0).invoke('attr', 'href').should('equal','nosotros');
        cy.get('[data-cy="navegacion-footer"]').find('a').eq(0).invoke('text').should('equal','Nosotros');

        cy.get('[data-cy="navegacion-footer"]').find('a').eq(1).invoke('attr', 'href').should('equal','propiedades');
        cy.get('[data-cy="navegacion-footer"]').find('a').eq(1).invoke('text').should('equal','Propiedades');

        cy.get('[data-cy="navegacion-footer"]').find('a').eq(2).invoke('attr', 'href').should('equal','blog');
        cy.get('[data-cy="navegacion-footer"]').find('a').eq(2).invoke('text').should('equal','Blog');

        cy.get('[data-cy="navegacion-footer"]').find('a').eq(3).invoke('attr', 'href').should('equal','contacto');
        cy.get('[data-cy="navegacion-footer"]').find('a').eq(3).invoke('text').should('equal','Contacto');
        
        cy.get('[data-cy="copy-right"]').should('have.prop','class').should('equal','copyright');
    });
});