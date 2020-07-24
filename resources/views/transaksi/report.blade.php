<table class="table table-bordered">
    <tr class="success">
        <th colspan="5"> Laporan Penjualan Tiket </th>
    </tr>
    <tr>
        <th>No</th>
        <th>Nama Tiket</th>
        <th>Qty</th>
        <th>Harga Tiket</th>
        <th>Subtotal</th>
    </tr>
    <?php $no=1; $total=0;?>
    @foreach($transaksi as $item)
    <tr>
        <td> {{ $no }}
        <td> {{ $item->tiket->name_tiket }}
        <td> {{ $item->qty }}
        @php( $harga=str_replace('.','',$item->tiket->harga_tiket) )
        <td> {{ "Rp.".number_format($harga) }}
        <td> {{ "Rp.".number_format($harga*$item->qty) }}
    </tr>
    <?php $no++; ?>
    <?php $total = $total+($harga*$item->qty); ?>
    @endforeach
    <tr>
        <td colspan="4">
            <p align="right">Total</p>
            <td> {{ "Rp.".number_format($total) }}
        </td>
    </tr>
</table>
