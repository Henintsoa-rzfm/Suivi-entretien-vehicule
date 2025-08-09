<?php

namespace App\Http\Controllers\Personnel;

use Carbon\Carbon;
use App\Models\Chauffeur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Chauffeur\StoreChauffeurRequest;
use App\Http\Requests\Chauffeur\UpdateChauffeurRequest;
use App\Services\Chauffeurs\ChauffeurService;

class ChauffeurController extends Controller
{
    private ChauffeurService $chauffeurService;

    public function __construct(ChauffeurService $chauffeurService)
    {
        $this->middleware('auth');
        $this->chauffeurService = $chauffeurService;
    }
    
    public function index()
    {
        $chauffeurs = $this->chauffeurService->getAllChauffeurs();
        $stats = $this->chauffeurService->getDashboardStats();

        return view('chauffeur.chauffeurs', [
            'chauffeurs' => $chauffeurs,
            'stats' => $stats
        ]);
    }

    public function create()
    {        
        $chauffeurNextId = $this->chauffeurService->getNextId();

        return view('chauffeur.addChauffeur',[
            'chauffeurNextId' => $chauffeurNextId
        ]);
    }
    
    public function store(StoreChauffeurRequest $request)
    {
        $this->chauffeurService->create($request->validated());
        return redirect('/chauffeurs');
    }

    public function show($id)
    {
        $chauffeur = $this->chauffeurService->find($id);

        return view('chauffeur.Chauffeur', [
            'chauffeur' => $chauffeur
        ]);
    }

    public function edit($id)
    {
        $chauffeur = $this->chauffeurService->find($id);

        return view('chauffeur.editChauffeur', [
            'chauffeur' => $chauffeur,
        ]);
    }

    public function update(UpdateChauffeurRequest $request, $id)
    {
        $validateData = $request->validated();
        $this->chauffeurService->update($id, $validateData);
        
        return redirect('/chauffeurs');
    }

    //Pending
    public function destroy($id)
    {
        $chauffeur = Chauffeur::findOrfail($id);
        $chauffeur->delete();

        return redirect('/chauffeurs');
    }        
}
