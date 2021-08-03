@extends('master.master-admin')

@section('content')

<h3>Edit kirim</h3>
 
	<a href="/kirim"> Kembali</a>
	
	<br/>
	<br/>
 
	@foreach($kirims as $k)
	<form action="/kirim/updatekirim" method="post">
		{{ csrf_field() }}
		<input type="hidden" name="id" value="{{ $k->id }}"> <br/>

        <div class="form-group">
	    	<label>JENIS</label> 
            <input type="text" required="required" class="form-control" name="jenis" value="{{ $k->jenis }}"> 
        </div>

        <div class="form-group">
	    	<label>WAKTU</label> 
            <input type="text" required="required" class="form-control" name="waktu" value="{{ $k->waktu }}"> 
        </div>

        <div class="form-group">
	    	<label>HARGA</label> 
            <input type="text" required="required" class="form-control" name="harga" value="{{ $k->harga }}"> 
        </div>


		<input type="submit" value="Simpan Data">
	</form>
	@endforeach
		
 
</body>
</html>

@endsection




