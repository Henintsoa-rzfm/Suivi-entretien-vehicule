<?php

namespace App\Http\Controllers;

use App\Models\Vehicule;
use App\Models\Visite;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisiteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $visites = DB::table('visites')->join('vehicules', 'visites.vehicule_id', '=', 'vehicules.id')
            ->select('visites.*', 'vehicules.PlaqueImmatric')->get();
        $max = Visite::count('id');
        $exp = DB::table('visites')->where('Date_exp_Visite', '<', now())->count();
        $dv = DB::table('visites')->where('Date_exp_Visite', '>', now())->count();
        $andro = Carbon::now();
        // $lim = Carbon::now()->addYear()->subDays(15);
        $lim = Carbon::now()->subDays(15);
        $nbV = Vehicule::count();

        return view('feature.vehicle.technical-inspection.visites', [
            'visites' => $visites,
            'max' => $max,
            'andro' => $andro,
            'exp' => $exp,
            'dv' => $dv,
            'nbV' => $nbV,
            'lim' => $lim,
        ]);
    }

    public function create()
    {
        $visites = Visite::all();
        $vehicules = Vehicule::all();
        $max = Visite::count('id');

        return view('feature.vehicle.technical-inspection.create', [
            'visites' => $visites,
            'vehicules' => $vehicules,
            'max' => $max,
        ]);
    }

    public function store(Request $request)
    {
        $a = $request->DateVisite;
        $b = Carbon::now();
        $c = '<h3 class="alert alert-danger" style="text-align : center; margin-top: 250px" >La date début de validité de la visite ne peut pas être dans le futur</h3>';
        if ($a > $b) {
            return $c;
        } else {
            $validateData = $request->validate([
                'DateVisite' => 'required',
                'Date_exp_Visite' => 'required',
                'vehicule_id' => 'required|unique:visites,vehicule_id',
            ]);

            Visite::create($validateData);

            return redirect('/visites');
        }
    }

    public function show($id)
    {
        $visite = Visite::findOrfail($id);
        $andro = Carbon::now();

        return view('feature.vehicle.technical-inspection.visite', [
            'visite' => $visite,
            'andro' => $andro,
        ]);
    }

    public function edit($id)
    {
        $visite = Visite::findOrfail($id);
        $vehicules = Vehicule::all();

        return view('feature.vehicle.technical-inspection.edit', [
            'visite' => $visite,
            'vehicules' => $vehicules,
        ]);
    }

    public function update(Request $request, $id)
    {
        $a = $request->DateVisite;
        $b = Carbon::now();
        $c = '<h3 class="alert alert-danger" style="text-align : center; margin-top: 250px" >La date début de validité de la visite ne peut pas être dans le futur</h3>';
        if ($a > $b) {
            return $c;
        } else {
            $validateData = $request->validate([
                'DateVisite' => 'required',
                'Date_exp_Visite' => 'required',
                'vehicule_id' => 'required',
            ]);

            Visite::whereId($id)->update($validateData);

            return redirect('/visites');
        }
    }

    public function destroy($id)
    {
        $visite = Visite::findOrfail($id);
        $visite->delete();

        return redirect('/visites');
    }
}
