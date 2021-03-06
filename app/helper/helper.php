<?php


//Json array response

use App\Models\AccountingSystem\AccountingAccount;
use App\Models\SubscriptionMeal;
use App\Models\Unit;
use Carbon\Carbon;
class MyHelper{

    public static function tree($accounts, $step = 0)
   {
       $output = '';
    //    $base_url = url('/ChartsAccounts/ChartsAccounts/');
           foreach($accounts as $account)
           {
            if($account->type!='sub'){
               $output .=

               '<li  data-jstree={"opened":true} > '. $account->code . " -".$account->name;
               }else
               {
                $output .=

                '<li  data-jstree={"type":"file"} > '. $account->code . " -".$account->name;
               }
               if($account->type!='sub'){
               if($account->children)
               {
                   $output .= '<ul>'. self::tree($account->children, $step+1).'</ul>'.'</li>';
               }
           }else{

                   $output .= '</li>';

               }
           }
       return $output;
   }

   }

  function unit($unit_=null){
    $unit=Unit::where('name',$unit_)->first();
    return $unit->id??Null;
}
function meals($id,$week,$day,$type_id){
    $subscriptionMeal=SubscriptionMeal::where('subscription_id',$id)
        ->where('week',$week)->where('day',$day)->pluck('meal_id','id')->toArray();
        $meals=\App\Models\Meal::whereIn('id',$subscriptionMeal)->get();
    return $meals;
}
function meal_sizes($id,$week,$day,$type_id){
    $subscriptionMeal=SubscriptionMeal::where('subscription_id',$id)
        ->where('week',$week)->where('day',$day)->pluck('meal_id','id')->toArray();
    $meal_sizes=\App\Models\Size::whereIn('meal_id',$subscriptionMeal)->get();
//    dd($meal_sizes);
    return $meal_sizes;
}
function mealsWeek1($id,$day,$type_id){
    $systemMeal=\App\Models\Dietsystem::where('client_subscription_id',$id)
        ->where('week','1')->where('day_No',$day)->pluck('size_id','id')->toArray();
    $meals=\App\Models\Size::whereIn('id',$systemMeal)->get();

    return $meals;
}

function mealsWeek2($id,$day,$type_id){
    $systemMeal=\App\Models\Dietsystem::where('client_subscription_id',$id)
        ->where('week','2')->where('day_No',$day)->pluck('size_id','id')->toArray();
    $meals=\App\Models\Size::whereIn('id',$systemMeal)->get();
    return $meals;
}
function mealsWeek3($id,$day,$type_id){
    $systemMeal=\App\Models\Dietsystem::where('client_subscription_id',$id)
        ->where('week','3')->where('day_No',$day)->pluck('size_id','id')->toArray();
    $meals=\App\Models\Size::whereIn('id',$systemMeal)->get();
    return $meals;
}
function mealsWeek4($id,$day,$type_id){
    $systemMeal=\App\Models\Dietsystem::where('client_subscription_id',$id)
        ->where('week','4')->where('day_No',$day)->pluck('size_id','id')->toArray();
    $meals=\App\Models\Size::whereIn('id',$systemMeal)->get();
    return $meals;
}


function mealsWeek5($id,$day,$type_id){
    $systemMeal=\App\Models\Dietsystem::where('client_subscription_id',$id)
        ->where('week','5')->where('day_No',$day)->pluck('meal_id','id')->toArray();
    $meals=\App\Models\Meal::whereIn('id',$systemMeal)->get();
    return $meals;
}
function mealsWeek6($id,$day,$type_id){
    $systemMeal=\App\Models\Dietsystem::where('client_subscription_id',$id)
        ->where('week','6')->where('day_No',$day)->pluck('meal_id','id')->toArray();
    $meals=\App\Models\Meal::whereIn('id',$systemMeal)->get();
    return $meals;
}
function mealsWeek7($id,$day,$type_id){
    $systemMeal=\App\Models\Dietsystem::where('client_subscription_id',$id)
        ->where('week','7')->where('day_No',$day)->pluck('meal_id','id')->toArray();
    $meals=\App\Models\Meal::whereIn('id',$systemMeal)->get();
    return $meals;

}
function responseJson($status, $msg, $data = null, $state = 200)
{
    $response = [
        'status' => (int)$status,
        'message' => $msg,
        'data' => $data,
    ];
    return response()->json($response, $state);
}

