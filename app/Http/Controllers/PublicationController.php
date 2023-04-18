<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

use App\Models\Publication;
use App\Models\File as FileModel;
use App\Models\Type;

use File;

class PublicationController extends Controller
{
	public $errMessage;
	public $repository;

	public function __construct()
    {
        $this->errMessage = 'Whoops, looks like something went wrong';
        $this->repository = 'repository';
    }

    public function create()
    {
    	return view('front.contents.publications.create', get_defined_vars());
    }

    public function edit($slug)
    {
        $data = Publication::where('slug', $slug)->firstOrFail();

    	return view('front.contents.publications.edit', get_defined_vars());
    }

	public function store(Request $request)
	{
		$errMessage = null;
		$file_cover = null;

        $validator = Validator::make($request->all(), [
        	'ref_type_id' => ['required'],
        	'serial_number' => ['required', 'string'],
        	'name' => ['required', 'string'],
        	'year' => ['required'],
        	'publisher' => ['required', 'string'],
        	'cover' => 'nullable|mimes:png,jpeg,jpg|max:2048',
        	'file_path.*' => 'nullable|mimes:pdf,png,jpeg,jpg|max:2048'
        ]);

        if ($validator->fails()) {
            \Session::flash('error', $validator->errors()->first());

            return redirect()->back();
        }

        DB::beginTransaction();

		try {
	        if (!File::isDirectory($this->repository)) {
	            File::makeDirectory($this->repository, 0775, TRUE);
	        }

	        if ($request->hasFile('cover')) {
	            $cover = $request->file('cover');
	            $file_cover = date('YmdHis').'_'.$cover->getClientOriginalName();
	            $cover->move($this->repository, $file_cover);
	        }

	        if (Publication::where('serial_number', $request->serial_number)->exists()) {
	        	throw new \Exception("Serial Number telah terdaftar", 1);
	        }

			$data = new Publication;
			$data->author_id = \Auth::user()->id;
			$data->ref_type_id = $request->ref_type_id;
			$data->serial_number = $request->serial_number;
			$data->slug = \Str::slug($request->name).'-'.date('Y-m-d-H-i-s');
			$data->cover = $file_cover;
			$data->name = $request->name;
			$data->year = $request->year;
			$data->publisher = $request->publisher;
			$data->is_public = ($request->is_public) ? true : false;
			$data->description = $request->description;
			$data->save();

            $filename = $request->file_name;
            $filepath = $request->file('file_path');

            foreach ($filepath as $key => $file) {
	            $files = date('YmdHis').'_'.$file->getClientOriginalName();
	            $file->move($this->repository, $files);

            	FileModel::create([
            		'publication_id' => $data->id,
            		'name' => $filename[$key],
            		'file_path' => $files,
            		'created_by' => \Auth::user()->id
            	]);
            }

			DB::commit();

			\Session::flash('success', 'Data uploaded successfully');
		} catch (\Exception $ex) {
			DB::rollBack();
			if (env('APP_DEBUG')) {
				$errMessage = $ex->getMessage().' in file '.$ex->getFile(). ' at line '.$ex->getLine();
			} else {
				$errMessage = $this->errMessage;
			}

			\Session::flash('error', $errMessage);
		}

		return redirect()->back();
	}

	public function update(Request $request, $slug)
	{
		$errMessage = null;
		$file_cover = null;

        $validator = Validator::make($request->all(), [
        	'ref_type_id' => ['required'],
        	'serial_number' => ['required', 'string'],
        	'name' => ['required', 'string'],
        	'year' => ['required'],
        	'publisher' => ['required', 'string'],
        	'cover' => 'nullable|mimes:png,jpeg,jpg|max:2048',
        	'file_path.*' => 'nullable|mimes:pdf,png,jpeg,jpg|max:2048'
        ]);

        if ($validator->fails()) {
            \Session::flash('error', $validator->errors()->first());

            return redirect()->back();
        }

        DB::beginTransaction();

		try {
			if (!File::isDirectory($this->repository)) {
	            File::makeDirectory($this->repository, 0775, TRUE);
	        }

			$data = Publication::where('slug', $slug)->first();

			if (!$data) {
				throw new \Exception("Data tidak ditemukan", 1);
			}

			$data->author_id = \Auth::user()->id;
			$data->ref_type_id = $request->ref_type_id;
			$data->serial_number = $request->serial_number;
			$data->name = $request->name;
			$data->year = $request->year;
			$data->publisher = $request->publisher;
			$data->is_public = ($request->is_public) ? true : false;
			$data->description = $request->description;

	        if ($request->hasFile('cover')) {
	            $cover = $request->file('cover');
	            $file_cover = date('YmdHis').'_'.$cover->getClientOriginalName();
	            $cover->move($this->repository, $file_cover);
				$data->cover = $file_cover;
	        }

			$data->save();

            $filename = $request->file_name;
            $filepath = ($request->file('file_path')) ? $request->file('file_path') : [];

            foreach ($filepath as $key => $file) {
	            $files = date('YmdHis').'_'.$file->getClientOriginalName();
	            $file->move($this->repository, $files);

            	FileModel::create([
            		'publication_id' => $data->id,
            		'name' => $filename[$key],
            		'file_path' => $files,
            		'created_by' => \Auth::user()->id
            	]);
            }

            $u_id = ($request->u_id) ? $request->u_id : [];
            $u_filename = $request->u_file_name;
            $u_filepath = $request->file('u_file_path');

            // if ($request->hasFile('u_filepath') && count((array) $u_id) == count((array) $u_filepath)) {

            // }

            for ($i = 0; $i < count((array) $u_id); $i++) {
	            $arrData = [
            		'publication_id' => $data->id,
            		'name' => $u_filename[$i],
            		'created_by' => \Auth::user()->id
            	];

	            if (@$u_filepath[$i]) {
		            $files = date('YmdHis').'_'.$u_filepath[$i]->getClientOriginalName();
		            var_dump($files);
		            $u_filepath[$i]->move($this->repository, $files);
		            $arrData['file_path'] = $files;
	            }

            	FileModel::find($u_id[$i])->update($arrData);
            }

			DB::commit();

			\Session::flash('success', 'Data uploaded successfully');
		} catch (Exception $ex) {
			DB::rollBack();
			if (env('APP_DEBUG')) {
				$errMessage = $ex->getMessage().' in file '.$ex->getFile(). ' at line '.$ex->getLine();
			} else {
				$errMessage = $this->errMessage;
			}

			\Session::flash('error', $errMessage);
		}

		return redirect()->back();
	}

	public function delete($id)
	{
		$errMessage = null;

		DB::beginTransaction();

		try {
			FileModel::where('publication_id', $id)->delete();
			Publication::find($id)->delete();

			DB::commit();

			\Session::flash('success', 'Data deleted successfully');
		} catch (Exception $ex) {
			DB::rollBack();
			if (env('APP_DEBUG')) {
				$errMessage = $ex->getMessage().' in file '.$ex->getFile(). ' at line '.$ex->getLine();
			} else {
				$errMessage = $this->errMessage;
			}

			\Session::flash('error', $errMessage);
		}

		return redirect()->back();
	}

	public function download($file_path)
    {
        $file= public_path(). "/repository/" . @FileModel::where('file_path', $file_path)->first()->file_path;

        $headers = [];

        return response()->download($file, $file_path, $headers);
    }
}