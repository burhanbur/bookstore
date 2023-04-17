@extends('front.layouts.main')

@section('css')
	<style>
		.text-title {
			color: #7fad39;
		}

		.text-paragraph {
			text-align: justify;
		}

		.publication-content {
			padding-top: 2%;
			padding-bottom: 3%;
		}

		.active-page {
			color: white !important;
			background: #7fad39;
		}

		.text-justify {
			text-align: justify;
		}
	</style>
@endsection

@section('content')
<div class="container">
    @if (\Session::get('error'))
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ \Session::get('error') }}
    </div>
    @endif

	<div class="publication-content">
		<h2 class="text-title">{{ $data->name }}</h2>

		<br>

		<div class="row">
			<div class="col-md-4">
				<img src="{{ ($data->cover) ? asset('repository/'.$data->cover) : asset('no-thumbnail.jpg') }}">
				<br><br>
				<div class="form-group">
					<strong>Author</strong>
					<br>
					<label>{{ $data->author->name }}</label>
				</div>
				<div class="form-group">
					<strong>Tahun</strong>
					<br>
					<label>{{ $data->year }}</label>
				</div>
				<div class="form-group">
					<strong>Publisher</strong>
					<br>
					<label>{{ $data->publisher }}</label>
				</div>
				<div class="form-group">
					<strong>Jenis</strong>
					<br>
					<label>{{ $data->type->name }}</label>
				</div>
			</div>

			<div class="col-md-8">
				<p class="text-justify">
					{{ $data->description }}
				</p>

				<p class="text-left">
					URI <br> <a href="{{ \URL::current() }}">{{ \URL::current() }}</a>
				</p>

				<p>
					File: <br>
					@foreach(\App\Models\File::where('publication_id', $data->id)->get() as $key => $value)
						<a href="{{ asset('repository/'.$value->file_path) }}" target="_blank">{{ $value->file_path }}</a>
						<br>
					@endforeach
				</p>
			</div>
		</div>
	</div>
</div>
@endsection