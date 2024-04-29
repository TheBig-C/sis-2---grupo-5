function updateDetails(button) {
    // Obtener los datos desde los atributos del botón
    var cp = button.getAttribute('data-cp');
    var cinv = button.getAttribute('data-cinv');
    var nombre = button.getAttribute('data-nombre');
    var cantidad = button.getAttribute('data-cantidad');
    var precioVenta = button.getAttribute('data-precio-venta');
    var precioCompra = button.getAttribute('data-precio-compra');
    var inventario = button.getAttribute('data-inventario');
    var categoria = button.getAttribute('data-categoria');

    // Actualizar los detalles en la sección baseDerecha usando .value en lugar de .textContent
    document.getElementById('cp').value = cp;
    document.getElementById('cinv').value = cinv;
    document.getElementById('detalle_nombre').value = nombre;
    document.getElementById('detalle_cantidad').value = cantidad;
    document.getElementById('detalle_precio_venta').value = precioVenta;
    document.getElementById('detalle_precio_compra').value = precioCompra;
    document.getElementById('detalle_inventario').value = inventario;
    document.getElementById('detalle_categoria').value = categoria;
    toEdit()
}
function toEdit(){
    var editBtn= document.getElementById('edit_button');

    editBtn.textContent = "Editar";

}
function editProduct() {
    var editBtn = document.getElementById('edit_button');

    if (editBtn.textContent === "Editar") {
        // Habilitar la edición
        document.querySelectorAll('#cp, #cinv, #detalle_nombre, #detalle_cantidad, #detalle_precio_venta, #detalle_precio_compra, #detalle_inventario, #detalle_categoria')
            .forEach(input => input.readOnly = false);
        editBtn.textContent = "Guardar";
    } else {
        // Guardar los cambios y deshabilitar la edición
        document.querySelectorAll('#cp, #cinv, #detalle_nombre, #detalle_cantidad, #detalle_precio_venta, #detalle_precio_compra, #detalle_inventario, #detalle_categoria')
            .forEach(input => input.readOnly = true);
        editBtn.textContent = "Editar";
        saveDetails(); // Cambio aquí para llamar a saveDetails
    }
}
function deleteProduct(){
    document.querySelectorAll('#cp, #cinv, #detalle_nombre, #detalle_cantidad, #detalle_precio_venta, #detalle_precio_compra, #detalle_inventario, #detalle_categoria')
            .forEach(input => input.readOnly = true);
            var cp = document.getElementById('cp').value;
    var cinv = document.getElementById('cinv').value;
    var nombre = document.getElementById('detalle_nombre').value;
    var cantidad = document.getElementById('detalle_cantidad').value;
    var precioVenta = document.getElementById('detalle_precio_venta').value;
    var precioCompra = document.getElementById('detalle_precio_compra').value;
    var inventario = false;
    var categoria = document.getElementById('detalle_categoria').value;

    console.log("Guardar detalles", cp, cinv, nombre, cantidad, precioVenta, precioCompra, inventario, categoria);
    updateProductInDB(cp, cinv, nombre, cantidad, precioVenta, precioCompra, inventario, categoria);
}

function saveDetails() {
    var cp = document.getElementById('cp').value;
    var cinv = document.getElementById('cinv').value;
    var nombre = document.getElementById('detalle_nombre').value;
    var cantidad = document.getElementById('detalle_cantidad').value;
    var precioVenta = document.getElementById('detalle_precio_venta').value;
    var precioCompra = document.getElementById('detalle_precio_compra').value;
    var inventario = document.getElementById('detalle_inventario').value;
    var categoria = document.getElementById('detalle_categoria').value;

    console.log("Guardar detalles", cp, cinv, nombre, cantidad, precioVenta, precioCompra, inventario, categoria);
    updateProductInDB(cp, cinv, nombre, cantidad, precioVenta, precioCompra, inventario, categoria);
}

