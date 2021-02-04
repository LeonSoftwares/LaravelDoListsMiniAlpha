<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exports\UserExport;
use App\Exports\DoExport;

use App\Imports\DoImport;
use App\Imports\UserImport;

use Maatwebsite\Excel\Facades\Excel;

class ImportExportListsController extends Controller
{
    function index()
    {
    	$name_page = 'Импорт/Экспорт';
    	return view('ImportExport', compact('name_page'));
    }

    public function importFileDo(Request $request)
    {
    	$file = $request->file('importFile');
        $file_name = time().'_'.$file->getClientOriginalName();
    	$file->move(storage_path('files'), $file_name);

        //$file_to = storage_path('files').DIRECTORY_SEPARATOR.time().'_'.$file->getClientOriginalName();

    	//Excel::import(new DoImport, $file_path);

        //dd(storage_path('files'.DIRECTORY_SEPARATOR.$file_name));

        Excel::import( new DoImport, storage_path('files'.DIRECTORY_SEPARATOR.$file_name) );

    	return redirect()->route('do-lists')->send();
    }

     public function importFileUser(Request $request)
    {
        $file = $request->file('importFile');
        $file->move(storage_path('files'), time().'_'.$file->getClientOriginalName());

        dd($file);

        //return redirect()->route('do-lists')->send();
    }

    public function exportFileDo(Request $request)
    {
        return Excel::download(new DoExport, 'do.xlsx');
    }

    public function exportFileUser(Request $request)
    {
        return Excel::download(new UserExport, 'user.xlsx');
    }
}
