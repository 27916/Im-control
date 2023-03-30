<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

# Sobre Laravel:
Para el desarrollo de este proyecto se utilizó el framework Laravel, el cual es un framework de código abierto para desarrollar aplicaciones y servicios web con PHP. <br>
El cual se ejecuta en el lado del servidor, es decir, el código se ejecuta en el servidor y el resultado se envía a la computadora del usuario, en lugar de ejecutarse en el navegador del usuario.

---
#  Prelude:
Para que el desarrollo sea más ameno y más visual, es recomendable que el desarrollador cuente con una herramienta de trabajo que le de gusto trabajar.

Mis recomendaciones son:

## Editor de código | IDE:
- **[Visual Studio Code](https://code.visualstudio.com/)**
- **[PHP Storm](https://www.jetbrains.com/es-es/phpstorm/)**
- **[IntelliJ IDEA](https://www.jetbrains.com/idea/)**
(Configurando los plugins necesarios)

## Temas para VS Code | IDE Jetbrains:
Los temas son gustos personales, por lo que se recomienda que el desarrollador elija el que más le guste.

En estas páginas se encuentran una gran variedad de temas para VS Code y para los IDE de Jetbrains (PHP Storm, IntelliJ IDEA, etc.) lo mejor esque te muestran una vista previa de como se verá el tema en el editor de código sin necesidad de instalar cada tema para probarlo:

- **[Vs Code themes](https://vscodethemes.com/)**
- **[Themes jetbrains ](https://plugins.jetbrains.com/search?tags=Theme)**

**Opcional Escoger un Icon Theme**

## Plugins para VS Code | IDE Jetbrains:
**Para el caso de PHP Storm, ya viene con los plugins necesarios para trabajar con PHP y Larvel.**

### VS Code
- **[Auto Rename Tag](https://marketplace.visualstudio.com/items?itemName=formulahendry.auto-rename-tag)**
- **[Auto Close Tag](https://marketplace.visualstudio.com/items?itemName=formulahendry.auto-close-tag)**
- **[Path Intellisense](https://marketplace.visualstudio.com/items?itemName=christian-kohler.path-intellisense)**
- **[PHP Intelephense](https://marketplace.visualstudio.com/items?itemName=bmewburn.vscode-intelephense-client)**
- **[PHP Debug](https://marketplace.visualstudio.com/items?itemName=xdebug.php-debug)**
- **[Code Spell Checker](https://marketplace.visualstudio.com/items?itemName=streetsidesoftware.code-spell-checker)**
- **[Indent Rainbow](https://marketplace.visualstudio.com/items?itemName=oderwat.indent-rainbow)**
- **[Better Comments](https://marketplace.visualstudio.com/items?itemName=aaron-bond.better-comments)**
- **[Tailwind CSS IntelliSense](https://marketplace.visualstudio.com/items?itemName=bradlc.vscode-tailwindcss)**
- **[Laravel Extension Pack](https://marketplace.visualstudio.com/items?itemName=onecentlin.laravel-extension-pack)**
- **[Editor Config](https://marketplace.visualstudio.com/items?itemName=EditorConfig.EditorConfig)**
- **[Image Preview](https://marketplace.visualstudio.com/items?itemName=kisstkondoros.vscode-gutter-preview)**
- **[Color Highlight](https://marketplace.visualstudio.com/items?itemName=naumovs.color-highlight)**



---
# Setup del ambiente de desarrollo:
## Requerimientos
- **[Node Js v16 o superior](https://nodejs.org/es/)**
- **[Composer 2.2 o superior](https://getcomposer.org/Composer-Setup.exe)**
- **[Php 8.1.12 o superior](https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/8.1.12/xampp-windows-x64-8.1.12-0-VS16-installer.exe)**


## Instalación de dependencias
Para ejecutar el proyecto es necesario instalar las dependencias con los siguientes comandos en la terminal:
## Node Js
```bash
npm install
```

## PHP
```bash
composer install
```

## Archivo .env
Para la ejecución del proyecto es necesario un archivo ```.env``` en la raíz del proyecto, el cual contendrá las variables de ambiente necesarias para la ejecución del proyecto.

Este archivo es necesario pedirlo en el grupo, ya que contiene información sensible.

---
# Ejecución del proyecto en modo desarrollo (local):
Para la ejecución debe tener configuradas las variables de ambiente que se encuentran en el archivo ``` .env ```

## Levantar el servidor
Para ejecutar el proyecto en modo desarrollo, es necesario abrir dos terminales  
En la primera correr el siguiente comando:
```bash
npm run watch
```
En la segunda correr el siguiente comando:
```bash
php artisan serve
```
**Opcional**  
Abrir una tercera terminal para ejecutar cualquier otro comando que se necesite.

___
# Consideraciones:

## Diseño
- Se refactorizaron las vistas y la estructura con respecto a la primer versión base.
- Ahora las vistas Extienden de un layout o plantilla base,  ubicado en la siguiente ruta ```resources/views/components/layouts``` con el nombre ```app.blade.php```.
- Se crearon componentes para los elementos que se repiten en las vistas, estos componentes se encuentran en la siguiente ruta ```resources/views/components```.
- Los videos e imagenes se encuentran en la siguiente ruta ```public/images``` y ```public/videos``` respectivamente.
- Para acceder a las imagenes y videos, es necesario hacer uso de la función asset() con la siguiente sintaxis:
```code
    {{ asset('images/nombre_imagen.extensión') }}
    {{ asset('videos/video.extensión') }}
```

- Ejemplo:
```code
    <img src="{{ asset('images/nombre_imagen.extensión') }}" alt="nombre_imagen">
```

## Layout App
- El layout ```app.blade.php``` contiene la estructura base de la aplicación, en el cual se incluyen los estilos y scripts necesarios para el funcionamiento de la aplicación.
- Por defecto, esta configurado para que las vistas que extiendan de este layout, tengan un header y un footer, pero si se desea que la vista no tenga alguno de estos elementos, se pueden omitir.
- Este layout contiene los siguientes elementos:
    - Header: <br> Contiene el logo de la aplicación y el menú de navegación.
    - Footer: <br> Contiene el footer 
    - title: <br> Es el título de la página, el valor será aplicado al title de vista. 
    - meta description: <br> Es la descripción de la página, el valor será aplicado al meta description de la vista.
    - content: <br> Es el contenido de la vista, este elemento es obligatorio y es aquí donde se introducirá el contenido de cada página.

- Los elementos se pueden idenficar con la siguiente sintaxis:
```code
    <x-slot name="nombre_elemento">contenido</x-slot>
```
- Ejemplo:
```code
    <x-slot name="title">Login</x-slot>
```

## Emails
- Los correos electrónicos se encuentran en la siguiente ruta ```resources/views/emails```.
- Para fines prácticos, se creó un correo de prueba, hasta que se tenga un correo disponible para la aplicación.
- Una vez tengamos un correo disponible, se debe cambiar las credenciales y configuraciones en el archivo ```.env``` con las siguientes variables:
```code
    MAIL_MAILER=smtp
    MAIL_HOST=host_email
    MAIL_PORT=225
    MAIL_USERNAME=your_username
    MAIL_PASSWORD=your_password
    MAIL_ENCRYPTION=tls
    MAIL_FROM_ADDRESS=your_email
    MAIL_FROM_NAME="${APP_NAME}"
```


---
# Documentación útil:
## Laravel 
- **[Laravel Oficial](https://laravel.com/docs/10.x)**
- **[Blade Templates](https://laravel.com/docs/10.x/blade)**
- **[Blade Components](https://laravel.com/docs/10.x/blade#components)**
- **[Blade Slots](https://laravel.com/docs/10.x/blade#slots)**
- **[Laravel Lang](https://laravel-lang.com/)**
- **[Views](https://laravel.com/docs/10.x/views)**
- **[Routes](https://laravel.com/docs/10.x/routing)**
- **[Controllers](https://laravel.com/docs/10.x/controllers)**
- **[Migrations](https://laravel.com/docs/10.x/migrations)**
- **[Models](https://laravel.com/docs/10.x/eloquent)**
- **[CSRF](https://laravel.com/docs/10.x/csrf)**
- **[Request](https://laravel.com/docs/10.x/requests)**
- **[Response](https://laravel.com/docs/10.x/responses)**
- **[Validation](https://laravel.com/docs/10.x/validation)**
- **[Reglas de Validación](https://laravel.com/docs/10.x/validation#available-validation-rules)**
- **[API Documentation](https://laravel.com/api/9.x/doc-index.html)**
- **[Eloquent Factories](https://laravel.com/docs/10.x/eloquent-factories#main-content)**
- **[Eloquent Migrations](https://laravel.com/docs/10.x/migrations#creating-columns)**

## Tailwind CSS
- **[Tailwind CSS Oficial](https://tailwindcss.com/docs/installation)**
- **[Animaciones](https://tailwindcss.com/docs/animation)**
- **[Transiciones](https://tailwindcss.com/docs/transition-property)**
- **[Tailwind Play](https://play.tailwindcss.com/)**

## Git
- **[Git Oficial](https://git-scm.com/docs)**
- **[Github y trabajo en equipo](https://www.youtube.com/watch?v=sH9g77J92ns&t=997s)**
- **[Repositorio del proyecto](https://github.com/TheAnonymousDarck/Im-control)**
