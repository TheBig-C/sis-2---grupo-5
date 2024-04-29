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


INSERT INTO sucursal (csucursal, zona)VALUES 
(1, 'Obrajes'),
(2, 'Irpavi');

INSERT INTO funcionario (cf, tipo, nombre, password, sucursal_csucursal)
VALUES (20524548, 'administrador', 'admin', '12345678', 1);


INSERT INTO Cliente (ci, nombre, apellidos, sexo) VALUES
(1234567, 'Juan', 'Pérez', 'Masculino'),
(2345678, 'María', 'López', 'Femenino');

INSERT INTO Venta (cv, fecha, hora, estado, metodo, total, totalentregado, tipodepago, ci_cliente, Funcionario_cf) VALUES
(1, '2024-04-26', '10:30:00', true, 'Tarjeta', 100.50, 100.50, 'Débito',1234567, 20524548),
(2, '2024-04-26', '11:45:00', true, 'Efectivo', 150.75, 150.75, 'Efectivo',2345678 ,20524548);


-- Insertar ejemplo de producto vendido para la venta #1
INSERT INTO ProductoVendido (cpv, Venta_cv, Producto_cp)
VALUES
    (1, 1, 1001), -- cpv: ID del producto vendido, Venta_cv: ID de la venta #1, Producto_cp: ID del producto "Laptop HP Pavilion"
    (2, 1, 1002); -- cpv: ID del producto vendido, Venta_cv: ID de la venta #1, Producto_cp: ID del producto "Camisa de Manga Larga"

-- Insertar ejemplo de producto vendido para la venta #2
INSERT INTO ProductoVendido (cpv, Venta_cv, Producto_cp)
VALUES
	(3, 2, 1002),
    (4, 2, 1003); -- cpv: ID del producto vendido, Venta_cv: ID de la venta #2, Producto_cp: ID del producto "Refrigerador Samsung"

INSERT INTO Cliente (ci, nombre, apellidos, sexo)
VALUES 
    (3456789, 'Luis', 'Martínez', 'Masculino'),
    (4567890, 'Ana', 'López', 'Femenino'),
    (5678901, 'Carlos', 'Rodríguez', 'Masculino'),
    (6789123, 'Sofía', 'Hernández', 'Femenino'),
    (7890123, 'Pedro', 'García', 'Masculino'),
    (8901234, 'Laura', 'Díaz', 'Femenino'),
    (9012345, 'Pablo', 'Torres', 'Masculino'),
    (9876543, 'Elena', 'Ramírez', 'Femenino');

-- Insertar datos en la tabla Funcionario
INSERT INTO Funcionario 
VALUES 
    (567, 'Vendedor', 'Alejandro', 'password1', 1),
    (678, 'Gerente', 'Beatriz', 'password2', 1),
    (789, 'Vendedor', 'Carmen', 'password3', 2),
    (890, 'Gerente', 'Diego', 'password4', 2),
    (109, 'Vendedor', 'Eva', 'password5', 1),
    (210, 'Gerente', 'Fernando', 'password6', 1),
    (123, 'Vendedor', 'Gloria', 'password7', 2),
    (133, 'Gerente', 'Hugo', 'password8', 2),
    (234, 'Vendedor', 'Inés', 'password9', 1),
    (543, 'Gerente', 'Javier', 'password10', 1);

INSERT INTO Venta
VALUES 
    (3, '2024-04-26', '10:15:00', true, 'Efectivo', 150.75, 150.00, 'Efectivo', 4567890, 210),
    (4, '2024-04-25', '09:30:00', true, 'Tarjeta de débito', 200.00, 200.00, 'Tarjeta', 2345678, 109),
    (5, '2024-04-24', '11:45:00', false, 'Transferencia bancaria', 75.20, 75.20, 'Transferencia', 9876543, 567),
    (6, '2024-04-23', '14:20:00', true, 'Efectivo', 180.50, 180.00, 'Efectivo', 3456789, 123),
    (7, '2024-04-22', '16:00:00', false, 'Tarjeta de crédito', 300.25, 300.00, 'Tarjeta', 5678901, 234),
    (8, '2024-04-21', '08:45:00', true, 'Efectivo', 90.00, 90.00, 'Efectivo', 7890123, 789),
    (9, '2024-04-20', '13:10:00', true, 'Transferencia bancaria', 120.80, 120.80, 'Transferencia', 8901234, 234),
    (10, '2024-04-19', '10:55:00', false, 'Tarjeta de crédito', 250.50, 250.50, 'Tarjeta', 9012345, 789),
    (11, '2024-04-18', '15:25:00', true, 'Efectivo', 175.60, 175.00, 'Efectivo', 1234567,789),
    (12, '2024-04-17', '12:00:00', true, 'Tarjeta de débito', 150.00, 150.00, 'Tarjeta', 2345678, 210);
