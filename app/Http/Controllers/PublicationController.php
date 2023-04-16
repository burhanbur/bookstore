<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

use App\Models\Publication;
use App\Models\File;
use App\Models\Type;

class PublicationController extends Controller
{
	public $errMessage;

	public function __construct()
    {
        $this->errMessage = 'Whoops, looks like something went wrong';
    }

    public function create()
    {
    	return view('front.contents.publications.create', get_defined_vars());
    }

    public function edit($id)
    {
    	return view('front.contents.publications.edit', get_defined_vars());
    }

	public function store(Request $request)
	{
		$errMessage = null;

        $validator = Validator::make($request->all(), [
        	'ref_type_id' => ['required'],
        	'serial_number' => ['required', 'string'],
        	'name' => ['required', 'string'],
        	'year' => ['required'],
        	'publisher' => ['required', 'string'],
        	'files' => 'required|mimes:pdf|max:2048'
        ]);

        if ($validate->fails()) {
            \Session::flash('error', $validate->errors()->first());

            return redirect()->back();
        }

        DB::beginTransaction();

		try {
			
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

	public function update(Request $request, $id)
	{
		$errMessage = null;

        $validator = Validator::make($request->all(), [
        	'ref_type_id' => ['required'],
        	'serial_number' => ['required', 'string'],
        	'name' => ['required', 'string'],
        	'year' => ['required'],
        	'publisher' => ['required', 'string'],
        	'files' => 'nullable|mimes:pdf|max:2048'
        ]);

        if ($validate->fails()) {
            \Session::flash('error', $validate->errors()->first());

            return redirect()->back();
        }

        DB::beginTransaction();

		try {
			
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
		return redirect()->back();
	}
}