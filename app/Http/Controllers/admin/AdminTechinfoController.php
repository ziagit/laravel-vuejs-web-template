<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Techinfo;
use App\Tech;
class AdminTechinfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return [
            "techs"=>Tech::all('id','name'), 
            "techinfos"=>Techinfo::with('techs')->get()
        ];
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
            'date' => 'required',
            'users' => 'required',
            'tech' => 'required'
        ]);

        $info = new Techinfo();
        $info->date = $request->date;
        $info->users = $request->users;

        $info->save();
        $info->techs()->attach(Tech::where('name', $request->tech)->first());

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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($tech = Techinfo::find($id)){
            $tech->delete();
            return response()->json(["message"=>"Deleted Successfully."]);
        }
        return response()->json(["message"=>"Data Not Found!"]);
    }
}
