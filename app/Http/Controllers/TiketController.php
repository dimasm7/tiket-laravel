<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use\App\Tiket;

class TiketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tiket=Tiket::all();
        return view('tiket.index', compact('tiket'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tiket.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request -> validate([
            'name_tiket' => 'required|min:4',
            'harga_tiket' => 'required|numeric',
            'jumlah_tiket' => 'required', //required artiy tdk blh kosong
            'jenis_tiket' => 'required',

        ]);
        Tiket::create($request->all());
        return redirect()->route('tiket.index')->with('pesan', 'Data Tiket Berhasil Disimpan');
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
    public function edit($id)
    {
        $tiket = Tiket::findorfail($id);
        return view('tiket.edit', compact('tiket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request -> validate([
            'name_tiket' => 'required|min:4',
            'harga_tiket' => 'required|numeric',
            'jumlah_tiket' => 'required', //required artiy tdk blh kosong
            'jenis_tiket' => 'required',

        ]);
        $tiket = Tiket::find($id);
        $tiket->update($request->all());

        return redirect()->route('tiket.index')->with('pesan', 'Data Tiket Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tiket = Tiket::find($id);
        if(!$tiket){
        return redirect()->back();
        }
        $tiket->delete();
        return redirect()->route('tiket.index')->with('pesan', 'Data Tiket Berhasil Didelete');
    }
}
