
-- tables
-- Table: Cliente
CREATE TABLE Cliente (
    ci int  NOT NULL,
    nombre varchar(30)  NOT NULL,
    apellidos varchar(30)  NOT NULL,
    sexo  varchar(30)  NOT NULL,
    CONSTRAINT Cliente_pk PRIMARY KEY (ci)
);

-- Table: Funcionario
CREATE TABLE Funcionario (
    cf int  NOT NULL,
    tipo varchar(30)  NOT NULL,
    nombre varchar(30)  NOT NULL,
    password varchar(30)  NOT NULL,
    sucursal_csucursal int  NOT NULL,
    CONSTRAINT Funcionario_pk PRIMARY KEY (cf)
);

-- Table: Inventario
CREATE TABLE Inventario (
    cinv int  NOT NULL,
    cantidad int  NOT NULL,
    estado boolean  NOT NULL,
    sucursal_csucursal int  NOT NULL,
    Producto_cp int  NOT NULL,
    CONSTRAINT Inventario_pk PRIMARY KEY (cinv)
);

-- Table: Pedido
CREATE TABLE Pedido (
    cpe int  NOT NULL,
    fecha_pedido date  NOT NULL,
    fecha_entrega date  NOT NULL,
    estado varchar(30)  NOT NULL,
    Funcionario_cf int  NOT NULL,
    sucursal_csucursal int  NOT NULL,
    Pedido_producto_cpp int  NOT NULL,
    CONSTRAINT Pedido_pk PRIMARY KEY (cpe)
);

-- Table: Pedido_producto
CREATE TABLE Pedido_producto (
    cpp int  NOT NULL,
    cantidad int  NOT NULL,
    Producto_cp int  NOT NULL,
    Proveedor_cproveedor varchar(30)  NOT NULL,
    CONSTRAINT Pedido_producto_pk PRIMARY KEY (cpp)
);
-- Table: Producto
CREATE TABLE Producto (
    cp int  NOT NULL,
    nombre varchar(30)  NOT NULL,
    precioCompra float(2)  NOT NULL,
    precioVenta float(2)  NOT NULL,
    categoria varchar(30)  NOT NULL,
    Proveedor_cproveedor varchar(30)  NOT NULL,
    CONSTRAINT Producto_pk PRIMARY KEY (cp)
);

-- Table: ProductoVendido
CREATE TABLE ProductoVendido (
    cpv int  NOT NULL,
    cantidad int  NOT NULL,
    Venta_cv int  NOT NULL,
    Producto_cp int  NOT NULL,
    CONSTRAINT ProductoVendido_pk PRIMARY KEY (cpv)
);

-- Table: Proveedor
CREATE TABLE Proveedor (
    cproveedor varchar(30)  NOT NULL,
    nombre varchar(30)  NOT NULL,
    CONSTRAINT Proveedor_pk PRIMARY KEY (cproveedor)
);

-- Table: Venta
CREATE TABLE Venta (
    cv int  NOT NULL,
    fecha date  NOT NULL,
    hora time  NOT NULL,
    estado boolean  NOT NULL,
    total float(2)  NOT NULL,
    totalEntregado float(2)  NOT NULL,
    tipodepago varchar(50)  NOT NULL,
    Cliente_ci int  NOT NULL,
    Funcionario_cf int  NOT NULL,
    CONSTRAINT Venta_pk PRIMARY KEY (cv)
);

-- Table: sucursal
CREATE TABLE sucursal (
    csucursal int  NOT NULL,
    zona varchar(20)  NOT NULL,
    CONSTRAINT sucursal_pk PRIMARY KEY (csucursal)
);

-- foreign keys
-- Reference: Funcionario_sucursal (table: Funcionario)
ALTER TABLE Funcionario ADD CONSTRAINT Funcionario_sucursal
    FOREIGN KEY (sucursal_csucursal)
    REFERENCES sucursal (csucursal)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: Inventario_Producto (table: Inventario)
ALTER TABLE Inventario ADD CONSTRAINT Inventario_Producto
    FOREIGN KEY (Producto_cp)
    REFERENCES Producto (cp)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: Inventario_sucursal (table: Inventario)
ALTER TABLE Inventario ADD CONSTRAINT Inventario_sucursal
    FOREIGN KEY (sucursal_csucursal)
    REFERENCES sucursal (csucursal)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: Pedido_Funcionario (table: Pedido)
ALTER TABLE Pedido ADD CONSTRAINT Pedido_Funcionario
    FOREIGN KEY (Funcionario_cf)
    REFERENCES Funcionario (cf)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: Pedido_Pedido_producto (table: Pedido)
ALTER TABLE Pedido ADD CONSTRAINT Pedido_Pedido_producto
    FOREIGN KEY (Pedido_producto_cpp)
    REFERENCES Pedido_producto (cpp)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: Pedido_producto_Proveedor (table: Pedido_producto)
