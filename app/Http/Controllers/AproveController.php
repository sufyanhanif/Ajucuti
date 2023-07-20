<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\ajucutis;
use Illuminate\Http\Request;

class AproveController extends Controller
{
    public function index()
    {
        // Mengambil semua data cuti
        $ajucutis = Ajucutis::with('users')->get();
    
        // Mengirim data cuti ke view
        return view('admin.aprove.index', compact('ajucutis'));
    }

    public function setuju($id)
    {
        $ajucuti = ajucutis::findOrFail($id);

        // Ubah status menjadi 'setuju'
        $ajucuti->status = 'setuju';
        $ajucuti->save();

        // Kurangi sisa cuti pengguna yang dipilih
        $user = User::findOrFail($ajucuti->id_users);

        $mulaiCuti = Carbon::parse($ajucuti->mulai_cuti);
        $selesaiCuti = Carbon::parse($ajucuti->selesai_cuti);

        $duration = $mulaiCuti->diffInDays($selesaiCuti);

        $user->jml_cuti -= $duration;
        $user->save();

        return redirect()->back()->with('success', 'Cuti telah disetujui.');
    }

public function tolak($id)
    {
    $ajucuti = ajucutis::findOrFail($id);
    $ajucuti->status = 'tolak';
    $ajucuti->save();

    return redirect()->back()->with('success', 'Cuti ditolak.');
    }
}
