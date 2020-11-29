<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\VisitMeasurement;
use App\Models\Measurement;
use App\Models\Visit;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    public  function  index(){
        $visits=Visit::all();
        return view('admin.visits.index',compact('visits'));
    }
    public function create()
    {
        $measurements = Measurement::all();
        $clients = Client::pluck('name', 'id')->toArray();

        return view('admin.visits.create', compact('measurements', 'clients'));
    }

    public function store(Request $request){

        $rules = [
            'date'=>'required',

        ];
        $message=[
            'date.required'=>'تاريخ الزيارة مطلوب ',
        ];

        $this->validate($request,$rules,$message);

                    $visit=Visit::create([
                        'client_id' => $request['client_id'],
                        'date' => $request['date'],
                    ]);
                foreach ($request['measurement']as $key=>$measurement) {
                    VisitMeasurement::create([
                        'visit_id' => $visit->id,
                        'measurement_id' => $key,
                        'value' => $measurement,
                    ]);
                }

        return back()->with('success', 'تم  زياره  العميل بنجاخ ');

    }
    public function destroy($id)
    {
        $visit=Visit::find($id);
        $visit->delete();
        return redirect()->route('dashboard.visits.index')->with('success', __('تم الحذف بنجاح'));

    }

    public function add_visit($id)
    {
        $measurements = Measurement::all();
        $client = Client::find($id);
        $clients = Client::pluck('name', 'id')->toArray();

        return view('admin.visits.create', compact('measurements', 'client','clients'));
    }
    }
