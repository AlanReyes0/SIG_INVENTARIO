CREATE TABLE componentes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    producto_componente VARCHAR(255) NOT NULL,
    fecha DATE NOT NULL,
    stock INT NOT NULL
);

CREATE TABLE entregas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_apellido VARCHAR(255) NOT NULL,
    nomina INT(4) NOT NULL,
    producto_componente VARCHAR(255) NOT NULL,
    fecha DATE NOT NULL,
    puesto VARCHAR(255) NOT NULL,
    cantidad_entregada INT NOT NULL,
    FOREIGN KEY (producto_componente) REFERENCES componentes(producto_componente)
);
