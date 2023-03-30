<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anuncio</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<style>
    @font-face {
        font-family: "Manrope";
        src=url('{{ storage_path('fonts/Manrope-Light.ttf') }}') format('truetype');
        font-weight: 100;
        font-style: normal;
    }

    @font-face {
        font-family: "Manrope";
        src=url('{{ storage_path('fonts/Manrope-Regular.ttf') }}') format('truetype');
        font-weight: 400;
        font-style: normal;
    }

    @font-face {
        font-family: "Manrope";
        src=url('{{ storage_path('fonts/Manrope-Bold.ttf') }}') format('truetype');
        font-weight: 700;
        font-style: normal;
    }

    .ligera {
        font-family: "Manrope";
        font-weight: 100;
    }

    .regular {
        font-family: "Manrope";
        font-weight: 400;
    }

    .bold {
        font-family: "Manrope";
        font-weight: 700;
    }

    /*-----------ESTILOS PARA FONDO DE PANTALLA CON IMAGEN------------------*/
    Body {
        background-image: url(https://im-control.com/main/public/images/ImControl/ba.png);
        background-repeat: no-repeat;
        background-size: cover;
        margin: 0px;
    }

    html {
        margin: 0px;
    }

    /*-----------ESTILOS PARA HEADER Y LOGO ------------------*/
    #header {

        width: 100%;
        height: 6%;
        position: fixed;
        background-color: #1b1e23;
    }

    #imgHeader {
        width: 134px;
        height: 34px;
        margin-left: 10%;
        margin-top: 2%;
    }

    #contenedor {
        width: 93%;
        margin-top: 10%;
    }

    #izq {
        margin-top: 1%;
        float: left;
        width: 62%;
        margin-left: 2%;
    }

    #der {
        margin-top: 10%;
        float: left;
        width: 33%;
        margin-left: 1%;

    }

    #t {
        color: black;
        text-align: center;
        height: 3%;
        font-size: 16px;
        border-radius: 3px;
        background-color: #e4f4fc;
    }

    tbody tr.active-row {
        background-color: #1A8CA6;
        border: 1px solid;
    }

    #ta {
        height: 4%;
        color: black;
        text-align: center;
        font-size: 14px;
        border-radius: 5px;
        background-color: #e4f4fc;
    }

    #a {
        color: white;
        text-align: center;
        height: 4%;
        font-size: 16px;
        border-radius: 5px;
        background-color: #8AA1E4;
    }
</style>

<body>
    <div id="header">
        <img id="imgHeader" src="{{ public_path('images\Imcontrol\ImControl Logo.png') }}">
    </div>
    <div class="contenedor">
        <div id="izq">
            <div style="margin-top: 15%; text-align: center; color:white; font-size:14;">
                <p>Anuncio: {{ $name }}</p>
            </div>
            <table style="width:98%; color:white;">
                <tr>
                    <th style="width:15%; text-align:left; font-size:16px;" class="regular">
                        <p>Estatus:</p>
                    </th>
                    <th style="width:15%; text-align:left; font-size:16px; " class="regular">
                        <p>Página: ImCo</p>
                    </th>
                    <th style="width:15%; text-align:center; font-size:16px;" class="regular">
                        <p>Información extraída:
                            {{ $fecha }}</p>
                    </th>
                </tr>
            </table>
            <table style="table-layout: fixed; width: 750px;">
                <tr>
                    <td style="font-size:16px; text-align:left; color:white;" class="regular">El reporte se extrajo:
                        {{ $hora }}</td>
                </tr>
                <table style="width:63%;">
                    <tr>
                        <td style="text-align: center; color:white" class="blod">
                            <p>Desglose</p>
                        </td>
                        <td style="text-align: center; color:white" class="blod">
                            <p>Fecha desde:</p>
                        </td>
                        <td style="text-align: center; color:white" class="blod">
                            <p>Fecha Hasta:</p>
                        </td>
                    </tr>
                    <tr>
                        <td id="t" class="regular">Por tiempo:</td>
                        <td id="t" class="regular">{{ $finicio }}</td>
                        <td id="t" class="regular">{{ $endtime }}</td>
                    </tr>
                </table>
                <div style="width: 63%">
                    <h1 class="regular" style="background-color:#8AA1E4; color:white" id="t">Información general
                        del anuncio </h1>
                </div>
                <table style="width: 62.5%; color: white; font-size: 14px; border: 2px solid; border-color: #1A8CA6">
                    <tbody>
                        <tr>
                            <th>Nombre del anuncio</th>
                            <th style="text-align: left;">{{ $name }}</th>
                        </tr>
                    <tbody>
                        <tr class="active-row">
                            <td style="width: 15%";>Estrategia de puja</td>
                            <td>{{ $puja }}</td>
                        </tr>
                        <tr>
                            <td style="width: 15%";>Presupuesto</td>
                            <td> ${{ $pre / 100 }}</td>
                        </tr>
                        <tr class="active-row">
                            <td style="width: 15%";>Último Cambio significativo</td>
                            <td>{{ $time }}</td>
                        </tr>
                        <tr>
                            <td style="width: 15%";>Configuración de atribución </td>
                            <td>7 días después</td>
                        <tr class="active-row">
                            <td>Alcance</td>
                            <td>{{ $alc }}</td >
                        </tr>
                        <tr>
                            <td>Impresiones</td>
                            <td>{{ $imp }}</td>
                         </tr>
                         <tr class="active-row">
                            <td>Accion</td>

                            <td>Resultado</td>


                        </tr>
                        <tr>
                            <td>
                                @foreach ($costA as $co)
                                    {{ $co }}
                                @endforeach
                            </td>
                            <td>
                                @foreach ($costV as $co)
                                    <ul> {{ round($co) }}</ul>
                                @endforeach
                        </tr>
                        <tr class="active-row">
                            <td>Clasificación de calidad</td>
                            <td>{{ $claf }}</td>
                        </tr>
                        <tr>
                            <td>Clasificación del porcentaje</td>
                            <td>{{ $tasa }}</td>
                        </tr>
                        <tr class="active-row">
                            <td>Importe gastado</td>
                            <td>${{ $gasto }}</td>
                        </tr>
                        <tr>
                            <td>Finalización</td>
                            <td>{{ $endtime }}</td>
                        </tr>
                </table>
        </div>
        <div id="der">
            <div id="a" class="regular">
                <p>Intereses</p>
            </div>
            <div id="ta" class="regular">
                <p>
                    @foreach ($interests as $inte)
                        {{ $inte . ', ' }}
                    @endforeach
            </div>
            <div id="a" class="regular">
                <p>Lugares</p>
            </div>
            <div id="ta" class="regular">
                @foreach ($locations as $loca)
                    {{ $loca . ', ' }}
                @endforeach
            </div>
        </div>
</body>

</html>
