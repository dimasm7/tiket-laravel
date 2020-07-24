<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use Fpdf;
use App\Exports\TransaksiExport;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::where('status','0')->get();
        return view('transaksi.index', compact('transaksi'));
    }

    public function store(Request $request)
    {
        //return $request->all(); fungsi tombol simpang
        $request->validate([
            
            'qty'=>'required',
        ]);
        Transaksi::create($request->except('simpan')); //except >>> kita memasukkan data kecuali yg ada name="simpan"
        return redirect()->route('transaksi.index');
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findorfail($id);
        if(!$transaksi){
            return redirect()->back();
        }
        $transaksi->delete();
        return redirect()->route('transaksi.index');
    }

    public function update()
    {
        $transaksi = Transaksi::where('status','0');
        $transaksi->update(['status'=>'1']);
        return redirect()->back();
    }

    public function laporan()
    {
        $pdf = new Fpdf("L","cm","A4");
        $pdf::AddPage();
        $pdf::SetFont('Arial', 'B', 18);
        $pdf::Cell(185,7,'Laporan Penjualan tiket',0,1,'C');
        $pdf::SetFont('Arial', '', 12);
        $pdf::Cell(185,5,'Surabaya',0,1,'C');
        $pdf::SetFont('Arial', '', 12);
        $pdf::Cell(185,5,"Telpon : ----------- ",0,1,'C');
        $pdf::Line(10,30,190,30);
        $pdf::Line(10,31,190,31);
        $pdf::Cell(30,10,'',0,1);
        $pdf::SetFont('Arial', 'B', 14);
        $pdf::Cell(185,5,'Penjualan Tiket',0,0,'C');
        $pdf::Cell(30,10,'',0,1);
        $pdf::Cell(60,7,'Nama Tiket',1,0);
        $pdf::Cell(25,7,'Qty',1,0);
        $pdf::Cell(40,7,'Harga Tiket',1,0);
        $pdf::Cell(38,7,'Subtotal',1,0);
        $pdf::Cell(30,7,'Tanggal',1,1);
        $transaksi=Transaksi::where('status','1')->get();
        foreach($transaksi as $item){
            $pdf::Cell(60,7,$item->tiket->name_tiket,1,0);
            $pdf::Cell(25,7,$item->qty,1,0);
            $harga=str_replace('.','', $item->tiket->harga_tiket); //utk format uang rupian
            $pdf::Cell(40,7,"Rp.".number_format($harga),1,0);
            $pdf::Cell(38,7,"Rp.".number_format($harga*$item->qty).",-",1,0);
            $pdf::Cell(30,7,\Carbon\Carbon::parse($item->created_at)->formatLocalized('%d %b %Y'),1,1);
       }

        $pdf::Output();
        exit;
    
    }

    public function excel()
    {
        return (new TransaksiExport)->download('penjualan_tiket'.'.xlsx');
        //return Excel::download(new TransaksiExport, 'penjualan_tiket.xlsx');
    }
}