function rearrange_array($array, $key) {
    while ($key > 0) {
        $temp = array_shift($array);
        $array[] = $temp;
        $key--;
    }
    return $array;
}


function storekeepers()
{
    $storekeepers = \App\User::where('is_storekeeper',1)->get()->mapWithKeys(function ($q) {
        return [$q['id'] => $q['name']];
    });
    return $storekeepers;
}


function chart_accounts()
{
    $chart_accounts = \App\Models\Account::all()->mapWithKeys(function ($q) {
        return [$q['id'] => $q['name']];
    });
    return $chart_accounts;
}

function allstores()
{
    $stores = \App\Models\AccountingSystem\AccountingStore::all()->mapWithKeys(function ($q) {
        return [$q['id'] => $q['ar_name']];
    });
    return $stores;
}

//function discounts()
//{
//    $discounts = \App\Models\Discount::all()->mapWithKeys(function ($q) {
//        return [$q['id'] => $q['name']];
//    });
//    return $discounts;
//}

function stores_to($id=Null)

{
    if ($id != null) {
    $stores_to= \App\Models\AccountingSystem\AccountingStore::where('id','!=',$id)->get()->mapWithKeys(function ($q) {
        return [$q['id'] => $q['ar_name']];
    });
}else{
    $stores_to=[];
}

    // dd($stores_to);
    return $stores_to;
}

function subscriptions(){

          $subscriptions=App\Models\ClientSubscriptions::all()->mapWithKeys(function ($q) {
            return [$q['id'] => $q['name']];
        });



    return $subscriptions;
}

function products_purchase($purchase=null){
    if ($purchase != null) {

        $products_id=App\Models\AccountingSystem\AccountingPurchaseItem::where('purchase_id',$purchase)->where('quantity','!=',Null)->pluck('product_id')->toArray();

          $products=App\Models\AccountingSystem\AccountingProduct::whereIn('id',$products_id)->get()->mapWithKeys(function ($q) {
            return [$q['id'] => $q['name']];
        });


    }else{
        $products=[];
    }

    return $products;
}






function getsetting($name)
{
    $settings=App\Models\Setting::where('name',$name)->first();
//    dd($settings);
    return $settings->value ??'';
}

function products_not_settement($store=null){
    if ($store != null) {

        $products_id=App\Models\AccountingSystem\AccountingProductStore::where('store_id',$store)->where('quantity','!=',Null)->where('quantity','>',0)->pluck('product_id')->toArray();

        $products=App\Models\AccountingSystem\AccountingProduct::select(['id', 'name'])->whereIn('id',$products_id)->where('is_settlement',0)->get();


    }else{
        $products=[];
    }


    return $products;
}


function companies()
{
    $companies = \App\Models\AccountingSystem\AccountingCompany::all()->mapWithKeys(function ($q) {
        return [$q['id'] => $q['name']];
    });
    return $companies;
}


function shifts()
{
    $shifts = \App\Models\AccountingSystem\AccountingBranchShift::all()->mapWithKeys(function ($q) {
        return [$q['id'] => $q['name']];
    });
    return $shifts;
}

function devices()
{
    $devices = \App\Models\AccountingSystem\AccountingDevice::all()->mapWithKeys(function ($q) {
        return [$q['id'] => $q['code']];
    });
// dd($devices);
    return $devices;
}





