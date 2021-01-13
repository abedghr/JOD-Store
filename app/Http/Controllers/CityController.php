<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::select()->orderBy('id','desc')->paginate(10);
        return view('Admin.manage_delivery',[
            'cities'=>$cities
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valid = $request->validate([
            'city_name'=>'required|string|unique:cities,city',
            'delivery_price'=>'required|numeric'
        ]);

        City::create([
            'city'=>$request->city_name,
            'delivery_price'=>$request->delivery_price
        ]);

        return redirect()->route('delivery.price');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $city = City::findorFail($id);
        return view('Admin.edit_delivery',[
            'city'=>$city
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $valid = $request->validate([
            'city_name'=>'required|string',
            'delivery_price'=>'required|numeric'
        ]);

        City::where('id',$id)->update([
            'city'=>$request->city_name,
            'delivery_price'=>$request->delivery_price
        ]);

        return redirect()->route('delivery.edit',['id'=>$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        City::where('id',$id)->delete();
        return redirect()->route('delivery.price');
    }
}
