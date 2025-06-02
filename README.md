# MailBlaster

MailBlaster es un sistema de envío masivo de correos publicitarios desarrollado en Laravel. Permite a los usuarios cargar un archivo CSV con direcciones de correo electrónico, seleccionar una plantilla de diseño o subir una imagen personalizada, y enviar campañas de correo de forma eficiente y segura mediante colas de trabajo.

## Objetivo

Desarrollar una plataforma web para gestionar campañas de email marketing, facilitando la carga de destinatarios, la personalización del contenido y el monitoreo de resultados.

## Características principales

- **Carga de archivo CSV**: Permite subir un archivo con emails, valida los correos y evita duplicados.
- **Selección de plantilla**: Elige entre al menos dos plantillas predefinidas o sube una imagen personalizada para el diseño del correo.
- **Envío masivo con colas**: Utiliza Laravel Queues (driver database) para procesar el envío de correos de manera asíncrona y eficiente.
- **Reportes detallados**: Visualiza el estado de cada campaña, incluyendo correos enviados, fallidos y pendientes.
- **Gestión de campañas y usuarios**: Interfaz web para crear, editar y consultar campañas, plantillas y usuarios.
- **Historial de actividades**: Registro de acciones relevantes en el sistema.

## Requisitos técnicos

- PHP >= 8.1
- Laravel >= 12.x
- MySQL
- [Laravel Excel](https://laravel-excel.com/) para procesar archivos CSV
- Laravel Queues (driver database)
- Laravel Mail
- Node.js y npm (para assets frontend)
- Servidor web compatible (VPS, cPanel, Laravel Forge, etc.)

## Instalación

1. **Clona el repositorio**
   ```sh
   git clone https://github.com/tuusuario/mailblaster.git
   cd mailblaster/MailBlaster
   ```

2. **Instala dependencias**
   ```sh
   composer install
   npm install
   npm run build
   ```

3. **Configura el entorno**
   - Copia `.env.example` a `.env` y ajusta las variables, especialmente la configuración de correo:
     ```
     MAIL_MAILER=smtp
     MAIL_HOST=mail.deur.com.co
     MAIL_PORT=465
     MAIL_USERNAME=test@deur.com.co
     MAIL_PASSWORD=UWy!M2Q2rau*
     MAIL_ENCRYPTION=tls
     MAIL_FROM_ADDRESS=test@deur.com.co
     ```
   - Configura la base de datos MySQL y actualiza las variables `DB_*` en `.env`.

4. **Genera la clave de la aplicación**
   ```sh
   php artisan key:generate
   ```

5. **Ejecuta migraciones y seeders**
   ```sh
   php artisan migrate --seed
   ```

6. **Configura el almacenamiento**
   ```sh
   php artisan storage:link
   ```

7. **Inicia el servidor**
   ```sh
   php artisan serve
   ```

8. **Inicia el worker de colas**
   ```sh
   php artisan queue:work
   ```

## Uso

1. **Accede a la aplicación**
   - URL: [http://localhost:8000](http://localhost:8000) (o la URL de tu servidor)
   - Usuarios de prueba (creados por el seeder):
     - Administrador:  
       Email: `admin@mail.com`  
       Contraseña: `password`
     - Publicista:  
       Email: `publicista@mail.com`  
       Contraseña: `password`

2. **Crea una campaña**
   - Sube un archivo CSV con la columna "email".
   - Selecciona una plantilla o sube una imagen.
   - Inicia el envío masivo.

3. **Monitorea el progreso**
   - Consulta el reporte de la campaña para ver enviados, fallidos y pendientes.
   - Descarga logs y revisa el historial de actividades.

## Estructura del proyecto

- `app/Http/Controllers/`: Controladores principales (campañas, usuarios, plantillas, reportes).
- `app/Jobs/SendCampaignEmailJob.php`: Job para el envío asíncrono de correos.
- `app/Imports/RecipientsImport.php`: Importación y validación de emails desde CSV.
- `app/Mail/CampaignMailable.php`: Lógica de construcción del correo.
- `resources/views/`: Vistas Blade para la interfaz web.
- `database/seeders/`: Seeders para roles y usuarios de prueba.
- `routes/web.php`: Definición de rutas web.

## Despliegue

- Sube el proyecto a tu servidor (VPS, cPanel, Forge, etc.).
- Configura el entorno y ejecuta los comandos de instalación.
- Asegúrate de ejecutar el worker de colas:
  ```sh
  php artisan queue:work
  ```
- Proporciona la URL de acceso y credenciales de prueba si es necesario.

## Notas

- El sistema valida y elimina emails duplicados automáticamente.
- El envío de correos es asíncrono y seguro.
- Puedes crear, editar, deshabilitar y habilitar campañas, plantillas y usuarios desde la interfaz.
- El historial de logs permite auditar todas las acciones importantes.

---

¡Gracias por revisar MailBlaster!  
Para dudas o soporte, contacta al desarrollador.
