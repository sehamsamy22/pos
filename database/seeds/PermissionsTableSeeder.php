<?php
namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


      DB::table('permissions')->delete();

        DB::table('permissions')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'management',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
                'ar_name' => 'مدير النظام',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'financial',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
                'ar_name' => 'الادارة المالية',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'storages',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
                'ar_name' => 'المخزون',
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'purchases',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
                'ar_name' => 'المشتريات',
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'sales',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
                'ar_name' => 'المبيعات',
            ),
            5 =>
            array (
                'id' => 6,
                'name' => 'clients_subscriptions',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
                'ar_name' => 'الاشتركات والعضويات',
            ),
            6 =>
            array (
                'id' => 7,
                'name' => 'roles',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
                'ar_name' => 'الصلاحيات',
            ),
            7 =>
            array (
                'id' => 8,
                'name' => 'purchase_order',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
                'ar_name' => ' شاشة مسئول المخزن',
            ),
            8 =>
            array (
                'id' => 9,
                'name' => 'cook-view',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
                'ar_name' => 'شاشة المطبخ',
            ),
            9 =>
            array (
                'id' => 10,
                'name' => 'operarion_manger_view',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
                'ar_name' => 'شاشة مسئول التشغيل',
            ),
            10 =>
            array (
                'id' => 11,
                'name' => 'driver_manger_view',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
                'ar_name' => 'شاشة مسئول السائقين',
            ),

        ));


    }
}
