<?php

namespace App\Exports;

use App\Models\cliente;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Illuminate\Support\Collection;

class ClientesExport implements FromCollection, WithHeadings, WithColumnFormatting
{
    public function collection(): Collection
    {
        return cliente::with('juego')
            ->where('estado', 'activo')
            ->get()
            ->map(function ($cliente) {
                return [
                    
                    'Nombre' => $cliente->nombre,
                    'Identificación' => (string) $cliente->numero_identificacion,
                    'Teléfono' => (string) $cliente->numero_telefono,
                    'Juego' => $cliente->juego?->nombre ?? 'Sin juego',
                ];
            });
    }

    public function headings(): array
    {
        return ['ID', 'Nombre', 'Identificación', 'Teléfono', 'Juego'];
    }

    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_TEXT,
            'D' => NumberFormat::FORMAT_TEXT,
        ];
    }
     public function columnWidths(): array
    {
        return [
            
            'B' => 30,  // Nombre
            'C' => 80,  // Identificación
            'D' => 80,  // Teléfono
            'E' => 25,  // Juego
        ];
    }
}