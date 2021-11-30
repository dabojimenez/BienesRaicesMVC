//POdemso elegir nuestro navegador a usar, en la parte isquierda podemos notrar que estra seleccionado el navegador que siempre y cuando soporte cypress
/** Esta funcion ( describe ), nos permite describir que es lo que hace esta prueba, recibe dos parametros
 * 1)   la descripcion, en string
 * 2)   recibe un llamado o un callback
 * Ademas podemos agrupar nuestras pruebas con los ( it )
 * */ 
describe("Envia un hola mundo", () => {
    /** La palabra reservada ( it ), nos permite hacer una prueba en especifico y de igual amnera recibe una descripcion y un callback
     * Ahora en la ventana de escritorio abierta, podemosver nuestra prueba y le dmaos click y nos abrira una nueva ventana de nuestro navegador y 
    */
    it('Hola mundo', () => {
        ////Como es un navegador como Tal podemos ir a inspeccionar el codigo y es ahi donde se imprimira el log
        //console.log('HOla mundo');
        //Todos los comandos comienzan con la palabra reservada ( cy ) y la paalabra ( visit ), toma un string que es una URL y pegamos la de nuestro sitio web
        cy.visit("http://localhost/BienesRaicesMVC/public/index.php/");
    });

    it("Test 2", () => {

    });

    it("Test 3", () => {

    });

    it("Test 4", () => {

    });
});