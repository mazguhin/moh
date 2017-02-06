<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use Auth;

class ClientController extends Controller
{
    // form for create client
    public function create (Request $data) {
        if (empty($data['organization']))
            return redirect('/client/show');

        return view ('client.create', [
            'ranks' => \App\Organization::findOrFail($data['organization'])->ranks
        ]);
    }

    public function store (Request $data) {
        $this->validate($data, [
            'name' => 'required|max:255',
            'rank' => 'required|max:255',
            'drugAddiction' => 'required|max:255',
            'description' => 'max:255',
            'countSession' => 'required|max:255',
            'hepatitisB' => 'required|max:255',
            'hepatitisC' => 'required|max:255',
            'HIV' => 'required|max:255',
            'staphylococcus' => 'required|max:255',
            'allergies' => 'required|max:255',
            'vision' => 'required|max:255',
        ],[
            'name.unique' => 'Такой клиент уже существует'
        ]);

        if (Client::where('name',$data['name'])->count()>0)
            return redirect('/client/show')->with(['msg'=>'Клиент '.$data['name'].' уже существует']);

        $client = new Client();
        $client->name = $data['name'];
        $client->rank_id = $data['rank'];
        $client->drugAddiction = $data['drugAddiction'];
        $client->description = $data['description'];
        $client->countSession = $data['countSession'];
        $client->hepatitisB = $data['hepatitisB'];
        $client->hepatitisC = $data['hepatitisC'];
        $client->HIV = $data['HIV'];
        $client->staphylococcus = $data['staphylococcus'];
        $client->allergies = $data['allergies'];
        $client->vision = $data['vision'];
        $client->user_id = Auth::user()->id;
        $client->save();

        Auth::user()->logs()->create([
            'name' => 'addClient',
            'description' => 'Добавлен новый клиент ['.$client->name.']'
            ]);

        return redirect('/client/show')->with(['msg'=>'Клиент '.$client->name.' успешно добавлен']);
    }

    public function edit($client_id)
    {
        return view ('client.edit',[
            'client' => Client::findOrFail($client_id),
            'ranks' => \App\Rank::with('organization')->get()
        ]);
    }

    public function save (Request $data, $client_id) {
            $this->validate($data, [
            'rank' => 'required|max:255',
            'drugAddiction' => 'required|max:255',
            'description' => 'max:255',
            'countSession' => 'required|max:255',
            'hepatitisB' => 'required|max:255',
            'hepatitisC' => 'required|max:255',
            'HIV' => 'required|max:255',
            'staphylococcus' => 'required|max:255',
            'allergies' => 'required|max:255',
            'vision' => 'required|max:255',
        ],[
            
        ]);

        $client = Client::findOrFail($client_id);
        $client->rank_id = $data['rank'];
        $client->drugAddiction = $data['drugAddiction'];
        $client->description = $data['description'];
        $client->countSession = $data['countSession'];
        $client->hepatitisB = $data['hepatitisB'];
        $client->hepatitisC = $data['hepatitisC'];
        $client->HIV = $data['HIV'];
        $client->staphylococcus = $data['staphylococcus'];
        $client->allergies = $data['allergies'];
        $client->vision = $data['vision'];
        $client->user_id = Auth::user()->id;
        $client->save();

        Auth::user()->logs()->create([
            'name' => 'editClient',
            'description' => 'Отредактирован клиент ['.$client->name.']'
            ]);

        return redirect('/client/show')->with(['msg'=>'Клиент '.$client->name.' успешно обновлен']);
    }

    public function show()
    {
        return view('client.show', [
            'clients' => Client::orderBy('created_at','desc')->paginate(15),
            'organizations' => \App\Organization::all(),
            'ranks' => \App\Rank::all(),
        ]);
    }

    public function showProfile($client_id)
    {
        return view('client.showProfile', [
            'client' => Client::findOrFail($client_id)
        ]);
    }

    public function search(Request $data)
    {
         $this->validate($data, [
            'name' => 'required|max:255',
        ],[
            
        ]);

        $client = Client::where('name',$data['name'])->first();

        if ($client!=null) {
            return redirect('/client/show/'.$client->id);
        } else {
            return redirect()->back()->with(['msg'=>'Клиент не найден']);
        }
    }

    public function delete($client_id)
    {
        $client = Client::findOrFail($client_id);
        $client->delete();

        Auth::user()->logs()->create([
            'name' => 'deleteClient',
            'description' => 'Удален клиент ['.$client->name.']'
            ]);

        return redirect('/client/show')->with(['msg'=>'Клиент успешно удален']);
    }
}
