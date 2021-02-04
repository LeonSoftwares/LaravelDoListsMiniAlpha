<?php

namespace App\Imports;


use App\Models\DoLists;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DoImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return DoLists|null
     */
    public function model(array $row)
    {
    	if (!empty($row[0])) {
    		return new DoLists([
	           'name'     => $row[0],
	           'do'    => $row[1], 
	           'status' => $row[2],
	           'order_item' => '1',
	           'user_id' => Auth::id(),
	           'created_at' => Carbon::now(),
        ]);
    	}
    }

}