ALTER TABLE Pedido_producto ADD CONSTRAINT Pedido_producto_Proveedor
    FOREIGN KEY (Proveedor_cproveedor)
    REFERENCES Proveedor (cproveedor)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: Pedido_sucursal (table: Pedido)
ALTER TABLE Pedido ADD CONSTRAINT Pedido_sucursal
    FOREIGN KEY (sucursal_csucursal)
    REFERENCES sucursal (csucursal)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: ProductoVendido_Producto (table: ProductoVendido)
ALTER TABLE ProductoVendido ADD CONSTRAINT ProductoVendido_Producto
    FOREIGN KEY (Producto_cp)
    REFERENCES Producto (cp)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: ProductoVendido_Venta (table: ProductoVendido)
ALTER TABLE ProductoVendido ADD CONSTRAINT ProductoVendido_Venta
    FOREIGN KEY (Venta_cv)
    REFERENCES Venta (cv)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: Producto_Proveedor (table: Producto)
ALTER TABLE Producto ADD CONSTRAINT Producto_Proveedor
    FOREIGN KEY (Proveedor_cproveedor)
    REFERENCES Proveedor (cproveedor)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: Venta_Cliente (table: Venta)
ALTER TABLE Venta ADD CONSTRAINT Venta_Cliente
    FOREIGN KEY (Cliente_ci)
    REFERENCES Cliente (ci)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: Venta_Funcionario (table: Venta)
ALTER TABLE Venta ADD CONSTRAINT Venta_Funcionario
    FOREIGN KEY (Funcionario_cf)
    REFERENCES Funcionario (cf)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: entity_1_Producto (table: Pedido_producto)
ALTER TABLE Pedido_producto ADD CONSTRAINT entity_1_Producto
    FOREIGN KEY (Producto_cp)
    REFERENCES Producto (cp)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- End of file.



--DESPUES DE CORRER LA BASE DE DATOS SI O SI PONEN ESTO

ALTER TABLE pedido_producto ALTER COLUMN cpp ADD GENERATED ALWAYS AS IDENTITY;
ALTER TABLE pedido ALTER COLUMN cpe ADD GENERATED ALWAYS AS IDENTITY;
ALTER TABLE inventario ALTER COLUMN cinv ADD GENERATED ALWAYS AS IDENTITY;




--triggers:
--trigger inventario
create function cantidadInventario()
returns trigger as 
$BODY$
Declare var1 integer :=0;
Declare var2 integer :=0;
begin 
	var1 := (Select a.cantidad from inventario a, producto b where a.producto_cp=b.cp and b.cp=new.producto_cp);
	var2 := (select a.sucursal_csucursal from funcionario a, venta b, productovendido c where a.cf=b.funcionario_cf and b.cv=c.venta_cv and c.cpv=new.cpv );
	UPDATE Inventario SET cantidad = var1-new.cantidad WHERE producto_cp =new.producto_cp and sucursal_csucursal=var2; 
	
	return new;
end;
$BODY$
language plpgsql;
create trigger cantidadInventario
after insert on productovendido
for each row
execute procedure cantidadInventario();

INSERT INTO ProductoVendido (cpv, cantidad,Venta_cv, Producto_cp)
VALUES
    (11,10 ,1, 525);
select * from pedido

--trigger pedidos

create function cantidadPedidoInventario6()
returns trigger as 
$BODY$
Declare var1 integer :=0;
Declare var2 integer :=0;

Declare var3 integer :=0;
begin 
	if (new.estado='Entregado') THEN
		var3 := (Select a.cantidad from pedido_producto a where a.cpp=new.pedido_producto_cpp);
		var2 := (Select a.producto_cp from pedido_producto a  where a.cpp=new.pedido_producto_cpp);
		var1 := (Select a.cantidad from inventario a, producto b where a.producto_cp=b.cp and b.cp=var2);
		UPDATE Inventario SET cantidad = var1+var3 WHERE producto_cp =var2 and sucursal_csucursal=new.sucursal_csucursal; 
	end if;
	
	return new;
end;
$BODY$
language plpgsql;
create trigger cantidadPedidoInventario6
after insert on pedido
for each row
execute procedure cantidadPedidoInventario6();



--update:
create function cantidadPedidoInventario10()
returns trigger as 
$BODY$
Declare var1 integer :=0;
Declare var2 integer :=0;

Declare var3 integer :=0;
begin 
	if (new.estado='Entregado') THEN
		var3 := (Select a.cantidad from pedido_producto a where a.cpp=new.pedido_producto_cpp);
		var2 := (Select a.producto_cp from pedido_producto a  where a.cpp=new.pedido_producto_cpp);
		var1 := (Select a.cantidad from inventario a, producto b where a.producto_cp=b.cp and b.cp=var2);
		UPDATE Inventario SET cantidad = var1+var3 WHERE producto_cp =var2 and sucursal_csucursal=new.sucursal_csucursal; 
	end if;
	
	return new;
end;
$BODY$
language plpgsql;
create trigger cantidadPedidoInventario10
after update on pedido
for each row
execute procedure cantidadPedidoInventario10();


