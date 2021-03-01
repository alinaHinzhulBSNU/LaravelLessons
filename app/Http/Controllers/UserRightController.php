<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserRightController extends Controller
{

    public function __construct(Request $request){
        $this->middleware('auth');
        $this->middleware('admin');
    }

    //CREATE
    public function create(){
        return view('users/create', [
            'users' => \App\User::all()->sortBy('name'),
        ]);
    }

    public function store(){
        $data = $this->validateData(\request());

        \App\UserRight::create([
            'model' => $data['model'],
            'right' => $data['right'],
            'user_id' => $data['user'],
        ]);
        return redirect("admin/users");
    }

	//READ
    public function index(){
        $rights = \App\UserRight::all()->sortBy("model");

    	return view('users/index', [
    			'rights' => $rights,
    	]);
    }
    public function edit($id){
    	$right = \App\UserRight::find($id);
        return view("/users/edit", [
            'right' => $right,
            'users' => \App\User::all()->sortBy('name'),
        ]);
    }

    //UPDATE
    public function update($id){
    	$right = \App\UserRight::find($id);

        $data = $this->validateData(\request());

        $right->model = $data['model'];
        $right->right = $data['right'];
        $user = \App\User::find($data['user']);
        $right->user()->associate($user);

        $right->save();

        return redirect("admin/users");
    }

    //DELETE
    public function destroy($id){
    	$right = \App\UserRight::find($id);
        $right->delete();
        
        return redirect("admin/users");
    }

    //VALIDATION
    private function validateData($data){
        return $this->validate($data, [
            'model' => ['required', 'max:100'],
            'right' => ['required', 'max:100'],
            'user' => ['required', Rule::exists('users', 'id')],
        ], [
            'model.required' => 'Назва моделі має бути заповнена!',
            'model.max' => 'Назва моделі має бути менше 100 символів!',
            'right.required' => 'Назва права має бути заповнена!',
            'right.max' => 'Назва права має бути менше 100 символів!',
            'user.required' => "Ім'я користувача має бути заповнене!",
            'user.exists' => "Ви обрали неіснуючого користувача!",
        ]);
    }
}
