# TPI: Administración de Egresados

## CRITERIOS DE EVALUACIÓN

Aplicar los contenidos abordados en la asignatura Taller de Lenguajes I para desarrollar una aplicación web en PHP, segura y accesible.

## CONSIGNAS

Se deberá realizar una Aplicación Web (programas PHP y Base de Datos) de acuerdo con los requerimientos establecidos.

### Aplicación: Administración de Egresados

Una Universidad desea brindar una plataforma de registro para los egresados de sus distintas carreras. Para eso se deberá desarrollar la aplicación web con la siguiente funcionalidad.

### Página pública

El navegante completa un formulario de registro como Egresado con los siguientes datos:

- Nombre y Apellido
- Carrera
- Nro. de matrícula
- Email
- Teléfono

Al cargar un formulario se deberá enviar un email con los datos del formulario a todas las direcciones de correo cargadas por el Administrador en el Panel.

Además, deberá registrar una solicitud de alta de egresado.

### Panel de Administración

de acceso restringido, en donde un usuario Administrador tendrá acceso a tareas solamente permitidas para ese rol.
El acceso al panel se deberá validar con usuario y contraseña.
Esta información deberá estar guardada en la misma base de datos de la aplicación El Administrador deberá hacer las siguientes funciones:

- ABM de tabla de Carreras
- ABM de tabla de emails para recibir alertas de nuevos Egresados
- Confirmar o rechazar solicitudes de egresados
- Generar un listado con todos los egresados y sus datos de contacto
- Cambiar su contraseña.

## Link local

- [Localhost](http://localhost/taller1/TPI/index.php)
- [PhpMyAdmin-DB](http://localhost/phpmyadmin/index.php?route=/database/structure&db=taller1-tpi)

## Links útiles

- [Intalación de TailwindCSS](https://tailwindcss.com/docs/installation/tailwind-cli)
- [Ayuda para modelar componentes](https://preline.co/docs/alerts.html)
- [Favicon elegido](https://icon-icons.com/es/icono/universidad/180696)
