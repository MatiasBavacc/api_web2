# Libreria


## Integrantes:
 * Matias Bava (38961362)
 * Valentino Salerno (43258242)

## Descripción

Hicimos un sistema para registrar libros en una libreria. La relacion es un libro una libreria. Una tabla contiene los atributos id_libro (la cual es la clave primaria), nombre_libro, genero, editorial y id_libreria (clave foranea). La otra tabla contiene los atributos id_libreria (clave primaria), nombre y direccion.

## Despliegue del Sitio

Para desplegar el sitio web en un servidor con Apache y MySQL, sigue estos pasos:

### Requisitos Previos

- Tener instalado XAMPP.
- Asegurarse de que el servidor esté en funcionamiento.

### Pasos para Desplegar

1. **Descargar el Repositorio**
Clona el repositorio en tu máquina local o descarga los archivos ZIP y descomprímelos en tu computadora.

2. **Mover archivos**
Copia la carpeta del proyecto a C:\xampp\htdocs\.

3. **Configurar Conexión**
Edita config.php para ajustar las credenciales de la base de datos.

4. **Configurar Conexión**
Acceder al Sitio: Visita http://localhost/TPEWeb2.

### Acceso Administrador
-Usuario: webadmin
-Contraseña: admin

## DER

![Diagrama Entidad Relación](/der.png)