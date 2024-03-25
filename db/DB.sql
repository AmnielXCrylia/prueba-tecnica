create database catalogo;
use catalogo;

CREATE TABLE menu_padre (
    id_menu_padre SERIAL PRIMARY KEY,
    descripcion VARCHAR(100),
    nombre VARCHAR(100)
);

CREATE TABLE menu_hijo (
    id_menu_hijo SERIAL PRIMARY KEY,
    id_menu_padre INTEGER references menu_padre(id_menu_padre)  ,    
    descripcion VARCHAR(100),
    nombre VARCHAR(100)
);

INSERT INTO menu_padre (descripcion, nombre)
VALUES ('Listado de Catalogos', 'Catalogos');

INSERT INTO menu_padre (descripcion, nombre)
VALUES ('Listado de Marcas de Autos', 'Marcas');

INSERT INTO menu_hijo (id_menu_padre, descripcion, nombre)
VALUES (1, 'Catalogo de Archivos', 'Tipos de Archivos');

INSERT INTO menu_hijo (id_menu_padre, descripcion, nombre)
VALUES (1, 'Listado de Profesiones', 'Profesiones');

INSERT INTO menu_hijo (id_menu_padre, descripcion, nombre)
VALUES (2, 'Marcas Seat', 'SEAT');

INSERT INTO menu_hijo (id_menu_padre, descripcion, nombre)
VALUES (2, 'Marcas BMW', 'BMW');



/*SELECT mp.nombre, '' as "Menu Padre", mp.descripcion FROM menu_padre mp
UNION ALL
SELECT nombre, (select mp2.nombre from menu_padre mp2 where mp2.id_menu_padre = mh.id_menu_padre) as "Menu Padre", descripcion FROM menu_hijo mh;
*/
