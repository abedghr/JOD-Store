<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use App\Models\Related;
use Illuminate\Http\Request;

class RelatedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function create()
    {
        $all_related = Related::select()->paginate(10);
        $providers = Provider::all();
        return view("Admin.manage_related",[
            'all_related' =>$all_related,
            'providers'=>$providers
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
            'name'=>'required|unique:related,name',
            'provider'=>'required'
        ]);

        Related::create([
            'name'=>$request->input('name'),
            'provider_id'=>$request->input('provider')
        ]);
        
        return redirect()->route('related.create');
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
        $single_related = Related::find($id);
        $providers = Provider::all();
        return view('Admin.edit_related',[
            'related'=>$single_related,
            'providers'=>$providers
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
        $related = Related::find($id);
        if($request->input('name') != $related->name){
            dd();
            $valid = $request->validate([
                'name'=>'required|unique:related,name',
                'provider'=>'required'
            ]);
        }else{
            $valid = $request->validate([
                'provider'=>'required'
            ]);
        }

        Related::where('id',$id)->update([
            'name'=>$request->input('name'),
            'provider_id'=>$request->input('provider')
        ]);
        
        return redirect()->route('related.create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Related::where('id',$id)->delete();
        return redirect()->route('related.create');
    }
}
