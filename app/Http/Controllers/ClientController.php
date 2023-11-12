<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $company = auth()->user()->companies()->first();

        $heading = ['Id', 'Client', 'Actions'];
        $clients = $company->clients->map(function ($client){
            return [
                $client->id,
                $client->name,
                '<a dt-action="delete" dt-id="' . $client->id . '" class="flex-shrink-0 cursor-pointer text-red-500" aria-hidden="true">Delete</a>'
            ];
        });;

        return view('clients.index')
            ->with('heading', $heading)
            ->with('clients', $clients);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'company_id' => ['required', 'numeric', 'exists:App\\Models\\Company,id'],
        ]);

        Client::create([
            'name' => $request->name,
            'company_id' => $request->company_id
        ]);

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return response()->json();
    }
}
