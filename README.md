# 📌 Todo List App - Documentación

## 📖 Descripción

Este proyecto es una aplicación de lista de tareas (Todo List) que utiliza PHP, Nginx, MySQL y un frontend con React JS. La
aplicación está completamente dockerizada para facilitar su despliegue y desarrollo en local.

## 🔧 Requisitos

Antes de ejecutar el proyecto, asegúrese de tener instalado:

- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)

## 🚀 Instalación y puesta en marcha

Siga estos pasos para ejecutar el proyecto en su entorno local:

### 1️⃣ Clonar el repositorio

```sh
git clone <URL_DEL_REPOSITORIO>
cd <NOMBRE_DEL_REPOSITORIO>
```

### 2️⃣ Construir y levantar los contenedores

Ejecute el siguiente comando para construir y ejecutar los contenedores:

```sh
docker-compose up --build -d
```

Esto iniciará los siguientes servicios:

- `app`: Contenedor con PHP
- `nginx`: Servidor web
- `mysql`: Base de datos MySQL
- `frontend`: Aplicación frontend con React JS

### 3️⃣ Acceder a la aplicación

- Backend (API en PHP): [http://localhost:9000](http://localhost:9000)
- Frontend (Vite): [http://localhost:9001](http://localhost:9001)
- MySQL está accesible en el puerto `3308`

### 4️⃣ Ver logs y depuración

Para ver los logs de los contenedores en tiempo real:

```sh
docker-compose logs -f
```

Si necesita ingresar a un contenedor, use:

```sh
docker exec -it php_app bash
```

### 5️⃣ Detener los contenedores

Para detener y eliminar los contenedores, ejecute:

```sh
docker-compose down
```

## 📡 Endpoints Disponibles

A continuación, se detallan los endpoints disponibles en la API:

### 🔐 Autenticación

- **POST** `/auth/login` → Iniciar sesión

### 👤 Usuarios

- **GET** `/users/{id}` → Obtener usuario por ID

### ✅ Tareas (Tasks)

- **GET** `/tasks` → Obtener todas las tareas
- **POST** `/tasks` → Crear una nueva tarea
- **GET** `/tasks/{id}` → Obtener tarea por ID
- **POST** `/tasks/update/{id}` → Actualizar tarea por ID
- **DELETE** `/tasks/delete/{id}` → Eliminar tarea por ID

---
## ⚙️ Configuración adicional

### 🔑 Variables de entorno

Las variables de entorno deben tener los siguientes valores por defecto, guardadas en un archivo llamado `.env`:

```dotenv
# Archivo .env
APP_ENV=local
DB_HOST=mysql
DB_NAME=my_database
DB_USER=user
DB_PASSWORD=password

JWT_SECRET=secretkey
```

Las variables de entorno deben tener los siguientes valores por defecto:

```env
APP_ENV=local
DB_HOST=mysql
```

Si necesita modificar las credenciales de la base de datos, edite la sección `environment` del servicio `mysql`
en `docker-compose.yml`.Ahor📂 Configuración de Nginx

El archivo de configuración de Nginx se encuentra en `config/nginx.conf`. Puede modificarlo según sus necesidades.

## 🤝 Contribuir

Si desea contribuir a este proyecto, haga un fork del repositorio y envíe un pull request con sus mejoras.

## 📜 Licencia

Este proyecto está bajo la licencia MIT.

