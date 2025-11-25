<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Ventas</title>
    <style>
        body { font-family: DejaVu Sans; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Reporte de Ventas</h2>
    <p><strong>Fecha de generación:</strong> {{ now()->format('d/m/Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>ID Venta</th>
                <th>Fecha</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Total</th>
                <th>Usuario</th>
                <th>Cliente</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ventas as $venta)
                <tr>
                    <td>{{ $venta->id }}</td>
                    <td>{{ $venta->created_at->format('Y-m-d H:i') }}</td>
                    <td>{{ $venta->producto->nombre ?? '—' }}</td>
                    <td>{{ $venta->cantidad }}</td>
                    <td>${{ number_format($venta->total, 0, ',', '.') }}</td>
                    <td>{{ $venta->usuario->name ?? '—' }}</td>
                    <td>{{ $venta->nombre_cliente ?? '—' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>
    <p><strong>Total vendido:</strong> ${{ number_format($totalVentas, 0, ',', '.') }}</p>
    <p><strong>Total productos vendidos:</strong> {{ $cantidadProductos }}</p>
</body>
</html>
