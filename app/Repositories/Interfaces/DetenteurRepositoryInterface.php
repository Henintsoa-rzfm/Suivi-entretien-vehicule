<?php

namespace App\Repositories\Interfaces;

interface DetenteurRepositoryInterface
{
    public function all();
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);

    public function getMaxId();
    public function countWithoutAucun();
    public function countByMonth($month);
    public function countByDay($day);
    public function countByWeek($startOfWeek, $endOfWeek);
    

}
