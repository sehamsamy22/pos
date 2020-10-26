<?php

namespace App\Http\Traits;



use App\Models\Setting;
use Illuminate\Http\Request;

trait SettingOperation
{

    /**
     * Update Existing Setting
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function RegisterSetting(Request $request)
    {
        $data = $request->all();

        foreach ($data as $key => $value) {
            if ($key == '_token' || !$value) continue;
            if($key == 'file'||$key == 'logo'){

                Setting::where(['name' => $key])->update(['value' => saveImage($value[0])]);

            }else
            {
               Setting::where(['name' => $key])->update(['value' => $value[0], ]);
            }


        }
    }

}
