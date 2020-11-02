<?php

namespace App\Http\Controllers;

use App\Models\Related;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProviderRelatedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:provider');
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
        $all_related = Related::where('provider_id',Auth::user()->id)->select()->paginate(10);
        return view("Provider_views.manage_related",[
            'all_related' =>$all_related
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
            'name'=>'required|unique:related,name'
        ]);

        Related::create([
            'name'=>$request->input('name'),
            'provider_id'=>Auth::user()->id
        ]);
        
        return redirect()->route('related_provider.create');
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
        return view('Provider_views.edit_related',[
            'related'=>$single_related
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
            'name'=>'required|unique:related,name'
        ]);

        Related::where('id',$id)->update([
            'name'=>$request->input('name'),
            'provider_id'=>Auth::user()->id
        ]);
        
        return redirect()->route('related_provider.create');
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
        return redirect()->route('related_provider.create');
    }
}
