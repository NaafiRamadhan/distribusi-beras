<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use App\Models\GradeToko;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TokoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $toko = Toko::all();
        $grade = GradeToko::all();
        return view('admin.toko.index', compact('toko', 'grade'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.toko.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $request->validate([
        'sales' => 'required',
        'foto_toko' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'nama_toko' => 'required',
        'grade_toko' => 'required',
        'pemilik' => 'required',
        'foto_ktp' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'alamat' => 'required',
        'nomor_tlp' => 'required',
    ]);

    // Mencari ID yang belum digunakan
    $nextId = $this->generateNextId();

    //foto toko
    $foto_toko = $request->file('foto_toko');
    $foto_toko->storeAs('public/toko/', $foto_toko->hashName());

    //foto ktp
    $foto_ktp = $request->file('foto_ktp');
    $foto_ktp->storeAs('public/ktp/', $foto_ktp->hashName());

    $toko = Toko::create([
        'id_toko' => $nextId,
        'sales' => $request->sales,
        'foto_toko' => $foto_toko->hashName(),
        'nama_toko' => $request->nama_toko,
        'grade_toko' => $request->grade_toko,
        'pemilik' => $request->pemilik,
        'foto_ktp' => $foto_ktp->hashName(),
        'alamat' => $request->alamat,
        'nomor_tlp' => $request->nomor_tlp,
    ]);

    if ($toko) {
        //redirect dengan pesan sukses
        return redirect()->route('admin.toko')->with('success', 'Data Toko Berhasil Disimpan!');
    } else {
        //redirect dengan pesan error
        Alert::error('Data Toko Gagal Disimpan!');
        return back();
    }
}


    private function generateNextId()
     {
         $prefix = 'T-';
         $lastId = Toko::max('id_toko');

         if (!$lastId) {
             // Jika belum ada data laporan, gunakan nomor 1
             return $prefix . '00001';
         }

         // Ambil angka dari ID terakhir, tambahkan 1, dan lakukan padding
         $lastNumber = intval(substr($lastId, strlen($prefix)));
         $nextNumber = $lastNumber + 1;
         $nextId = $prefix . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);

         return $nextId;
     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_toko)
    {
        $toko = Toko::find($id_toko);
        $grade = GradeToko::all();
        return view('admin.toko.edit', compact('toko', 'grade'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Toko $id_toko)
    {
        $request->validate([
            'sales' => 'required',
            'nama_toko' => 'required',
            'grade_toko' => 'required',
            'pemilik' => 'required',
            'alamat' => 'required',
            'nomor_tlp' => 'required',
        ]);

        $toko = Toko::find($id_toko);

        if (!$toko) {
            // Handle case where toko with the given ID is not found
            return redirect()->route('admin.toko')->with('error', 'Data Toko tidak ditemukan!');
        }

        // Update data
        $toko->sales = $request->sales;
        $toko->nama_toko = $request->nama_toko;
        $toko->grade_toko = $request->grade_toko;
        $toko->pemilik = $request->pemilik;
        $toko->alamat = $request->alamat;
        $toko->nomor_tlp = $request->nomor_tlp;

        // Check if a new foto_toko is uploaded
        if ($request->hasFile('foto_toko')) {
            $foto_toko = $request->file('foto_toko');
            $foto_toko->storeAs('public/toko/', $foto_toko->hashName());
            $toko->foto_toko = $foto_toko->hashName();
        }

        // Check if a new foto_ktp is uploaded
        if ($request->hasFile('foto_ktp')) {
            $foto_ktp = $request->file('foto_ktp');
            $foto_ktp->storeAs('public/ktp/', $foto_ktp->hashName());
            $toko->foto_ktp = $foto_ktp->hashName();
        }

        // Save updated data
        $toko->save();

        // Redirect with success message
        return redirect()->route('admin.toko')->with('success', 'Data Toko Berhasil Diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Toko $id_toko)
    {
        $id_toko->delete();
        Alert::error('Data Toko Berhasil Dihapus!');
        return back();
    }
}
