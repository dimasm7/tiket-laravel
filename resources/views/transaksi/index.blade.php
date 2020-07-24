@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: #00ff00"><i class="fas fa-money-bill"> TRANSAKSI TIKET </i></div>
                    <div class="card-body">
                    @include('validasi')
                    <h3><i class="fab fa-accusoft"> Form Transaksi</i></h3>
                    <table class="table table-bordered">
                        {!! Form::open(['route'=>'transaksi.store', 'method'=>'POST']) !!}
                        <tr>
                            <td>
                                <div class="col-md-12">
                                    {!! Form::select('id_tiket',\App\Tiket::pluck('name_tiket', 'id'),null,['class'=>'form-control']) !!}
                                </div>
                           </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="col-md-12">
                                {!! Form::number('qty',null,['class'=>'form-control', 'placeholder'=>'Qty']) !!}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="simpan" name="simpan" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('transaksi.update') }}" name="selesai" class="btn btn-danger">Selesai</a>
                            </td>
                        </tr>
                    </table>
                    {!! Form::close() !!}
                    <table class="table table-bordered">
                        <tr class="success" style="background-color: #00ff00">
                            <th colspan="6"><i class="fas fa-align-left"> Detail Transaksi </i></th>
                        </tr>
                        <tr>
                            <th><i class="fas fa-sticky-note"> No</i></th>
                            <th><i class="fas fa-file-signature"> Nama Tiket</i></th>
                            <th><i class="fas fa-bars"> Qty</i></th>
                            <th><i class="fas fa-puzzle-piece"> Harga Tiket</i></th>
                            <th><i class="fas fa-calculator"> Subtotal</i></th>
                            <th><i class="fas fa-history"> Cancel </i></th>
                        </tr>
                        <?php $no=1; $total=0;?>
                        @foreach($transaksi as $item)
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$item->tiket->name_tiket}}</td>
                            <td>{{$item->qty}}</td>
                            <td>{{$item->tiket->harga_tiket}}</td>
                            @php ($harga=str_replace('.','',$item->tiket->harga_tiket) )  <!--utk membaca format data rupiah yg ada di data base yt agar membaca '.' pd 100.000 tdk sebagai koma-->
                            <td>{{ "Rp.".number_format($harga*$item->qty).",-"}}</td>
                            <td>
                            {!! Form::open(['route'=>['transaksi.destroy', $item->id], 'method'=>'DELETE']) !!}
                                <button type="submit" name="cancel" class="btn btn-danger"> Cancel </button>
                            </td>
                            {!! Form::close() !!}
                        </tr>
                        <?php $no++;?>
                        <?php $total = $total+($harga*$item->qty);?>
                        @endforeach
                        <tr>
                            <td colspan="5">
                                <p align="right"><i class="fas fa-euro-sign"> Total</i></p>
                                <td> {{"Rp.".number_format($total).",-"}} </td>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection