<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra Confirmada</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f5f5f5; padding: 40px 0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; }
        .card { border-radius: 8px; border: 1px solid #e0e0e0; }
        .card-header { background: #27ae60; color: white; border-radius: 8px 8px 0 0 !important; }
        .item-row { border-left: 3px solid #27ae60; padding-left: 12px; margin-bottom: 10px; }
        .order-id { background: #f0f9f4; border: 1px solid #27ae60; border-radius: 6px; padding: 10px 16px; color: #27ae60; font-weight: 600; }
        .btn-volver { background: #2c3e50; border-color: #2c3e50; color: white; }
        .btn-volver:hover { background: #34495e; color: white; }
    </style>
</head>
<body>
<div class="container" style="max-width:600px;">
    <div class="card shadow-sm">
        <div class="card-header py-3 text-center">
            <h4 class="mb-0">✅ ¡Compra realizada con éxito!</h4>
        </div>
        <div class="card-body">
            <div class="order-id text-center mb-4">
                Orden #{{ $order->id }}
            </div>

            <h6 class="text-muted mb-3">Productos comprados:</h6>

            @foreach($items as $item)
                <div class="item-row">
                    <div class="d-flex justify-content-between">
                        <span><strong>{{ $item['product']->name }}</strong></span>
                        <span class="text-success">{{ number_format($item['subtotal'], 0, ',', '.') }} COP</span>
                    </div>
                    <small class="text-muted">
                        Cantidad: {{ $item['cantidad'] }} × {{ number_format($item['product']->price, 0, ',', '.') }} COP
                    </small>
                </div>
            @endforeach

            <hr>
            <div class="d-flex justify-content-between fw-bold fs-5">
                <span>Total pagado:</span>
                <span class="text-success">{{ number_format($total, 0, ',', '.') }} COP</span>
            </div>

            <div class="mt-3 text-muted" style="font-size:13px;">
                <p class="mb-1">📅 Fecha: {{ now()->format('d/m/Y H:i') }}</p>
                <p class="mb-0">📦 Estado: <span class="badge bg-warning text-dark">Pendiente</span></p>
            </div>
        </div>
        <div class="card-footer text-center">
            <a href="/productos" class="btn btn-volver px-4">← Seguir comprando</a>
        </div>
    </div>
</div>
</body>
</html>
