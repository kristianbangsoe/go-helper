<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index() {
        $title = 'Hello';
        // return view('pages.index', compact('title'));
        return view('pages.index')->with('title', $title);
    }

    public function about() {
        $data = array(
            'title' => 'About',
            'info' => 'Lorem ipsum dolor ahmet...',
            'lists' => ['Jeg', 'elers', 'farsbrød']
        );
        return view('pages.about')->with($data);
    }
}
