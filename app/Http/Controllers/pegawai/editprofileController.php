<?php

namespace App\Http\Controllers\pegawai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class editprofileController extends Controller
{
    public function edit_profile(){
        return view('pegawai.profile')->with('user', auth()->user());
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
        return redirect(route('ajucutis.index'))->with('success', 'Data Profile berhasil diperbarui!');

        
    }
}