function keepers($store= null)
{
    if ($store != null) {
        $keepers = \App\User::where('is_storekeeper', 1)->where('accounting_store_id',$store)->get()->mapWithKeys(function ($q) {
            return [$q['id'] => $q['name']];
        });
    }else{
        $keepers=[];
    }

    return $keepers;
}

function AllStore()
{
    $stores =App\Models\AccountingSystem\AccountingStore::all()->mapWithKeys(function ($q) {
        return [$q['id'] => $q['ar_name']];
    });
// dd($devices);
    return $stores;
}

function branches($company = null)
{

    if ($company != null) {
        $branches = App\Models\AccountingSystem\AccountingCompany::find($company)->branches->mapWithKeys(function ($item) {
            return [$item['id'] => $item['name'],'all' => '???? ????????????'];
        });
    } else {
        $branches = \App\Models\AccountingSystem\AccountingBranch::all()->mapWithKeys(function ($item) {
            return [$item['id'] => $item['name']];
        });
    }
    return $branches;
}



function branches_only($company = null)
{

    if ($company != null) {
        $branches = App\Models\AccountingSystem\AccountingCompany::find($company)->branches->mapWithKeys(function ($item) {
            return [$item['id'] => $item['name']];
        });
    } else {
        $branches = \App\Models\AccountingSystem\AccountingBranch::all()->mapWithKeys(function ($item) {
            return [$item['id'] => $item['name']];
        });
    }
    return $branches;
}


function stores($branch=null){


    if ($branch != null) {


        // $stores=App\Models\AccountingSystem\AccountingStore::find($branch)->faces->mapWithKeys(function ($item) {
        //     return [$item['id'] => $item['ar_name']];
        // });
    }else{
    $stores=[];
}
    return $stores;
}


function faces($branch=null,$company_id=null){
    if ($branch != null) {
        if ($branch != 'all') {
        $faces=App\Models\AccountingSystem\AccountingBranch::find($branch)->faces->mapWithKeys(function ($item) {
            return [$item['id'] => $item['name']];
        });
        }else{
            $branches=App\Models\AccountingSystem\AccountingBranch::where('company_id',$company_id)->pluck('id','id')->toArray();
            $faces=[];

               $faces=\App\Models\AccountingSystem\AccountingBranchFace::whereIn('branch_id',$branches)->pluck('name','id')->toArray();


        }

    }else{
        $faces=[];
    }

    return $faces;
}



function colums($face=null,$cell=null){
    if ($face != null) {


        $colums=App\Models\AccountingSystem\AccountingBranchFace::find($face)->columns->mapWithKeys(function ($item) {
            return [$item['id'] => $item['name']];
        });
    }else{
        $colums=[];
    }
    if($cell!= null){
        dd($cell->column_id);
       return $cell->column_id;
    }

    return $colums;
}

function cells($colum=null){
    if ($colum != null) {


        $cells=App\Models\AccountingSystem\AccountingFaceColumn::find($colum)->cells->mapWithKeys(function ($item) {
            return [$item['id'] => $item['name']];
        });
    }else{
        $cells=[];
    }

    return $cells;
}


function saveImage($file, $folder = '/')
{
    $fileName = date('YmdHis') . '-' . $file->getClientOriginalName();;
    $path = \Storage::disk('public')->putFileAs($folder, $file, $fileName);
    return 'storage/' . $path;
}


function uploadpath()
{
    return 'photos';
}

function uploader($request, $img_name)

{
    $file = $request->file($img_name);
    $fileHash = str_replace('.' . $file->extension(), '', $file->hashName());
    $fileName = $fileHash . '.' . $request->file($img_name)->getClientOriginalExtension();
    $path = Storage::disk('public')->putFileAs(uploadpath(), $file, $fileName);
    return $path;
}


function routeActive($path, $active = 'active')
{

    return request()->routeIs($path) ? $active : '';
}

function urlActive($path, $active = 'active')
{
    return Request::is($path . '*') ? $active : '';
}


/**
 * Get Image
 * @param $filename
 * @return string
 */
