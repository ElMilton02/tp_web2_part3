# tp_web2_part3

## Temática

Este proyecto es un sitio web para programar viajes en avión. La aplicación permite gestionar información sobre viajes, aviones y pilotos, facilitando la planificación y administración de vuelos.

## integrantes

1.Palucci, Milton

2.Bombace, Gastón

## Endpoints

- __GET__

        
    1. Obtener todos los viajes (sin ningún filtro ni paginación)
        Ruta: GET /viajes
        URL:
        http://localhost/tp_web2_part3/api/viajes


    2. Obtener todos los viajes filtrados por un campo específico (filtro único, fecha hora y id_destino)
        Ruta: GET /viajes
        URL:
        http://localhost/tp_web2_part3/api/viajes?filterBy=id_destinos&filterValue=1
        Descripción: Filtra los viajes por un campo específico, en este caso destinoId igual a 1.


    3. Obtener todos los viajes con ordenación (ascendente o descendente)
        Ruta: GET /viajes
        URL (orden ascendente parametro[ASC]):
        http://localhost/tp_web2_part3/api/viajes?orderBy=fecha&orderValue=ASC
        URL (orden descendente parametro[DESC]):
        http://localhost/tp_web2_part3/api/viajes?orderBy=fecha&orderValue=DESC
        Descripción: Ordena los viajes según el campo fecha en orden ascendente o descendente.


    4. Obtener todos los viajes filtrados por un campo y ordenados
        Ruta: GET /viajes
        URL:
        http://localhost/tp_web2_part3/api/viajes?filterBy=id_destinos&filterValue=1&orderBy=fecha&orderValue=ASC
        Descripción: Filtra los viajes por destinoId igual a 1 y los ordena por fecha en orden ascendente.


    5. Obtener todos los viajes con paginación (especificando página y límite de resultados)
        Ruta: GET /viajes
        URL (página 1, 10 resultados por página):
        http://localhost/tp_web2_part3/api/viajes?page=1&limit=10
        Descripción: Obtiene los viajes de la página 1, mostrando 10 resultados por página.


    6. Obtener todos los viajes con filtros, ordenación y paginación
        Ruta: GET /viajes
        URL:
        http://localhost/tp_web2_part3/api/viajes?filterBy=id_destinos&filterValue=1&orderBy=fecha&orderValue=ASC&page=1&limit=10
        Descripción: Filtra los viajes por destinoId igual a 1, los ordena por fecha en orden ascendente, y aplica paginación mostrando 10 resultados en la página 1.


    7. Obtener todos los viajes con filtros por fecha, destino, y ordenación por hora (por ejemplo, orden descendente)
        Ruta: GET /viajes
        URL:
        http://localhost/tp_web2_part3/api/viajes?filterBy=fecha&filterValue=2024-12-01&orderBy=hora&orderValue=DESC
        Descripción: Filtra los viajes por fecha igual a 2024-12-01 y los ordena por hora en orden descendente.


    8. Obtener todos los viajes con filtros por destino y paginación
        Ruta: GET /viajes
        URL:
        http://localhost/tp_web2_part3/api/viajes?filterBy=id_destinos&filterValue=2&page=2&limit=5
        Descripción: Filtra los viajes por destinoId igual a 2 y los muestra en la página 2, con un límite de 5 resultados por página.


    9. Obtener todos los viajes con filtros y ordenación por un campo diferente (por ejemplo, hora)
        Ruta: GET /viajes
        URL:
        http://localhost/tp_web2_part3/api/viajes?filterBy=hora&filterValue=14:30:00.0000&orderBy=fecha&orderValue=ASC
        Descripción: Filtra los viajes por hora igual a 15:30 y los ordena por fecha en orden ascendente.


    10. Obtener todos los viajes con filtros y ordenación descendente
        Ruta: GET /viajes
        URL:
        http://localhost/tp_web2_part3/api/viajes?filterBy=id_destinos&filterValue=3&orderBy=hora&orderValue=DESC
        Descripción: Filtra los viajes por destinoId igual a 3 y los ordena por hora en orden descendente.


    11. Obtener todos los viajes sin filtros ni ordenación, solo con paginación
        Ruta: GET /viajes
        URL (paginación sin filtros ni ordenación):
        http://localhost/tp_web2_part3/api/viajes?page=1&limit=10
        Descripción: Solo realiza la paginación sin ningún filtro ni ordenación.


    12. Obtener todos los viajes ordenados por un campo específico (por ejemplo, fecha), sin filtros ni paginación
        Ruta: GET /viajes
        URL (orden por fecha, ascendente):
        http://localhost/tp_web2_part3/api/viajes?orderBy=fecha&orderValue=ASC
        Descripción: Ordena todos los viajes por fecha en orden ascendente, sin ningún filtro ni paginación.


    13. Obtener todos los viajes con varios filtros y ordenación (con paginación)
        Ruta: GET /viajes
        URL:
        http://localhost/tp_web2_part3/api/viajes?filterBy=id_destinos&filterValue=1&orderBy=fecha&orderValue=ASC&page=2&limit=5
        Descripción: Filtra los viajes por destinoId igual a 1, los ordena por fecha en orden ascendente, y los muestra en la página 2 con un límite de 5 resultados.
    


- __POST__

    - tp_web2_part3/api/viajes

        - Esta ruta permite agregar un viaje http://localhost/tp_web2_part3/api/viajes
            - ej:
            ```json
                {
                    "fecha": "2000-11-15",
                    "hora": "14:30:00",
                    "destinoId": 1
                }
            ```


- __PUT__

    - tp_web2_part3/api/viajes/:ID

        -  Esta ruta permite actualizar un viaje existente http://localhost/tp_web2_part3/api/viajes/63
            - ej:
            ```json
                {
                "fecha": "2000-11-15",
                "hora": "14:40:00",
                "destinoId": 3
                }
            ```


- __DELETE__

    - tp_web2_part3/api/viajes/:ID

        - Esta ruta permite eliminar un viaje específico http://localhost/tp_web2_part3/api/viajes/63