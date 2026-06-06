<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Monitor de Seguridad</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background: linear-gradient(135deg, #1f1f2e, #2c3e50);
            margin: 0;
            padding: 0;
            color: #333;
        }

        h2 {
            text-align: center;
            color: white;
            margin-top: 30px;
            letter-spacing: 1px;
        }

        .contenedor {
            width: 85%;
            margin: 30px auto;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0px 10px 25px rgba(0,0,0,0.3);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #2c3e50;
            color: white;
        }

        th {
            padding: 15px;
            text-align: left;
            font-size: 15px;
            letter-spacing: 0.5px;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }

        tr:hover {
            background-color: #f5f5f5;
            transition: 0.2s;
        }

        /* Estados */
        .autorizado {
            background-color: #e8f5e9;
            color: #2e7d32;
            font-weight: 500;
        }

        .alerta {
            background-color: #ffebee;
            color: #c62828;
            font-weight: bold;
        }

        .error {
            background-color: #fff8e1;
            color: #f57f17;
            font-weight: 500;
        }

        /* Etiquetas tipo badge */
        .badge {
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: bold;
        }

        .badge-ok { background: #2e7d32; color: white; }
        .badge-alert { background: #c62828; color: white; }
        .badge-error { background: #f9a825; color: white; }

    </style>
</head>
<body>

<h2>🔐 Registro de Auditoría</h2>

<div class="contenedor">
<table>
    <thead>
        <tr>
            <th>Fecha/Hora</th>
            <th>Evento</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $archivo = fopen("auditoria.txt", "r");
    if ($archivo) {
        while (($linea = fgets($archivo)) !== false) {
            $partes = explode(" - ", $linea, 2);
            $fecha = $partes[0] ?? "";
            $evento = $partes[1] ?? "";

            $clase = "";
            $badge = "";

            if (strpos($evento, "AUTORIZADO") !== false) {
                $clase = "autorizado";
                $badge = "<span class='badge badge-ok'>OK</span>";
            }
            elseif (strpos($evento, "ALERTA") !== false || strpos($evento, "DENEGADO") !== false) {
                $clase = "alerta";
                $badge = "<span class='badge badge-alert'>ALERTA</span>";
            }
            elseif (strpos($evento, "ERROR") !== false) {
                $clase = "error";
                $badge = "<span class='badge badge-error'>ERROR</span>";
            }

            echo "<tr class='$clase'>
                    <td>" . htmlspecialchars($fecha) . "</td>
                    <td>$badge " . htmlspecialchars($evento) . "</td>
                  </tr>";
        }
        fclose($archivo);
    }
    ?>
    </tbody>
</table>
</div>

</body>
</html>




