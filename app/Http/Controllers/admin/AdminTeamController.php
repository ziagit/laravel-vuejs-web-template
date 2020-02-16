<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Team;

class AdminTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Team::all();
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
            'position' => 'required',
            'image' => 'required | image',
            'details' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/monkey'), $image_name);
        } else {
            $image_name = "no image available";
        }

        $team = new Team();
        $team->name = $request->name;
        $team->position = $request->position;
        $team->details = $request->details;
        $team->image = $image_name;
        $team->company_id = 1;

        $team->save();
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
            'position' => 'required',
            'details' => 'required'
        ]);
        if($team = Team::find($request->id)){
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/monkey'), $image_name);
                $old_image_path = public_path('images/monkey/'.$team->image);
                if(file_exists($old_image_path)){
                    @unlink($old_image_path);
                }
            } else {
                $image_name = $team->image;
            }

            $team->name = $request->name;
            $team->position = $request->position;
            $team->details = $request->details;
            $team->image = $image_name;
            $team->save();
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
        if($team = Team::find($id)){
            $team->delete();
            $image_path = public_path('images/monkey/'.$team->image);
            if(file_exists($image_path)){
                @unlink($image_path);
            }
            return response()->json(["message"=>"Deleted Successfully."]);
        }
        return response()->json(["message"=>"Data Not Found!"]);
    }
}
