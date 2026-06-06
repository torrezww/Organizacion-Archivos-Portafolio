<!DOCTYPE html>
<html lang="es">
<head>

<!--
===========================================
CONFIGURACIÓN BÁSICA DEL DOCUMENTO
Define codificación y título de la página
===========================================
-->

<meta charset="UTF-8">
<title>Sistema de Órdenes - Restaurante Mexicano</title>


<style>

/*
=====================================================
ESTILO GENERAL DE LA PÁGINA
Aquí se define la apariencia base del sitio.
=====================================================
*/

body{

    /* Tipo de letra principal del sistema */
    font-family:'Segoe UI', Arial, sans-serif;

    /*
    Fondo con degradado que representa
    los colores de la bandera mexicana
    Verde -> Blanco -> Rojo
    */
    background: linear-gradient(
        to bottom,
        #2a713a 0%,
        #2a713a 40%,
        white 50%,
        white 60%,
        #ce1126 100%
    );

    margin:0;
    padding:0;

    /* Centra el contenido horizontalmente */
    display:flex;

    /* Permite acomodar elementos verticalmente */
    flex-direction:column;

    /* Centra los elementos en la página */
    align-items:center;

    /* Hace que la página ocupe toda la pantalla */
    min-height:100vh;
}


/*
=====================================================
ENCABEZADO DEL SISTEMA
Título principal del sistema que aparece arriba
=====================================================
*/

.tituloSistema{

    /* Espacio desde la parte superior */
    margin-top:20px;

    /* Color del texto */
    color:white;

    /* Tamaño del título */
    font-size:26px;

    /* Texto en negrita */
    font-weight:bold;

    /* Sombra para mejorar visibilidad */
    text-shadow:1px 1px 3px rgba(0,0,0,0.4);

    /* Centra el texto */
    text-align:center;

}


/*
=====================================================
CONTENEDOR PRINCIPAL
Caja blanca donde está todo el formulario
=====================================================
*/

.contenedor{

    /* Ancho del panel */
    width:420px;

    /* Fondo blanco */
    background:white;

    /* Espacio interno */
    padding:30px;

    /* Bordes redondeados */
    border-radius:15px;

    /* Sombra para dar efecto de tarjeta */
    box-shadow:0px 8px 20px rgba(0,0,0,0.25);

    /* Centra el texto */
    text-align:center;

    /* Espacio entre el título y el contenedor */
    margin-top:20px;

}


/*
=====================================================
IMAGEN DECORATIVA
Imagen del menú o comida mexicana
=====================================================
*/

.contenedor img{

    /* La imagen ocupa todo el ancho del contenedor */
    width:100%;

    /* Bordes redondeados */
    border-radius:10px;

    /* Separación inferior */
    margin-bottom:15px;

}


/*
=====================================================
TÍTULOS
=====================================================
*/

h1{

    /* Color verde del título principal */
    color:#006847;

    font-size:28px;

    margin-bottom:5px;

}

h2{

    /* Color rojo para subtítulos */
    color:#ce1126;

    font-size:18px;

    margin-top:10px;

}


/*
=====================================================
MENSAJES INFORMATIVOS
Texto pequeño que explica el sistema
=====================================================
*/

.mensaje{

    font-size:14px;

    color:#444;

    margin-bottom:15px;

}


/*
=====================================================
ETIQUETAS DE LOS CAMPOS
Nombre que aparece encima de cada input
=====================================================
*/

label{

    display:block;

    margin-top:15px;

    font-weight:bold;

    text-align:left;

}


/*
=====================================================
CAMPOS DE ENTRADA
Inputs y listas desplegables
=====================================================
*/

input, select{

    width:100%;

    padding:12px;

    margin-top:8px;

    border:1px solid #ccc;

    border-radius:8px;

    /* Animación suave al interactuar */
    transition:all 0.3s;

}


/*
Cuando el usuario selecciona un campo
se resalta con color rojo
*/

input:focus, select:focus{

    border-color:#ce1126;

    box-shadow:0px 0px 5px rgba(206,17,38,0.5);

    outline:none;

}


/*
=====================================================
BOTONES DEL SISTEMA
=====================================================
*/

button{

    width:100%;

    padding:12px;

    margin-top:20px;

    border:none;

    border-radius:8px;

    font-size:16px;

    font-weight:bold;

    cursor:pointer;

    transition:all 0.2s ease;

}


/*
BOTÓN PRINCIPAL
Botón que ejecuta la búsqueda
*/

button[type="submit"]{

    background:#ce1126;

    color:white;

}

button[type="submit"]:hover{

    background:#a50d1f;

    transform:scale(1.03);

}


