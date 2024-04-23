--para probar lo que se ha subido a la base de datos deben correr la base de datos primero, 
--y luego esto para registrar un administrador y sucursales
--funcionario:
INSERT INTO funcionario (cf, tipo, nombre, password, sucursal_csucursal)
VALUES (20524548, 'administrador', 'admin', '12345678', 1);
--sucursales
INSERT INTO sucursal (csucursal, zona)
VALUES (1, 'Obrajes'),
VALUES (1, 'Irpavi');