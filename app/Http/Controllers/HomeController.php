<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Publication;

use Exception;

class HomeController extends Controller
{
    public $errMessage;

    public function __construct()
    {
        $this->errMessage = 'Whoops, looks like something went wrong';
    }

    public function index()
    {
        return view('front.contents.home', get_defined_vars());
    }

    public function shop(Request $request)
    {
        return view('front.contents.shop', get_defined_vars());
    }

    public function detail(Request $request, $slug)
    {
        if ($slug == 'protein-representation-sequence-embedding') {
            return view('front.contents.detail', get_defined_vars());  
        } else {
            return view('front.contents.brawijaya', get_defined_vars()); 
        }
    }

    public function publication(Request $request)
    {
        $data = [];
        $errMessage = null;
        $limit = 10;

        $title = $request->title;
        $category = $request->category;
        $author = $request->author;

        try {
            $data = Publication::with(['createdBy', 'pubCat'])->where('is_public', true);

            if ($title) {
                $data->where('name', 'like', '%'.$title.'%');
            }

            if ($author) {               
                // $data->whereHas('author', function($query) use ($author) {
                //     $query->where('name', 'like', '%'.$author.'%');
                // });
                $data->where('author', 'like', '%'.$author.'%');
            }

            if ($category) {                
                $data->whereHas('pubCat', function($query) use ($category) {
                    $query->where('category_id', $category);
                });
            }

            $data = $data->orderBy('created_at', 'DESC')->get()->toArray();

            // pagination
            $page = ($request->get('page')) ? $request->get('page') : 1;
            $total = count($data);
            $offset = ($page - 1) * $limit;
            $data = array_slice($data, $offset, $limit);
            $totalPages = ceil($total / $limit);
        } catch (Exception $ex) {
            if (env('APP_DEBUG')) {
                $errMessage = $ex->getMessage().' in file '.$ex->getFile(). ' at line '.$ex->getLine();
            } else {
                $errMessage = $this->errMessage;
            }

            \Session::flash('error', $errMessage);
        }

        return view('front.contents.publications.index', get_defined_vars());
    }

    public function showPublication($slug)
    {
        $data = null;
        $errMessage = null;

        try {
            $data = Publication::where('slug', $slug)->firstOrFail();
        } catch (Exception $ex) {
            if (env('APP_DEBUG')) {
                $errMessage = $ex->getMessage().' in file '.$ex->getFile(). ' at line '.$ex->getLine();
            } else {
                $errMessage = $this->errMessage;
            }

            \Session::flash('error', $errMessage);            
        }

        return view('front.contents.publications.show', get_defined_vars());   
    }

    public function post(Request $request)
    {
        return view('front.contents.post', get_defined_vars());
    }

    public function contact()
    {
        return view('front.contents.contact', get_defined_vars());
    }

    public function downloadProteinRepresentation()
    {
        $file= public_path(). "/books/protein_representation.pdf";

        $headers = array(
          'Content-Type: application/pdf',
        );

        return response()->download($file, 'protein_representation.pdf', $headers);
    }

    public function downloadSequenceModel()
    {
        $file= public_path(). "/books/sequence_model.pdf";

        $headers = array(
          'Content-Type: application/pdf',
        );

        return response()->download($file, 'sequence_model.pdf', $headers);
    }

    public function downloadConvolutionalNeuralNetwork()
    {
        $file= public_path(). "/books/convolutional_neural_network.pdf";

        $headers = array(
          'Content-Type: application/pdf',
        );

        return response()->download($file, 'convolutional_neural_network.pdf', $headers);
    }
}