//function getimg($filename)
//{
//    $base_url = url('/');
//    return $base_url . '/' . $filename;
//}

function getimg($filename)
{
    $base_url = url('/');
    return $base_url.'/'.$filename;
}


function deleteImg($img_name)
{
    \Storage::disk('public')->delete(uploadpath(),$img_name);
    return True;
}



/**
 * Get Image
 * @param $filename
 * @return string
 */
function getStorageImg($filename)
{
    $base_url = url('/');
    return $base_url . '/storage/' . $filename;
}

function getimgWeb($filename)
{
    $base_url = url('/');
    return $base_url . '/' . $filename;
}

function generatePIN($digits = 4)
{
    $i = 0; //counter
    $pin = ""; //our default pin is blank.
    while ($i < $digits) {
        //generate a random number between 0 and 9.
        $pin .= mt_rand(0, 9);
        $i++;
    }
    return $pin;
}

function ShowOrHide($task, $types)
{

    if (in_array($task->type, $types)) {

        return 'd-block';
    }
    return 'd-none';

}

function toSeconds($days, $hours, $minutes)
{

    $seconds = 0;
    $seconds += (($days * 24 + $hours) * 60 + $minutes) * 60;
    /*    return strtotime("{$days} days {$hours} hours {$minutes} minutes");*/

    return $seconds;
}

function secondsToTime($seconds)
{
    $dtF = new \DateTime('@0');
    $dtT = new \DateTime("@$seconds");
    $days = $dtF->diff($dtT)->format('%a');
    $hours = $dtF->diff($dtT)->format('%h');
    $minutes = $dtF->diff($dtT)->format('%i');
    return ['days' => $days, 'hours' => $hours, 'minutes' => $minutes];
}


function taskTypes()
{

}

function presentFilter($task_user)
{
    if($task_user->from_time==null){
        return false;
    };
    return (Carbon::now()->greaterThanOrEqualTo($task_user->from_time) && Carbon::now()->LessThanOrEqualTo($task_user->to_time));
}

function oldFilter($task_user)
{
    if($task_user->from_time==null){
        return false;
    };
    return (Carbon::now()->greaterThan($task_user->from_time) && Carbon::now()->greaterThan($task_user->to_time));
}
function futureFilter($task_user)
{

    if($task_user->from_time==null){
        return false;
    };

    return (Carbon::now()->lessThan($task_user->from_time) && Carbon::now()->lessThan($task_user->to_time));

}


function rates()
{
    $arr = [
        '0'=>'????',
        '1'=>'????????',
        '2'=>'??????????',
        '3'=>'??????',
        '4'=>'?????? ????????',
        '5'=>'??????????',
    ];
    return $arr;
}




function idol_user()
{
    $idol_user = \App\User::WhereHas('tasks',function ($q){
        $q->where('rate','!=',null);
        $q->whereMonth('finished_at',date("m"));
    })->get()->sortByDesc(function($user) {
        return $user->rate();
    })->first();

    return $idol_user;
}


function lastMessage($user_id)
{
    $message_user = \App\Models\Message::where(['user_id' => auth()->user()->id, 'receiver_id' => $user_id])->orderby('id', 'desc')->first();
    $message_reciver = \App\Models\Message::where(['receiver_id' => auth()->user()->id, 'user_id' => $user_id])->orderby('id', 'desc')->first();
    if ($message_user && $message_reciver) {
        if ($message_reciver->created_at > $message_user->created_at) return $message_reciver->message;
        return $message_user->message;
    } elseif ($message_user) return $message_user->message;
    elseif ($message_reciver) return $message_reciver->message;
    return '???? ???????? ??????????';
}


function allowExtentionsImage()
{
    return [
        'png',
        'jpg',
        'jpeg',
        'gif',
        'IMG'
    ];
}

