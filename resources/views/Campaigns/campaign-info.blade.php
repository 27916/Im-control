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

            .p {
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
        <div class="box-xontent w-[80%] h-[80%] absolute mt-[5%] z-40">
            <div class="m-8">
                <h3 class="text-center text-xl font-bold text-white">Detalles de campaña</h3>
                <div class="grid grid-cols-3 gap-4">
                    <h2 class="text-center text-xl font-bold text-white">Nombre campaña</h2>
                    <h2 class="text-center text-xl font-bold text-white">Pagina: <small>Nombre de la
                            pagina</small> </h2>
                    <h2 class="text-center text-xl font-bold text-white">Informacion extraida:
                        <small>12/02/23</small>
                    </h2>
                </div>
                <div grid grid-cols-6 gap-4>
                    <h3 class=" text-xl font-bold text-white col-start-1 col-end-7">Filtros</h3>
                </div>
                <div class="grid grid-cols-3 gap-4">
                    <!--Encabezados filtros-->
                    <div>
                        <p class="text-white text-center absolute"> Desglose: </p>
                    </div>
                    <div>
                        <p class="text-white text-center absolute">Fecha desde: </p>
                    </div>
                    <div>
                        <p class="text-white text-center absolute">Fecha hasta: </p>
                    </div>
                    <!--Filtros-->
                    <div>
                        <div class="dropdown form-select">
                            <button onclick="myFunction()" class="dropbtn">Por tiempo:</button>
                            <div id="myDropdown" class="dropdown-content">
                                <a href="{{ route('campaign_info1') }}">Por Día</a>
                                <a href="{{ route('campaign_info1') }}">Por Semana</a>
                            </div>
                        </div>
                    </div>
                    <div>
                        <input type="date" id="buscafechadesde" name="buscafechadesde" class="form-control mt-2"
                            value="">
                    </div>
                    <div>
                        <input type="date" id="buscafechahasta" name="buscafechahasta" class="form-control mt-2"
                            value="">
                    </div>
                </div>
                <!--Reporte-->

                <form action="{{ route('campaigns_report') }}" method="GET" target="_blank">
                    @csrf
                    <button type="submit" onclick="alerta()"
                        class="rounded-lg p-2 text-white text-2xl  hover:bg-sky-900 bg-[#152a3a] w-[20%] absolute ml-[100%]"">
                        Generar reporte
                    </button>
                </form>
                <br> <br> <br>
                {{-- {{ dd(Auth::user()) }} --}}
                <form action="{{ route('campaign_info_report_email', Auth::user()) }}" method="POST" enctype="multipart/form-data" >
                    @csrf
                    <button type="submit" onclick="alerta()"
                        class="rounded-lg p-2 text-white text-2xl  hover:bg-sky-900 bg-[#152a3a] w-[20%] absolute ml-[100%]"">
                        Enviar reporte al Email
                    </button>
                </form>
                {{-- <button
                            class="rounded-lg p-2 text-white text-2xl  hover:bg-sky-900 bg-[#152a3a] w-[20%] absolute ml-[100%]"
                            onclick="alerta()">

                        </button> --}}

                <a href="{{ route('ads') }}">
                    <button
                        class="rounded-lg p-2 text-white text-2xl  hover:bg-sky-900 bg-[#152a3a] w-[20%] absolute ml-[100%] mt-[5%]">
                        Anuncios
                    </button>
                </a>
                <!--Tablas -->
                <div class="flex justify-center">
                    <table class="table-auto border-spacing w-full">

                        <tbody>
                            <tr class="fondtab">
                                <td>
                                    <p class="p"> Nombre campaña: </p>
                                </td>
                                <td>
                                    <p class="p"> Nombre campaña</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="p"> Alcance de todos los anuncios</p>
                                </td>
                                <td>
                                    <p class="p"> Alcance anuncios</p>
                                </td>
                            </tr>
                            <tr class="fondtab">
                                <td>
                                    <p class="p">Presupuesto</p>
                                </td>
                                <td>
                                    <p class="p">Presupuesto</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="p">Resultados</p>
                                </td>
                                <td>
                                    <p class="p">Me gusta de la página</p>
                                </td>
                            </tr>
                            <tr class="fondtab">
                                <td>
                                    <p class="p">Alcance</p>
                                </td>
                                <td>
                                    <p class="p">Visualizaciones anuncios</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="p">Impresiones</p>
                                </td>
                                <td>
                                    <p class="p">Numero de veces que mostraron los anuncios</p>
                                </td>
                            </tr>
                            <tr class="fondtab">
                                <td>
                                    <p class="p">Costo por resultado</p>
                                </td>
                                <td>
                                    <p class="p">Clientes potenciales</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="p">Importe gastado</p>
                                </td>
                                <td>
                                    <p class="p">$$</p>
                                </td>
                            </tr>
                            <tr class="fondtab">
                                <td>
                                    <p class="p">Finalización</p>
                                </td>
                                <td>
                                    <p class="p">15/dic/23</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script>
            function myFunction() {
                document.getElementById("myDropdown").classList.toggle("show");
            }


            window.onclick = function(event) {
                if (!event.target.matches('.dropbtn')) {

                    var dropdowns = document.getElementsByClassName("dropdown-content");
                    var i;
                    for (i = 0; i < dropdowns.length; i++) {
                        var openDropdown = dropdowns[i];
                        if (openDropdown.classList.contains('show')) {
                            openDropdown.classList.remove('show');
                        }
                    }
                }
            }
            const alerta = () => {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'El reporte se envió al correo electronico',
                    showConfirmButton: false,
                    timer: 2000
                })
            }
        </script>
        </div>
    </x-slot>

</x-layouts.body.guest1>

{{-- <form action="{{ route('campaign_info_report', Auth::user()) }}" method="POST">
    @csrf
    <button type="submit">
        Enviar Reporte
    </button>
</form> --}}
