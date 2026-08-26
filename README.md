# Plan Familiar App

![PHP](https://img.shields.io/badge/PHP-%5E8.1-8892BF?logo=php&logoColor=white)
![Lumen](https://img.shields.io/badge/Lumen-10.x-FF2D20?logo=laravel&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?logo=mysql&logoColor=white)
![Licencia](https://img.shields.io/badge/Licencia-MIT-green.svg)

Sistema web para elaborar el **Plan Familiar de Emergencia** en el marco de la gestión de riesgos de desastres. Guía a la familia paso a paso —desde la información general y la identificación de amenazas hasta los planes de acción y la evaluación de la vivienda— y genera el plan final como documento **Word (.docx)** listo para imprimir.

## Funcionalidades

| Módulo | Descripción |
|--------|-------------|
| Dashboard | Lista los planes familiares registrados y permite eliminarlos |
| Información general | Datos de la familia acogiente: dirección, teléfono, provincia y cantón |
| Integrantes de la familia | Registro y edición de cada integrante del hogar |
| Amenazas | Catálogo de amenazas de la zona |
| Identificación de amenazas | Amenazas que afectan a la familia |
| Lugares de evacuación y encuentro | Puntos de encuentro y rutas de evacuación |
| Recursos familiares disponibles | Recursos con los que cuenta la familia |
| Plan de acción | Medidas de reducción, respuesta y recuperación |
| Números de emergencia | Contactos de emergencia del plan |
| Mi mascota | Datos de las mascotas del hogar |
| Vivienda | Estructura general y evaluación por ambientes: comedor, sala, dormitorio, baño y cocina |
| Resumen de vulnerabilidad | Consolidado de la vulnerabilidad de la vivienda |
| Gráfico de vivienda | Visualización gráfica de la evaluación |
| Reporte Word | Genera el documento completo del plan familiar en formato .docx |

## Stack tecnológico

| Tecnología | Uso |
|------------|-----|
| PHP ^8.1 | Lenguaje |
| Lumen 10 (Laravel) | Microframework |
| Eloquent ORM + MySQL | Persistencia |
| Blade | Motor de vistas |
| PHPWord ^1.3 | Generación del reporte .docx |
| PHPUnit ^10 | Pruebas |

## Instalación

### Requisitos previos

- PHP >= 8.1 (extensiones: `pdo`, `pdo_mysql`, `mbstring`, `openssl`)
- Composer
- MySQL

### Pasos

1. Clonar el repositorio e instalar dependencias:

    ```bash
    git clone https://github.com/ashcroft08/plan-familiar-app.git
    cd plan-familiar-app
    composer install
    ```

2. Crear el archivo de entorno (Windows: `copy .env.example .env`):

    ```bash
    cp .env.example .env
    ```

3. Crear la base de datos:

    ```sql
    CREATE DATABASE plan_familiar CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
    ```

4. Configurar la conexión en `.env`:

    ```env
    DB_CONNECTION=mysql
    DB_DATABASE=plan_familiar
    DB_USERNAME=tu_usuario
    DB_PASSWORD=tu_contraseña
    ```

5. Ejecutar las migraciones:

    ```bash
    php artisan migrate
    ```

6. Levantar el servidor de desarrollo:

    ```bash
    php -S localhost:8000 -t public
    ```

Abrir [http://localhost:8000](http://localhost:8000) en el navegador.

## Uso

1. Desde el **dashboard**, crear un plan completando la información general de la familia.
2. Completar los módulos del plan: integrantes, amenazas, lugares de evacuación, planes de acción, vivienda, etc.
3. Descargar el reporte final en Word desde el dashboard (`/generar-word/{cod_familia}`).

## Estructura del proyecto

```
plan-familiar-app/
├── app/
│   ├── Http/Controllers/    # Controladores (uno por módulo)
│   └── Models/              # Modelos Eloquent
├── database/
│   └── migrations/          # Esquema de la base de datos
├── resources/views/         # Vistas Blade organizadas por módulo
├── routes/web.php           # Todas las rutas de la aplicación
└── public/                  # Punto de entrada (index.php)
```

## Pruebas

```bash
vendor/bin/phpunit
```

## Licencia

Este proyecto está licenciado bajo la [Licencia MIT](LICENSE).
