create database SIG_Inventory;
use SIG_Inventory;

CREATE TABLE tbl_entrega (
  id int(11)  AUTO_INCREMENT,
  nombre varchar(20) NOT NULL,
  apellido varchar(20) DEFAULT NULL,
  nomina varchar(20) DEFAULT NULL,
  fecha varchar(20) DEFAULT NULL,
  marca varchar(10) DEFAULT NULL,
  numeroserie varchar(20) DEFAULT NULL,
  puesto varchar(100) DEFAULT NULL,
  departamento varchar(100) DEFAULT NULL,
  avatar varchar(255),
  PRIMARY KEY (id)
);
select*from tbl_entrega;
drop table tbl_entrega;