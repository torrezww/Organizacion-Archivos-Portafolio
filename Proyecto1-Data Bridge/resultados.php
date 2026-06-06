<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Resultados de Búsqueda</title>

<style>

/* ===============================
ESTILO GENERAL DE LA PÁGINA
Fondo con degradado bandera mexicana
verde → blanco → rojo
================================= */

body{
    font-family:'Segoe UI', Arial, sans-serif;

    background: linear-gradient(
        to bottom,
        #2a713a 0%,
        #2a713a 35%,
        white 50%,
        white 65%,
        #ce1126 100%
    );

    margin:0;
    padding:0;

    display:flex;
    justify-content:center;
    align-items:flex-start;

    /* altura mayor para que siempre se vea el degradado */
    min-height:150vh;
}


/* ===============================
CONTENEDOR PRINCIPAL
Caja blanca estilo tarjeta
================================= */

.contenedor{

    width:900px;

    background:white;

    padding:30px;

    margin-top:60px;

    border-radius:15px;

    box-shadow:0px 8px 20px rgba(0,0,0,0.25);
}


/* ===============================
TÍTULO
================================= */

h1{

    text-align:center;

    color:#006847;

    margin-bottom:25px;

}


/* ===============================
MENSAJES DE RESULTADO
================================= */

.resultado{

    text-align:center;

    font-weight:bold;

    margin-bottom:20px;

    font-size:18px;

}

.exito{
    color:green;
}

.error{
    color:red;
}


/* ===============================
TABLA DE RESULTADOS
================================= */

table{

    width:100%;

    border-collapse:collapse;

    margin-top:20px;

}

/* encabezados */

th{

    background:#006847;

    color:white;

    padding:12px;

    font-size:15px;

}

/* celdas */

td{

    padding:10px;

    text-align:center;

    border-bottom:1px solid #ddd;

}

/* efecto hover */

tr:hover{

    background:#f5f5f5;

}


/* ===============================
BOTONES
================================= */

.botones{

    text-align:center;

    margin-top:30px;

}

button{

    padding:12px 20px;

    margin:5px;

    border:none;

    border-radius:8px;

    font-size:15px;

    font-weight:bold;

    cursor:pointer;

}


/* botón volver */

.volver{

    background:#ce1126;

    color:white;

}

.volver:hover{

    background:#a50d1f;

}


/* botón txt */

.txt{

    background:#006847;

    color:white;

}

.txt:hover{

    background:#004d33;

}

</style>

</head>

<body>

<div class="contenedor">

<h1>📊 Resultados de Órdenes</h1>

<?php

/*
=========================================================
ARCHIVO: resultados.php
FUNCIÓN:
Lee el archivo filtrado.txt,
parsea las líneas y genera una tabla HTML dinámica
=========================================================
*/

/* ---> Es la que jala los resultados que 
el archivo procesar.php guardó.*/ 
if (file_exists("filtrado.txt")) {

    // Lee el archivo completo en un arreglo
    $lineas = file("filtrado.txt");

    // Si solo existe el encabezado
    if (count($lineas) <= 1) {

        echo "<p class='resultado error'>❌ Orden no encontrada.</p>";

    } else {

        // Número total de resultados (sin contar encabezado)
        $total = count($lineas) - 1;

        echo "<p class='resultado exito'>✅ Se encontraron $total orden(es).</p>";

        echo "<table>";

/* ---> Dentro de este ciclo se separan los datos 
para ponerlos en sus cuadros correspondientes.*/
        foreach ($lineas as $i => $linea){

            // Divide cada línea por |
            /* ---> El código rompe la primera línea
            para los títulos de las columnas.*/
            $datos = explode("|", trim($linea));

            // Encabezado
            if($i == 0){

                echo "<tr>";

                foreach($datos as $dato){
                    echo "<th>$dato</th>";
                }

                echo "</tr>";

            }

            // Filas normales
            else{

                echo "<tr>";

                foreach($datos as $dato){
                    echo "<td>$dato</td>";
                }

                echo "</tr>";

            }

        }

        echo "</table>";

    }

}

else{

    echo "<p class='resultado error'>No existe el archivo de resultados.</p>";

}

?>

<div class="botones">

<a href="index.php">
<button class="volver">⬅ Volver</button>
</a>

<a href="descargar_txt.php">
<button class="txt">📄 Abrir resultados en archivo .txt</button>
</a>

</div>

</div>

</body>
</html>