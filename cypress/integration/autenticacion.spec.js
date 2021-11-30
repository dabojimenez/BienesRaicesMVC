/// <reference types="cypress" />

describe('Probar la autenticación', () => {
    it('Prueba la autenticacion en login',() =>{
        cy.visit('login');
        cy.get('[data-cy="head-login"]').should('exist');
        cy.get('[data-cy="head-login"]').should('have.text', 'Iniciar Sesión');

        //Validamos el formulario de Iniciar sesión
        cy.get('[data-cy="formulario-login"]').should('exist')

        //Ambos campos son obligatorios
        cy.get('[data-cy="formulario-login"]').submit();
        cy.get('[data-cy="alerta-login"]').should('exist');
        cy.get('[data-cy="alerta-login"]').eq(0).should('have.class','error')
        cy.get('[data-cy="alerta-login"]').eq(0).should('have.text','El email es Obligatorio')

        cy.get('[data-cy="alerta-login"]').eq(1).should('have.class','error')
        cy.get('[data-cy="alerta-login"]').eq(1).should('have.text','El password es Obligatorio')
        //EL usuarios exista

        //Verificar password
        
    })
})