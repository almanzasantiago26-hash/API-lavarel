<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f5f5f5; padding: 40px 0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; }
        .card { border-radius: 8px; border: 1px solid #e0e0e0; }
        .card-header { background: #2c3e50; color: white; border-radius: 8px 8px 0 0 !important; }
        .btn-primary { background: #2c3e50; border-color: #2c3e50; }
        .btn-primary:hover { background: #34495e; border-color: #34495e; }
        .item-row { border-left: 3px solid #2c3e50; padding-left: 12px; margin-bottom: 10px; }
    </style>
</head>
<body>
<div class="container" style="max-width:600px;">
    <div class="card shadow-sm">
        <div class="card-header py-3">
            <h4 class="mb-0">🛒 Resumen de tu pedido</h4>
        </div>
        <div class="card-body">
            <div id="resumen-productos"></div>
            <hr>
            <div class="d-flex justify-content-between fw-bold fs-5">
                <span>Total a pagar:</span>
                <span class="text-success" id="total-label"></span>
            </div>
        </div>
        <div class="card-footer">
            <form action="/orders" method="POST" id="form-checkout">
                @csrf
                <div id="inputs-hidden"></div>
                <div class="d-flex gap-2">
                    <a href="/productos" class="btn btn-outline-secondary w-50">← Volver</a>
                    <button type="submit" class="btn btn-primary w-50" id="btn-confirmar">Confirmar compra</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let carrito = [];
    try {
        carrito = JSON.parse(localStorage.getItem('carrito'));
        if (!Array.isArray(carrito)) carrito = [];
    } catch { carrito = []; }

    const resumen = document.getElementById('resumen-productos');
    const inputsHidden = document.getElementById('inputs-hidden');
    const totalLabel = document.getElementById('total-label');
    const btnConfirmar = document.getElementById('btn-confirmar');

    if (carrito.length === 0) {
        resumen.innerHTML = '<p class="text-muted text-center py-3">No hay productos en tu carrito.</p>';
        btnConfirmar.disabled = true;
    } else {
        let total = 0;
        carrito.forEach(item => {
            let subtotal = item.cantidad * item.price;
            total += subtotal;
            resumen.innerHTML += `
                <div class="item-row mb-3">
                    <div class="d-flex justify-content-between">
                        <span><strong>${item.name}</strong></span>
                        <span class="text-success">${subtotal.toLocaleString('es-CO')} COP</span>
                    </div>
                    <small class="text-muted">Cantidad: ${item.cantidad} × ${Number(item.price).toLocaleString('es-CO')} COP</small>
                </div>`;
            inputsHidden.innerHTML += `<input type="hidden" name="product_id[]" value="${item.id}">`;
            inputsHidden.innerHTML += `<input type="hidden" name="cantidad[]" value="${item.cantidad}">`;
        });
        totalLabel.textContent = total.toLocaleString('es-CO') + ' COP';
    }

    // Limpiar carrito al confirmar
    document.getElementById('form-checkout').addEventListener('submit', function() {
        localStorage.removeItem('carrito');
    });
</script>
</body>
</html>
