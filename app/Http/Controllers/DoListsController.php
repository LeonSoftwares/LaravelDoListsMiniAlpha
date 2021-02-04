<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\DoLists;
use Carbon\Carbon;

class DoListsController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$name_page = "Список ваших дел";
    	$do_lists = DoLists::where('user_id', Auth::id())->orderBy('order_item', 'ASC')->get(); 
    	return view('doLists', compact('name_page', 'do_lists'));
    }

    public function create(Request $request)
    {
    	if ( $request->isMethod('post') )
    	{
    		$this->doSave($request);
    	}

    	$name_page = "Создать новое дело";
    	return view('doListsCreate', compact('name_page'));
    }

    private function doSave($data)
    {
    	$id = DoLists::insertGetId(
    		[
    			'name' => $data->input('name'),
        		'do' => $data->input('do'),
        		'status' => $data->input('status'),
        		'user_id'	=> Auth::id(),
        		'created_at' => Carbon::now(),
    		]
    	);

        DoLists::where('id', $id)->update(
            [
                'order_item' => $id,
            ]
        );
    	return redirect()->route('do-lists')->send();
    }

    private function doUpdate($data, $id)
    {
    	DoLists::where('id', $id)->update([
    		'name' => $data->input('name'),
        	'do' => $data->input('do'),
        	'status' => $data->input('status'),
            'order_item'  => $id,
        	'user_id'	=> Auth::id(),
        	'created_at' => Carbon::now(),
    	]);

    	return redirect()->route('do-lists')->send();
    }

    public function edit(Request $request, $id)
    {	
    	if ( $request->isMethod('post') )
    	{
    		$this->doUpdate($request, $id);
    	}
    	$data = DoLists::where('id', $id)->first();
    	$name_page = "Редактирование задания";
    	return view('doListsEdit', compact('name_page', 'data'));
    }

    public function order(Request $request)
    {
        if ( $request->has('ids') ) 
        {
            $arr = explode(',', $request->input('ids'));

            foreach ($arr as $order_item => $id) 
            {
                $menu = DoLists::where('id', $id)->first();
                $menu->order_item = $order_item;
                $menu->save();
            }

            return response()->json(['success'=>true]);
        }
    }

    public function delete($id)
    {
    	DoLists::where('id', $id)->delete();
    	redirect()->route('do-lists')->send();
    }
}
