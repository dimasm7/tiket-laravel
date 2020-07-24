<?php

namespace App\Http\Controllers;

use App\Kategori; //ambil model kategori
use App\Imports\KategoriImport; //utk import file excel
use Excel;
use Illuminate\Http\Request;


class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = kategori::all();
        return view('kategori.index', compact('kategori')); //di dlm view->folder kategori->file index.blade.php 
                                                //kategori ini mengacu ke $kateori
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kategori.create');
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
            'nama_kategori'=>'min:4|required',
        ]);

        $kategori=Kategori::create($request->all()); //all() menerima semua data
        return redirect()->route('kategori.index')->with('pesan', 'Data Berhasil Ditambah');
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
        $kategori= Kategori::findorfail($id);
        return view('kategori.edit', compact('kategori'));
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
        $request->validate([
            'nama_kategori'=>'min:4|required',
        ]);

        $kategori=Kategori::find($id); //all() menerima semua data
        $kategori->update($request->all());
        return redirect()->route('kategori.index')->with('pesan', 'Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategori = Kategori::find($id);
        $kategori->delete();
        return redirect()->route('kategori.index')->with('pesan', 'Data Berhasil Didelete');

    }

    public function excel()
    {
        return view('kategori.excel');
    }

    public function Upload(Request $request)
    {
        $this->validate($request,[
            'file'=>'required|mimes:xls,xlsx'
        ]);
        if($request->hasFile('file')) { //ini artiny jika user memasukkan file maka kerjakan...
            $file = $request->file('file'); //memberi nam file sesuai nama itu sendiri
            Excel::import(new KategoriImport,$file);
            return redirect()->route('kategori.index')->with('pesan', 'Data berhasil diupload');
        }
        return redirect()->back()->with('pesan', 'Data gagal diupload');
    }
}
