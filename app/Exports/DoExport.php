<?php

namespace App\Exports;

use App\Models\DoLists;
use Maatwebsite\Excel\Concerns\FromCollection;

class DoExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DoLists::all();
    }
}
