<?php

namespace App\Exports;

use App\Models\Commodity;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CommodityExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Commodity::select(
            ['id','name',]
        )->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'name'
        ];
    }

    public function map($commodity): array
    {
        return [
            $commodity->id,
            $commodity->name, 
        ];
    }
}
