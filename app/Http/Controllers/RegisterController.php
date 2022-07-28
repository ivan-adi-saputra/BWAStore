<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('pages.register.index');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255', 
            'email' => 'required|email:dns|unique:users', 
            // 'address_one' => 'The :attribute field is required.', 
            // 'address_two' => 'The :attribute field is required.', 
            // 'provinces_id' => 'The :attribute field is required.', 
            // 'regencies_id' => 'The :attribute field is required.', 
            // 'zip_code' => 'The :attribute field is required.', 
            // 'country' => 'The :attribute field is required.', 
            // 'phone_number' => 'The :attribute field is required.', 
            // 'store_name' => 'The :attribute field is required.', 
            // 'store_status' => 'The :attribute field is required.', 
            // 'roles' => 'The :attribute field is required.', 
            // 'category_id' => 'The :attribute field is required.'
        ]);
        $validatedData['password'] = bcrypt($request->password);

        User::create($validatedData);
        return redirect()->route('register-success');
    }
     
    public function success()
    {
        return view('pages.register.success');
    }
}
