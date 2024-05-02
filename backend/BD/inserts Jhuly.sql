INSERT INTO Proveedor (cproveedor, nombre) 
VALUES 
('PRV001', 'Distribuciones Alfa'),
('PRV002', 'Comestibles Beta'),
('PRV003', 'Suministros Gamma');

INSERT INTO Producto (cp, nombre, precioCompra, precioVenta, categoria, Proveedor_cproveedor)
VALUES 
(1001, 'Laptop HP Pavilion', 700.00, 900.00, 'Electrónica', 'PRV001'),
(1002, 'Camisa de Manga Larga', 20.50, 35.00, 'Ropa', 'PRV002'),
(1003, 'Refrigerador Samsung', 1200.00, 1500.00, 'Electrodomésticos', 'PRV003');

INSERT INTO Inventario ( cantidad, estado, sucursal_csucursal, Producto_cp) 
values 
(10001,'true',1,1001),
(10002,'true',1,1002),
(10003,'true',1,1003);

INSERT INTO sucursal (csucursal, zona)VALUES 
(1, 'Obrajes'),
(2, 'Irpavi');

INSERT INTO funcionario (cf, tipo, nombre, password, sucursal_csucursal)
VALUES (20524548, 'administrador', 'admin', '12345678', 1),
(232332, 'cajero', 'cajero1', '12345678', 1);

INSERT INTO Cliente (ci, nombre, apellidos, sexo) VALUES
(1234567, 'Juan', 'Pérez', 'male'),
(2345678, 'María', 'López', 'female');

INSERT INTO Venta (cv, fecha, hora, estado, total, totalentregado, tipodepago, Cliente_Ci, Funcionario_cf) VALUES
(1, '2024-04-26', '10:30:00', 'true', 100.50, 100.50, 'Débito',1234567, 20524548),
(2, '2024-04-26', '11:45:00', 'true', 150.75, 150.75, 'Efectivo',2345678 ,20524548);


-- Insertar ejemplo de producto vendido para la venta #1
INSERT INTO ProductoVendido (cpv, cantidad,Venta_cv, Producto_cp)
VALUES
    (1,10 ,1, 1001), -- cpv: ID del producto vendido, Venta_cv: ID de la venta #1, Producto_cp: ID del producto "Laptop HP Pavilion"
    (2,10, 1, 1002); -- cpv: ID del producto vendido, Venta_cv: ID de la venta #1, Producto_cp: ID del producto "Camisa de Manga Larga"

---- Insertar ejemplo de producto vendido para la venta #1
INSERT INTO ProductoVendido (cpv, cantidad,Venta_cv, Producto_cp)
VALUES
    (3,10 ,2, 1001), -- cpv: ID del producto vendido, Venta_cv: ID de la venta #1, Producto_cp: ID del producto "Laptop HP Pavilion"
    (4,10, 2, 1002); -- cpv: ID del producto vendido, Venta_cv: ID de la venta #1, Producto_cp: ID del producto "Camisa de Manga Larga"