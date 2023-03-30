    <style>
        /*poppup-------------------*/
        .overlay1 {
            background: rgba(0, 0, 0, 0.3);
            position: fixed;
            top: 10%;
            bottom: 5%;
            left: 10%;
            right: 0;
            display: flex;
            align-items: center;
            justify-content: left;
            visibility: hidden;
        }

        .overlay1 .active1 {
            visibility: visible;
        }


        .popup1 {
            box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.3);
            border-radius: 3px;
            text-align: center;
            width: 90%;
            max-width: 400px;
            transition: .3s ease all;
            opacity: 0;
            padding: 17px;
        }

        .button {
            position: absolute;
            z-index: 1;
        }

        .popup1 .btn1-cerrar-popup1 {
            font-size: 16px;
            line-height: 20px;
            display: block;
            text-align: right;
            color: #0ea1e6;
            transition: .3s ease all;
        }

        .popup1 .btn1-cerrar-popup1 :hover {
            color: black;
        }

        .popup1 h2 {
            font-size: 36px;
            font-weight: 600;
            margin-bottom: 10px;
            opacity: 0;
        }

        .popup1 p {
            font-size: 20;
            font-weight: 300;
            margin-bottom: 40px;
            opacity: 0;
        }

        /*ANIMACIONES popup1*/
        .popup1.active1 {
            transform: scale(1);
            opacity: 1;
        }

        .popup1.active1 h2 {
            animation: entradaTitulo .8s ease .5s forwards;
        }

        .popup1.active1 p {
            animation: entradaSubtitulo .8s ease .5s forwards;
        }

        .popup1.active1 .contenedor1-inputs {
            animation: entradaInputs 1s linear 1s forwards;
        }

        @keyframes entradaTitulo {
            from {
                opacity: 0;
                transform: translateY(-25px);
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes entradaSubtitulo {
            from {
                opacity: 0;
                transform: translateY(25px);
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .contenedor1-acordeon1 {
            width: 100%;
            max-width: 800px;
            margin: auto;
            margin-top: 50px;
            padding-left: 7%;
            padding-right: 7%;
            padding-bottom: 7%;
        }

        .contenedor1-acordeon1 h2 {
            text-align: center;
            font-size: 50px;
            margin-bottom: 30px;
        }

        .contenedor1 label {
            display: block;
            padding: 10px;
            font-size: 12px;
            cursor: pointer;
            margin-bottom: 10px;
            transition: all 300ms ease;
            background-color: #158ca7;
            border-radius: 20px;
            color: white;
            height: 20%;

        }

        .contenedor1 label:hover {
            background: #152a3a;
        }

        .acordeon1 .contenido-acordeon1 {
            padding: 0%;
            margin: 0px 20px;
            max-height: 0px;
            overflow: hidden;
            transition: all 300ms ease;
        }

        .btn1-acordeon1:checked~.contenido-acordeon1 {
            max-height: 600px;
            padding: 15px 0px;
        }

        .btn1-acordeon1 {
            display: none;
        }

        @media screen and (max-widht:900px) {
            .contenedor1-acordeon1 {
                width: 90%;
            }
        }
    </style>
    <div class="contenedor1">
        <button id="btn1-abrir1-popup1" class="btn1-abrir1-popup1 btn1 bg-cyan-600 rounded-full text-white text-3xl p-3 item-center  hover:bg-sky-700 ">Contactanos</button>
        <div class="overlay1 z-50" id="overlay1">
            <div class="popup1 absolute " id="popup1" style="font-family: 'Manrope',serif; background-image:url(https://im-control.com//main/public/images/ImControl/window.png);">
                <a href="#" id="btn1-cerrar-popup1" class="btn1-cerrar-popup1"><i class="fas fa-times"></i></a>
                <div class="contenedor1-acordeon1">
                    <h2 class="text-cyan-600">Contáctanos</h2>
                    <div class="acordeon1">
                    <label for="btn1-acordeon11">Correo.imco@gmail.com</label>
                    <label for="btn1-acordeon11">Facebook/imco</label>
                    <label for="btn1-acordeon11">Instagram/@imco</label>
            </div>
        </div>
    </div>

    <script>
        var btn1abrir1popup1 = document.getElementById('btn1-abrir1-popup1'),
            overlay1 = document.getElementById('overlay1'),
            popup1 = document.getElementById('popup1'),
            btn1Cerrarpopup1 = document.getElementById('btn1-cerrar-popup1');

        btn1abrir1popup1.addEventListener('click', function() {
            overlay1.classList.add('active1');
            popup1.classList.add('active1');
        });

        btn1Cerrarpopup1.addEventListener('click', function(e) {
            e.preventDefault();
            overlay1.classList.remove('active1');
            popup1.classList.remove('active1');
        });
    </script>