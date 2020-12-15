# PHP MVC Sistema de Horas Extras

## Pre-requisitos

instalar [Bitnami lapp Stack](https://bitnami.com/stack/lapp) (version minima lapp-5.6.24-0) o en su defecto, tener:

- PHP >= 5.6.24
- Apache >= 
- PostgreSQL
- Driver de postgres para PHP

## Instalacion

```
Ingresar en "lappstack-5.6.24-0/apache2/htdocs/"
git clone <Git URL>
cd <carpeta el proyecto>
abrir el navegador en la ruta usada
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
            "port": "5432"
          }
      ],
      "base_url": "http://localhost:8080/SysHorasExtras"
   }
   ```
2. Ingresar en la URL del proyecto segun su entorno. Ejemplo: [http://localhost:8080/SysHorasExtras](http://localhost:8080/SysHorasExtras)
