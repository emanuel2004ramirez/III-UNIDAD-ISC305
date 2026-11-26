# III-UNIDAD-ISC305

API REST CRUD de personas desarrollada con Laravel para la asignatura **ISC-305 Programacion Web**. La aplicacion responde en formato JSON y permite listar, consultar, crear, actualizar y eliminar personas.

## Requisitos

- PHP 8.2 o superior con la extension `pdo_mysql` habilitada.
- Composer 2.
- MySQL 8.0 (local o mediante Docker).
- Git.
- Postman para probar los endpoints.

## Estructura del repositorio

El proyecto Laravel se encuentra en la carpeta `backend`.

```text
III-UNIDAD-ISC305/
|-- backend/
|-- README.md
`-- postman/        # Coleccion exportada de Postman (cuando se agregue)
```

## Instalacion

Clone el repositorio e instale las dependencias desde la carpeta `backend`:

```bash
git clone https://github.com/emanuel2004ramirez/III-UNIDAD-ISC305.git
cd III-UNIDAD-ISC305/backend
composer install
```

Cree el archivo local `.env` usando como referencia la configuracion mostrada en la siguiente seccion y genere la clave de la aplicacion si se trata de una instalacion nueva:

```powershell
php artisan key:generate
```

> El archivo `.env` contiene configuracion local y posibles secretos; no debe publicarse en Git.

## Configuracion de MySQL

Cree la base de datos con codificacion UTF-8:

```sql
CREATE DATABASE isc305_unidad3
CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Configure estas variables en `backend/.env` con el usuario y la contrasena correspondientes a su servidor MySQL:

```dotenv
APP_NAME="API Personas ISC305"
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=isc305_unidad3
DB_USERNAME=TU_USUARIO_MYSQL
DB_PASSWORD="TU_CLAVE_MYSQL"

SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=sync
```

Si MySQL se ejecuta en Docker y publica el puerto `3306`, se utiliza la misma configuracion. Limpie la configuracion almacenada y ejecute las migraciones:

```bash
php artisan config:clear
php artisan migrate
```

## Ejecutar la API

Desde `backend`, inicie el servidor de desarrollo:

```bash
php artisan serve
```

La API quedara disponible normalmente en `http://127.0.0.1:8000`. Para verificar sus rutas:

```bash
php artisan route:list --path=api
```

## Endpoints

Todas las solicitudes deben incluir el encabezado `Accept: application/json`. Las solicitudes `POST` y `PUT` tambien deben incluir `Content-Type: application/json`.

| Metodo | Endpoint | Descripcion | Respuesta esperada |
| --- | --- | --- | --- |
| GET | `/api/hola` | Mensaje de bienvenida | `200 OK` |
| GET | `/api/personas` | Listar todas las personas | `200 OK` |
| GET | `/api/personas/{id}` | Consultar una persona | `200 OK` o `404 Not Found` |
| POST | `/api/personas` | Crear una persona | `201 Created` o `422 Unprocessable Content` |
| PUT | `/api/personas/{id}` | Actualizar una persona completa | `200 OK`, `404` o `422` |
| DELETE | `/api/personas/{id}` | Eliminar una persona | `204 No Content` o `404 Not Found` |

### Ejemplo para crear una persona

`POST /api/personas`

```json
{
  "dni": "0000000000001",
  "nombre": "Ana Lopez",
  "fecha_nacimiento": "2000-05-15"
}
```

### Validaciones

- `dni`: obligatorio, exactamente 13 digitos y unico.
- `nombre`: obligatorio, texto de hasta 100 caracteres.
- `fecha_nacimiento`: obligatoria, fecha valida y no futura.

Los errores de validacion responden con codigo `422` y un objeto JSON que identifica los campos incorrectos.

## Pruebas con Postman

Cree una coleccion llamada `III-UNIDAD-ISC305` y guarde una solicitud para cada endpoint. Compruebe tambien los siguientes errores:

- Crear una persona sin nombre.
- Utilizar un DNI duplicado o con menos de 13 digitos.
- Enviar una fecha de nacimiento futura.
- Consultar o modificar un identificador inexistente.
- Intentar asignar a una persona el DNI de otra.

Exporte la coleccion en formato JSON y guardela en la carpeta `postman` de la raiz, sin incluir contrasenas ni datos privados.

## Tecnologias

- Laravel 12.74
- PHP 8.2
- MySQL 8.0
- Eloquent ORM

## Autor

Proyecto academico de la asignatura ISC-305 Programacion Web.
