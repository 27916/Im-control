<style>
    /*poppup-------------------*/
.overlay{
background: rgba(0,0,0,0.3);
position: fixed;
top: 10%;
bottom: 5%;
left: 53%;
right: 0;
display: flex;
align-items:center;
justify-content: center;
visibility: hidden;
}
.overlay .active{
visibility: visible;
}


.popup {
box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.3);
border-radius: 3px;
text-align: center;
width: 95%;
max-width: 600px;
transition: .3s ease all;
opacity: 0;
padding: 17px;
}
.button{
position: absolute;
z-index: 1;
}

.popup .btn-cerrar-popup{
font-size: 16px;
line-height: 20px;
display: block;
text-align: right;
color: #0ea1e6;
transition: .3s ease all;
}
.popup .btn-cerrar-popup :hover{
color: black ;
}
.popup h2 {
font-size: 36px;
font-weight: 600;
margin-bottom: 10px;
opacity: 0;
}
.popup p {
font-size: 12px;
font-weight: 300;
margin-bottom: 30px;
opacity: 0;
}
/*ANIMACIONES POPUP*/
.popup.active {	transform: scale(1); opacity: 1; }
.popup.active h2 { animation: entradaTitulo .8s ease .5s forwards; }
.popup.active p { animation: entradaSubtitulo .8s ease .5s forwards; }
.popup.active .contenedor-inputs { animation: entradaInputs 1s linear 1s forwards; }
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

.contenedor-acordeon {
width: 100%;
max-width: 800px;
margin: auto;
margin-top: 50px;
padding-left:7%;
padding-right: 7%;
padding-bottom: 7%;
}

.contenedor-acordeon h2 {
text-align: center;
font-size: 20px;
margin-bottom: 20px;
}

.contenedor label {
display: block;
padding: 10px;
font-size: 12px;
cursor: pointer;
margin-bottom: 10px;
transition: all 300ms ease;
background-color:#158ca7;
border-radius:20px;
color: white;
height: 20%;

}

.contenedor label:hover {
background: #152a3a;
}

.acordeon .contenido-acordeon {
padding: 0%;
margin: 0px 20px;
max-height: 0px;
overflow: hidden;
transition: all 300ms ease;
}

.btn-acordeon:checked~.contenido-acordeon {
max-height: 600px;
padding: 15px 0px;
}

.btn-acordeon {
display: none;
}
@media screen and (max-widht:900px) {
.contenedor-acordeon {
    width: 90%;
}
}

</style>
<div class="contenedor">
<button id="btn-abrir-popup" class="btn-abrir-popup btn bg-[#152a3a] rounded-full text-white text-2xl p-3 item-center w-[100%] hover:bg-sky-700 ">Ayuda y soporte</button>
    <div class="overlay z-50" id="overlay">
        <div class="popup absolute " id="popup" style="font-family: 'Manrope',serif; background-image:url(https://im-control.com//main/public/images/ImControl/window.png);" >
            <a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="fas fa-times"></i></a>
            <div class="contenedor-acordeon">
                <h2>¡Hola!</h2>
                <p>¿Tienes dudas sobre la app? Da Click en una pregunta frecuente. Y descubre la información.</p>
                <div class="acordeon">
                    <input type="radio" name="acordeon" id="btn-acordeon1" class="btn-acordeon">
                    <label for="btn-acordeon1">
                        ¿Cómo puedo ver las campañas?
                    </label>
                    <div class="contenido-acordeon">
                        <p>Las campañas se encuentran en cada categoría de red social.
                            Pará acceder a las canpañas da clic en el icono de la red social de la cual quieres visualizar las campañas.</p>
                    </div>
                </div>
                <div class="acordeon">
                    <input type="radio" name="acordeon" id="btn-acordeon2" class="btn-acordeon">
                    <label for="btn-acordeon2">
                        ¿Cómo se cual campaña está activa o caducada?
                    </label>
                    <div class="contenido-acordeon">
                        <p>Después de acceder a la red social de la cual te interesa ver las campañas.
                            Podrás ver el nombre de las campañas en color gris o en color verde.
                            Las campañas con su nombre en color verde son las campañas con estatus “activa”
                            Las campañas con su nombre en color gris son las campañas con estatus “caducada”</p>
                    </div>
                </div>
                <div class="acordeon">
                    <input type="radio" name="acordeon" id="btn-acordeon3" class="btn-acordeon">
                    <label for="btn-acordeon3">
                        ¿Qué información veo en las campañas caducadas?
                    </label>
                    <div class="contenido-acordeon">
                        <p> Las campañas con estatus caducada tienen información del periodo de tiempo en el que estuvieron activas.
                            Por lo que se podrá visualizar sólo la información de los últimos 90 días de actividad</p>
                    </div>
                </div>
                <div class="acordeon">
                    <input type="radio" name="acordeon" id="btn-acordeon4" class="btn-acordeon">
                    <label for="btn-acordeon4">
                        ¿Cómo generó un reporte?
                    </label>
                    <div class="contenido-acordeon">
                        <p> Los reportes sólo se pueden generar de las campañas activas.
                            Puedes generar un reporte cuando das clic en el icono “generar reporte” que está debajo de la información de la campaña activa.
                            Se mostrará un mensaje "el reporte se envió al correo electrónico".</p>
                    </div>
                </div>
                <div class="acordeon">
                    <input type="radio" name="acordeon" id="btn-acordeon5" class="btn-acordeon">
                    <label for="btn-acordeon5">
                        ¿A dónde se envían los reportes cuando se generan?
                    </label>
                    <div class="contenido-acordeon">
                        <p> Se genera un reporte en pdf que es enviado a tu correo electrónico.
                            Registrado en la aplicación.</p>
                    </div>
                </div>

            </div>


        </div>
    </div>
</div>

<script>
    var btnAbrirPopup = document.getElementById('btn-abrir-popup'),
        overlay = document.getElementById('overlay'),
        popup = document.getElementById('popup'),
        btnCerrarPopup = document.getElementById('btn-cerrar-popup');

    btnAbrirPopup.addEventListener('click', function() {
        overlay.classList.add('active');
        popup.classList.add('active');
    });

    btnCerrarPopup.addEventListener('click', function(e) {
        e.preventDefault();
        overlay.classList.remove('active');
        popup.classList.remove('active');
    });
</script>
