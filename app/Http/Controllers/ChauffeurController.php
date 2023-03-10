<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Chauffeur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChauffeurController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $chauffeurs = Chauffeur::all();
        $nbC = DB::table('chauffeurs')->whereNotIn('Chauffeur',['Aucun'])->count();
        $mois = Chauffeur::whereMonth('created_at', '=', now()->month)->count();
        $day = Chauffeur::whereDay('created_at','=', now()->day)->count();
        $semaine = Chauffeur::whereBetween('created_at', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])->get()->count();

        return view('chauffeurs', [
            'chauffeurs' => $chauffeurs,
            'nbC' => $nbC,
            'mois' => $mois,
            'day' => $day,
            'semaine' => $semaine
        ]);
    }

    public function create()
    {        
        $chauffeurs = Chauffeur::all();
        $max = DB::table('chauffeurs')->max('id');

        return view('addChauffeur',[
            'chauffeurs' => $chauffeurs,
            'max' => $max
        ]);
    }
    
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'MatrCh' => 'required|numeric|digits:6',
            'Chauffeur' => 'required'
        ]);

        Chauffeur::create($validateData);

        return redirect('/chauffeurs');
        // ->with('success', 'Voiture enregistrée avec succès')
    }

    public function show($id)
    {
        $chauffeur = Chauffeur::findOrfail($id);

        return view('Chauffeur', [
            'chauffeur' => $chauffeur
        ]);
    }

    public function edit($id)
    {
        $chauffeur = Chauffeur::findOrfail($id);

        return view('editChauffeur', [
            'chauffeur' => $chauffeur,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'MatrCh' => 'required|numeric|digits:6',
            'Chauffeur' => 'required',
        ]);

        Chauffeur::whereId($id)->update($validateData);
        return redirect('/chauffeurs');
    }

    public function destroy($id)
    {
        $chauffeur = Chauffeur::findOrfail($id);
        $chauffeur->delete();

        return redirect('/chauffeurs');
    }        
}
