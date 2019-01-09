# Sistema de gestión de objetos de aprendizaje

El presente proyecto consiste en una aplicación web que permite gestionar y catalogar objetos de aprendizaje comprimidos con extensión .zip.

## Especificaciones:

Para poder ejecutar el proyecto es necesario disponer de un servidor web, este puede ser local o remoto. Si se utiliza un servidor local se recomienda instalar [Wampserver](http://www.wampserver.es/) en el caso de que se desee usar un servidor web remoto se recomienda usar el hosting gratuito de [000Webhosting](https://www.000webhost.com/).

### Prerequisitos:
Para el correcto funcionamiento del proyecto se requiere:
* Apache 2.4.2
* PHP 5.4.3
* Mysql 5.5.24

### Instalacion:
* Descargar el proyecto directamente desde el siguiente [enlace](https://gitlab.com/Diego2525/sistemadegestiondeobjetosdeaprendizaje/-/archive/master/sistemadegestiondeobjetosdeaprendizaje-master.zip)
* Es necesario cargar la base de datos que se va a utilizar, para esto se abre localhost y se busca phpmyadmin, en este sistema vamos a la opcion importar y selecinamos el archivo sgoa.sql contenido en la descarga, click en continuar para importar la base de datos.
* Copiar el contenido de la carpeta excepto sgoa.sql a la ruta de instalción, que por defecto suele ser C:\xampp\htdocs 
* Abrir un navegador cualquiera y se escribe la siguiente ruta: loacalhost/sgoa
* Continuar como lo indica el [manual de usuario](https://raw.githubusercontent.com/Dayarenth/SistemaDeGestionDeObjetosDeAprendizaje/master/manual_de_usuario.pdf)

### Demo del proyecto en funcionamiento:
Para probar las funcionalidades de acuerdo al [manual de usuario](https://raw.githubusercontent.com/Dayarenth/SistemaDeGestionDeObjetosDeAprendizaje/master/manual_de_usuario.pdf) se puede dirigir al siguiente [enlace](http://jacr.000webhostapp.com/sgoa/)

## Autores
* Balcazar Cesar
* Guerrero Sofia
* Portero Diego

