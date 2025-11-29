<?php

namespace App\Http\Controllers;

use App\Models\Assurance;
use App\Models\Vehicule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssuranceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $assurances = DB::table('assurances')
            ->join('vehicules', 'assurances.vehicule_id', '=', 'vehicules.id')
            ->select('assurances.*', 'vehicules.PlaqueImmatric')
            ->get();
        $andro = Carbon::now();
        $max = DB::table('assurances')->count();
        $exp = DB::table('assurances')->where('Date_exp_Assurance', '<', now())->count();
        $da = DB::table('assurances')->where('Date_exp_Assurance', '>', now())->count();
        $nbV = Vehicule::count();

        return view('feature.vehicle.insurance.assurances', [
            'assurances' => $assurances,
            'andro' => $andro,
            'max' => $max,
            'exp' => $exp,
            'da' => $da,
            'nbV' => $nbV,
        ]);
    }

    public function create()
    {
        $assurances = Assurance::all();
        $vehicules = Vehicule::all();
        $max = DB::table('assurances')->max('id');

        return view('feature.vehicle.insurance.create', [
            'assurances' => $assurances,
            'vehicules' => $vehicules,
            'max' => $max,
        ]);
    }

    public function store(Request $request)
    {
        $a = $request->DateAssurance;
        $b = Carbon::now();
        $c = '<h3 class="alert alert-danger" style="text-align : center; margin-top: 250px" >La date début de validité de l\'assurance ne peut pas être dans le futur</h3>';
        if ($a > $b) {
            return $c;
        } else {
            $validateData = $request->validate([
                'DateAssurance' => 'required',
                'Date_exp_Assurance' => 'required',
                'vehicule_id' => 'required|unique:assurances,vehicule_id',
            ]);

            assurance::create($validateData);

            return redirect('/assurances');
        }
    }

    public function show($id)
    {
        $assurance = Assurance::findOrfail($id);
        $andro = Carbon::now();

        return view('feature.vehicle.insurance.assurance', [
            'assurance' => $assurance,
            'andro' => $andro,
        ]);
    }

    public function edit($id)
    {
        $assurance = Assurance::findOrfail($id);
        $vehicules = Vehicule::all();
        $date1 = Carbon::now();

        return view('feature.vehicle.insurance.edit', [
            'assurance' => $assurance,
            'vehicules' => $vehicules,
            'date1' => $date1,
        ]);
    }

    public function update(Request $request, $id)
    {
        $a = $request->DateAssurance;
        $b = Carbon::now();
        $c = '<h3 class="alert alert-danger" style="text-align : center; margin-top: 250px" >La date début de validité de l\'assurance ne peut pas être dans le futur</h3>';
        if ($a > $b) {
            return $c;
        } else {
            $validateData = $request->validate([
                'DateAssurance' => 'required',
                'Date_exp_Assurance' => 'required',
                'vehicule_id' => 'required',
            ]);

            Assurance::whereId($id)->update($validateData);

            return redirect('/assurances');
        }
    }

    public function destroy($id)
    {
        $assurance = Assurance::findOrfail($id);
        $assurance->delete();

        return redirect('/assurances');
    }
}
