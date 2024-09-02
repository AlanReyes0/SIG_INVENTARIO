CREATE TABLE tbl_mantenimiento (
  id int(11)  AUTO_INCREMENT,
  nombre varchar(20) DEFAULT NULL,
  apellido varchar(20) DEFAULT NULL,
  nomina varchar(4) default null,
  fecha varchar(20) DEFAULT NULL,
  estado varchar(20) DEFAULT NULL,
  equipo varchar(100) DEFAULT NULL,
  cargo varchar(20) DEFAULT NULL,
  checklist varchar(500) default NULL,
  PRIMARY KEY (id)
);