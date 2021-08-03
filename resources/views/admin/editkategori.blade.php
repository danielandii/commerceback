@extends('master.master-admin')

@section('content')

<h3>Edit kategori</h3>
 
	<a href="/kategori"> Kembali</a>
	
	<br/>
	<br/>
 
	@foreach($kategori as $g)
	<form action="/kategori/updatekategori" method="post">
		{{ csrf_field() }}
		<input type="hidden" name="id" value="{{ $g->id }}"> <br/>

        <div class="form-group">
	    	<label>JENIS</label> 
            <input type="text" required="required" class="form-control" name="jenis" value="{{ $g->jenis }}"> 
        </div>


		<input type="submit" value="Simpan Data">
	</form>
	@endforeach
		
 
</body>
</html>

@endsection




