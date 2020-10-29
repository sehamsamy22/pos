<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\ClientSubscriptions;
use App\Models\VisitMeasurement;
use App\Models\Meal;
use App\Models\Measurement;
use App\Models\Subscription;
use App\Models\Visit;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients=Client::all();

        return view('admin.clients.index',compact('clients'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $measurements=Measurement::all();
        $subscriptions=Subscription::pluck('name','id')->toArray();
        $breakfasts=Meal::where('type','breakfast')->get();
        $lunches=Meal::where('type','lunch')->get();
        $dinners=Meal::where('type','dinner')->get();
        return view('admin.clients.create',compact('measurements','subscriptions','breakfasts','lunches','dinners'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requests=$request->all();
//        $components= collect($requests['visits_date'])->zip(collect($requests['measurement']));

        $client=Client::create($request->all());
//        foreach($requests['measurement'] as $key=>$measurements){
//            foreach ($measurements as $key2=>$measurement) {
//                VisitMeasurement::create([
//                    'client_id' => $client->id,
//                    'date' => $requests['visits_date'][$key2],
//                    'measurement_id' => $key,
//                    'value' => $measurement,
//
//                ]);
//            }
//        }

        return back()->with('success', 'تم اضافه الزياره بنجاخ ');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        $visits=Visit::where('client_id',$client->id)->get();
        $measurements=Measurement::all();
        $subscriptions=ClientSubscriptions::where('client_id',$client->id)->get();
        return view('admin.clients.show', compact('client','visits','measurements','subscriptions'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        $measurements=Measurement::all();
//        $visits=VisitMeasurement::where('client_id',$client->id)->get();

        return view('admin.clients.edit', compact('client','measurements'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Client::find($id)->delete();
        return redirect()->route('dashboard.clients.index')->with('success', __('تم الحذف بنجاح'));

    }

}