function allowExtentionsFiles()
{
    return [
        'txt',
        'zip',
        'sql',
        'xls',
        'xlm',
        'xla',
        'xlc',
        'xlt',
        'xlw',
        'pdf',
        'xla',
        'docx',
        'rtf',
        'doc',
        'dot',
        'dotx',
        'docm',
        'xlsx',
        'xlsm',
        'xltx',
        'dotm',
        'xltm',
        'xlam',
        'xlsb'
    ];
}

function getFileType($filedName, $value)
{
        if (in_array(getExtention($value), allowExtentionsImage())) {
            return 'Image';
        }
        if (in_array(getExtention($value), allowExtentionsFiles())) {
            return 'File';
        }
        else
            return "undefined";
}

function getExtention($fileName)
{
    $array = explode('.', $fileName);
    return end($array);
}


function getNationalities(){

    return [
        "Afghan"=> "????????????",
        "Albanian"=> "????????????",
        "Algerian"=> "????????????",
        "American"=> "????????????",
        "Andorran"=> "????????????",
        "Angolan"=> "????????????",
        "Antiguans"=> "??????????????",
        "Argentinean"=> "????????????????",
        "Armenian"=> "????????????",
        "Australian"=> "??????????????",
        "Austrian"=> "????????????",
        "Azerbaijani"=> "??????????????????",
        "Bahamian"=> "????????????",
        "Bahraini"=> "????????????",
        "Bangladeshi"=> "??????????????????",
        "Barbadian"=> "??????????????????",
        "Barbudans"=> "????????????",
        "Batswana"=> "????????????????",
        "Belarusian"=> "????????????????",
        "Belgian"=> "????????????",
        "Belizean"=> "??????????",
        "Beninese"=> "??????????",
        "Bhutanese"=> "????????????",
        "Bolivian"=> "????????????",
        "Bosnian"=> "??????????",
        "Brazilian"=> "??????????????",
        "British"=> "??????????????",
        "Bruneian"=> "????????????",
        "Bulgarian"=> "????????????",
        "Burkinabe"=> "??????????????",
        "Burmese"=> "??????????",
        "Burundian"=> "??????????????",
        "Cambodian"=> "????????????",
        "Cameroonian"=> "????????????????",
        "Canadian"=> "????????",
        "Cape Verdean"=> "???????????? ????????????",
        "Central African"=> "?????? ??????????????",
        "Chadian"=> "??????????",
        "Chilean"=> "????????",
        "Chinese"=> "????????",
        "Colombian"=> "??????????????",
        "Comoran"=> "?????? ??????????",
        "Congolese"=> "??????????????",
        "Costa Rican"=> "??????????????????",
        "Croatian"=> "??????????????",
        "Cuban"=> "????????",
        "Cypriot"=> "??????????",
        "Czech"=> "??????????",
        "Danish"=> "????????????????",
        "Djibouti"=> "????????????",
        "Dominican"=> "????????????????????",
        "Dutch"=> "????????????",
        "East Timorese"=> "???????????? ????????",
        "Ecuadorean"=> "????????????????",
        "Egyptian"=> "????????",
        "Emirian"=> "??????????????",
        "Equatorial Guinean"=> "????????  ??????????????",
        "Eritrean"=> "????????????",
        "Estonian"=> "????????????",
        "Ethiopian"=> "????????",
        "Fijian"=> "????????",
        "Filipino"=> "????????????",
        "Finnish"=> "????????????",
        "French"=> "??????????",
        "Gabonese"=> "????????????",
        "Gambian"=> "????????????",
        "Georgian"=> "??????????",
        "German"=> "????????????",
        "Ghanaian"=> "????????",
        "Greek"=> "????????????",
        "Grenadian"=> "??????????????",
        "Guatemalan"=> "??????????????????",
        "Guinea-Bissauan"=> "???????? ????????????",
        "Guinean"=> "????????",
        "Guyanese"=> "????????????",
        "Haitian"=> "??????????",
        "Herzegovinian"=> "??????????",
        "Honduran"=> "????????????????",
        "Hungarian"=> "????????????",
        "Icelander"=> "??????????????",
        "Indian"=> "????????",
        "Indonesian"=> "????????????????",
        "Iranian"=> "????????????",
        "Iraqi"=> "??????????",
        "Irish"=> "??????????????",
        "Italian"=> "????????????",
        "Ivorian"=> "????????????",
        "Jamaican"=> "??????????????",
        "Japanese"=> "????????????",
        "Jordanian"=> "??????????",
        "Kazakhstani"=> "????????????????????",
        "Kenyan"=> "????????",
        "Kittian and Nevisian"=> "?????????????? ????????????????????",
        "Kuwaiti"=> "??????????",
        "Kyrgyz"=> "????????????????????",
        "Laotian"=> "??????????",
        "Latvian"=> "??????????",
        "Lebanese"=> "????????????",
        "Liberian"=> "????????????",
        "Libyan"=> "????????",
        "Liechtensteiner"=> "??????????????????????",
        "Lithuanian"=> "????????????",
        "Luxembourger"=> "????????????????",
        "Macedonian"=> "????????????",
        "Malagasy"=> "??????????????",
        "Malawian"=> "????????????",
        "Malaysian"=> "????????????",
        "Maldivan"=> "??????????????",
        "Malian"=> "????????",
        "Maltese"=> "??????????",
        "Marshallese"=> "??????????????",
        "Mauritanian"=> "????????????????",
        "Mauritian"=> "??????????????????",
        "Mexican"=> "????????????",
        "Micronesian"=> "??????????????????",
        "Moldovan"=> "??????????????",
        "Monacan"=> "????????????",
        "Mongolian"=> "????????????",
        "Moroccan"=> "??????????",
        "Mosotho"=> "????????????",
        "Motswana"=> "??????????????",
        "Mozambican"=> "????????????????",
        "Namibian"=> "????????????",
        "Nauruan"=> "??????????",
        "Nepalese"=> "????????????",
        "New Zealander"=> "??????????????????",
        "Ni-Vanuatu"=> "???? ??????????????",
        "Nicaraguan"=> "??????????????????",
        "Nigerien"=> "??????????",
        "North Korean"=> "???????? ??????????",
        "Northern Irish"=> "?????????????? ??????????",
        "Norwegian"=> "????????????",
        "Omani"=> "??????????",
        "Pakistani"=> "????????????????",
        "Palauan"=> "????????????",
        "Palestinian"=> "??????????????",
        "Panamanian"=> "????????",
        "Papua New Guinean"=> "?????????? ?????????? ??????????????",
        "Paraguayan"=> "??????????????????????",
        "Peruvian"=> "????????????",
        "Polish"=> "????????????",
        "Portuguese"=> "??????????????",
        "Qatari"=> "????????",
        "Romanian"=> "????????????",
        "Russian"=> "????????",
        "Rwandan"=> "????????????",
        "Saint Lucian"=> "??????????????",
        "Salvadoran"=> "????????????????",
        "Samoan"=> "????????????????",
        "San Marinese"=> "?????? ??????????????",
        "Sao Tomean"=> "?????? ????????????",
        "Saudi"=> "??????????",
        "Scottish"=> "??????????????",
        "Senegalese"=> "????????????",
        "Serbian"=> "????????",
        "Seychellois"=> "??????????",
        "Sierra Leonean"=> "???????? ??????????",
        "Singaporean"=> "????????????????",
        "Slovakian"=> "??????????????",
        "Slovenian"=> "??????????????",
        "Solomon Islander"=> "?????? ????????????",
        "Somali"=> "????????????",
        "South African"=> "???????? ??????????????",
        "South Korean"=> "???????? ??????????",
        "Spanish"=> "????????????",
        "Sri Lankan"=> "?????? ??????????",
        "Sudanese"=> "????????????",
        "Surinamer"=> "????????????????",
        "Swazi"=> "??????????",
        "Swedish"=> "??????????",
        "Swiss"=> "????????????",
        "Syrian"=> "????????",
        "Taiwanese"=> "??????????????",
        "Tajik"=> "????????????",
        "Tanzanian"=> "????????????",
        "Thai"=> "????????????????????",
        "Togolese"=> "??????????????",
        "Tongan"=> "??????????????",
        "Trinidadian or Tobagonian"=> "?????????????????? ???? ????????????????",
        "Tunisian"=> "??????????",
        "Turkish"=> "????????",
        "Tuvaluan"=> "????????????",
        "Ugandan"=> "????????????",
        "Ukrainian"=> "??????????????",
        "Uruguayan"=> "????????????????",
        "Uzbekistani"=> "????????????????????",
        "Venezuelan"=> "??????????????",
        "Vietnamese"=> "??????????????",
        "Welsh"=> "??????????",
        "Yemenite"=> "????????",
        "Zambian"=> "??????????",
        "Zimbabwean"=> "????????????????"
    ];


}

