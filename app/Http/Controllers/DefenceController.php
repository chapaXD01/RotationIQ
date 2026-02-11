<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class DefenceController extends Controller
{
    public function index()
    {
        return view('defence.index');
    }

    public function create()
    {
        return view('defence.create');
    }

    public function show()
    {
        return view('defence.show');
    }

    public function edit()
    {
        return view('defence.edit');
    }
}