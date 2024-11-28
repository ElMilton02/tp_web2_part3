<?php
require_once './config.php';

class Model
{
  protected $db;

  public function __construct()
  {
    require_once './config.php';
    $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
    $this->deploy();
  }

  function deploy()
  {
    // Chequear si hay tablas
    $query = $this->db->query('SHOW TABLES');
    $tables = $query->fetchAll();

    if (count($tables) == 0) {
      // Si no hay tablas, crearlas
        $sql = <<<SQL
      
          SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
          START TRANSACTION;
          SET time_zone = "+00:00";


          /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
          /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
          /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
          /*!40101 SET NAMES utf8mb4 */;

          --
          -- Base de datos: `via_tandil`
          --

          -- --------------------------------------------------------

          --
          -- Estructura de tabla para la tabla `destinos`
          --

          CREATE TABLE `destinos` (
            `destino` varchar(40) NOT NULL,
            `id` int(11) NOT NULL,
            `imagen_destino` text NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

          --
          -- Volcado de datos para la tabla `destinos`
          --

          INSERT INTO `destinos` (`destino`, `id`, `imagen_destino`) VALUES
          ('Roma', 1, 'https://wayfarer.travel/wp-content/uploads/2018/06/Colloseum-Rome-iStock-622806180-EDITED.jpg'),
          ('Londres', 2, 'https://th.bing.com/th/id/OIP.J2QErjnq41Jqrs1TuSoYRQHaD4?rs=1&pid=ImgDetMain'),
          ('Nueva York', 3, 'https://th.bing.com/th/id/OIP.ugAMks5e-IS9pWp2SKNe3wHaFj?rs=1&pid=ImgDetMain'),
          ('Madrid', 4, 'https://th.bing.com/th/id/R.eafa92f0f4c4230dcb053bc474c78d17?rik=W2WZ4YNaO6DHAQ&riu=http%3a%2f%2fcdn.wallpapersafari.com%2f48%2f51%2fQZgadO.jpg&ehk=mTlbhFs%2fQE4JiKm1%2bWwmqqDul8d4gbFxQGi87WasrFM%3d&risl=&pid=ImgRaw&r=0'),
          ('Paris', 5, 'https://th.bing.com/th/id/OIP.q60dh7WzKb9fOQthaESViQHaEK?rs=1&pid=ImgDetMain');

          -- --------------------------------------------------------

          --
          -- Estructura de tabla para la tabla `usuarios`
          --

          CREATE TABLE `usuarios` (
            `nombre_usuario` varchar(30) DEFAULT NULL,
            `clave_usuario` varchar(255) NOT NULL,
            `id` int(11) NOT NULL,
            `rol` int(11) NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

          --
          -- Volcado de datos para la tabla `usuarios`
          --

          INSERT INTO `usuarios` (`nombre_usuario`, `clave_usuario`, `id`, `rol`) VALUES
          ('webadmin', '$2y$10$EpcT77aEVovD9C5nEP7sB.HHM8ak3KsC2KztMDXDtOTBo9sk3FWd6', 9, 1),
          ('pepe', '$2y$10$.XXGd5n4OcIjyADQShm7YuXG82WKT2w0SmwZHLhazFsAzUOy.RnW6', 10, 0),
          ('pedro', '$2y$10$WHGd8KUlZIGk6QxpRm.5UOp9mlKLGy7R7e74LHXhRe62ix3d2EpZ6', 11, 0),
          ('saul', '$2y$10$H/p7Oj.55BWzxYncJ0e0puJ9.cfhCbztWeoowuWZaN9n..oQWPCdq', 12, 0),
          ('fede', '$2y$10$l3qqtaDBEjXEXEIFmow15OoZ7OqeqaMPuRp3sBuaKoMJnof3DwxPG', 13, 0);

          -- --------------------------------------------------------

          --
          -- Estructura de tabla para la tabla `viajes`
          --

          CREATE TABLE `viajes` (
            `id` int(11) NOT NULL,
            `fecha` date NOT NULL,
            `hora` time(4) NOT NULL,
            `id_destinos` int(11) NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

          --
          -- Volcado de datos para la tabla `viajes`
          --

          INSERT INTO `viajes` (`id`, `fecha`, `hora`, `id_destinos`) VALUES
          (1, '2024-09-16', '00:00:00.0000', 1),
          (2, '2024-09-16', '00:00:00.0000', 2),
          (3, '2024-09-16', '00:00:00.0000', 3),
          (4, '2024-09-16', '00:00:00.0000', 4),
          (5, '2024-09-16', '00:00:00.0000', 5),
          (6, '2025-12-10', '00:00:00.0000', 1),
          (7, '2025-12-10', '00:00:00.0000', 2),
          (8, '2025-12-10', '00:00:00.0000', 3),
          (9, '2025-12-10', '00:00:00.0000', 4),
          (10, '2025-12-10', '00:00:00.0000', 5),
          (11, '2025-01-01', '00:00:00.0000', 1),
          (12, '2025-01-01', '00:00:00.0000', 2),
          (13, '2025-01-01', '00:00:00.0000', 3),
          (14, '2025-01-01', '00:00:00.0000', 4),
          (15, '2025-01-01', '00:00:00.0000', 5),
          (16, '2024-09-16', '08:00:00.0000', 1),
          (17, '2024-09-16', '08:00:00.0000', 2),
          (18, '2024-09-16', '08:00:00.0000', 3),
          (19, '2024-09-16', '08:00:00.0000', 4),
          (20, '2024-09-16', '08:00:00.0000', 5),
          (21, '2025-11-10', '08:00:00.0000', 1),
          (22, '2025-11-10', '08:00:00.0000', 2),
          (23, '2025-11-10', '08:00:00.0000', 3),
          (24, '2025-11-10', '08:00:00.0000', 4),
          (25, '2025-11-10', '08:00:00.0000', 5),
          (26, '2025-01-01', '08:00:00.0000', 1),
          (27, '2025-01-01', '08:00:00.0000', 2),
          (28, '2025-01-01', '08:00:00.0000', 3),
          (29, '2025-01-01', '08:00:00.0000', 4),
          (30, '2025-01-01', '08:00:00.0000', 5),
          (31, '2024-08-16', '14:00:00.0000', 1),
          (32, '2024-08-16', '14:00:00.0000', 2),
          (33, '2024-08-16', '14:00:00.0000', 3),
          (34, '2024-08-16', '14:00:00.0000', 4),
          (35, '2024-08-16', '14:00:00.0000', 5),
          (36, '2025-11-10', '14:00:00.0000', 1),
          (37, '2025-11-10', '14:00:00.0000', 2),
          (38, '2025-11-10', '14:00:00.0000', 3),
          (39, '2025-11-10', '14:00:00.0000', 4),
          (40, '2025-11-10', '14:00:00.0000', 5),
          (41, '2025-01-01', '14:00:00.0000', 1),
          (42, '2025-01-01', '14:00:00.0000', 2),
          (43, '2025-01-01', '14:00:00.0000', 3),
          (44, '2025-01-01', '14:00:00.0000', 4),
          (45, '2025-01-01', '14:00:00.0000', 5),
          (46, '2024-08-16', '22:00:00.0000', 1),
          (47, '2024-08-16', '22:00:00.0000', 2),
          (48, '2024-08-16', '22:00:00.0000', 3),
          (49, '2024-08-16', '22:00:00.0000', 4),
          (50, '2024-08-16', '22:00:00.0000', 5),
          (51, '2025-11-10', '22:00:00.0000', 1),
          (52, '2025-11-10', '22:00:00.0000', 2),
          (53, '2025-11-10', '22:00:00.0000', 3),
          (54, '2025-11-10', '22:00:00.0000', 4),
          (55, '2025-11-10', '22:00:00.0000', 5),
          (56, '2025-03-01', '22:00:00.0000', 1),
          (57, '2025-03-01', '22:00:00.0000', 2),
          (58, '2025-03-01', '22:00:00.0000', 3),
          (59, '2025-03-01', '22:00:00.0000', 4),
          (60, '2025-03-01', '22:00:00.0000', 5);

          --
          -- Índices para tablas volcadas
          --

          --
          -- Indices de la tabla `destinos`
          --
          ALTER TABLE `destinos`
            ADD PRIMARY KEY (`id`);

          --
          -- Indices de la tabla `usuarios`
          --
          ALTER TABLE `usuarios`
            ADD PRIMARY KEY (`id`);

          --
          -- Indices de la tabla `viajes`
          --
          ALTER TABLE `viajes`
            ADD PRIMARY KEY (`id`),
            ADD KEY `id_destinos` (`id_destinos`);

          --
          -- AUTO_INCREMENT de las tablas volcadas
          --

          --
          -- AUTO_INCREMENT de la tabla `destinos`
          --
          ALTER TABLE `destinos`
            MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

          --
          -- AUTO_INCREMENT de la tabla `usuarios`
          --
          ALTER TABLE `usuarios`
            MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

          --
          -- AUTO_INCREMENT de la tabla `viajes`
          --
          ALTER TABLE `viajes`
            MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

          --
          -- Restricciones para tablas volcadas
          --

          --
          -- Filtros para la tabla `viajes`
          --
          ALTER TABLE `viajes`
            ADD CONSTRAINT `viajes_ibfk_2` FOREIGN KEY (`id_destinos`) REFERENCES `destinos` (`id`);
          COMMIT;

          /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
          /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
          /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


        SQL;

        $this->db->exec($sql);
    }
  }
}