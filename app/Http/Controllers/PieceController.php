<?php

namespace App\Http\Controllers;

use App\Models\Piece;
use Illuminate\Http\Request;

class PieceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pieces = Piece::all();
        $nbPi = Piece::count('id');

        return view('pieces', [
            'pieces' => $pieces,
            'nbPi' => $nbPi,
        ]);
    }

    public function create()
    {
        $pieces = Piece::all();
        $max = Piece::max('id');

        return view('addpiece', [
            'pieces' => $pieces,
            'max' => $max,
        ]);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'Piece' => 'required|unique:pieces,Piece',
        ]);

        Piece::create($validateData);

        return redirect('/interventions/create');
        // ->with('success', 'Voiture enregistrée avec succès')
    }

    public function show($id)
    {
        $piece = Piece::findOrfail($id);

        return view('piece', [
            'piece' => $piece,
        ]);
    }

    public function edit($id)
    {
        $piece = Piece::findOrfail($id);

        return view('editPiece', [
            'piece' => $piece,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'Piece' => 'required',
        ]);

        Piece::whereId($id)->update($validateData);

        return redirect('/pieces');
    }

    public function destroy($id)
    {
        $piece = Piece::findOrfail($id);
        $piece->delete();

        return redirect('/pieces');
    }
}
