<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePegawaiRequest;
use App\Http\Requests\UpdatePegawaiRequest;

class UserController extends Controller
{
    

    public function index()
    {
        $users = User::all();

        return view('admin.pegawai.index', ['users' => $users]);
    }

    public function create()
    {
        return view('admin.pegawai.create');
    }

    public function store(StorePegawaiRequest $request)
    {
        $tambah_pegawai = new User;
        $tambah_pegawai->name = $request->name;
        $tambah_pegawai->email = $request->email;
        $tambah_pegawai->password = 'user123';
        $tambah_pegawai->alamat = $request->alamat;
        $tambah_pegawai->telepon = $request->telepon;
        $tambah_pegawai->role = $request->role;
        $tambah_pegawai->save();

        return redirect(route('users.data-pegawai'))->with('success', 'Berhasil ditambahkan!');

    }

    public function edit($id)
    {
    $pegawai = User::find($id);

    return view('admin.pegawai.edit', compact('pegawai'));
    }

    public function update(Request $request, $id){
        $pegawai = User::find($id);
        $pegawai->name = $request->name;
        $pegawai->email = $request->email;
        $pegawai->alamat = $request->alamat;
        $pegawai->telepon = $request->telepon;
        $pegawai->role = $request->role;
        $pegawai->update();

        return redirect(route('users.data-pegawai'))->with('success', 'Berhasil diubah!');
    }

    public function destroy($id)
    {
        $pegawai = User::find($id);

        if ($pegawai->delete()) {
            return redirect(route('users.data-pegawai'))->with('success', 'Deleted!');
        }

        return redirect(route('users.data-pegawai'))->with('error', 'Sorry, unable to delete this!');
    }

    public function resetSisaCuti()
    {
        // Reset sisa cuti menjadi 12 untuk semua pegawai
        User::query()->update(['jml_cuti' => 12]);

        // Redirect kembali ke halaman data pegawai dengan pesan sukses
        return redirect()->route('users.data-pegawai')->with('success', 'Sisa cuti berhasil direset.');
    }

public function resetPass(Request $request, $id)
    {
        $pegawai = User::find($id);
        $pegawai->password = bcrypt('user123');
        $pegawai->save();

        // Redirect kembali ke halaman data pegawai dengan pesan sukses
        return redirect()->route('users.data-pegawai')->with('success', 'Password pengguna terpilih berhasil direset menjadi user123.');
    }

    

}
