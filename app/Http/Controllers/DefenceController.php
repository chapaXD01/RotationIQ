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
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'players' => 'required|array|min:1'
    ]);

    $rotation = DefenceRotation::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

    $rotation->update([
        'name' => $validated['name'],
        'players' => json_encode($validated['players'])
    ]);

    return response()->json(['success' => true]);
}


     public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'players' => 'required|array|min:1'
        ]);

        DefenceRotation::create([
            'name' => $validated['name'],
            'players' => json_encode($validated['players']),
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