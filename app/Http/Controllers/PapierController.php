<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;

class PapierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (! Gate::allows('access-admin')) {
            abort(403);
        }

        return view('papier');
    }
}
