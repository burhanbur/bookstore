@extends('front.layouts.main')

@section('css')
<style>
	test {
        display: block;
        margin-block-start: 1em;
        margin-block-end: 1em;
        margin-inline-start: 0px;
        margin-inline-end: 0px;
    }
</style>
@endsection

@section('javascript')
<script>
	$("#addrow").on("click", function () {
        var newRow = $("<p>");
        var cols = "";

        cols += '<div class="row"> <div class="col-md-6"> <div class="form-group"> <div class="input-group"> <div class="custom-file"> <input type="file" name="file_path[]" class="custom-file-input" onchange="aplot(this)" accept="application/pdf, image/png, image/jpeg" required> <label class="custom-file-label">Upload Publikasi</label> </div> </div> </div> </div> <div class="col-md-4"> <div class="form-group"> <input type="text" class="form-control" name="file_name[]" placeholder="Nama file..." required> </div> </div> <div class="col-md-2"> <div class="form-group"> <input type="button" class="btn btn-xs btn-danger ibtnDel" value="Hapus" /> </div> </div> </div>';

        newRow.append(cols);
        $("#content-file").append(newRow);
    });

    $("#content-file").on("click", ".ibtnDel", function (event) {
        event.preventDefault();
        $(this).closest("p").remove();
        $(this).closest("test").remove();
    });

    function aplot(val){
		var cucian = val.value.replace('C:\\fakepath\\','');
		$(val)[0].nextElementSibling.innerText = cucian;
	}
</script>
@endsection

@section('content')
<div class="container">
    @if (\Session::get('success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ \Session::get('success') }}
    </div>
    @endif

    @if (\Session::get('error'))
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ \Session::get('error') }}
    </div>
    @endif

	<div class="">
		<form method="POST" action="{{ route('publication.store') }}" enctype="multipart/form-data">
			@csrf
			<div class="form-group">
				<label>Judul</label>
				<input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
			</div>

			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Tahun</label>
						<input type="text" class="form-control" name="year" value="{{ old('year') }}" required>
					</div>					
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>ISSN/ISBN</label>
						<input type="text" class="form-control" name="serial_number" value="{{ old('serial_number') }}" required>
					</div>					
				</div>
			</div>

			<div class="row">
				<div class="col-md-6">					
					<div class="form-group">
						<label>Tipe Publikasi</label>
						<br>
						<select name="ref_type_id" class="" required>
							<option value="">-- Pilih Tipe Publikasi --</option>
							@foreach(\App\Models\Type::all() as $value)
								<option value="{{ $value->id }}">{{ $value->name }}</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label>Publisher</label>
						<input type="text" class="form-control" name="publisher" value="{{ old('publisher') }}" required>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Akses Terbuka</label>
						<br>
						<input type="radio" name="is_public" value="1" required> Ya &nbsp;&nbsp;&nbsp;
						<input type="radio" name="is_public" value="0"> Tidak
					</div>					
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label>Gambar Sampul</label>
						<br>
						<input type="file" name="cover" accept="image/*">
					</div>					
				</div>
			</div>

			<div class="form-group">
				<label>Deskripsi</label>
				<textarea class="form-control" name="description" rows="5">{{ old('description') }}</textarea>
			</div>

			<div class="row">
	            <div class="col-md-12 text-center">
	                <input type="button" class="btn btn-xs site-btn" id="addrow" value="Tambah Unggahan" />
	            </div>
	        </div>

			<hr>

			<div id="content-file">
				<div class="row">
				    <div class="col-md-6">
				        <div class="form-group">
				            <label for="bukti_penghargaan">Bukti Publikasi | Format : pdf / jpeg / png</label>
				            <div class="input-group">
				                <div class="custom-file">
				                    <input type="file" name="file_path[]" class="custom-file-input" onchange="aplot(this)" accept="application/pdf, image/png, image/jpeg" required>
				                    <label class="custom-file-label">Upload Publikasi</label>
				                </div>
				            </div>
				        </div>
				    </div>
				    <div class="col-md-6">
				        <div class="form-group">
				            <label for="name">Nama File : </label>
				            <input type="text" class="form-control" name="file_name[]" placeholder="Nama file..." required>
				        </div>
				    </div>
				</div>
			</div>

			<div class="form-group">
				<button class="site-btn"><i class="fa fa-save"></i>&nbsp; Simpan</button>
			</div>
		</form>		
	</div>
</div>
@endsection