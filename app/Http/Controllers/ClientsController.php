<?php

namespace App\Http\Controllers;

use DB;
use App\Client;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function postClient(Request $request) 
    {
    	$client = new Client();

    	$client->firstname = $request->input('firstname');
    	$client->lastname = $request->input('lastname');
    	$client->address = $request->input('address');

    	$client->save();

    	return response()->json(['client' => $client], 201);
    }
    
    public function getClients() 
    {
        $clients = Client::all();

        return response()->json(['clients' => $clients], 200);
    }
    
    public function findClient($id) 
    {
        $client = Client::find($id);

        if (!$client) return response()->json(['message' => 'Client not found'], 404);

        return response()->json(['client' => $client], 200);
    }
    
    public function filterClients(Request $request) 
    {
        $input = $request->input('terms');

        if (!$input) return response()->json(['clients' => Client::all()], 200);

        $terms = explode(" ", $input);

        $clients = DB::table('clients');

        foreach ($terms as $key => $term) {
            $clients->where(function ($query) use ($term) {
                $query->where('firstname', 'like', '%' . $term . '%')
                        ->orWhere('lastname', 'like', '%' . $term . '%')
                        ->orWhere('address', 'like', '%' . $term . '%');
            });
        }

        return response()->json(['clients' => $clients->get()], 200);
    }
    
    public function putClient(Request $request, $id) 
    {
    	$client = Client::find($id);

    	if (!$client) return response()->json(['message' => 'Client not found'], 404);

    	$client->firstname = $request->input('firstname');
    	$client->lastname = $request->input('lastname');
    	$client->address = $request->input('address');

    	$client->save();

    	return response()->json(['client' => $client], 200);
    }
    
    public function deleteClient($id) 
    {
    	$client = Client::find($id);

    	if (!$client) return response()->json(['message' => 'Client not found'], 404);

    	$client->delete();

    	return response()->json(['message' => 'Client deleted'], 200);
    }
}
