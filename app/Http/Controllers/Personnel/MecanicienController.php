<?php

namespace App\Http\Controllers\Personnel;

use Carbon\Carbon;
use App\Models\Mecanicien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MecanicienController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $mecaniciens = Mecanicien::all();
        $nbM = Mecanicien::count();
        $mois = Mecanicien::whereMonth('created_at', '=', now()->month)->count();
        $day = Mecanicien::whereDay('created_at','=', now()->day)->count();
        $semaine = Mecanicien::whereBetween('created_at', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])->get()->count();
        

        return view('mecaniciens', [
            'mecaniciens' => $mecaniciens,
            'nbM' => $nbM,
            'mois' => $mois,
            'day' => $day,
            'semaine' => $semaine
        ]);
    }

    public function create()
    {        
        $mecaniciens = Mecanicien::all();
        $nbM = Mecanicien::count();

        return view('addMecanicien',[
            'mecaniciens' => $mecaniciens,
            'nbM' => $nbM
        ]);
    }
    
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'MatrMeca' => 'required|unique:mecaniciens,MatrMeca|numeric|digits:6',
            'Mecanicien' => 'required'
        ]);

        Mecanicien::create($validateData);

        return redirect('/mecaniciens');
        // ->with('success', 'Voiture enregistrée avec succès')
    }

    public function show($id)
    {
        $mecanicien = Mecanicien::findOrfail($id);
        $daty = Carbon::now();
        return view('mecanicien', [
            'mecanicien' => $mecanicien,
            'daty' => $daty
        ]);
    }

    public function edit($id)
    {
        $mecanicien = Mecanicien::findOrfail($id);

        return view('editMecanicien', [
            'mecanicien' => $mecanicien,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'MatrMeca' => 'required|numeric|digits:6',
            'Mecanicien' => 'required',
        ]);

        Mecanicien::whereId($id)->update($validateData);
        return redirect('/mecaniciens');
    }

    public function destroy($id)
    {
        $mecanicien = Mecanicien::findOrfail($id);
        $mecanicien->delete();

        return redirect('/mecaniciens');
    }

}
