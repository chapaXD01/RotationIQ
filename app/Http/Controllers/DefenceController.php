<?php

namespace App\Http\Controllers;

use App\Models\DefenceRotation;
use Illuminate\Http\Request;


class DefenceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

     public function index()
    {
        $rotations = DefenceRotation::where('user_id', auth()->id())->latest()->get();

        return view('defence.index', compact('rotations'));
    }

    public function create()
    {
        return view('defence.create');
    }

    public function show($id)
    {
        $rotation = DefenceRotation::where('id', $id)->where('user_id', auth()->id())->first();
        
        if (!$rotation) {
            return redirect()->route('defence.index')->with('error', 'Rotation not found.');
        }

        return view('defence.show', compact('rotation'));
    }

    public function edit($id)
    {
        $rotation = DefenceRotation::where('id', $id)->where('user_id', auth()->id())->first();
        
        if (!$rotation) {
            return redirect()->route('defence.index')->with('error', 'Rotation not found.');
        }

        return view('defence.edit', compact('rotation'));
    }

    public function update(Request $request, $id)
{
    $rotation = DefenceRotation::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

    $rotation->update([
        'name' => $request->name,
        'players' => json_encode($request->players)
    ]);

    return response()->json(['success' => true]);
}


     public function store(Request $request)
    {
        DefenceRotation::create([
            'name' => $request->name,
            'players' => json_encode($request->players),
            'user_id' => auth()->id()
        ]);

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $rotation = DefenceRotation::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $rotation->delete();

        return redirect()->route('defence.index')->with('success', 'Rotation deleted successfully.');
    }
}