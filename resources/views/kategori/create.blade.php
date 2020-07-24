@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                  <div class="card-header" style="background-color: #00ff00"><i class="fas fa-ad"> Tambah Kategori </i></div>
                      <div class="card-body">
                            @include('validasi')
                            {!! Form::open(['route'=>'kategori.store', 'method'=>'POST']) !!}
                            <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-md-right"><i class="fas fa-file-signature"> Nama kategori </i></label>
                                    <div class="col-md-6">

                                    {!! Form::text('nama_kategori',null,['class'=>'form-control']) !!}
                                      <!--<input type="text" name="nama_kategori" class="form-control">-->
                                    </div>
                            </div>

                            <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-2">
                                        <button type="submit" class="btn btn-primary">Tambah data</button>
                                        <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
                                    </div>
                          </div>
                      </div>
                  </div>
            </div>
        </div>
    </div>
</div>
@endsection