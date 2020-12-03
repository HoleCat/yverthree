<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
    public function index()
    {
        $user_id = Auth::user()->id;
        $clients = Client::query()->where('clients.user_id','=',$user_id)->get();
        return Inertia::render('Clients/Index',[
            'clients' => $clients
        ]);
    }
    public function create()
    {
        //$clients = Client::with("user")->paginate(2);
        $user_id = Auth::user()->id;
        return Inertia::render('Clients/Create');
    }
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $client = new Client();
        $client->name = $request->name;
        $client->document = $request->document;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->direction = $request->direction;
        $client->adiction = $request->adiction;
        $client->points = 0;
        $client->interactions = 0;
        $client->user_id = $user_id;
        $client->save();

        $clients = Client::query()->where('user_id','=',$user_id)->get();
        return Inertia::render('Clients/Index',[
            'clients' => $clients
        ]);
    }
    public function show(Client $client)
    {
        return Inertia::render('Clients/Preview',[
            'client' => $client
        ]);
    }
    public function edit(Request $request)
    {
        $client = new Client();
        $old_client = new Client();
        $client->id = $request->id;
        $old_client->id = $request->id;
        $client->name = $request->name;
        $old_client->name = $request->name;
        $client->document = $request->document;
        $old_client->document = $request->document;
        $client->email = $request->email;
        $old_client->email = $request->email;
        $client->phone = $request->phone;
        $old_client->phone = $request->phone;
        $client->direction = $request->direction;
        $old_client->direction = $request->direction;
        $client->adiction = $request->adiction;
        $old_client->adiction = $request->adiction;
        $client->points = 0;
        $old_client->points = 0;
        $client->interactions = 0;
        $old_client->interactions = 0;
        $client->old_client = json_encode($old_client);
        $client->action = $request->action;
        return Inertia::render('Clients/Edit',[
            'client_prop' => $client
        ]);
    }
    public function update(Request $request)
    {
        $user_id = Auth::user()->id;
        try {   
            $action = $request->action;
            switch($action){
                case 'EDIT':
                    $client = Client::find($request->id);            
                    $client->name = $request->name;
                    $client->document = $request->document;
                    $client->email = $request->email;
                    $client->phone = $request->phone;
                    $client->direction = $request->direction;
                    $client->adiction = $request->adiction;
                    $client->points = 0;
                    $client->interactions = 0;
                    $client->user_id = $user_id;
                    $client->save();
                    $client->old_client = $request->old_client;
                    
                    return Inertia::render('Clients/Preview',[
                        'client_prop' => $client
                    ]);
                break;
                case 'ACEPT':
                    $clients = Client::query()->where('user_id','=',$user_id)->get();
                    return Inertia::render('Clients/Index',[
                        'clients' => $clients
                    ]);
                break;
                case 'CANCEL':
                    $client = Client::find($request->id);
                    $old_client = json_decode($request->old_client);
                    $client->name = $request->name;
                    $client->document = $request->document;
                    $client->email = $request->email;
                    $client->phone = $request->phone;
                    $client->direction = $request->direction;
                    $client->adiction = $request->adiction;
                    $client->points = 0;
                    $client->interactions = 0;
                    $client->user_id = $user_id;
                    $client->save();
                    $client->action = "EDIT";
                    $client->old_client = $old_client;
                    return Inertia::render('Clients/Edit',[
                        'client_prop' => $client
                    ]);
                break;
            }
        } catch (\Throwable $th) {
            return ["error"=>$th->getMessage(),"trace"=>$th->getTraceAsString()];
        }
    }
    public function destroy(Request $request)
    {
        $user_id = Auth::user()->id;
        try {
            Client::query()->where('id','=',$request->id)->delete();
            $clients = Client::query()->where('user_id','=',$user_id)->get();
            return Inertia::render('Categories/Index',[
                'clients' => $clients
            ]);
        } catch (\Throwable $th) {
            $clients = Client::query()
            ->select('clients.*')
            ->where('clients.user_id','=',$user_id)
            ->get();
            return Inertia::render('Clients/Index',[
                'clients' => $clients
            ]);
        }
    }
}
