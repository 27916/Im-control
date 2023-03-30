<x-layouts.body.guest1>
    <x-slot name="title">Home</x-slot>

    <x-slot name="content">
        <style>
            .color {
                background-color: #152a3b;
            }

            .imagesize {
                width: 300px;
                height: 300px;
            }

            p {
                color: #ffffff;
                font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            }

            .fondtab {
                margin: 30px;
                background-color: #237492;
                border-radius: 25px;
                opacity: 0.6;
                color: #ffffff;
            }

            .fondTit {
                margin: 30px;
                background-color: #052835;
                border-radius: 25px;
                opacity: 0.6;
                color: #ffffff;
            }

            .dropbtn {
                background-color: #ffffff;
                color: #000000;
                font-size: 16px;
                border: none;
                cursor: pointer;
            }

            .dropbtn:hover,
            .dropbtn:focus {
                background-color: #42b8ee;
            }

            .dropdown {
                position: relative;
                display: inline-block;
            }

            .dropdown-content {
                display: none;
                background-color: #f9f9f9;
                min-width: 160px;
                overflow: auto;
                box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            }

            .dropdown-content a {
                color: black;
                text-decoration: none;
                display: block;
            }

            .dropdown a:hover {
                background-color: #f1f1f1
            }

            .show {
                display: block;
            }

            .colorFo {
                background-color: #158ca7;
                text-align: center;
                font-family: sans-serif;
                border-radius: 20px;
            }

            .caja {
                height: 120px;
                background-color: #deebf7;
                border-radius: 20px;
                color: #000000;
                font-family: sans-serif;
                font-size: 1.5em;
            }

            .cajas {
                height: 60px;
                background-color: #deebf7;
                border-radius: 20px;
                color: #000000;
                font-family: sans-serif;
                font-size: 1em;
            }
        </style>
        <div class="box-content w-[80%] h-[80%] ml-[2%] absolute mt-[5%]">
            <h1 class="text-center text-xl font-bold text-white">Cliente potencial</h3>
                <div class="grid grid-flow-row-dense grid-cols-3 grid-rows-3 ...">
                    <div class="col-span-2 text-xl font-bold text-white">Nombre del anuncio: <small>[<?php echo $name?>]</small></div>
                    <div class="text-xl font-bold text-white">Informacion extraida: <small>12/02/23</small></div>
                </div>
                <h2 class="text-left text-xl font-bold text-white">Pagina: <small>Nombre de la pagina</small> </h2>



                <div class="grid grid-cols-2 gap-4 place-content-stretch h-48 ...">
                    <div>
                        <p class="basis-1/2 colorFo">CTR</p>
                        <p><br></p>
                        <p>Rendimiento</p>
                        <p>$499.99 gastados en 5 días.</p>
                    </div>
                    <div>
                        <p class="basis-1/2 colorFo">Detalle </p>
                        <p><br></p>
                        <p class="basis-1/2 cajas"> <strong>&nbsp;&nbsp;Objetivo:</strong> <br> &nbsp;&nbsp;  {{$obj}}</p>
                    </div>
                    <div>
                        <p class="basis-1/2 caja">&nbsp;Clientes potenciales en Facebook <br> <strong> &nbsp;&nbsp;.</strong></p>
                    </div>
                    <div>
                        <p class="basis-1/2 cajas"> <strong>&nbsp;&nbsp;Presupuesto diario:</strong> <br> &nbsp;&nbsp; $100.00</p>
                        <p><br></p>
                        <p class="basis-1/2 cajas"> <strong>&nbsp;&nbsp;Duración:</strong> <br> &nbsp;&nbsp; 5 días </p>
                    </div>
                    <div>
                        <p class="basis-1/2 cajas">&nbsp;&nbsp;Alcance: <strong><br> &nbsp;&nbsp;{{$Alc}}</strong> </p>
                    </div>
                    <div>
                        <div class="grid gap-2 grid-cols-2">
                            <div>
                                <p class="cajas"><strong>&nbsp;&nbsp;Fecha inicio: <br></strong>&nbsp;&nbsp;   {{$creats}}</p>
                            </div>
                            <div>
                                <p class="cajas"><strong>&nbsp;&nbsp;Fecha de finalización: <br></strong>&nbsp;&nbsp;{{$creatst}}</p>
                            </div>
                        </div>

                    </div>
                    <div>
                        <p class="basis-1/2 cajas">&nbsp;&nbsp;Costo por clietes potenciales de Facebook: <br> <strong>&nbsp;&nbsp;56.90</strong></p>
                    </div>

                    <p class="basis-1/2 cajas"> <strong>&nbsp;&nbsp;Creado por:</strong> <br> &nbsp;&nbsp;<?php echo $Aname?></p>

                </div>
    </x-slot>

</x-layouts.body.guest1>
