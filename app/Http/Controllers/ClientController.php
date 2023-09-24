<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::paginate(5);
        return view('client.index')
                    ->with('clients',$clients);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('client.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|max:20',
                'due' => 'required|gte:1', // Great Than or Equal gte
            ]
        );

        $client = Client::create($request->only('name', 'due', 'comments')); //por seguridad se asignan los parametros a pasar

        Session::flash('mensaje', 'Registro Creado con exito!');
        return redirect()->route('client.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return view('client.form')
                    ->with('client',$client);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $request->validate(
            [
                'name' => 'required|max:20',
                'due' => 'required|gte:1',
            ]
        );
        $client->name = $request['name'];
        $client->due = $request['due'];
        $client->comments = $request['comments'];
        $client->save();
        Session::flash('mensaje', 'Registro Editado con exito!');
        return redirect()->route('client.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();
        Session::flash('mensaje', 'Registro Eliminado con exito!');
        return redirect()->route('client.index');
    }
}
