<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
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

    public function blog(Request $request)
    {
        return view('front.contents.blog', get_defined_vars());
    }

    public function post(Request $request)
    {
        return view('front.contents.post', get_defined_vars());
    }

    public function contact()
    {
        return view('front.contents.contact', get_defined_vars());
    }
}
