# sis2-Ketal
# Sistema de Punto de Venta (TPS) en Ketal
## Descripción del Proyecto  

El objetivo principal de este proyecto es desarrollar e implementar un Sistema de Punto de Venta (TPS) en Ketal con el fin de optimizar y centralizar las operaciones comerciales. Este sistema permitirá mejorar la eficiencia operativa a través de la automatización de tareas clave como el registro de ventas, el control de inventario, la gestión de pedidos a proveedores, y la actualización y mantenimiento de la información de clientes, incluyendo los funcionarios. Nuestro TPS estará diseñado para proporcionar automatización en el proceso de ventas y sincronización en 
tiempo real del inventario.


![Logo 1](https://th.bing.com/th/id/R.bef22aff30dcbcfec3762bd463c93e0f?rik=dkjkkaq46emZxw&pid=ImgRaw&r=0)
![Logo 2](https://th.bing.com/th/id/R.cbf8d13a339e78aeaec5300df37ebbee?rik=sVn05LDxQbZetw&pid=ImgRaw&r=0)
![Logo 3](https://th.bing.com/th/id/R.af379f239fe49b1e0491b1c73ce820a7?rik=Vz%2fExLWryP0Z9A&pid=ImgRaw&r=0)


## Herramientas usadas 

Frontend: HTML, CSS, JS, Bootstrap
Backend: PHP
BD: PostgreSQL


## Configuración del entorno de desarrollo

Este documento describe los pasos necesarios para configurar y ejecutar el proyecto en un entorno local usando XAMPP y PostgreSQL.

### Requisitos previos

Antes de comenzar, asegúrate de tener instalados los siguientes programas:
- **XAMPP** 
- **PostgreSQL**
- **Git** 

### Instalación y configuración

#### 1. Instalación de XAMPP y PostgreSQL

- **XAMPP:**
  - Descargar desde [Apache Friends](https://www.apachefriends.org/index.html) y seguir las instrucciones de instalación.
  - Asegúrate de incluir PHP y el servidor Apache.

- **PostgreSQL:**
  - Descargar desde [PostgreSQL Official Website](https://www.postgresql.org/download/).
  - Instalar PostgreSQL y configurar una contraseña para el usuario `postgres`.

#### 2. Configuración de la Base de Datos

- Utilizar pgAdmin o la línea de comandos de PostgreSQL para crear una nueva base de datos llamada `ketal`.
- Configurar los detalles de conexión de la base de datos directamente en los scripts PHP donde se necesite la conexión.

#### 3. Clonar el Repositorio (Opcional)

Si el proyecto está en un repositorio Git, clonarlo en la carpeta local deseada:

git clone https://github.com/TheBig-C/sis2-Ketal.git  


#### 4. Configurar XAMPP

- Mover la carpeta del proyecto clonada a `C:\xampp\htdocs\` (o el directorio equivalente en tu sistema operativo).
- Abrir el panel de control de XAMPP y asegurarse de que los servicios Apache y PostgreSQL estén en ejecución.

### Ejecución del proyecto

- Abrir un navegador y dirigirse a `http://localhost/sis2-ketal` para acceder a la aplicación.

### Verificación de la conexión a la base de datos

- Verificar que los scripts PHP estén correctamente configurados para conectar con PostgreSQL. Revisar que el host, nombre de la base de datos, usuario y contraseña estén correctamente especificados en el código PHP.

