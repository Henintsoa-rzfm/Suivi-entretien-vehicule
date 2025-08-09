<?php

namespace App\Repositories\Repository;

use App\Models\Detenteur;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\DetenteurRepositoryInterface;

class DetenteurRepository implements DetenteurRepositoryInterface
{
    public function all()
    {
        return Detenteur::orderBy('id', 'desc')->get();
    }

    public function find($id)
    {
        return Detenteur::findOrfail($id);
    }

    public function create(array $data)
    {
        return Detenteur::create($data);
    }

    public function update($id, array $data)
    {
        return Detenteur::whereId($id)->update($data);
    }

    public function delete($id)
    {
        $detenteur = Detenteur::findOrfail($id);
        $detenteur->delete();
    }

    public function getMaxId()
    {
        return DB::table('detenteurs')->max('id');
    }

    public function countWithoutAucun()
    {
        return Detenteur::whereNotIn('Detenteur', ['Aucun'])->count();
    }

    public function countByMonth($month)
    {
        return Detenteur::whereMonth('created_at', $month)->count();
    }

    public function countByDay($day)
    {
        return Detenteur::whereDay('created_at', $day)->count();
    }

    public function countByWeek($startOfWeek, $endOfWeek)
    {
        return Detenteur::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
    }

}