<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class ReporteController extends Controller
{
    public function index(Request $request)
    {
        $query = Venta::with(['producto', 'usuario']);

        $hoy = Carbon::today();
        $minFecha = $hoy->copy()->subYear();

        if ($request->filled('fecha_inicio')) {
            $fechaInicio = Carbon::parse($request->fecha_inicio);
            if ($fechaInicio->lt($minFecha)) $fechaInicio = $minFecha;
            $query->whereDate('created_at', '>=', $fechaInicio);
        }

        if ($request->filled('fecha_fin')) {
            $fechaFin = Carbon::parse($request->fecha_fin);
            if ($fechaFin->gt($hoy)) $fechaFin = $hoy;
            $query->whereDate('created_at', '<=', $fechaFin);
        }

        $ventas = $query->orderBy('created_at', 'desc')->get();

        $totalVentas = $ventas->sum('total');
        $cantidadProductos = $ventas->sum('cantidad');

        return view('reportes.index', compact('ventas', 'totalVentas', 'cantidadProductos'));
    }

    public function generarPDF(Request $request)
    {
        $query = Venta::with(['producto', 'usuario']);

        if ($request->filled('fecha_inicio')) {
            $query->whereDate('created_at', '>=', $request->fecha_inicio);
        }
        if ($request->filled('fecha_fin')) {
            $query->whereDate('created_at', '<=', $request->fecha_fin);
        }

        $ventas = $query->orderBy('created_at', 'desc')->get();

        $totalVentas = $ventas->sum('total');
        $cantidadProductos = $ventas->sum('cantidad');

        $pdf = Pdf::loadView('reportes.pdf', compact('ventas', 'totalVentas', 'cantidadProductos'));
        return $pdf->download('reporte_ventas.pdf');
    }

    // 🧾 Mostrar factura individual
    public function factura($id)
    {
        $venta = Venta::with(['producto.categoria', 'usuario'])->findOrFail($id);
        return view('reportes.factura', compact('venta'));
    }

    // 🧾 Generar PDF individual
    public function facturaPDF($id)
    {
        $venta = Venta::with(['producto.categoria', 'usuario'])->findOrFail($id);

        $pdf = Pdf::loadView('reportes.factura_pdf', compact('venta'));
        return $pdf->download('factura_venta_' . $venta->id . '.pdf');
    }
}
