<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

use App\Http\Requests;

class ApplicationController extends Controller
{
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $this->validate($request,Application::$rules);
        $application=new Application();
        $application->name=$request->input('name');
        $application->driver=$request->input('driver');
        $application->schema="public";
        $application->database=$request->input('database');
        $application->host=$request->input('host');
        $application->port=$request->input('port');
        $application->username=$request->input('username');
        $application->password=$request->input('password');
        $application->date_created="2016-05-16";
        $application->user_id=1;
        $application->save();
        return response()->json($application);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
