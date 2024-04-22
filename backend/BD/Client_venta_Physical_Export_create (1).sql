-- Created by Vertabelo (http://vertabelo.com)
-- Last modification date: 2024-04-22 23:10:07.562

-- tables
-- Table: Funcionario
CREATE TABLE Funcionario (
    cf int  NOT NULL,
    tipo varchar(30)  NOT NULL,
    nombre varchar(30)  NOT NULL,
    sucursal_csucursal int  NOT NULL,
    CONSTRAINT Funcionario_pk PRIMARY KEY (cf)
);

-- Table: Pedido
CREATE TABLE Pedido (
    cpe int  NOT NULL,
    fecha_pedido date  NOT NULL,
    fecha_entrega date  NOT NULL,
    estado varchar(30)  NOT NULL,
    Funcionario_cf int  NOT NULL,
    Proveedor_cproveedor varchar(30)  NOT NULL,
    CONSTRAINT Pedido_pk PRIMARY KEY (cpe)
);

-- Table: Pedido_producto
CREATE TABLE Pedido_producto (
    cpp int  NOT NULL,
    Producto_cp int  NOT NULL,
    Pedido_cpe int  NOT NULL,
    CONSTRAINT Pedido_producto_pk PRIMARY KEY (cpp)
);

-- Table: Producto
CREATE TABLE Producto (
    cp int  NOT NULL,
    nombre varchar(30)  NOT NULL,
    cantidad int  NOT NULL,
    estado boolean  NOT NULL,
    precioCompra float(2)  NOT NULL,
    precioVenta float(2)  NOT NULL,
    inventario int  NOT NULL,
    categoria varchar(30)  NOT NULL,
    sucursal_csucursal int  NOT NULL,
    Proveedor_cproveedor varchar(30)  NOT NULL,
    CONSTRAINT Producto_pk PRIMARY KEY (cp)
);

-- Table: ProductoVendido
CREATE TABLE ProductoVendido (
    cpv int  NOT NULL,
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
    etado boolean  NOT NULL,
    metodo varchar(30)  NOT NULL,
    total float(2)  NOT NULL,
    totalEntregado float(2)  NOT NULL,
    tipodepago varchar(50)  NOT NULL,
    ci_cliente int  NOT NULL,
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

-- Reference: Pedido_Funcionario (table: Pedido)
ALTER TABLE Pedido ADD CONSTRAINT Pedido_Funcionario
    FOREIGN KEY (Funcionario_cf)
    REFERENCES Funcionario (cf)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: Pedido_Proveedor (table: Pedido)
ALTER TABLE Pedido ADD CONSTRAINT Pedido_Proveedor
    FOREIGN KEY (Proveedor_cproveedor)
    REFERENCES Proveedor (cproveedor)  
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

-- Reference: Producto_sucursal (table: Producto)
ALTER TABLE Producto ADD CONSTRAINT Producto_sucursal
    FOREIGN KEY (sucursal_csucursal)
    REFERENCES sucursal (csucursal)  
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

-- Reference: entity_1_Pedido (table: Pedido_producto)
ALTER TABLE Pedido_producto ADD CONSTRAINT entity_1_Pedido
    FOREIGN KEY (Pedido_cpe)
    REFERENCES Pedido (cpe)  
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