/*
BOTÓN SECUNDARIO
Muestra todas las órdenes
*/

button.secundario{

    background:#006847;

    color:white;

}

button.secundario:hover{

    background:#004d33;

    transform:scale(1.03);

}


/*
Separa los formularios entre sí
*/

form + form{

    margin-top:10px;

}


/*
=====================================================
MENSAJE DE ERROR
Se muestra si el usuario no llena ningún campo
=====================================================
*/

#errorBusqueda{

    color:red;

    font-weight:bold;

    margin-top:10px;

}


/*
=====================================================
DESCRIPCIÓN DEL SISTEMA
Texto informativo pequeño al final
=====================================================
*/

.descripcion{

    font-size:12px;

    color:#777;

    margin-top:15px;

}

</style>


<script>

/*
=========================================================
FUNCIÓN DE VALIDACIÓN DEL FORMULARIO
Esta función evita que el usuario envíe una búsqueda vacía
=========================================================
*/

function validarBusqueda(){

    /*
    Se obtienen los valores ingresados por el usuario
    en cada campo del formulario
    */

    let id = document.querySelector("input[name='id']").value.trim();
    let platillo = document.querySelector("select[name='platillo']").value;
    let mesero = document.querySelector("select[name='mesero']").value;
    let mesa = document.querySelector("input[name='mesa']").value.trim();

    /*
    Si todos los campos están vacíos,
    se muestra un mensaje de error
    */

    if(id === "" && platillo === "" && mesero === "" && mesa === ""){

        document.getElementById("errorBusqueda").innerText =
        "❌ Debes ingresar al menos un criterio de búsqueda.";

        /* Evita que el formulario se envíe */
        return false;
    }

    /* Permite enviar el formulario si hay datos */
    return true;
}

</script>

</head>

<body>


<!--
=====================================================
TÍTULO PRINCIPAL DEL SISTEMA
=====================================================
-->

<div class="tituloSistema">
Sistema de Órdenes - Restaurante Mexicano
</div>


<!--
=====================================================
CONTENEDOR PRINCIPAL DEL SISTEMA
Aquí se encuentra todo el formulario de búsqueda
=====================================================
-->

<div class="contenedor">


<!-- Imagen decorativa del menú -->
<img src="menu.jpeg" alt="Comida mexicana">


<!-- Título principal de la sección -->
<h1>🌮 Buscar Órdenes</h1>


<!-- Descripción del sistema -->
<p class="mensaje">
Consulta las órdenes registradas en el sistema del restaurante.
</p>


<!-- Subtítulo -->
<h2>Filtros de búsqueda</h2>


<!-- Lugar donde aparece el mensaje de error -->
<p id="errorBusqueda"></p>


<!--
=====================================================
FORMULARIO DE BÚSQUEDA
Envía los datos al archivo procesar.php
=====================================================
-->

<form action="procesar.php" method="POST" onsubmit="return validarBusqueda()">


<!-- Campo para buscar por ID -->
<label>🆔 Buscar por ID:</label>
<input type="text" name="id" placeholder="Ejemplo: 005">


<!-- Lista para buscar por tipo de platillo -->
<label>🍽 Buscar por Platillo:</label>
<select name="platillo">
<option value="">-- Seleccionar --</option>
<option value="Tacos">Tacos</option>
<option value="Gordas">Gordas</option>
<option value="Tamales">Tamales</option>
<option value="Enchiladas">Enchiladas</option>
<option value="Quesadillas">Quesadillas</option>
</select>


<!-- Lista para buscar por mesero -->
<label>👨‍🍳 Buscar por Mesero:</label>
<select name="mesero">
<option value="">-- Seleccionar --</option>
<option value="Jahaziel">Jahaziel</option>
<option value="Zenqu">Zenqu</option>
<option value="Alex">Alex</option>
<option value="Torres">Torres</option>
</select>


<!-- Campo para buscar por número de mesa -->
<label>🪑 Buscar por Mesa:</label>
<input type="number" name="mesa" placeholder="1 - 15" min="1" max="15">


<!-- Botón para realizar la búsqueda -->
<button type="submit">🔎 Buscar Orden</button>

</form>


<!--
=====================================================
FORMULARIO SECUNDARIO
Permite mostrar todas las órdenes registradas
=====================================================
-->

<form action="mostrar_todas.php" method="POST">
<button type="submit" class="secundario">
📋 Mostrar Todas las Órdenes
</button>
</form>


<!-- Descripción pequeña del sistema -->
<p class="descripcion">
Sistema de consulta de órdenes del restaurante.  
Los datos se almacenan y procesan utilizando archivos planos.
</p>

</div>

</body>
</html>