@extends('front.layouts.main')

@section('css')
	<style>
		.text-title {
			color: #7fad39;
			font-size: 20px;
		}

		.text-paragraph {
			text-align: justify;
		}

		.publication-content {
			padding-bottom: 3%;
		}
	</style>
@endsection

@section('content')
<div class="container">
	<!-- filter -->
	<form method="GET">
		<div class="row">
			<div class="col-md-7">
				<div class="form-group">
					<input type="text" class="form-control" name="title" value="{{ ($title) ? $title : old('title') }}" placeholder="Judul Artikel">
				</div>		
			</div>

			<div class="col-md-3">
				<div class="form-group">
					<input type="text" class="form-control" name="author" value="{{ ($author) ? $author : old('author') }}" placeholder="Penulis Artikel">						
				</div>
			</div>

			<div class="col-md-2">
				<button style="background: #7fad39; text-transform: uppercase; color: #ffffff; border: none;" class="btn btn-primary"><i class="fa fa-search"></i>&nbsp; Cari</button>
			</div>
		</div>		
	</form>

	<div class="publication-content">
		@if (!$data->isEmpty())
			@foreach($data as $key => $row)
				<div class="form-group">
					<a class="text-title" href="">
						<strong>{{ $row->name }}</strong>
					</a>
					<br>
					<label>{{ $row->author->name }} ({{ $row->year }})</label>
					<p class="text-paragraph">
						{{ Str::limit($row->description, 300) }}
					</p>
					<div class="text-right">
						<a style="color: #7fad39;" href="">Baca Selengkapnya</a>
					</div>

					@if (!$row === end($data))
						<hr>
					@endif
				</div>
			@endforeach

			{{ $data->links() }}

			<div class="product__pagination">
	            <a href="#">1</a>
	            <a href="#">2</a>
	            <a href="#">3</a>
	            <a href="#"><i class="fa fa-long-arrow-right"></i></a>
	        </div>
		@else 
			<strong class="text-title text-center">Tidak ada artikel yang dipublikasi</strong>
		@endif
	</div>
</div>
@endsection