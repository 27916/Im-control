<x-layouts.body.app1>
    <x-slot name="title">Información anuncio</x-slot>

    <x-slot name="content">
        <style>
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

        <div class="box-content w-[55%] h-[90%] inset-x-16 bottom-0 absolute z-40">
            <div class="mt-[1%]">
                <table class="w-full inset-x-0 top-0 h-16">
                    <td class="text-2xl text-white w-full text-center">Anuncio:{{ $name }}</td>
                </table>
                <table class="w-full inset-x-0 top-0 h-16">
                    <tr class="text-center">
                        <td class="text-2xl text-white w-[33.3%]">Estatus: </td>
                        <td class="text-2xl text-white w-[33.3%]">Pagina:
                        </td>
                        <td class="text-xl text-white w-[33.3%]">Informacion extraida el: {{ $fecha }}</td>
                    </tr>
                    <tr class="text-center">
                        <td class="text-2xl text-white w-[33.3%]">Desgloce:</td>
                        <td class="text-2xl text-white w-[33.3%]">Fecha desde:</td>
                        <td class="text-2xl text-white w-[33.3%]">Fecha hasta:</td>
                    </tr>
                    <tr class="text-center">
                        <td class="text-4xl text-white w-[33.3%]">
                            <div class="dropdown form-select">
                                <button onclick="myFunction()" class="dropbtn text-xl  p-2.5 px-12 rounded-lg block w-full  bg-white :border-gray-600 placeholder-gray-400 text-black focus:ring-blue-500 focus:border-blue-500">Por
                                    tiempo:
                                </button>
                                <div id="myDropdown"
                                    class="dropdown-content text-xl rounded-lg block w-full  bg-white :border-gray-600 placeholder-gray-400 text-black focus:ring-blue-500 focus:border-blue-500 absolute">
                                    <a href="{{ route('ad_info1') }}?ad_id=<?php echo $adId; ?>&&dia=dia&&page=1">Día</a>
                                    <a
                                        href="{{ route('ad_info1') }}?ad_id=<?php echo $adId; ?>&&week=week&&page=1">Semana</a>
                                </div>
                            </div>
                        </td>
                        <form action="" method="POST">
                            @csrf
                            <td class="text-4xl text-white w-[33.3%]">
                                <input type="date" id="buscafechadesde" name="desde"
                                    class=" text-sm rounded-lg block w-full pl-10 p-2.5  bg-white :border-gray-600 placeholder-gray-400 text-black focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Fecha de inicio">
                            </td>
                            <td class="text-4xl text-white w-[33.3%]">
                                <input type="date" id="buscafechadesde" name="hasta"
                                    class=" text-sm rounded-lg block w-full pl-10 p-2.5  bg-white :border-gray-600 placeholder-gray-400 text-black focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Fecha final">
                            </td>
                            <td class="text-4xl text-white w-[33.3%]">
                                {{-- <form action="{{ route('ad_info', ['ad_id' => '?week=week&&page=1']) }}"> --}}
                                {{-- @csrf --}}
                                <button type="submit"
                                    class="bg-cyan-600 rounded-lg p-2 text-white text-2xl mt-3 mb-3 hover:bg-sky-900 hover:text-black w-[90%]">
                                    Buscar
                                </button>
                                {{-- </form> --}}
                            </td>
                        </form>
                    </tr>
                </table>
                @if (empty($ad['data']) & empty($ca['data']))
                    <table class="border-4 border-[#188ca4]/50 border-y-[#188ca4]/50 w-[100%] float-left  inset-0">
                        <tr>
                            <td class="xl:text-xl ms:text-xs text-white w-[100%] text-center">No hay datos en el rango
                                seleccionado
                            </td>
                        </tr>
                    </table>
                @else
                    <table class="border-4 border-[#188ca4]/50 border-y-[#188ca4]/50 w-[100%] float-left  inset-0">
                        <tr class="text-left ">
                            <td class="xl:text-xl ms:text-xs text-white w-[50%]">Nombre del anuncio
                            </td>
                            <td class="xl:text-xl ms:text-xs text-white w-[50%]">{{ $name }}
                            </td>
                        </tr>
                        <tr class="text-left bg-[#188ca4]">
                            <td class="xl:text-xl ms:text-xs text-white w-[50%]">Entrega de puja
                            </td>
                            <td class="xl:text-xl ms:text-xs text-white w-[50%]">{{ $puja }}
                            </td>
                        </tr>
                        <tr class="text-left ">
                            <td class="xl:text-xl ms:text-xs text-white w-[50%]">Presupuesto</td>
                            <td class="xl:text-xl ms:text-xs text-white w-[50%]">
                                @if (empty($ad['data']) & empty($ca['data']))
                                    {{ $pre }}
                                @else
                                    ${{ $pre / 100 }}
                                @endif
                            </td>
                        </tr>
                        <tr class="text-left bg-[#188ca4]">
                            <td class="xl:text-xl ms:text-xs text-white w-[50%]">Último cambio significativo
                            </td>
                            <td class="xl:text-xl ms:text-xs text-white w-[50%]">{{ $time }}
                            </td>
                        </tr>
                        <tr class="text-left ">
                            <td class="xl:text-xl ms:text-xs text-white w-[50%]">Configuración de atribución
                            </td>
                            <td class="xl:text-xl ms:text-xs text-white w-[50%]">
                                @if (empty($ad['data']) & empty($ca['data']))
                                    {{ $time }}
                            </td>
                        @else
                            {{ '7 días después' }}
                @endif
                </td>
                </tr>
                <tr class="text-left bg-[#188ca4]">
                    <td class="xl:text-xl ms:text-xs text-white w-[50%]">Alcance</td>
                    <td class="xl:text-xl ms:text-xs text-white w-[50%]">{{ $alc }}
                    </td>
                </tr>
                <tr class="text-left ">
                    <td class="xl:text-xl ms:text-xs text-white w-[50%]">Impresiones</td>
                    <td class="xl:text-xl ms:text-xs text-white w-[50%]">{{ $imp }}
                    </td>
                </tr>
                </table>
                <table class="border-4 border-[#188ca4]/50 border-y-[#188ca4]/50 w-[100%] float-left  inset-0">
                    <tr class=" bg-[#188ca4]">
                        <td class="xl:text-xl ms:text-xs text-white w-[75%] text-left">Acción
                        </td>
                        <td class="xl:text-xl ms:text-xs text-white w-[20%] text-center">Costo por resultado
                        </td>
                        <td class="xl:text-xl ms:text-xs text-white w-[5%] text-center">Resultado
                        </td>
                    </tr>
                    <tr>
                        <td class="xl:text-xl ms:text-xs text-white w-[75%] text-left ">
                            @if (empty($ad['data']) & empty($ca['data'])) {{ $costA }}
                            @else
                                @foreach ($costA as $co)
                                    <ul> {{ $co }}</ul>
                                @endforeach
                            @endif
                        </td>
                        <td class="xl:text-xl ms:text-xs text-white w-[20%] text-center ">
                            @if (empty($ad['data']) & empty($ca['data'])) {{ $costR }}
                            @else
                                @foreach ($costR as $co)
                                    <ul> ${{ number_format($co, 2) }}</ul>
                                @endforeach
                            @endif
                        </td>
                        <td class="xl:text-xl ms:text-xs text-white w-[5%] text-center ">
                            @if (empty($ad['data']) & empty($ca['data'])) {{ $costV }}
                            @else
                                @foreach ($costV as $co)
                                    <ul> {{ round($co) }}</ul>
                                @endforeach
                            @endif
                        </td>
                    </tr>
                </table>
                <table class="border-4 border-[#188ca4]/50 border-y-[#188ca4]/50 w-[100%] float-left  inset-0">
                    <tr class="text-left bg-[#188ca4]">
                        <td class="xl:text-xl ms:text-xs text-white w-[50%]">Clasificación de calidad</td>
                        <td class="xl:text-xl ms:text-xs text-white w-[50%]">{{ $claf }}
                        </td>
                    </tr>
                    <tr class="text-left ">
                        <td class="xl:text-xl ms:text-xs text-white w-[50%]">Clasificación de porcentaje</td>
                        <td class="xl:text-xl ms:text-xs text-white w-[50%]">{{ $tasa }}
                        </td>
                    </tr>
                    <tr class="text-left bg-[#188ca4]">
                        <td class="xl:text-xl ms:text-xs text-white w-[50%]">Importe gastado
                        </td>
                        <td class="xl:text-xl ms:text-xs text-white w-[50%]">${{ $gasto }}</td>
                    </tr>
                    <tr class="text-left ">
                        <td class="xl:text-xl ms:text-xs text-white w-[50%]">Finalización
                        </td>
                        <td class="xl:text-xl ms:text-xs text-white w-[50%]">{{ $endtime }}
                        </td>
                    </tr>
                </table>
                @endif
                <table class="w-full inset-x-0 bottom-0 h-16">
                    <tr class="text-center">
                        <td class="w-[33.3%] relative">
                            <x-layouts.soporte.spt></x-layouts.soporte.spt>
                        </td>
                        <td class="text-4xl text-white w-[33.3%]">
                            <a href="{{ route('client_profile', ['ad_id' => $adId]) }}">
                                <button
                                    class="bg-cyan-600 rounded-lg p-2 text-white text-2xl mt-3 mb-3 hover:bg-sky-900 hover:text-black w-[90%]">
                                    Estatus Financiero
                                </button>
                            </a>
                        </td>
                        <td class="text-4xl text-white w-[33.3%]">
                            <form action="{{ route('ads_report', ['ad_id' => $adId]) }}" method="GET"
                                target="_blank">
                                @csrf
                                <button type="submit"
                                    class="bg-cyan-600 rounded-lg p-2 text-white text-2xl mt-3 mb-3 hover:bg-sky-900 hover:text-black w-[95%]"
                                    onclick="alerta()">
                                    Descargar reporte
                                </button><br>
                            </form>
                        </td>
                        {{-- TODO: email desabilitado --}}
                        {{-- <td class="text-4xl text-white w-[33.3%]">
                            <form action="{{ route('ad_info_report_email', Auth::user()) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <button type="submit"
                                    class="bg-cyan-600 rounded-lg p-2 text-white text-2xl mt-3 mb-3 hover:bg-sky-900 hover:text-black w-[95%]"
                                    onclick="alerta()">
                                    Enviar Reporte Email
                                </button><br>
                            </form>
                        </td> --}}
                    </tr>
                </table>
            </div>
        </div>
        <div class="box-content w-[40%] h-[90%] inset-x-[55%] bottom-0 absolute">
            <div class="box-content w-[60%]  ml-[23%] mt-[3%]">
                <p class="bg-[#88a2e2] rounded-lg p-2 text-white text-2xl mt-3 mb-3 w-full text-left">Intereses </p>
                <p class="bg-[#deebf7] rounded-lg p-2 text-black text-2xl mt-3 mb-3 w-full text-left">
                    @if (empty($ad['data']) & empty($ca['data'])) {{ $interests }}
                    @else
                        @foreach ($interests as $inte)
                            {{ $inte . ', ' }}
                        @endforeach
                    @endif
                </p>
                <p class="bg-[#88a2e2] rounded-lg p-2 text-white text-2xl mt-3 mb-3 w-full text-left">Lugares </p>
                <p class="bg-[#deebf7] rounded-lg p-2 text-black text-2xl mt-3 mb-3 w-full text-left">
                    @if (empty($ad['data']) & empty($ca['data'])) {{ $locations }}
                    @else
                        @foreach ($locations as $loca)
                            {{ $loca . ', ' }}
                        @endforeach
                    @endif
                </p>
            </div>

            <div class="box-content w-[90%] h-[45%] ml-[3%] mt-[2%]">
                <div class="box-content w-[64%] ml-[22%]">
                    <div class="">
                        <div id="container" class="absolute 2xl:w-[450px] min-[2560px]:w-[600px] 2xl:h-[250px] md:w-[300px] md:h-[250px] "></div>
                    </div>
                </div>
                <div class="box-content w-[64%] ml-[22%] 2xl:pt-[42%] md:pt-[55%] min-[2560px]:pt-[30%]">
                    <div class="">
                        <canvas class="absolute" id="myChart2"></canvas>
                    </div>
                </div>
            </div>

        <script>
            const alerta = () => {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'El reporte se envió al correo electronico',
                    showConfirmButton: false,
                    timer: 2000
                })
            }

            Chart.defaults.backgroundColor = '#FFFFFF';
            Chart.defaults.borderColor = '#FFFFFF';
            Chart.defaults.color = '#FFFFFF';

            const ctx1 = document.getElementById('otro');

            new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: ['la otra tabla'],
                    data: [1,2,3,4,5,6,7,12,21,54,62],
                    datasets: [{
                            label: 'Presupuesto $',
                            data: [25],
                        },
                        {
                            label: 'Importe Gastado $ ',
                            data: [ 100],
                        }
                    ]
                }
            });

            const ctx2 = document.getElementById('myChart2');

            new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: ['<?php echo $grafPresupuesto['dates']; ?>  /  <?php echo $grafPresupuesto['dates']; ?>'],
                    data: [<?php echo $grafPresupuesto['dates']; ?>],
                    datasets: [{
                            label: 'Presupuesto $',
                            data: [<?php echo $grafPresupuesto['pre']; ?>],
                        },
                        {
                            label: 'Importe Gastado $ ',
                            data: [<?php echo $grafPresupuesto['imgast'] / 100; ?>],
                        }
                    ]
                }
            });

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

            Highcharts.setOptions({
                colors: ['#1777ef', '#27bca4']
            });

            Highcharts.chart('container', {
                chart: {
                    type: 'column',
                    zoomType: 'y'
                },
                title: {
                    text: 'Grafica de edad y sexo '
                },
                subtitle: {
                    text: 'Este anuncio tiene un alcance:<?php echo $alc; ?> '
                },
                xAxis: {
                    categories: [<?php
                    if (empty($ad['data']) & empty($ca['data'])) {
                        echo $edad;
                    } else {
                        foreach ($edad as $co) {
                            echo "'" . $co . "'" . ',';
                        }
                    } ?>],
                    title: {
                        text: null
                    },
                    accessibility: {
                        description: 'Countries'
                    }
                },
                yAxis: {
                    title: {
                        text: 'Alcance'
                    },
                    labels: {
                        overflow: 'justify'
                    }
                },
                plotOptions: {
                    column: {
                        dataLabels: {
                            enabled: true
                        }
                    }
                },
                tooltip: {
                    valueSuffix: ' (1000 MT)',
                    stickOnContact: true,
                    backgroundColor: 'rgba(255, 255, 255, 0.93)'
                },
                legend: {
                    enabled: true
                },
                series: [{
                        name: 'Masculino',
                        data: [<?php $z = 1;
                        if (empty($ad['data']) & empty($ca['data'])) {
                            echo $gen;
                        } else {
                            foreach ($gen as $k => $arr) {
                                foreach ($arr as $k => $v) {
                                    $arre[] = $v;
                                    $z++;
                                }
                            }
                            for ($h = 0; $h < $z - 1; $h += 2) {
                                print_r($arre[$h] . ',');
                            }
                        } ?>],
                        borderColor: '#949494'
                    },
                    {
                        name: 'Femenino',
                        data: [<?php $z = 1;
                        if (empty($ad['data']) & empty($ca['data'])) {
                            echo $gen;
                        } else {
                            foreach ($gen as $k => $arr) {
                                foreach ($arr as $k => $v) {
                                    $arre[] = $v;
                                    $z++;
                                }
                            }
                            for ($h = 1; $h < $z; $h += 2) {
                                print_r($arre[$h] . ',');
                            }
                        } ?>]
                    }
                ]
            });
        </script>
    </x-slot>


</x-layouts.body.app1>
