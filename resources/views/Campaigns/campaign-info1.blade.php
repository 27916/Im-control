<x-layouts.body.guest1>
    <x-slot name="title">Home</x-slot>
    {{-- <x-slot name="metaDescription">Pantalla principal</x-slot> --}}
    {{-- <x-slot name="header">
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              {{ __('Home') }}
    </h2>
    </x-slot> --}}

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
                    <h2 class="text-center text-xl font-bold text-white">Pagina: <small>Nombre de la pagina</small> </h2>
                    <h2 class="text-center text-xl font-bold text-white">Informacion extraida: <small>12/02/23</small>
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
                <button
                    class="rounded-lg p-2 text-white text-2xl  hover:bg-sky-900 bg-[#152a3a] w-[20%] absolute ml-[100%]"
                    onclick="alerta()">Generar reporte</button>
                <a href="{{ route('ads') }}"><button
                        class="rounded-lg p-2 text-white text-2xl  hover:bg-sky-900 bg-[#152a3a] w-[20%] absolute ml-[100%] mt-[5%]">Anuncios</button></a>
                <!--Tablas -->
                <div class="flex justify-center">
                    <table class="table-auto border-spacing w-full">

                        <tbody>
                            <tr class="fondTit">
                                <td colspan="2">
                                    <p class="p">Datos generales de la campaña</p>
                                </td>
                                <td colspan="2">
                                    <p class="p">Desglose</p>
                                </td>
                            </tr>
                            <tr class="fondtab">
                                <td>
                                    <p class="p"> Nombre campaña: </p>
                                </td>
                                <td>
                                    <p class="p"> Nombre campaña</p>
                                </td>
                                <td>
                                    <p class="p">14/12/22</p>
                                </td>
                                <td>
                                    <p class="p">17/12/22</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="p"> Alcance de todos los anuncios:</p>
                                </td>
                                <td>
                                    <p class="p"> Alcance anuncios</p>
                                </td>
                                <td>
                                    <p class="p"> Alcance anuncios 2</p>
                                </td>
                                <td>
                                    <p class="p"> Alcance anuncios 3</p>
                                </td>
                            </tr>
                            <tr class="fondtab">
                                <td>
                                    <p class="p">Presupuesto:</p>
                                </td>
                                <td>
                                    <p class="p">Presupuesto</p>
                                </td>
                                <td>
                                    <p class="p">Presupuesto 2</p>
                                </td>
                                <td>
                                    <p class="p">Presupuesto 3</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="p">Resultados:</p>
                                </td>
                                <td>
                                    <p class="p">Me gusta de la página</p>
                                </td>
                                <td>
                                    <p class="p">Me gusta de la página 2</p>
                                </td>
                                <td>
                                    <p class="p">Me gusta de la página 3</p>
                                </td>
                            </tr>
                            <tr class="fondtab">
                                <td>
                                    <p class="p">Alcance:</p>
                                </td>
                                <td>
                                    <p class="p">Visualizaciones anuncios</p>
                                </td>
                                <td>
                                    <p class="p">Visualizaciones anuncios 2</p>
                                </td>
                                <td>
                                    <p class="p">Visualizaciones anuncios 3</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="p">Impresiones:</p>
                                </td>
                                <td>
                                    <p class="p">No. de veces que mostraron los anuncios</p>
                                </td>
                                <td>
                                    <p class="p">No. de veces que mostraron los anuncios 2</p>
                                </td>
                                <td>
                                    <p class="p">No. de veces que mostraron los anuncios 3</p>
                                </td>
                            </tr>
                            <tr class="fondtab">
                                <td>
                                    <p class="p">Costo por resultado:</p>
                                </td>
                                <td>
                                    <p class="p">Clientes potenciales</p>
                                </td>
                                <td>
                                    <p class="p">Clientes potenciales 2</p>
                                </td>
                                <td>
                                    <p class="p">Clientes potenciales 3</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="p">Importe gastado:</p>
                                </td>
                                <td>
                                    <p class="p">$$</p>
                                </td>
                                <td>
                                    <p class="p">$</p>
                                </td>
                                <td>
                                    <p class="p">$</p>
                                </td>
                            </tr>
                            <tr class="fondtab">
                                <td>
                                    <p class="p">Finalización</p>
                                </td>
                                <td>
                                    <p class="p">15/dic/23</p>
                                </td>
                                <td>
                                    <p class="p">15/dic/23</p>
                                </td>
                                <td>
                                    <p class="p">15/dic/23</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="flex flex-col items-center">
                <!-- Help text -->
                <span class="text-sm text-gray-700 dark:text-gray-400 absolute">
                    Mostrando <span class="font-semibold text-gray-900 dark:text-white">1</span> a <span
                        class="font-semibold text-gray-900 dark:text-white">10</span> de <span
                        class="font-semibold text-gray-900 dark:text-white">100</span> Entradas
                </span><br>
                <div class="inline-flex mt-2 xs:mt-12 ">
                    <!-- Buttons -->
                    <button
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-800 rounded-l hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        <svg aria-hidden="true" class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Anterior
                    </button>
                    <button
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-800 border-0 border-l border-gray-700 rounded-r hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        Próximo
                        <svg aria-hidden="true" class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
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
    </x-slot>

    {{-- <x-slot name="footer">
          <x-layouts.footer></x-layouts.footer>
      </x-slot> --}}
</x-layouts.body.guest1>