function updateProductInDB(cp, cinv, nombre, cantidad, precioVenta, precioCompra, inventario, categoria) {
    fetch('editar.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `cp=${encodeURIComponent(cp)}&cinv=${encodeURIComponent(cinv)}&nombre=${encodeURIComponent(nombre)}&cantidad=${encodeURIComponent(cantidad)}&precioVenta=${encodeURIComponent(precioVenta)}&precioCompra=${encodeURIComponent(precioCompra)}&inventario=${encodeURIComponent(inventario)}&categoria=${encodeURIComponent(categoria)}`
    })
    .then(response => response.text())
    .then(data => {
        console.log(data);
    })
    .catch(error => console.error('Error:', error));

    location.reload();
}
var deetallesVenta=[];
function agregarLista(btn) {
    var nombreProducto = btn.getAttribute('data-nombre');
    var precioVenta = btn.getAttribute('data-precio-venta');
    var cantidad = btn.getAttribute('data-cantidad');
    var cp = btn.getAttribute('data-cp');

    var precioTotalProducto = parseFloat(precioVenta) * parseInt(cantidad);

    var nuevoProductoHtml = `
        <div class="Contendorproducto">
            <div class="row">
                <h5 class="tituloProducto">${nombreProducto}</h5>
                <p>${precioVenta} Bs. x ${cantidad} = ${precioTotalProducto.toFixed(2)} Bs.</p>
            </div>
        </div>`;

    document.querySelector('.contendorDeProductos').innerHTML += nuevoProductoHtml;
    deetallesVenta.push({ cp: cp, nombre: nombreProducto, precio: precioVenta, cantidad: cantidad });

    actualizarTotal(precioVenta, cantidad);  // Asegúrate de pasar la cantidad aquí
}

function updateCantidad(inputElement, productId) {
    var button = document.querySelector(`button[data-cp='${productId}']`);
    button.setAttribute('data-cantidad', inputElement.value);
}

function realizarVenta() {
    $('#clienteModal').modal('show'); // Mostrar el modal
}

function finalizarVenta() {
    var metodoPago = document.getElementById('metodoPago').value;
    console.log('Método de Pago seleccionado:', metodoPago);

    var productos = document.querySelectorAll('.Contendorproducto');
    var totalVenta = parseFloat(document.querySelector('.tituloProducto2').parentNode.children[1].textContent);
console.log(productos);
    
    var clienteCI = document.getElementById('clienteCI').value;
    var clienteNombres = document.getElementById('clienteNombres').value;
    var clienteApellidos = document.getElementById('clienteApellidos').value;

    if (!clienteCI || !clienteNombres || !clienteApellidos) {
        alert("Por favor, complete todos los campos del cliente.");
        return;
    }
    console.log("ddfa");
console.log(deetallesVenta);

    enviarVenta(deetallesVenta, totalVenta, clienteCI, clienteNombres, clienteApellidos,metodoPago);
}

function enviarVenta(detallesVenta, total, ci, nombres, apellidos,metodoPago) {
    console.log("Enviando al servidor:", detallesVenta, "Total:", total, "CI:", ci, "Nombres:", nombres, "Apellidos:", apellidos);

    fetch('venta.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `clienteCI=${encodeURIComponent(ci)}&clienteNombres=${encodeURIComponent(nombres)}&clienteApellidos=${encodeURIComponent(apellidos)}&detallesVenta=${encodeURIComponent(JSON.stringify(detallesVenta))}&totalVenta=${encodeURIComponent(total)}&metodoPago=${encodeURIComponent(metodoPago)}`
    })
    location.reload();

    
}

function actualizarTotal(precioNuevo, cantidad) {
    var totalElemento = document.querySelector('.tituloProducto2').parentNode.children[1];
    var totalActual = parseFloat(totalElemento.textContent);
    var nuevoTotal = totalActual + (parseFloat(precioNuevo) * parseInt(cantidad));
    totalElemento.textContent = `${nuevoTotal.toFixed(2)} Bs.`;
}
