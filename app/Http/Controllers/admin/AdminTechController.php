<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tech;
use App\Year;
use App\Nouser;

class AdminTechController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Tech::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'details' => 'required',
            'brand' => 'required',
            'logo' => 'required | image'
        ]);
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logo_name = rand() . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('images/monkey'), $logo_name);
        }else{
            $logo_name = 'no logo provided';
        }

        $tech = new Tech();
        $tech->name = $request->name;
        $tech->brand = $request->brand;
        $tech->details = $request->details;
        $tech->logo = $logo_name;

        $tech->save();
  
        return response()->json(["message"=>"Saved Successfully."]);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'details' => 'required',
            'brand' => 'required'
        ]);
        if($tech = Tech::find($request->id)){
            if ($request->hasFile('logo')) {
                $logo = $request->file('logo');
                $logo_name = rand() . '.' . $logo->getClientOriginalExtension();
                $logo->move(public_path('images/monkey'), $logo_name);
                $old_logo_path = public_path('images/monkey/'.$tech->logo);
                if(file_exists($old_logo_path)){
                    @unlink($old_logo_path);
                }
            } else {
                $logo_name = $tech->logo;
            }

            $tech->name = $request->name;
            $tech->brand = $request->brand;
            $tech->details = $request->details;
            $tech->logo = $logo_name;
            $tech->save();
            return response()->json(["message"=>"Updated Successfully."]);
        }
        return response()->json(["message"=>"Data Not Found!"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($tech = Tech::find($id)){
            $tech->delete();

            $logo_path = public_path('images/monkey/'.$tech->logo);
            if(file_exists($logo_path)){
                @unlink($logo_path);
            }
            return response()->json(["message"=>"Deleted Successfully."]);
        }
        return response()->json(["message"=>"Data Not Found!"]);
    }
}
