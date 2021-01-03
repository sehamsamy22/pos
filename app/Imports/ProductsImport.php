<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
//        'ar_name', 'en_name','unit','calories','price','image','barcode','sub_category_id','unit_id'


        return new Product([
            //
            'ar_name' => $row[2]??'',
            'en_name' => $row[2]??'',
            'price' => $row[11]??'',
            'unit'=>$row[6]??'',
            'barcode'=>$row[1]??'',
//            'unit'=>$row[2]??'',
        ]);
    }
}