function chooseNationality($nationality){
    if(array_key_exists($nationality,getNationalities())){
        return getNationalities()[$nationality];
    }
    return $nationality;

}

function currency(){
$currencies=\App\Models\AccountingSystem\AccountingCurrency::pluck('ar_name','id')->toArray();
    return $currencies;
}


function accounts(){


    $accounts=\App\Models\AccountingSystem\AccountingAccount::select('id', DB::raw("concat(ar_name, ' - ',code) as code_name"))->where('kind','sub')->pluck('code_name','id')->toArray();
return $accounts;
}

function pay_type(){

    return [
        "cash"=> "????????",
        "agel"=> "??????",

    ];
}

function productCategories()
{
    $categories = \App\Models\AccountingSystem\AccountingProductCategory::all()->mapWithKeys(function ($q) {
        return [$q['id'] => $q['ar_name']];
    });
    return $categories;
}

function months(){

    return [
        'Jan'=>'??????????',
        'Feb'=>'????????????',
        'Mar'=>'????????',
        'Apr'=>'??????????',
        'May'=>'????????',
        'Jun'=>'??????????',
        'Jul'=>'??????????',
        'Aug'=>'??????????',
        'Sep'=>'????????????',
        'Oct'=>'????????????',
        'Nov'=>'????????????',
        'Dec'=>'????????????'

    ];
}
function chooseMonthly($month){
    if(array_key_exists($month,months())){
        return months()[$month];
    }
    return $month;

}


  function quarterly(){
   return [
    '1'=>'?????????? ???????????? ??????????',
    '2'=>'?????????? ???????????? ????????????',
    '3'=>'?????????? ???????????? ????????????',
    '4'=>'?????????? ???????????? ????????????',
   ];
}



function levels(){
    return [
     '1'=>' ?????????????? ??????????  ',
     '2'=>' ?????????????? ????????????',
     '3'=>' ?????????????? ????????????',
     '4'=>' ?????????????? ????????????',
     '5'=>' ?????????????? ????????????',
     '6'=>' ?????????????? ????????????',
     '7'=>' ?????????????? ????????????',
     '8'=>' ?????????????? ????????????',
     '9'=>' ?????????????? ????????????',
     '10'=>' ?????????????? ????????????',
     '11'=>' ?????????????? ?????????? ??????',
     '12'=>' ?????????????? ???????????? ??????',
     '13'=>' ?????????????? ???????????? ??????',
     '14'=>' ?????????????? ???????????? ??????',
     '15'=>' ?????????????? ???????????? ??????',
     '16'=>' ?????????????? ???????????? ??????',
     '17'=>' ?????????????? ???????????? ??????',
    ];
 }

 function all_levels($id){
    if(array_key_exists($id,levels())){
        return levels()[$id];
    }
    return $id;

}
function choosequarterly($quarter){
    if(array_key_exists($quarter,quarterly())){
        return quarterly()[$quarter];
    }
    return $quarter;

}
