<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Project;

class AdminProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Project::all();
        
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
            'title' => 'required',
            'subtitle' => 'required',
            'body' => 'required',
            'image' => 'required | image',
        ]);
        $convertedTitle = strtolower($request->title);
        $convertedTitle = preg_replace('/\s+/', '-', $convertedTitle);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/monkey'), $image_name);
        } else {
            $image_name = "no image available";
        }

        $project = new Project();
        $project->title = $request->title;
        $project->subtitle = $request->subtitle;
        $project->body = $request->body;
        $project->image = $image_name;
        $post->slug = $convertedTitle;

        $project->save();
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
            'title' => 'required',
            'subtitle' => 'required',
            'body' => 'required'
        ]);
        if($project = Project::find($request->id)){
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/monkey'), $image_name);
                $old_image_path = public_path('images/monkey/'.$project->image);
                if(file_exists($old_image_path)){
                    @unlink($old_image_path);
                }
            } else {
                $image_name = $project->image;
            }

            $project->title = $request->title;
            $project->subtitle = $request->subtitle;
            $project->body = $request->body;
            $project->image = $image_name;
            $project->save();
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
        if($project = Project::find($id)){
            $project->delete();

            $image_path = public_path('images/monkey/'.$project->image);
            if(file_exists($image_path)){
                @unlink($image_path);
            }
            return response()->json(["message"=>"Deleted Successfully."]);
        }
        return response()->json(["message"=>"Data Not Found!"]);

    }
}
