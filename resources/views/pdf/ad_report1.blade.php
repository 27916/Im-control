<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anuncio</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

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
        height: 8%;
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

    }

    #izq {
        float: left;
        width: 60%;
        margin-left: 2%;
    }

    #der {
        margin-top: 6.3%;
        float: right;
        width: 35%;
        margin-left: 1%;
        margin-right: 2%;
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
        height: 5.5%;
        color: black;
        text-align: center;
        font-size: 14px;
        border-radius: 5px;
        background-color: #e4f4fc;
    }

    #a {
        color: white;
        text-align: center;
        height: 5.5%;
        font-size: 16px;
        border-radius: 5px;
        background-color: #8AA1E4;
    }

    .content-table {
        color: white;
        font-size: 11.53px;
        border: 2px solid;
        border-color: #1A8CA6;

    }

    .content-table tbody tr.active-row {
        background-color: #1A8CA6;
        border: 2px solid;
    }

    .content-tabl {
        color: white;
        font-size: 10.4px;
        border: 2px solid;
        border-color: #1A8CA6;

    }

    .content-tabl tbody tr.active-row {
        background-color: #1A8CA6;
        border: 2px solid;
    }

    .page-break {
        page-break-after: always;
    }

    .izq {
        float: left;
        width: 48%;

    }

    .der {
        float: right;
        margin-right: 2.564102564102564%;
        width: 48%;

    }
</style>

<body>
    <div id="header">
        <img id="imgHeader" src="{{ public_path('images\Imcontrol\ImControl Logo.png') }}">
    </div>
    <div class="contenedor">
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

        <div id="izq">
            <div style="margin-top: 15%; text-align: center; color:white; font-size:14;">
                <p>Anuncio: {{ $name }}</p>
            </div>
            <table style="width:98%; color:white;">
                <tr>
                    <th style="width:18%; text-align:left; font-size:16px;" class="regular">
                        <p>Estatus:</p>
                    </th>
                    <th style="width:18%; text-align:left; font-size:16px; " class="regular">
                        <p>Página: ImCo</p>
                    </th>
                    <th style="width:18%; text-align:center; font-size:16px;" class="regular">
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
                <table style="width:90%;">
                    <tr>
                        <td style="text-align: center; color:white" class="blod">
                            <p>Desglose</p>
                        </td>
                        <td style="text-align: center; color:white" class="blod">
                            <p>Fecha desde:</p>
                        </td>
                        <td style="text-align: center; color:white" class="blod">
                            <p>Fecha hasta:</p>
                        </td>
                    </tr>
                    <tr>
                        <td id="t" class="regular">Por tiempo:</td>
                        <td id="t" class="regular">{{ $finicio }}</td>
                        <td id="t" class="regular">{{ $endtime }}</td>
                    </tr>
                </table>
                @for ($j = 0; $j < $i; $j++)
                    @if ($j > 0)
                        <div style="padding-top: 10%; margin-right:20%;"></div>
                    @endif
                    <div style="width:92%">

                        <article class="izq">
                            <div style="width: 100%">
                                <h1 class="regular" style="background-color:#8AA1E4; color:white" id="t">
                                    Información general
                                    del anuncio </h1>
                            </div>
                            <table class="content-table">
                                <tbody>
                                    <thead>
                                        <tr>
                                            <th style=" text-align: left;">Nombre del anuncio</th>
                                            <th style=" text-align: left;">{{ $name }}</th>
                                        </tr>
                                    </thead>
                                <tbody>
                                    <tr class="active-row">
                                        <td>Estrategia de puja</td>
                                        <td>{{ $puja }}</td>
                                    </tr>
                                    <tr>
                                        <td>Presupuesto</td>
                                        <td> ${{ $pre / 100 }}</td>
                                    </tr>
                                    <tr class="active-row">
                                        <td>Último cambio significativo</td>
                                        <td>{{ $time }}</td>
                                    </tr>
                                    <tr>
                                        <td>Configuración de atribución </td>
                                        <td>7 días después</td>
                                    </tr>
                                    <tr class="active-row">
                                        <td>Alcance</td>
                                        <td>{{ $alc }}</td>
                                    </tr>
                                    <tr>
                                        <td>Impresiones</td>
                                        <td>{{ $imp }}</td>
                                    </tr>
                                    <tr class="active-row">
                                        <td>Acción
                                        </td>
                                        <td>Resultado
                                        </td>
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
                        </article>


                        <article class="der">
                            <div style="width: 100%">
                                <h1 class="regular" style="background-color:#8AA1E4; color:white" id="t">
                                    Desglose del
                                    anuncio </h1>
                            </div>
                            <table class="content-tabl">
                                <tbody>
                                    <thead>
                                        <th class="active-row" style="width: 15%" colspan="2">
                                            {{ $ad['data'][$j]['date_start'] }} &nbsp; &nbsp;a &nbsp;
                                            &nbsp;{{ $ad['data'][$j]['date_stop'] }}</th>
                                    </thead>
                                <tbody>
                                    <tr class="active-row">
                                        <td>Estrategia de puja</td>
                                        <td><?php $puj = $ca['campaign']['bid_strategy'];
                                        if ($puj == 'LOWEST_COST_WITHOUT_CAP') {
                                            echo $puj = 'Costo más bajo';
                                        }
                                        ?></td>
                                    </tr>
                                    <tr>
                                        <td>Presupuesto</td>
                                        <td> ${{ $ca['campaign']['budget_remaining'] / 100 }}</td>
                                    </tr>
                                    <tr class="active-row">
                                        <td>Último cambio significativo</td>
                                        <td>{{ $ad['data'][$j]['updated_time'] }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 15%" ;>Configuración de atribución </td>
                                        <td>7 días después</td>
                                    </tr>
                                    <tr class="active-row">
                                        <td>Alcance</td>
                                        <td>{{ $ad['data'][$j]['reach'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>Impresiones</td>
                                        <td>{{ $ad['data'][$j]['impressions'] }}</td>
                                    </tr>
                                    <tr class="active-row">
                                        <td>Acción
                                        </td>
                                        <td>Resultado
                                        </td>
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
                                        <td><?php $claf = $ad['data'][$j]['quality_ranking'];
                                        if ($claf == 'AVERAGE') {
                                            echo $claf = 'PROMEDIO';
                                        }
                                        if ($claf == 'BELOW_AVERAGE_35') {
                                            echo $claf = 'POR DEBAJO DEL PROMEDIO';
                                        } ?></td>
                                    </tr>
                                    <tr>
                                        <td>Clasificación del porcentaje</td>
                                        <td><?php $tasa = $ad['data'][$j]['engagement_rate_ranking'];
                                        if ($tasa == 'BELOW_AVERAGE_35') {
                                            echo $tasa = 'POR DEBAJO DEL PROMEDIO';
                                        }
                                        if ($tasa == 'AVERAGE') {
                                            echo $tasa = 'PROMEDIO';
                                        } ?></td>
                                    </tr>
                                    <tr class="active-row">
                                        <td>Importe gastado</td>
                                        <td>${{ $ad['data'][$j]['spend'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>Finalización</td>
                                        <td><?php $newDate = $ca['adset']['end_time'];
                                        $timestamp = strtotime($newDate);
                                        echo $endtime = date('d-m-Y', $timestamp); ?></td>
                                    </tr>
                            </table>

                        </article>
                    </div>
                    <div class="page-break"></div>
                @endfor
        </div>

    </div>




</body>

</html>
