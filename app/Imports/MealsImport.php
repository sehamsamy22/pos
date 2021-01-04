<?php

namespace App\Imports;

use App\Meal;
use Maatwebsite\Excel\Concerns\ToModel;

class MealsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Meal([

        ]);
    }
}
