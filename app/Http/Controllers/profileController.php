<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class profileController extends Controller
{
    
    public function edit_profile(){
        return view('admin.pegawai.profile')->with('user', auth()->user());
    }

    public function update_profile(Request $request){
        $user = auth()->user();

        $user->update([
           'name' => $request->name,
           'email' => $request->email,
           'password' => $request->password,
           'alamat' => $request->alamat,
           'telepon' =>$request->telepon,
        ]);
        return redirect(route('users.data-pegawai'))->with('success', 'Data Profile berhasil diperbarui!');

        
    }
}
