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

$id_buscar = $_POST['id'] ?? "";
$platillo_buscar = $_POST['platillo'] ?? "";
$mesa_buscar = $_POST['mesa'] ?? "";
$mesero_buscar = $_POST['mesero'] ?? "";

/*
Si todos los campos están vacíos:
En lugar de mostrar error, copiamos maestro.txt completo
a filtrado.txt para que se muestren todas las órdenes.
*/
if ($id_buscar == "" && $platillo_buscar == "" && $mesa_buscar == "" && $mesero_buscar == "") {
    if (file_exists("maestro.txt")) {
        copy("maestro.txt", "filtrado.txt");
    }
    header("Location: resultados.php");
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
*/
while (($linea = fgets($maestro)) !== false) {
    $datos = explode("|", trim($linea));

    $id = $datos[0];
    $mesa = $datos[1];
    $mesero = $datos[2];
    $platillo = $datos[3];

    $coincide = true;

    if ($id_buscar != "" && $id != $id_buscar) {
        $coincide = false;
    }

    if ($platillo_buscar != "" && $platillo != $platillo_buscar) {
        $coincide = false;
    }

    if ($mesa_buscar != "" && $mesa != $mesa_buscar) {
        $coincide = false;
    }

    if ($mesero_buscar != "" && strtolower($mesero) != strtolower($mesero_buscar)) {
        $coincide = false;
    }

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
