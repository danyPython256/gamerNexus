function agregarAlCarrito(nombre, precio){
    let carrito =JSON.parse(localStorage.getItem('carrito')) ||[];

    carrito.push({nombre: nombre, precio: precio, cantidad: 1}); 
    
    localStorage.setItem('carrito', JSON.stringify(carrito));

    alert(nombre + "Ha sido cargado al carrito. ");
}


function actualizarContadorCarrito() {
    let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
    let totalCantidad = carrito.reduce((total, producto) => total + producto.cantidad, 0);
    document.getElementById('carrito-count').innerText = totalCantidad;
}


document.addEventListener('DOMContentLoaded', actualizarContadorCarrito);

function eliminarDelCarrito(index) {
    let carrito = JSON.parse(localStorage.getItem('carrito'));
    carrito.splice(index, 1); 
    localStorage.setItem('carrito', JSON.stringify(carrito)); 
    mostrarCarrito(); 
    actualizarContadorCarrito(); 
}

function procesarPedido() {
    const carrito = JSON.parse(localStorage.getItem('carrito'));

    fetch('procesar_pedido.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(carrito)
    })
    .then(response => response.text())
    .then(data => {
        alert(data); 
        localStorage.removeItem('carrito'); 
        mostrarCarrito(); 
    })
    .catch(error => console.error('Error:', error));
}

