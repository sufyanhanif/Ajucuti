<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Ajucuti;
use App\Models\ajucutis;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjuController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $ajucutis = ajucutis::where('id_users', $user->id)->get();

        return view('admin.cuti.index', compact('ajucutis'));
    }

    
    public function create()
    {
        return view('admin.cuti.create');
    }

    public function store(Request $request)
    {
        
        $today = Carbon::today()->format('Y-m-d');

        $request->validate([
            'mulai_cuti' => "required|date|after_or_equal:$today",
            'selesai_cuti' => "required|date|after:mulai_cuti",
            'alasan' => 'required',
        ]);
    
        // Retrieve the user's remaining leave days (jml_cuti)
        $user = User::findOrFail(auth()->user()->id);
        $remainingLeaveDays = $user->jml_cuti;
    
        // Calculate the total number of leave days
        $mulaiCuti = $request->mulai_cuti;
        $selesaiCuti = $request->selesai_cuti;
        $totalLeaveDays = Carbon::parse($mulaiCuti)->diffInDays($selesaiCuti) + 1;
    
        // Check if the total leave days exceed the remaining leave days
        if ($totalLeaveDays > $remainingLeaveDays) {
            return redirect()->back()->with('error', 'Tidak dapat mengajukan cuti. Jumlah cuti yang diajukan melebihi sisa cuti Anda.');
        }

        if ($remainingLeaveDays <= 0) {
            return redirect()->back()->with('error', 'Tidak dapat mengajukan cuti. Jumlah cuti Anda telah habis.');
        }
    
        // Create a new instance of ajucutis with the input data
        $ajucuti = new ajucutis();
        $ajucuti->mulai_cuti = $mulaiCuti;
        $ajucuti->selesai_cuti = $selesaiCuti;
        $ajucuti->alasan = $request->alasan;
        $ajucuti->status = 'tunggu';
        $ajucuti->id_users = auth()->user()->id;// Set initial status
    
        // Save the leave request
        $ajucuti->save();

        $ajucuti->users()->attach(auth()->user()->id);
    
        return redirect()->route('ajucutis.index')->with('success', 'Pengajuan cuti berhasil diajukan');
    }

    public function edit($id)
    {
    // Find the ajucutis record by ID
    $ajucuti = ajucutis::findOrFail($id);

    // Return the edit view with the found record
    return view('admin.cuti.edit', compact('ajucuti'));
    }

    public function update(Request $request, $id)
{
    // Validasi input pengajuan cuti (disesuaikan dengan kebutuhan)
    $request->validate([
        'mulai_cuti' => 'required|date',
        'selesai_cuti' => 'required|date|after:mulai_cuti',
        'alasan' => 'required',
    ]);

    // Find the ajucutis record by ID
    $ajucuti = ajucutis::findOrFail($id);

    // Retrieve the user's remaining leave days (jml_cuti)
    $user = User::findOrFail(auth()->user()->id);
    $remainingLeaveDays = $user->jml_cuti;

    // Calculate the total number of leave days
    $mulaiCuti = $request->mulai_cuti;
    $selesaiCuti = $request->selesai_cuti;
    $totalLeaveDays = Carbon::parse($mulaiCuti)->diffInDays($selesaiCuti) + 1;

    // Check if the total leave days exceed the remaining leave days
    if ($totalLeaveDays > $remainingLeaveDays) {
        return redirect()->back()->with('error', 'Tidak dapat mengajukan cuti. Jumlah cuti yang diajukan melebihi sisa cuti Anda.');
    }

    if ($remainingLeaveDays <= 0) {
        return redirect()->back()->with('error', 'Tidak dapat mengajukan cuti. Jumlah cuti Anda telah habis.');
    }

    // Update the fields with the new values
    $ajucuti->mulai_cuti = $mulaiCuti;
    $ajucuti->selesai_cuti = $selesaiCuti;
    $ajucuti->alasan = $request->alasan;

    // Save the updated record
    $ajucuti->save();

    // Redirect to the index page with a success message
    return redirect()->route('ajucutis.index')->with('success', 'Pengajuan cuti berhasil diperbarui');
}


    public function destroy($id)
    {
        $ajucuti = ajucutis::find($id);

        if ($ajucuti->delete()) {
            return redirect(route('ajucutis.index'))->with('success', 'Batal Mengajukan cuti');
        }

        return redirect(route('ajucutis.index'))->with('error', 'Sorry, unable to delete this!');
    }
}



