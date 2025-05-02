<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            margin: 20px;
        }
        .titulo {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .seccion {
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th {
            background-color: #f3f4f6;
            text-align: left;
            font-weight: bold;
            padding: 10px;
            text-transform: uppercase;
        }
        td {
            padding: 10px;
            font-size: 12px;
            vertical-align: top;
        }
        .etiqueta {
            padding: 4px 8px;
            border-radius: 4px;
            font-weight: bold;'RECHAZADO'
            display: inline-block;
        }
        .aprobado { background-color: #d1fae5; color: #065f46; }
        .gris { background-color: #e5e7eb; color: #374151; }
    </style>
</head>
<body>

<div class="titulo">Boleta BO-{{ $boleta->correlativo }}</div>

<table>
    <tr>
        <td>
            <strong>Fecha de Solicitud:</strong><br>
            {{ $boleta->fecha_solicitado }}
        </td>
        <td>
            <strong>Fecha de Aprobación:</strong><br>
            {{ $boleta->fecha_aprobacion }}
        </td>
        <td>
            <strong>Costo:</strong><br>
            {{ $boleta->costo }}
        </td>
        <td>
            <strong>Estado de la Boleta:</strong><br>
            <span class="etiqueta
                    @if($boleta->estado_boleta == \App\enums\TipoBoleta::APROBADO) aprobado
                    @else gris @endif">
                    {{ $boleta->estado_boleta }}
                </span>
        </td>
    </tr>
</table>

<div class="seccion">
    <h3 style="text-align: center; font-weight: bold; margin: 20px 0;">Información del Encargado</h3>
    <table>
        <tr>
            <td>
                <strong>DPI del Encargado:</strong><br>
                {{ $boleta->dpi }}
            </td>
            <td>
                <strong>Nombre del Encargado:</strong><br>
                {{ $boleta->nombre }}
            </td>
        </tr>
    </table>
</div>

</body>
</html>
