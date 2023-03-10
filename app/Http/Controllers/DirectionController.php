<?php

namespace App\Http\Controllers;

use App\Models\Direction;
use Illuminate\Http\Request;

class DirectionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $directions = Direction::all();

        return view('directions', [
            'directions' => $directions
        ]);
    }

    public function create()
    {        
        $directions = Direction::all();

        return view('adddirection',[
            'directions' => $directions
        ]);
    }
    
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'Direction' => 'required'
        ]);

        direction::create($validateData);

        return redirect('/directions');
        // ->with('success', 'Voiture enregistrée avec succès')
    }

    public function show($id)
    {
        $direction = Direction::findOrfail($id);

        return view('direction', [
            'direction' => $direction
        ]);
    }

    public function edit($id)
    {
        $direction = Direction::findOrfail($id);
    
        return view('editDirection', [
            'direction' => $direction
        ]);
    }

    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'Direction' => 'required'
        ]);

        direction::whereId($id)->update($validateData);
        return redirect('/directions');
    }

    public function destroy($id)
    {
        $direction = direction::findOrfail($id);
        $direction->delete();

        return redirect('/directions');
    }    
}
