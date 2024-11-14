# tp_web2_part3

## Temática

Este proyecto es un sitio web para programar viajes en avión. La aplicación permite gestionar información sobre viajes, aviones y pilotos, facilitando la planificación y administración de vuelos.

## integrantes

1.Palucci, Milton

2.Bombace, Gastón

## Endpoints

- __GET__

    - tp_web2_part3/api/destinos

        - Esta ruta muestra los destinos ej: http://localhost/tp_web2_part3/api/destinos

    - tp_web2_part3/api/destinos/:ID/viajes
        
        - Esta ruta permite obtener viajes por destino específico ej: http://localhost/tp_web2_part3/api/destinos/1/viajes
    
    - tp_web2_part3/api/viajes/order/:order

        - Esta ruta ordena viajes por orden ascendente o descendente ej: http://localhost/tp_web2_part3/api/viajes/order/DESC
    
    - tp_web2_part3/api/destinos/:ID/viajes/order/:order

        - Esta ruta ordena viajes por ID de destino y orden ej: http://localhost/tp_web2_part3/api/destinos/1/viajes/order/DESC
    
    - tp_web2_part3/api/destinos/filter/:letter
       
        - Fsta ruta permite filtrar destinos por letra inicial ej: http://localhost/tp_web2_part3/api/destinos/filter/a
 
    - tp_web2_part3/api/viajes/page/:page

        - Esta ruta permite obtener viajes paginados ej: http://localhost/tp_web2_part3/api/viajes/page/1


- __POST__

    - tp_web2_part3/api/viajes

        - Esta ruta permite agregar un viaje http://localhost/tp_web2_part3/api/viajes
            ej:
                {
                    "fecha": "2000-11-15",
                    "hora": "14:30:00",
                    "destinoId": 1
                }


- __PUT__

    - tp_web2_part3/api/viajes/:ID

        -  Esta ruta permite actualizar un viaje existente http://localhost/tp_web2_part3/api/viajes/63
            ej:
                {
                "fecha": "2000-11-15",
                "hora": "14:40:00",
                "destinoId": 3
                }


- __DELETE__

    - tp_web2_part3/api/viajes/:ID

        - Esta ruta permite eliminar un viaje específico http://localhost/tp_web2_part3/api/viajes/63