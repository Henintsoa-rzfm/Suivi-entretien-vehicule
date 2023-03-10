<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Detenteur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class DetenteurController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $detenteurs = Detenteur::all();
        $nbD = DB::table('detenteurs')->whereNotIn('Detenteur', ['Aucun'])->count();
        $mois = Detenteur::whereMonth('created_at', '=', now()->month)->count();
        $day = Detenteur::whereDay('created_at','=', now()->day)->count();
        $semaine = Detenteur::whereBetween('created_at', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])->get()->count();
        
        if (! Gate::allows('access-admin')) {
            abort(403);
        }
        return view('detenteurs', [
            'detenteurs' => $detenteurs,
            'nbD' => $nbD,
            'mois' => $mois,
            'day' => $day,
            'semaine' => $semaine
        ]);
    }

    public function create()
    {        
        $detenteurs = detenteur::all();
        $max =  DB::table('detenteurs')->max('id');

        return view('adddetenteur',[
            'detenteurs' => $detenteurs,
            'max' => $max
        ]);
    }
    
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'MatrDetenteur' => 'required|unique:detenteurs,MatrDetenteur|numeric|digits:6',
            'Detenteur' => 'required|unique:detenteurs,Detenteur',
            'Poste' => 'required',
        ]);

        Detenteur::create($validateData);

        return redirect('/detenteurs');
        // ->with('success', 'Voiture enregistrée avec succès')
    }

    public function show($id)
    {
        $detenteur = Detenteur::findOrfail($id);
        
        return view('detenteur', [
            'detenteur' => $detenteur,
        ]);
    }

    public function edit($id)
    {
        $detenteur = Detenteur::findOrfail($id);
        
        return view('editdetenteur', [
            'detenteur' => $detenteur,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'MatrDetenteur' => 'required|numeric|digits:6',
            'Detenteur' => 'required',
            'Poste' => 'required',
        ]);

        detenteur::whereId($id)->update($validateData);
        return redirect('/detenteurs');
    }

    public function destroy($id)
    {
        $detenteur = detenteur::findOrfail($id);
        $detenteur->delete();

        return redirect('/detenteurs');
    }    
}
