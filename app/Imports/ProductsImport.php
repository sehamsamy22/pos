<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Unit;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ProductsImport implements ToModel,WithStartRow
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
            'unit_id'=>\unit($row[6])??'',
            'barcode'=>$row[1]??'',
            'sub_category_id'=>5,
            'calories'=> $row[12]??'',

        ]);
    }
    public function StartRow(): int
    {
        return 2;
    }

}
