<?php
/*
=========================================================
ARCHIVO: procesar.php
FUNCIÓN GENERAL:
Recibe los datos del formulario (index.php),
lee maestro.txt, aplica filtros de búsqueda,
y guarda las coincidencias en filtrado.txt
=========================================================
*/

/*
Se capturan los datos enviados por método POST.
El operador ?? evita errores si el campo no existe.
*/
$id_buscar = $_POST['id'] ?? "";
$platillo_buscar = $_POST['platillo'] ?? "";
$mesa_buscar = $_POST['mesa'] ?? "";
$mesero_buscar = $_POST['mesero'] ?? "";

/*
Validación en servidor:
Si todos los campos están vacíos, se detiene la ejecución.
Esto refuerza la validación hecha con JavaScript.
*/
if ($id_buscar == "" && $platillo_buscar == "" && $mesa_buscar == "" && $mesero_buscar == "") {
    echo "Debes ingresar al menos un criterio de búsqueda.";
    echo "<br><a href='index.php'>Volver</a>";
    exit();
}

/*
Se abre maestro.txt en modo lectura ("r")
*/
$maestro = fopen("maestro.txt", "r");

/*
Se crea filtrado.txt en modo escritura.
Aquí se guardarán los resultados de la búsqueda.
*/
$filtrado = fopen("filtrado.txt", "w");

/*
Se copia el encabezado del archivo original
para mantener la estructura de columnas.
*/
$encabezado = fgets($maestro);
fwrite($filtrado, $encabezado);

/*
Se recorre línea por línea el archivo maestro.
fgets devuelve false cuando termina el archivo.
*/
while (($linea = fgets($maestro)) !== false) {

    /*
    explode:
    Divide la línea usando "|" como separador.
    Esto es lo que significa "parsear las líneas".
    */
    $datos = explode("|", trim($linea));

    $id = $datos[0];
    $mesa = $datos[1];
    $mesero = $datos[2];
    $platillo = $datos[3];

    // Variable bandera para verificar coincidencia
    $coincide = true;

    // Aplicación de filtros
    if ($id_buscar != "" && $id != $id_buscar) {
        $coincide = false;
    }

    if ($platillo_buscar != "" && $platillo != $platillo_buscar) {
        $coincide = false;
    }

    if ($mesa_buscar != "" && $mesa != $mesa_buscar) {
        $coincide = false;
    }

    /*
    strtolower permite que la búsqueda
    no dependa de mayúsculas/minúsculas.
    */
    if ($mesero_buscar != "" && strtolower($mesero) != strtolower($mesero_buscar)) {
        $coincide = false;
    }

    /*
    Si cumple todas las condiciones,
    se escribe en filtrado.txt
    */
    if ($coincide) {
        fwrite($filtrado, $linea);
    }
}

// Cierre de archivos
fclose($maestro);
fclose($filtrado);

// Redirección automática a resultados
header("Location: resultados.php");
exit();
?>