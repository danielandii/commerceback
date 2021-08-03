@extends('master.master-admin')

@section('content')

<h3>Edit produk</h3>
 
	<a href="/produk"> Kembali</a>
	
	<br/>
	<br/>
 
	@foreach($produk as $h)
	<form action="/produk/update" method="post">
		{{ csrf_field() }}
		<input type="hidden" name="id" value="{{ $h->id_kategori }}"> <br/>

        <div class="form-group">
	    	<label>NAMA</label> 
            <input type="text" required="required" class="form-control" name="nama" value="{{ $h->nama_brg }}"> 
        </div>

        <div class="form-group">
		    <label>STOK</label> 
            <input type="text" required="required" class="form-control" name="stok" value="{{ $h->stok_brg }}"> 
        </div>

        <div class="form-group">
		    <label>HARGA</label> 
            <input type="text" required="required" class="form-control" name="harga" value="{{ $h->harga_brg }}"> 
        </div>

        <div class="form-group">
            <label>DESKRIPSI</label> 
            <textarea required="required" class="form-control" name="deskripsi">{{ $h->deskripsi }}</textarea> 
        </div>

		<input type="submit" value="Simpan Data">
	</form>
	@endforeach
		
 
</body>
</html>

@endsection


