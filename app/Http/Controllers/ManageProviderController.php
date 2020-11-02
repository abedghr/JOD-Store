<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Notification;

class ManageProviderController extends Controller
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
    public function create(){
        $providers = Provider::select()->orderBy('id','desc')->paginate(5);
        return view('Admin.manage_provider',[
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
            'prov_name'=>'required|string',
            'email'=>'required|email|unique:providers',
            'password'=>'required|min:8',
            'phone1'=>'required'
        ]);

        if($request->hasFile('image')){
            $fileImage = time() . '.' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/Provider_images',$fileImage);
            
            if($request->hasFile('cover_image')){
                $coverImage = time(). '.' . $request->file('cover_image')->getClientOriginalName();
                $request->file('cover_image')->storeAs('public/Provider_coverImages',$coverImage);
            }else{
                $coverImage='default_cover.jpg';
            }
            $provider = Provider::create([
                'name'=>$request->prov_name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
                'phone1'=>$request->phone1,
                'phone2'=>$request->phone2,
                'image'=>$fileImage,
                'cover_image'=>$coverImage,
                'description'=>$request->description
            ]);

            return redirect()->route('manage_provider.create');
        }else{
            if($request->hasFile('cover_image')){
                $coverImage = time(). '.' . $request->file('cover_image')->getClientOriginalName();
                $request->file('cover_image')->storeAs('public/Provider_coverImages',$coverImage);
            }else{
                $coverImage='default_cover.jpg';
            }
            $provider = Provider::create([
                'name'=>$request->prov_name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
                'phone1'=>$request->phone1,
                'phone2'=>$request->phone2,
                'cover_image'=>$coverImage,
                'description'=>$request->description
            ]);
            return redirect()->route('manage_provider.create');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $provider = Provider::find($id);
        return view('Admin.show_provider',[
            'provider'=>$provider
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $provider = Provider::find($id);
        return view('Admin.edit_provider',[
            'provider'=>$provider
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
            'prov_name'=>'required|string',
            'email'=>'required|email',
            'phone1'=>'required'
        ]);

        if($request->hasFile('image')){
            $fileImage = time() . '.' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/Provider_images',$fileImage);
            
            if($request->hasFile('cover_image')){
                $coverImage = time(). '.' . $request->file('cover_image')->getClientOriginalName();
                $request->file('cover_image')->storeAs('public/Provider_coverImages',$coverImage);
                $provider = Provider::where('id',$id)->update([
                    'name'=>$request->prov_name,
                    'email'=>$request->email,
                    'password'=>Hash::make($request->password),
                    'phone1'=>$request->phone1,
                    'phone2'=>$request->phone2,
                    'image'=>$fileImage,
                    'cover_image'=>$coverImage,
                    'description'=>$request->description
                ]);
            }else{
                $provider = Provider::where('id',$id)->update([
                    'name'=>$request->prov_name,
                    'email'=>$request->email,
                    'password'=>Hash::make($request->password),
                    'phone1'=>$request->phone1,
                    'phone2'=>$request->phone2,
                    'image'=>$fileImage,
                    'description'=>$request->description
                ]);
            }

            return redirect()->route('manage_provider.create');
        }else{
            if($request->hasFile('cover_image')){
                $coverImage = time(). '.' . $request->file('cover_image')->getClientOriginalName();
                $request->file('cover_image')->storeAs('public/Provider_coverImages',$coverImage);
                $provider = Provider::where('id',$id)->update([
                    'name'=>$request->prov_name,
                    'email'=>$request->email,
                    'password'=>Hash::make($request->password),
                    'phone1'=>$request->phone1,
                    'phone2'=>$request->phone2,
                    'cover_image'=>$coverImage,
                    'description'=>$request->description
                ]);
            }else{
                $provider = Provider::where('id',$id)->update([
                    'name'=>$request->prov_name,
                    'email'=>$request->email,
                    'password'=>Hash::make($request->password),
                    'phone1'=>$request->phone1,
                    'phone2'=>$request->phone2,
                    'description'=>$request->description
                ]);
            }
            return redirect()->route('manage_provider.create');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Provider::where('id',$id)->delete();
        Notification::where('data->provider',$id)->delete();
        return redirect(url()->previous());
    }
}
