<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserListsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$name_page = 'Пользователи';
    	$users_list = User::all();
    	return view('usersLists', compact('name_page', 'users_list'));
    }

    public function create(Request $request)
    {
    	if ( $request->isMethod('post') )
    	{
    		$this->userSave($request);
    	}

    	$name_page = 'Создать пользователя';
    	return view('userListsCreate', compact('name_page'));
    }

    private function userSave($data)
    {
    	User::insert([
    		'name'  =>  $data->input('name'),
    		'email'  => $data->input('email'),
    		'email_verified_at' => Carbon::now(),
    		'password' => bcrypt($data->input('password')),
    		'created_at'  =>  Carbon::now(),
    	]);

    	return redirect()->route('users-lists')->send();
    }

    private function userUpdate($data, $id)
    {
    	User::where('id', $id)->update([
    		'name'  =>  $data->input('name'),
    		'email'  => $data->input('email'),
    		'email_verified_at' => Carbon::now(),
    		'password' => bcrypt($data->input('password')),
    		'created_at'  =>  Carbon::now(),
    	]);

    	return redirect()->route('user-lists')->send();
    }

    public function edit(Request $request, $id)
    {
    	if ( $request->isMethod('post') )
    	{
    		$this->userUpdate($request, $id);
    	}
    	$data = User::where('id', $id)->first();
    	$name_page = "Редактировать пользователя";
    	return view('userListsEdit', compact('name_page', 'data'));
    }

    public function order(Request $request)
    {
        if ( $request->has('ids') ) 
        {
            $arr = explode(',', $request->input('ids'));

            foreach ($arr as $order_item => $id) 
            {
                $menu = User::where('id', $id)->first();
                $menu->order_item = $order_item;
                $menu->save();
            }

            return response()->json(['success'=>true]);
        }
    }

    public function delete($id)
    {
    	User::where('id', $id)->delete();
    	redirect()->route('user-lists')->send();
    }

}
