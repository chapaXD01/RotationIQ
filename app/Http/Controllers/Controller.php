<?php

namespace App\Http\Controllers;

abstract class Controller
{
     public function index()
    {
        return view('attack.index');
    }

    public function create()
    {
        return view('attack.create');
    }

    public function show()
    {
        return view('attack.show');
    }

    public function edit()
    {
        return view('attack.edit');
    }
}
