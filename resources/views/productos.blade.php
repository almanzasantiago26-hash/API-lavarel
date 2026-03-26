<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tienda — Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen', 'Ubuntu', 'Cantarell', sans-serif;
            color: #333;
        }

        .container-main {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            background: white;
            padding: 25px;
            margin-bottom: 30px;
            border-radius: 8px;
            border-left: 4px solid #2c3e50;
        }

        .header h1 {
            color: #2c3e50;
            margin: 0;
            font-weight: 500;
            font-size: 28px;
        }

        .products-section {
            margin-bottom: 30px;
        }

        .product-card {
            background: white;
            border-radius: 8px;
            padding: 18px;
            margin-bottom: 15px;
            border: 1px solid #e0e0e027;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: border-color 0.2s ease;
        }

        .product-card:hover {
            border-color: #bbb;
        }

        .product-info h5 {
            color: #2c3e50;
            margin: 0 0 8px 0;
            font-weight: 500;
            font-size: 16px;
        }

        .product-info p {
            color: #777;
            margin: 0;
            font-size: 13px;
        }

        .btn-add {
            background: #2c3e50;
            border: 1px solid #2c3e50;
            color: white;
            padding: 8px 18px;
            border-radius: 6px;
            font-weight: 500;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.2s ease;
            white-space: nowrap;
            margin-left: 10px;
        }

        .btn-add:hover {
            background: #34495e;
            color: white;
            text-decoration: none;
        }

        .carrito-section {
            position: fixed;
            right: 30px;
            top: 20px;
            width: 340px;
            max-height: 600px;
            background: white;
            border-radius: 8px;
            border: 1px solid #e0e0e018;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .carrito-header {
            background: white;
            color: #2c3e50;
            padding: 16px;
            border-bottom: 1px solid #e0e0e0;
            border-radius: 8px 8px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 600;
            font-size: 16px;
        }

        .carrito-header span {
            background: #f0f0f01c;
            color: #2c3e50;
            padding: 4px 10px;
            border-radius: 4px;
            font-size: 13px;
            font-weight: 500;
        }

        .carrito-content {
            padding: 15px;
            max-height: 400px;
            overflow-y: auto;
        }

        .carrito-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px;
            background: #fafafa;
            border-radius: 6px;
            margin-bottom: 10px;
            border-left: 3px solid #2c3e50;
        }

        .item-info {
            flex: 1;
        }

        .item-name {
            color: #2c3e50;
            font-weight: 500;
            margin: 0;
            font-size: 14px;
        }

        .item-cantidad {
            color: #777;
            font-weight: 400;
            font-size: 13px;
            margin: 4px 0 0 0;
        }

        .btn-remove {
            background: #e0e0e0;
            color: #666;
            border: none;
            padding: 4px 8px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 11px;
            transition: background-color 0.2s ease;
            margin-left: 10px;
            font-weight: 500;
        }

        .btn-remove:hover {
            background: #ccc;
            color: #333;
        }

        .carrito-vacio {
            text-align: center;
            padding: 30px 20px;
            color: #bbb;
            font-size: 14px;
        }

        .carrito-vacio-icon {
            font-size: 36px;
            margin-bottom: 10px;
            opacity: 0.6;
        }

        .carrito-footer {
            border-top: 1px solid #e0e0e015;
            padding: 14px;
            background: #fafafa;
            border-radius: 0 0 8px 8px;
        }

        .carrito-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 500;
            color: #2c3e50;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .carrito-total span {
            color: #2c3e50;
            font-size: 16px;
            font-weight: 600;
        }

        .btn-checkout {
            width: 100%;
            background: #2c3e50;
            color: white;
            border: 1px solid #2c3e50;
            padding: 10px;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s ease;
            margin-top: 8px;
            font-size: 14px;
        }

        .btn-checkout:hover:not(:disabled) {
            background: #34495e;
        }

        .btn-checkout:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            background: #ccc;
            border-color: #ccc;
        }

        @media (max-width: 768px) {
            .carrito-section {
                position: static;
                width: 100%;
                max-height: none;
                margin-top: 30px;
            }

            .product-card {
                flex-direction: column;
                text-align: center;
            }

            .btn-add {
                margin-left: 0;
                margin-top: 10px;
                width: 100%;
            }
        }

        .badge-cart {
            display: inline-block;
            background: #cccccc10;
            color: #333;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="container-main">
        <div class="header">
            <h1>🛍️ CATALOGO DE PRODUCTOS</h1>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="products-section">
                    @foreach($products as $product) 
                        <div class="product-card">
                            <div class="product-info">
                                <h5>{{ $product->name }}</h5>
                                <p><strong>ID:</strong> {{ $product->id }}</p>
                                <p><strong>Precio:</strong> <span class="text-success">${{ number_format($product->price, 0, ',', '.') }} COP</span></p>
                            </div>
                            <button class="btn-add"
                                data-id="{{ $product->id }}"
                                data-name="{{ $product->name }}"
                                data-price="{{ $product->price }}"
                                onclick="agregarAlcarrito(this)">
                                ➕ Añadir al carrito
                            </button>
                        </div>
                    @endforeach 
                </div>
            </div>

            <div class="col-lg-4">
                <div class="carrito-section">
                    <div class="carrito-header">
                        <div>🛒 Mi Carrito</div>
                        <span id="badge-count">0</span>
                    </div>
                    <div class="carrito-content" id="carrito">
                        <div class="carrito-vacio">
                            <div class="carrito-vacio-icon">🛒</div>
                            <p>Tu carrito está vacío</p>
                        </div>
                    </div>
                    <div class="carrito-footer">
                        <div class="carrito-total">
                            <span>Total de artículos:</span>
                            <span id="total-items">0</span>
                        </div>
                        <button class="btn-checkout" id="btn-comprar" onclick="finalizarCompra()" disabled>
                            Finalizar Compra
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Siempre inicializa el carrito como array
        let carrito = [];
        try {
            carrito = JSON.parse(localStorage.getItem('carrito'));
            if (!Array.isArray(carrito)) carrito = [];
        } catch { carrito = []; }

        // Mostrar el carrito al cargar la página
        document.addEventListener('DOMContentLoaded', mostrarCarrito);
        
        function agregarAlcarrito(btn){
            let product = {
                id:    parseInt(btn.dataset.id),
                name:  btn.dataset.name,
                price: parseFloat(btn.dataset.price),
            };
            let posicion = carrito.findIndex(item => item.id === product.id)
            if(posicion !== -1){
                carrito[posicion].cantidad = (carrito[posicion].cantidad || 1) + 1;
            } else {
                product.cantidad = 1;
                carrito.push(product);
            }
            localStorage.setItem("carrito", JSON.stringify(carrito));
            mostrarCarrito();
        }

        function eliminarDelCarrito(productId) {
            carrito = carrito.filter(item => item.id !== productId)
            localStorage.setItem("carrito" , JSON.stringify(carrito))
            mostrarCarrito();
        }

        function mostrarCarrito(){
            let divcarrito = document.getElementById('carrito')
            let buyBtn = document.getElementById('btn-comprar')
            let totalItems = document.getElementById('total-items')
            let badge = document.getElementById('badge-count')

            if(carrito.length === 0) {
                divcarrito.innerHTML = `
                    <div class="carrito-vacio">
                        <div class="carrito-vacio-icon">🛒</div>
                        <p>Tu carrito está vacío</p>
                    </div>
                `;
                buyBtn.disabled = true;
                totalItems.textContent = '0';
                badge.textContent = '0';
                document.getElementById('total-precio')?.remove();
            } else {
                let items = carrito.map(item => `
                    <div class="carrito-item">
                        <div class="item-info">
                            <p class="item-name">${item.name}</p>
                            <p class="item-cantidad">Cantidad: <strong>${item.cantidad}</strong></p>
                            <p class="item-precio">Precio: <span class="text-success">$${Number(item.price).toLocaleString('es-CO')} COP</span></p>
                        </div>
                        <button class="btn-remove" onclick="eliminarDelCarrito(${item.id})">Eliminar</button>
                    </div>
                `).join('');

                divcarrito.innerHTML = items;
                buyBtn.disabled = false;
                
                let totalDatos = carrito.reduce((sum, item) => sum + item.cantidad, 0);
                totalItems.textContent = totalDatos;
                badge.textContent = totalDatos;

                // Calcular el total de precios
                let totalPrecio = carrito.reduce((sum, item) => sum + (item.price * item.cantidad), 0);
                let totalPrecioHtml = `<div id="total-precio" class="carrito-total" style="margin-top:10px;">
                    <span>Total a pagar:</span>
                    <span class="text-success">$${totalPrecio.toLocaleString('es-CO')} COP</span>
                </div>`;
                let footer = document.querySelector('.carrito-footer');
                if(document.getElementById('total-precio')){
                    document.getElementById('total-precio').outerHTML = totalPrecioHtml;
                } else {
                    footer.insertAdjacentHTML('afterbegin', totalPrecioHtml);
                }
            }
        }

        function finalizarCompra() {
            if(carrito.length === 0) {
                alert('Tu carrito está vacío');
                return;
            }
            window.location.href = '/checkout';
        }
    </script>
</body>
</html>