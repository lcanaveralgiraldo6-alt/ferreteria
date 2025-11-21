<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Factura de Venta</title>
    <style>
        body { font-family: DejaVu Sans; font-size: 12px; margin: 40px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
        h2, h4 { text-align: center; }
    </style>
</head>
<body>
    <h2>Ferretería Pico & Pala</h2>
    <h4>Factura de Venta No. {{ $venta->id }}</h4>

    <p><strong>Fecha:</strong> {{ $venta->created_at->format('d/m/Y H:i') }}</p>
    <p><strong>Cliente:</strong> {{ $venta->nombre_cliente ?? '—' }}</p>
    <p><strong>Vendedor:</strong> {{ $venta->usuario->name ?? 'Sin asignar' }}</p>

    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Categoría</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $venta->producto->nombre ?? '—' }}</td>
                <td>{{ $venta->producto->categoria->nombre ?? '—' }}</td>
                <td>{{ $venta->cantidad }}</td>
                <td>${{ number_format(($venta->total / $venta->cantidad), 0, ',', '.') }}</td>
                <td>${{ number_format($venta->total, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <br>
    <h4>Total a pagar: ${{ number_format($venta->total, 0, ',', '.') }}</h4>
    <p style="text-align:center;">Gracias por su compra 💪</p>
</body>
</html>
