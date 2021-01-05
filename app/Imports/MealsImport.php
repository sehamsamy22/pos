<?php

namespace App\Imports;

use App\Models\Meal;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class MealsImport implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
//   dd($row);
     /*   'ar_name', 'en_name','sub_category_id','price','status','type_id','description','image','calories','discount','tax','approx_price'*/
        return new Meal([
            'ar_name' => $row[2]??'',
            'en_name' => $row[2]??'',
            'price' => $row[11]??'',
            'sub_category_id'=>5,
            'calories'=> $row[12]??'',
        ]);
    }
    public function StartRow(): int
    {
        return 1;
    }
}
