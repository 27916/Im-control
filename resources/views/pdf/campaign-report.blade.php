<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        background-image: url(https://im-control.com/main/public/images/ImControl/Background Azules.png);
        */ background-repeat: no-repeat;
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

    /*-----------ESTILOS PRIMER CONTENEDOR ------------------*/

    #titulo {
        margin-top: 11%;
        width: 100%;
        color: white;
        font-size: 20px;
    }

    #ca {
        font-size: 12px;
        width: 25%;
        float: left;
        margin-left: 5%;
        text-align: left;
        color: white;
    }

    #pa {
        font-size: 12px;
        margin-right: 4%;
        width: 30%;
        float: left;
        text-align: left;
        color: white;
    }

    #no {
        font-size: 12px;
        width: 35%;
        text-align: center;
        float: right;
        margin-right: 4%;
        color: white;
    }

    #fil {
        margin-top: 2%;
        width: 100%;
        height: 1%;
        text-align: left;
        margin-left: 5%;
        color: white;
    }

    /*ESTILOS PARA ENCABEZADOS FILTROS */
    #de {
        width: 20%;
        float: left;
        margin-left: 5%;
        text-align: left;
        font-size: 12px;
        color: white;
        height: 2%;
    }

    /*ESTILOS PARA  FILTROS */
    #caja {
        border-radius: 5px;
        background-color: #e4f4fc;
        height: 3%;
    }

    #ca123 {
        margin-top: 2%;
        text-align: center;
    }

    #caja1 {
        font-size: 12px;
        width: 15%;
        float: left;
        margin-left: 5%;
        color: black;
    }

    #caja2 {
        font-size: 12px;
        width: 15%;
        float: left;
        margin-left: 10%;
        color: black;
    }

    /*----------------------ESTILOS PARA  TABLAS-----------------------*/
    #conta {
        width: 90%;
        padding: 20px;
        margin-top: 5%
    }

    .col1 {
        width: 50%;
        float: left;
    }

    #t {
        margin-left: 2%;
        text-align: center;
        height: 4%;
        font-size: 16px;
        border-radius: 5px;
        background-color: #e4f4fc;
    }

    .content-table {
        width: 100%;
        color: white;
        margin: left:3px;
        font-size: 16px;
    }

    .content-ta {
        width: 95%;
        color: white;
        margin: :20px;
        font-size: 14px;
        margin-top: 0%;
        /*-*/
    }

    .content-table tbody tr.active-row {
        background-color: #14576c;
    }

    .content-ta tbody tr.active-row {
        background-color: #14576c;
    }


    #fecha {
        border-radius: 5px;
        background-color: #e4f4fc;
        height: 2%;
        width: 50%;
        color: black;
        text-align: center;

    }

    #dias {
        margin-top: 30%;

    }
</style>

