# PHP MVC Sistema de Horas Extras

## Pre-requisitos

instalar [Bitnami lapp Stack](https://bitnami.com/stack/lapp) o en su defecto, tener:

- PHP >= 7
- Apache
- PostgreSQL
- Driver de postgres para PHP

## Instalacion

```
git clone <Git URL>
cd <carpeta el proyecto>
composer install
```

## Configuracion

1. Abrir config.json y establecer los parametros de su entorno de trabajo.
   ```
   {
      "database": [
          {
            "driver": "pdo_pgsql",
            "user": "postgres",
            "password": "12345678",
            "dbname": "HorasExtras",
            "host": "localhost",
            "port": "5433"
          }
      ],
      "base_url": "http://localhost:8080/sistema_horas"
   }
   ```
2. Ingresar en la URL del proyecto segun su entorno. Ejemplo: [http://localhost:8080/sistema_horas](http://localhost:8080/sistema_horas)
