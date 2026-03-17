<?php

namespace App\Http\Controllers;

use App\Models\AttackRotation;
use Illuminate\Http\Request;

class AttackController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
       $rotations = AttackRotation::where('user_id', auth()->id())->latest()->get();

        return view('attack.index', compact('rotations'));
    }

    public function create()
    {
        return view('attack.create');
    }

    public function show($id)
    {
        $rotation = AttackRotation::where('id', $id)->where('user_id', auth()->id())->first();
        
        if (!$rotation) {
            return redirect()->route('attack.index')->with('error', 'Rotation not found.');
        }

        return view('attack.show', compact('rotation'));
    }

    public function edit($id)
    {
        $rotation = AttackRotation::where('id', $id)->where('user_id', auth()->id())->first();
        
        if (!$rotation) {
            return redirect()->route('attack.index')->with('error', 'Rotation not found.');
        }

        return view('attack.edit', compact('rotation'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'players' => 'required|array|min:1'
        ]);

        $rotation = AttackRotation::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

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

        AttackRotation::create([
            'name' => $validated['name'],
            'players' => json_encode($validated['players']),
            'user_id' => auth()->id()
        ]);

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $rotation = AttackRotation::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $rotation->delete();

        return redirect()->route('attack.index')->with('success', 'Rotation deleted successfully.');
    }
}

