@extends('front.layouts.main')

@section('css')
	<style>
		.text-title {
			color: #7fad39;
			font-size: 20px;
		}

		.text-title:hover {
            color: rgb(104, 134, 60);
        }

		.text-paragraph {
			text-align: justify;
		}

		.publication-content {
			padding-bottom: 3%;
		}

		.active-page {
			color: white !important;
			background: #7fad39;
		}
	</style>
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
		@if ($data)
			@foreach($data as $key => $row)
				<div class="form-group">
					<a class="text-title" href="{{ route('show.publication', $row['slug']) }}">
						<strong>{{ $row['name'] }}</strong>
					</a>
					<br>
					<label>{{ $row['author'] }} ({{ $row['year'] }})</label>

					@if (@\Auth::user()->id == $row['author_id'])
					<form style="display: inline;" method="POST" action="{{ route('publication.delete', $row['id']) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
						@csrf
						@method('DELETE')
						<button class="btn btn-xs btn-danger">Hapus</button>	
					</form>
					<a href="{{ route('publication.edit', $row['slug']) }}" class="btn btn-xs btn-info">Ubah</a>
					@endif

					<p class="text-paragraph">
						{{ Str::limit($row['description'], 300) }}
					</p>
					<div class="text-right">
						<a style="color: #7fad39;" href="{{ route('show.publication', $row['slug']) }}">Baca Selengkapnya</a>
					</div>

					<hr>
				</div>
			@endforeach

			<div class="product__pagination">
				@if ($totalPages > 1)
					@for($i = 1; $i <= $totalPages; $i++)
						@php $isActive = $i == $page ? 'active-page' : ''; @endphp
			            <a href="?page={{ $i }}" class="{{ $isActive }}">{{ $i }}</a>
					@endfor
				@endif
	        </div>
		@else 
			<strong class="text-title text-center">Tidak ada artikel yang dipublikasi</strong>
		@endif
	</div>
</div>
@endsection