<?php
namespace App\Http\Controllers;

use App\Models\Panne;
use Illuminate\Http\Request;

class PanneController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $pannes = Panne::all();
        return view('pannes', [
            'pannes' => $pannes
        ]);
    }
    
    public function create()
    {        
        $pannes = Panne::all();
        $max = Panne::max('id');

        return view('addPanne',[
            'pannes' => $pannes,
            'max' => $max
        ]);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'TypePanne' => 'required|unique:pannes,TypePanne'
        ]);
        Panne::create($validateData);
        return redirect('/dpannes');
    }


    public function show($id)
    {
        $panne = Panne::findOrfail($id);

        return view('panne', [
            'panne' => $panne
        ]);
    }

    public function edit($id)
    {
        $panne = Panne::findOrfail($id);
    
        return view('editPanne', [
            'panne' => $panne
        ]);
    }

    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'TypePanne' => 'required'
        ]);

        Panne::whereId($id)->update($validateData);
        return redirect('/pannes');
    }

    public function destroy($id)
    {
        $panne = Panne::findOrfail($id);
        $panne->delete();

        return redirect('/pannes');
    }


}
