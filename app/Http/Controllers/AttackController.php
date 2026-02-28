<?php

namespace App\Http\Controllers;

use App\Models\AttackRotation;
use Illuminate\Http\Request;

class AttackController extends Controller
{
    public function index()
    {
       $rotations = AttackRotation::latest()->get();

        return view('attack.index', compact('rotations'));
    }

    public function create()
    {
        return view('attack.create');
    }

    public function show($id)
    {
        $rotation = AttackRotation::find($id);
        
        if (!$rotation) {
            return redirect()->route('attack.index')->with('error', 'Rotation not found.');
        }

        return view('attack.show', compact('rotation'));
    }

    public function edit($id)
    {
        $rotation = AttackRotation::find($id);
        
        if (!$rotation) {
            return redirect()->route('attack.index')->with('error', 'Rotation not found.');
        }

        return view('attack.edit', compact('rotation'));
    }

     public function update(Request $request, $id)
    {
        $rotation = AttackRotation::findOrFail($id);

        $rotation->update([
            'name' => $request->name,
            'players' => json_encode($request->players)
        ]);

        return response()->json(['success' => true]);
    }

     public function store(Request $request)
    {
        AttackRotation::create([
            'name' => $request->name,
            'players' => json_encode($request->players)
        ]);

        return response()->json(['success' => true]);
    }

   
}
