@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: #00ff00"><i class="fas fa-database"> Kategori Tiket </i></div>
                <div class="card-body">
                    <a href="{{ route('kategori.create') }}" class="btn btn-primary btn-sm" style="margin-bottom: 10px;"><i class="fas fa-plus-square"> Tambah Kategori </i></a>
                    <a href="{{ route('kategori.excel') }}" class="btn btn-primary btn-sm" style="margin-bottom: 10px;"><i class="fas fa-file-excel"> Import Excel </i></a>
                <hr>
                @include('notifikasi')
                    <table class="table table-bordered" id="users-table">
                        <thead>
                            <tr>
                                <th><i class="fas fa-sticky-note"> No </i></th>
                                <th><i class="fas fa-file-signature"> Nama </i></th>
                                <th><i class="fas fa-edit"> Edit </i></th>
                                <th><i class="fas fa-trash-alt"> Delete </i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;?>
                            @foreach ($kategori as $item)
                            <tr>
                                <td> {{$no}} </td>
                                <td>{{ $item->nama_kategori }}</td>
                                <td> <a href="{{ route('kategori.edit', $item->id) }}" class="btn btn-primary btn-sm">Edit</a> </td>
                                
                                {!! Form::open([ 'route'=>['kategori.destroy', $item->id], 'method' => 'Delete']) !!}
                                <td><button type="submit" name="submit" class="btn btn-danger btn-sm">Hapus</button> </td>
                                {!! Form::close() !!}
                            </tr>
                            <?php $no++?>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(function() {
            $('#users-table').DataTable();
        });
    </script>
@endpush
