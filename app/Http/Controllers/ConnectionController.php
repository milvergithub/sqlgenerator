<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Response;
use App\Http\ResponseManager\ResponseManager;
use App\Http\Requests;

class ConnectionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function test(Request $request)
    {
        config([
            'database.connections.external.database' => $request->input('database'),
            'database.connections.external.driver' => $request->input('driver'),
            'database.connections.external.host' => $request->input('host'),
            'database.connections.external.username' => $request->input('username'),
            'database.connections.external.password' => $request->input('password')
        ]);
        $connection = config('database.connections.external');
        if (DB::connection('external')->getDatabaseName()) {
//            return response()->json($connection);
            return Response::json(ResponseManager::makeResult($connection, "Consultas retrieved successfully."));
        }else{
            return "fail";
        }
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
