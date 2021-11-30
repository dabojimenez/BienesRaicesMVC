/// <reference types="cypress" />
//EN el codigo superior, nos tendra un mejor tipeado al moemnto de escribir codigo

describe("Carga la pagina principal", () => {
    it('Prueba el Header de la pagina Principal', () => {
        //NO vamos a nuestro archivo cypress.json y definimos una ( baseUrl ), y ahora en ( visit ), colocamos solo una barra laterl para indicar la pagina principal, como referencia
        cy.visit("/");
        //Seleccionar elementos con ( cypress ), este nos da una capa de abstraccion para seleccionar los elemntos, dehando a un lado el clasico de javascript
        //cy.get('h1'); = {document.querySelector('h1)}
        // cy.get('h1');//De este modo es muy generico el poder seleccionar un h1
        /**POr lo tanto demos registrar este atributo [ data-cy ] en nuestro HTML y depsues irlo seleccioanndo, es lo que nos dan las buenas practicas de cypress
         * Ahora un exeption es una prueba, que retornaria verdadero o falso
         * Ahora con ( should ), podremos verificar que un elemento exista o sea igual.. etc
         *  exist:                                  Que exista
         *  equal, {parametro}:                     Que sea igual a {parametro}
         *  not.equal, {parametro}:                 Que no sea igual a {parametro}
         *  have.prop, tagName:                     Debe tener la propiedad/Verificamos que tenga dicha etiqueta
         *  tagName:                                Acceder a dicho tag/Que tenga una etiqueta HTML
         *  have.length, {parametroEntero}          Que tenga una extencion de {parametroEntero}
         *  not.have.length, {parametroEntero}      Que no tenga una extencion de {parametroEntero}
         *  Con ( incoke ), podemos seleccionar el texto o el contenido de dicha seleccion
         *  first                                   Seleccionamos unicamnete el primero
         * click                                    Verificamos los enlaces al momento de hacer click
         * go                                       Vamos al link indicado o con [back], regresamos a la pagina anterior
         * wait({parametro})                        Podemos esperar para que no se ejecute muy rapido y el {parametro} debe ser un entero, ej: 1000 = 1s
        */
        cy.get('[data-cy="heading-site"]').should('exist');
        cy.get('[data-cy="heading-site"]').invoke("text").should('equal', 'Venta de Casas y Departamentos Exclusivos de Lujo');
        cy.get('[data-cy="heading-site"]').invoke("text").should('not.equal', 'Bienes Raices');
    });
    it('Prueba el Bloque de los Iconos principales', () => {
        cy.get('[data-cy="headin-nosotros"]').should('exist');
        cy.get('[data-cy="headin-nosotros"]').should('have.prop', 'tagName').should('equal','H2');

        // Seleccionamos los iconos
        cy.get('[data-cy="iconos-nosotros"]').should('exist');
        //Con ( find ), nos permite seleccionar el elemento y buscar dentro del elemnto, bsucar dnetro de su contenido
        //en este caso estamps pasando la clase llamada ( .icono ), y no hay problema ya que estamos seleccionando el apdre con ( find )
        cy.get('[data-cy="iconos-nosotros"]').find('.icono').should('have.length', 3);
        cy.get('[data-cy="iconos-nosotros"]').find('.icono').should('not.have.length', 2);
    });

    it("Prueba la seeción de propiedades", () =>{
        //Debe haber 3 propiedades
        cy.get('[data-cy="anuncio"]').should('have.length', 3);
        cy.get('[data-cy="anuncio"]').should('not.have.length', 4);

        //Probar el enlace de las propiedades
        cy.get('[data-cy="enlace-propiedad"]').should('have.class','boton-amarillo-block');
        cy.get('[data-cy="enlace-propiedad"]').should('not.have.class','boton-amarillo');

        cy.get('[data-cy="enlace-propiedad"]').first().invoke('text').should('equal','Ver Propiedad');

        //Probar el enlace a una propiedad
        cy.get('[data-cy="enlace-propiedad"]').first().click();
        cy.get('[data-cy="titulo-propiedad"]').should('exist');

        //Regresar de pagina
        cy.wait(1000);
        cy.go('back');
    });

    it('Prueba el Routing hacia todas las propiedades', () => {
        cy.get('[data-cy="todas-propiedades"]').should('exist');
        cy.get('[data-cy="todas-propiedades"]').should('have.class','boton-verde');
        cy.get('[data-cy="todas-propiedades"]').invoke('attr','href').should('equal','propiedades');
        
        //Probar el enlace a una propiedad
        cy.get('[data-cy="todas-propiedades"]').click();
        cy.get('[data-cy="heading-propiedades"]').should('exist');
        cy.get('[data-cy="heading-propiedades"]').invoke('text').should('equal','Casas y Departamentos en Venta');
        //Regresar de pagina
        cy.wait(1000);
        cy.go('back');
    });

    it('Prueba el Bloque de contacto', () =>{
        cy.get('[data-cy="imagen-contacto"]').should('exist');
        cy.get('[data-cy="imagen-contacto"]').find('h2').invoke('text').should('equal','Encuentra la casa de tus sueños');
        cy.get('[data-cy="imagen-contacto"]').find('p').invoke('text').should('equal','Llena el el formulario de contacto y un asesor se pondrá en contacto contigo a la brevedad');

        cy.get('[data-cy="imagen-contacto"]').find('a').invoke('attr','href')
            //Obtenemos el link y lo visitamos, con este tipo de promesa
            .then(href => {
                cy.visit(href)
            });
        cy.get('[data-cy="heading-contacto"]').should('exist');
        
        cy.wait(1000);
        //Como usmaos (visit), en la promesa ya no podmeos usar (go), de lo contrario nos daria error
        cy.visit('/');

    });

    it('Prueba los Testimoniales y el Blog', () => {
        //Blog
        cy.get('[data-cy="blog"]').should('exist');
        cy.get('[data-cy="blog"]').find('h3').invoke('text').should('equal','Nuestro Blog');
        cy.get('[data-cy="blog"]').find('h3').invoke('text').should('not.equal','Blog');
        cy.get('[data-cy="blog"]').find('img').should('have.length',2);

        //Testimoniales
        cy.get('[data-cy="testimoniales"]').should('exist');
        cy.get('[data-cy="testimoniales"]').find('h3').invoke('text').should('equal','Testimoniales');
        cy.get('[data-cy="testimoniales"]').find('h3').invoke('text').should('not.equal','Nuestros Testimoniales');

    });
});