<body>
    <div id="header">
        <img id="imgHeader" src="{{ public_path('images\Imcontrol\ImControl Logo.png') }}" alt="">
    </div>
    <h3 class="blod" id="titulo">
        <center>Detalles de campaña<center>
    </h3>
    <div class="grid grid-cols-3 gap-4">
        <div id="ca">
            <h2 class="blod">Nombre campaña</h2>
        </div>
        <div id="pa">
            <h2 class="blod">Página: Nombre de la página </h2>
        </div>
        <div id="no">
            <h2 class="bold">Información extraída: 12/02/23</h2>
        </div>
        <h4 class="regular" id="fil">El reporte se extrajo: 02/03/2023 Hora:12:00 am</h4>
    </div><br>
    <h3 class="bold" id="fil">Filtros</h3>
    <!--Encabezados filtros-->
    <div class="ca123">
        <div id="de">
            <h2>Desglose:</h2>
        </div>
        <div id="de">
            <h2>Fecha desde:</h2>
        </div>
        <div id="de">
            <h2>Fecha hasta:</h2>
        </div><br>
        <div id="ca123">
            <div id="caja1">
                <p class="bold" id="caja">Por tiempo</p>
            </div>
            <div id="caja2">
                <p class="bold" id="caja">dd/mm/aaaa</p>
            </div>
            <div id="caja2">
                <p class="bold" id="caja">dd/mm/aaaa</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-3 gap-4">
        <div id="conta">
            <div class="col1">
                <h1 class="bold" id="t">Datos generales de la Campaña</h1>
                <table class="content-table">
                    <thead>
                        <tr>
                            <th>Campaña</th>
                            <th>Nombre Campaña</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="active-row">
                            <td>Alcance anuncios</td>
                            <td>Alcance anuncios</td>
                        </tr>
                        <tr>
                            <td>Presupuesto</td>
                            <td>Presupuesto de conjunto de anuncios</td>
                        </tr>
                        <tr class="active-row">
                            <td>Resultados</td>
                            <td>Me gusta de la pagina</td>
                        </tr>
                        <tr>
                            <td>Alcance</td>
                            <td>Visualizaciones de los anuncios</td>
                        </tr>
                        <tr class="active-row">
                            <td>Impresiones</td>
                            <td>Numero de veces que mostraron los anuncios</td>
                        </tr>
                        <tr>
                            <td>Costo por Resultado</td>
                            <td>Cliente Pontecial</td>
                        </tr>
                        <tr class="active-row">
                            <td>Importe Gastado</td>
                            <td>$$</td>
                        </tr>
                        <tr>
                            <td>Finalización</td>
                            <td>15/dic/2022</td>
                </table>
            </div>
            <div class="col1">
                <h1 class="bold" id="t">Desglose</h1>
                <div>
                    <table class="content-ta">
                        <thead>
                            <tr class="active-row">
                                <td id="fecha">21/12/2022</td>
                                <td id="fecha">27/12/2022</td>
                            </tr><br>
                            <tr>
                                <th>Campaña</th>
                                <th>Nombre Campaña</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="active-row">
                                <td>Alcance anuncios</td>
                                <td>Alcance anuncios</td>
                            </tr>
                            <tr>
                                <td>Presupuesto</td>
                                <td>Presupuesto de conjunto de anuncios</td>
                            </tr>
                            <tr class="active-row">
                                <td>Resultados</td>
                                <td>Me gusta de la pagina</td>
                            </tr>
                            <tr>
                                <td>Alcance</td>
                                <td>Visualizaciones de los anuncios</td>
                            </tr>
                            <tr class="active-row">
                                <td>Impresiones</td>
                                <td>Numero de veces que mostraron los anuncios</td>
                            </tr>
                            <tr>
                                <td>Costo por Resultado</td>
                                <td>Cliente Pontecial</td>
                            </tr>
                            <tr class="active-row">
                                <td>Importe Gastado</td>
                                <td>$$</td>
                            </tr>
                            <tr>
                                <td>Finalización</td>
                                <td>15/dic/2022</td>
                    </table>
                </div>
            </div>
        </div><br><br>
        <div id="dias">

            <div class="grid grid-cols-3 gap-4">
                <div id="conta">
                    <div class="col1">
                        <h1 class="bold"></h1>
                        <div>
                            <table class="content-ta">
                                <thead>
                                    <tr class="active-row">
                                        <td id="fecha">21/12/2022</td>
                                        <td id="fecha">27/12/2022</td>
                                    </tr><br>
                                    <tr>
                                        <th>Campaña</th>
                                        <th>Nombre Campaña</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="active-row">
                                        <td>Alcance anuncios</td>
                                        <td>Alcance anuncios</td>
                                    </tr>
                                    <tr>
                                        <td>Presupuesto</td>
                                        <td>Presupuesto de conjunto de anuncios</td>
                                    </tr>
                                    <tr class="active-row">
                                        <td>Resultados</td>
                                        <td>Me gusta de la pagina</td>
                                    </tr>
                                    <tr>
                                        <td>Alcance</td>
                                        <td>Visualizaciones de los anuncios</td>
                                    </tr>
                                    <tr class="active-row">
                                        <td>Impresiones</td>
                                        <td>Numero de veces que mostraron los anuncios</td>
                                    </tr>
                                    <tr>
                                        <td>Costo por Resultado</td>
                                        <td>Cliente Pontecial</td>
                                    </tr>
                                    <tr class="active-row">
                                        <td>Importe Gastado</td>
                                        <td>$$</td>
                                    </tr>
                                    <tr>
                                        <td>Finalización</td>
                                        <td>15/dic/2022</td>
                            </table>
                        </div>
                    </div>
                </div>
</body>

</html>
