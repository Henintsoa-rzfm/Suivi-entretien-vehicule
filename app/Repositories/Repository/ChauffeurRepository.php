<?php

namespace App\Repositories\Repository;

use App\Models\Chauffeur;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\ChauffeurRepositoryInterface;

class ChauffeurRepository implements ChauffeurRepositoryInterface
{
    public function all()
    {
        return Chauffeur::orderBy('id', 'desc')->get();
    }

    public function find($id)
    {
        return Chauffeur::findOrfail($id);
    }

    public function create(array $data)
    {
        return Chauffeur::create($data);
    }

    public function update($id, array $data)
    {
        return Chauffeur::whereId($id)->update($data);
    }

    public function delete($id)
    {
        $chauffeur = Chauffeur::findOrfail($id);
        $chauffeur->delete();
    }

    public function getMaxId()
    {
        return DB::table('detenteurs')->max('id');
    }

    public function countWithoutAucun()
    {
        return Chauffeur::whereNotIn('Chauffeur', ['Aucun'])->count();
    }

    public function countByMonth($month)
    {
        return Chauffeur::whereMonth('created_at', $month)->count();
    }

    public function countByDay($day)
    {
        return Chauffeur::whereDay('created_at', $day)->count();
    }

    public function countByWeek($startOfWeek, $endOfWeek)
    {
        return Chauffeur::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
    }

}