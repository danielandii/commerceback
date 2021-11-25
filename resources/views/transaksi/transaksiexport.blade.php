<table>
    <thead>
    <tr>
        <th><b>No</b></th>
        <th><b>No Pesanan</b></th>
        <th><b>Tanggal Transaksi</b></th>
        <th><b>Nama Pembeli</b></th>
        <th><b>Alamat Pembeli</b></th>
        <th><b>No. HP Pembeli</b></th>
        <th><b>Nama Produk</b></th>
        <th><b>Harga Produk</b></th>
        <th><b>Jumlah Produk</b></th>
        <th><b>Total Harga</b></th>
        <th><b>Metode Pembayaran</b></th>
        <th><b>Status</b></th>
    </tr>
    </thead>
    <tbody>
    @foreach($transaksi as $trans)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $trans->no_pesanan }}</td>
            <td>{{ $trans->tanggal_transaksi }}</td>
            <td>{{ $trans->nama }}</td>
            <td>{{ $trans->alamat }}</td>
            <td>{{ $trans->no_telp }}</td>
            <td>{{ @$trans->detail_transaksi->produk->nama }}</td>
            <td>{{ "Rp. ".format_uang(@$trans->detail_transaksi->harga) }}</td>
            <td>{{ @$trans->detail_transaksi->jumlah_produk }}</td>
            <td>{{ "Rp. ".format_uang(@$trans->detail_transaksi->total) }}</td>
            <td>{{ (config('custom.metode_pembayaran.'.$trans->metode_pembayaran)) ? (config('custom.metode_pembayaran.'.$trans->metode_pembayaran)) : '-' }}</td>
            <td>{{ (config('custom.status.'.$trans->status)) ? (config('custom.status.'.$trans->status)) : '-' }}</td>
        </tr>
    @endforeach
    </tbody>
</table>