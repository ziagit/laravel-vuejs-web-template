<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Company;

class AdminCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Company::all();
        
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
            'slogan' => 'required',
            'logo' => 'required | image',
            'slide' => 'required | image',
        ]);
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logo_name = rand() . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('images/monkey'), $logo_name);
        } else {
            $logo_name = "no logo available";
        }
        if ($request->hasFile('slide')) {
            $slide = $request->file('slide');
            $slide_name = rand() . '.' . $slide->getClientOriginalExtension();
            $slide->move(public_path('images/monkey'), $slide_name);
        } else {
            $slide_name = "no slide available";
        }

        $company = new Company();

        $company->name = $request->name;
        $company->details = $request->details;
        $company->slogan = $request->slogan;
        $company->logo = $logo_name;
        $company->slide = $slide_name;

        $company->save();
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
            'details' => 'required',
            'slogan' => 'required'
        ]);
        if($company = Company::find($request->id)){
            if ($request->hasFile('logo')) {
                $logo = $request->file('logo');
                $logo_name = rand() . '.' . $logo->getClientOriginalExtension();
                $logo->move(public_path('images/monkey'), $logo_name);
                $old_logo_path = public_path('images/monkey/'.$company->logo);
                if(file_exists($old_logo_path)){
                    @unlink($old_logo_path);
                }
            } else {
                $logo_name = $company->logo;
            }
            if ($request->hasFile('slide')) {
                $slide = $request->file('slide');
                $slide_name = rand() . '.' . $slide->getClientOriginalExtension();
                $slide->move(public_path('images/monkey'), $slide_name);
                $old_slide_path = public_path('images/monkey/'.$company->slide);
                if(file_exists($old_slide_path)){
                    @unlink($old_slide_path);
                }
            } else {
                $slide_name = $company->slide;
            }
            $company->name = $request->name;
            $company->details = $request->details;
            $company->slogan = $request->slogan;
            $company->logo = $logo_name;
            $company->slide = $slide_name;
            $company->save();
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
        if($company = Company::find($id)){
            $company->delete();

            $logo_path = public_path('images/monkey/'.$company->logo);
            if(file_exists($logo_path)){
                @unlink($logo_path);
            }
            $slide_path = public_path('images/monkey/'.$company->slide);
            if(file_exists($slide_path)){
                @unlink($slide_path);
            }
            return response()->json(["message"=>"Deleted Successfully."]);
        }
        return response()->json(["message"=>"Data Not Found!"]);

    }
}
