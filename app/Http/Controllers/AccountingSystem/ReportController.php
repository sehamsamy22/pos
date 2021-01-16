<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Http\Controllers\Controller;
use App\Models\ClientSubscriptions;
use App\Models\Purchase;
use App\Models\Revenue;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function incomes(Request  $request){

        if ($request->has('date')) {

        $data['incomes']=Revenue::whereDate('created_at',$request['date'])->where('type','!=','receipt')->sum('amount');
        $data['receipt']=Revenue::whereDate('created_at',$request['date'])->where('type','=','receipt')->sum('amount');
            $data['purchases']=Purchase::whereDate('created_at',$request['date'])->sum('total')+$data['receipt'];
            $data['profit']=$data['incomes']-($data['purchases']+$data['receipt']);

        }else{
            $data['incomes']=Revenue::whereDate('created_at',Carbon::today())->where('type','!=','receipt')
                ->sum('amount');
            $data['receipt']=Revenue::whereDate('created_at',Carbon::today())->where('type','=','receipt')->sum('amount');
            $data['purchases']=Purchase::whereDate('created_at',Carbon::today())->sum('total')+$data['receipt'];

            $data['profit']=$data['incomes']-($data['purchases']+$data['receipt']);
        }

        return view('admin.reports.index',compact('data'));
    }

    public function show($date){

        $data['sales']=Sale::whereDate('created_at',$date)->sum('total');
        $data['incomes']=Revenue::whereDate('created_at',$date)->where('type','!=','receipt')->sum('amount');
        $data['receipt']=Revenue::whereDate('created_at',$date)->where('type','=','receipt')->sum('amount');
        $data['purchases']=Purchase::whereDate('created_at',$date)->sum('total');
        $data['sales_discount']=Sale::whereDate('created_at',$date)->sum('discount');
        $data['purchases_discount']=Purchase::whereDate('created_at',$date)->sum('discount');
        $data['sales_discount_val']=( $data['sales']*$data['sales_discount'])/100;
        $data['purchases_discount_val']=( $data['purchases']*$data['purchases_discount'])/100;
        //---------------الاشتركات-----------------------------
        $data['subscription']=ClientSubscriptions::whereDate('created_at',$date)->sum('total');
        $data['subscription_cash']=ClientSubscriptions::whereDate('created_at',$date)->where('payment_type','cash')->sum('total');
        $data['subscription_mada']=ClientSubscriptions::whereDate('created_at',$date)->where('payment_type','mada')->sum('total');
        $data['subscription_master']=ClientSubscriptions::whereDate('created_at',$date)->where('payment_type','master')->sum('total');
        $data['subscription_veza']=ClientSubscriptions::whereDate('created_at',$date)->where('payment_type','veza')->sum('total');
        //-------------------------------
//        $data['purchases_cash']=Purchase::whereDate('created_at',$date)->where('payment_type','cash')->sum('total');
//        $data['purchases_mada']=Purchase::whereDate('created_at',$date)->where('payment_type','mada')->sum('total');
//        $data['purchases_master']=Purchase::whereDate('created_at',$date)->where('payment_type','master')->sum('total');
//        $data['purchases_veza']=Purchase::whereDate('created_at',$date)->where('payment_type','veza')->sum('total');
        return view('admin.reports.show',compact('data'));
    }

}
