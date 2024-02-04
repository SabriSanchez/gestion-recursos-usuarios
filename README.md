# gestion-recursos-usuarios
Resources management web software that allows resources, users and booking registrations written in PHP + MySQL + Boostrap + Spanish this time only

## Descripción funcional

Se trata de una aplicación web para la gestión y reserva de recursos, que debe ser instalada en un servidor web, y que puede ser utilizada desde un navegador web, como así también desde un móvil o una tablet.

Un usuario tipo administrador puede:
- Conocer el estado, crear, modificar o eliminar usuarios
- Conocer el estado, crear, modificar o eliminar recursos
- Conocer el estado y eliminar reservas de cualquier usuario

Un usuario normal puede:
- Conocer el estado, crear o eliminar sus propias reservas

## Lo que aprendí o practiqué

- Gestión de sesiones en PHP
- Creación de usuarios, gestión de accesos y rol del administrador
- Conexión e inicialización de una base de datos
- Encriptación de contraseñas mediante hash para su almacenamiento y autenticación
- Arquitectura de single page aplication para el área del administrador
- Uso de Bootstrap para diseño UI/UX y web responsiva

## Fuera del alcance 

- Control de accesos a la API
- Consultas a base de datos y tablas paginadas
- Tratar a los turnos como rangos horarios en lugar de cadenas de texto

## Dependencias

- PHP 
- MySQLI
- MySQL

## Instalación y configuración

1. Mover el directorio raíz de este código a un sitio del servidor web
2. Modificar del fichero /utiles/bdd.php, indicando en la variable $host la ruta web donde se ha desplegado el proyecto
3. Modificar del fichero /utiles/bdd.php, $user, $pass y $db_name, indicando los parámetros de conexión a la base de datos MySQL que se tengan.
4. Ingresar con un navegador a la raíz del proyecto (donde está el fichero index.php) para que se creen automáticamente las estructuras de base de datos
5. Ingresar a la aplicación con las credenciales "admin" y contraseña "admin", que deben ser cambiadas inmediatamente