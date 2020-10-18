<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\ClientVisit;
use App\Models\Measurement;
use App\Models\Visit;
use Illuminate\Http\Request;

class ClientVisitController extends Controller
{
    public  function  index(){
        $clients_visits=Visit::all();
        return view('admin.clients_visits.index',compact('clients_visits'));
    }
    public function create()
    {
        $measurements = Measurement::all();
        $clients = Client::pluck('name', 'id')->toArray();

        return view('admin.clients_visits.create', compact('measurements', 'clients'));
    }

    public function store(Request $request){
                    $visit=Visit::create([
                        'client_id' => $request['client_id'],
                        'date' => $request['date'],
                    ]);
                foreach ($request['measurement']as $key=>$measurement) {
                    ClientVisit::create([
                        'visit_id' => $visit->id,
                        'measurement_id' => $key,
                        'value' => $measurement,
                    ]);
                }

        return back()->with('success', 'تم  زياره  العميل بنجاخ ');

    }
    public function destroy($id )
    {
        ClientVisit::find($id)->delete();
        return redirect()->route('dashboard.clients_visits.index')->with('success', __('تم الحذف بنجاح'));

    }

    }
