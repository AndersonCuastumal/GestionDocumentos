# Gestion de Documentos

## Descripción
Es una aplicación web construida en Windows que se desarrolló con los frameworks Laravel y Vue.js. En el área de backend se ha utilizado el lenguaje de programación PHP y en el frontend se trabajó con JavaScript. Se desarrolló un CRUD de registro de documentos usando tecnología MVC y servicios web REST. La interfaz de usuario es funcional e interactiva.

## Capturas de Pantalla

### Inicio de sesión
Esta captura de pantalla muestra la página de inicio de sesión de la aplicación. Se requiere ingresar un correo electrónico y una contraseña válidos para acceder a los servicios.
![Login](/Imagenes_proyecto/Login.png)

### Listado de Documentos
En esta captura de pantalla, se muestra el listado de todos los documentos registrados en la base de datos. La lista se presenta con paginación para facilitar la navegación.
![Listado documentos](/Imagenes_proyecto/Lista_documentos.png)

### Registrar Nuevo Documento
Aquí se puede ver la interfaz para registrar un nuevo documento en la aplicación. Cada documento tiene asignado un código único.
![Registrar nuevo doc](/Imagenes_proyecto/Registrar_nuevo_doc.png)

### Editar Documento
En esta captura de pantalla se muestra la funcionalidad de edición de un documento. Se pueden modificar las características del documento y se genera un nuevo código único en caso necesario.
![editar documento](/Imagenes_proyecto/Editar_documento.png)

### Búsqueda
El buscador de la aplicación permite filtrar y encontrar rápidamente los documentos de interés. Esta captura muestra la interfaz de búsqueda.
![Busqueda](/Imagenes_proyecto/busqueda.png)

### Eliminar Documento
La función de eliminar documentos permite eliminar de la base de datos un documento específico. En esta captura se muestra la confirmación de eliminación de un documento.
![eliminar doc](/Imagenes_proyecto/eliminar_doc.png)


Estas capturas de pantalla ofrecen una visión general de las diferentes funcionalidades de la aplicación.

### Características de interfaz de usuario:
- Login de usuario.
- Logout de usuario.
- Tabla o grilla de datos de los documentos.
- Búsqueda de registro de documentos.
- Creación de registro de documentos.
- Edición de registro de documentos.
- Eliminación de registro de documentos.

### Nota:
El funcionamiento de registro de documentos no se debe repetir los códigos de documentos consecutivos, es decir, si el consecutivo 1 ya fue usado en un documento con el mismo Tipo y Proceso, este número no debe volver a utilizarse. En la edición del registro del documento, si el tipo o el proceso del documento cambian, se debe recalcular el código. Por ejemplo, si ya existe el código de documento "CON-DEV-5" y el usuario registra un nuevo documento con el mismo tipo y proceso, el código a generarse para este documento es "CON-DEV-6". Lo mismo aplica cuando se actualiza el registro del documento.

### Versión de las herramientas utilizadas:
- Laragon Full: 6.0
- Node.js: v18.8.0
- PHP: 8.1.10
- HeidiSQL: 12.1.0.6537
- Postman: 10.15.0
- Bootstrap
- DataTables
- FontAwesome
- SweetAlert


## Nota:
Después del paso 1 de instalación, se recomienda utilizar la guía "Instalacion.pdf" que se encuentra en el repositorio.

## Instalación
1. Descarga el repositorio. Verifica los siguientes archivos en la descarga: la base de datos y el proyecto con el desarrollo de backend y frontend. En la carpeta "pruebatecnica" encontrarás el backend y el frontend en la carpeta "frontpruebatecnica" e "Instalacion.pdf".
2. Instala Laragon Full: 6.0 desde el enlace [https://laragon.org/download/index.html](https://laragon.org/download/index.html). Selecciona la opción "Download Laragon - Full (173 MB)".
3. Después de instalar Laragon, abre la aplicación y carga la base de datos SQL llamada "BaseDatosSQL".
4. Copia las carpetas "frontpruebatecnica" y "pruebatecnica" en la carpeta raíz de Laragon, por ejemplo, la ruta del directorio puede ser: `C:\laragon\www`.
5. Abre la terminal o consola de Laragon.
6. Instala las dependencias del backend. Con la terminal de Laragon abierta, ejecuta los siguientes comandos:
	- cd pruebatecnica\
  	- composer install
  	- npm install
	- Luego, cierra la terminal.
7. Instala las dependencias del frontend. Con la terminal de Laragon abierta, ejecuta los siguientes comandos:
	- cd frontpruebatecnica\
	- npm install
	- npm install vue vue-router vue-axios @fortawesome/fontawesome-free axios bootstrap sweetalert2 jquery datatables.net js-cookie --save
	- Luego, cierra la terminal.
8. Lanza la aplicación frontend. Con la terminal de Laragon abierta, ejecuta el siguiente comando:
	- cd frontpruebatecnica\
	- npm run serve
	- Esto mostrará un mensaje con la ruta de localhost donde se está ejecutando la aplicación web. Por ejemplo:
	- App running at:
		- Local: http://localhost:8080/
		- Network: http://192.168.1.6:8080/
9. Abre un navegador (Chrome, Firefox, etc.) y pega la siguiente ruta: "http://localhost:8080/"

## Consideraciones
- Antes de lanzar la aplicación, verifica que la herramienta Laragon esté en estado de ejecución o funcionando correctamente.

## Contribución

Es posible crear nuevas características de valor a este proyecto donde se puedan crear diferentes perfiles como administrador y usuario final, donde el administrador pueda ayudar con la gestión de usuarios o administradores, y el perfil usuario final pueda gestionar únicamente sus propios documentos. 

## Credenciales de inicio de sesión
- Email: admin@email.com
- Contraseña: admin

## Contacto

Si tienes alguna pregunta o comentario, puedes contactarme a través de [correo electrónico](ander.ch95@gmail.com) o [LinkedIn](https://www.linkedin.com/in/andersoncuastumal/).


