<?php

namespace App\Http\Controllers\Personnel;

use Carbon\Carbon;
use App\Models\Detenteur;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Services\Detenteurs\DetenteurService;
use App\Http\Requests\Detenteur\StoreDetenteurRequest;
use App\Http\Requests\Detenteur\UpdateDetenteurRequest;

class DetenteurController extends Controller
{
    private DetenteurService $detenteurService;

    public function __construct(DetenteurService $detenteurService)
    {
        $this->middleware('auth');
        $this->detenteurService = $detenteurService;
    }
    
    public function index()
    {
        $detenteurs = $this->detenteurService->getAllDetenteurs();
        $stats = $this->detenteurService->getDashboardStats();
        
        if (! Gate::allows('access-admin')) {
            abort(403);
        }
        return view('detenteur.detenteurs', [
            'detenteurs' => $detenteurs,
            'stats' => $stats
        ]);
    }

    public function create()
    {   
        $detenteurNextId = $this->detenteurService->getNextId();

        return view('detenteur.adddetenteur',[
            'detenteurNextId' => $detenteurNextId
        ]);
    }
    
    public function store(StoreDetenteurRequest $request)
    {
        $this->detenteurService->create($request->validated());

        return redirect('/detenteurs');
    }

    public function show($id)
    {
        $detenteur = $this->detenteurService->find($id);
        
        return view('detenteur.detenteur', [
            'detenteur' => $detenteur,
        ]);
    }

    public function edit($id)
    {
        $detenteur = $this->detenteurService->find($id);
        
        return view('detenteur.editdetenteur', [
            'detenteur' => $detenteur,
        ]);
    }

    public function update(UpdateDetenteurRequest $request, $id)
    {
        $validateData = $request->validated();
        $this->detenteurService->update($id, $validateData);

        return redirect('/detenteurs');
    }

    // Pending
    public function destroy($id)
    {
        $detenteur = detenteur::findOrfail($id);
        $detenteur->delete();

        return redirect('/detenteurs');
    }    
}
