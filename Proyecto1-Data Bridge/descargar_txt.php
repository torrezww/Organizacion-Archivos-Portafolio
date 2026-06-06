<?php
/*
=========================================================
ARCHIVO: descargar_txt.php
FUNCIÓN:
Permite descargar el archivo filtrado.txt
como archivo.txt en formato texto plano.
=========================================================
*/
/* ---> Se define la ruta del archivo que el 
sistema generó antes de la búsqueda.*/
$archivo = "filtrado.txt";

/*
Verifica que el archivo exista antes de intentar enviarlo.
*/

/* ---> Esta es la validación de seguridad para evitar 
errores si el archivo no se encuentra el servidor.*/
if (file_exists($archivo)) {

    /*
    header():
    Envía cabeceras HTTP para forzar descarga.
    */
/* ---> Estás 3 líneas envían las instrucciones al navegador, la línea 25 es 
la más importante porque es la que activa la ventana de guardar como.*/
    header("Content-Type: text/plain");
    header("Content-Disposition: attachment; filename=archivo.txt");
    header("Content-Length: " . filesize($archivo));

    /*
    readfile():
    Envía el contenido del archivo directamente al navegador.
    */

/* ---> Está función es la que empuja los 
datos del archivo hacia nuestra computadora.*/
    readfile($archivo);
/* ---> Corta la ejecución para que el archivo 
descargado este limpio y no tenga texto extra al final*/
    exit();

} else {
    echo "El archivo no existe.";
}
?>