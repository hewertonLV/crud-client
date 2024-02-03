<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClientController extends Controller
{
    public function __construct(
        protected Client $client
    )
    {
    }

    public function dashboard(Request $request)
    {
        $clients = count(Client::withTrashed()->get());
        $clientsActive = Client::all();
        $clientsInactive = $clients-count($clientsActive);
        $data['amountClient']=[count($clientsActive),$clientsInactive];
        $data['status']=['Ativos','Inativos'];
        $data['total']=$clients;
        return view('pages.dashboard')->with(['data'=>$data]);
    }

    public function index()
    {
        $clients = Client::all();
        return view('pages.index')->with(['clients' => $clients ?? []]);
    }

    public function create()
    {
        return view('pages.create');
    }

    public function store(Request $request)
    {
        try {
            if ($request->cpf) {
                $request['cpf'] = Client::formatCpf($request->cpf);
            }
            $request->validate(Client::$rules);
            $this->client->fill($request->input());
            if ($this->client->save()) {
                toastr()->success('Cliente adicionada com sucesso.', 'Operação Realizada');
                return redirect()->route('clients');
            } else {
                toastr()->error('Cliente já cadastrado.', 'Operação Falhou');
                return redirect()->route('createClients')->withInput();
            }
        } catch (\Exception $e) {
            $mensagemErro = $e->getMessage();
            toastr()->info("Verifique os dados informados: $mensagemErro", 'Operação Falhou');
            return redirect()->route('createClients')->withInput();
        }
    }

    public function edit(Client $client)
    {
        return view('pages.edit')->with(['client' => $client]);
    }

    public function update(Request $request, Client $client)
    {
        try {

            if ($request->cpf) {
                $request['cpf'] = Client::formatCpf($request->cpf);
            }

            $uniqueRule = Rule::unique('clients')->ignore($client->id);

            $client->update($request->all());
            toastr()->success('Cliente atualizado.', 'Operação Realizada');
            return redirect()->route('clients');
        } catch (\Exception $e) {
            toastr()->error("E-mail ou CPF já possui cadastro", 'Operação Falhou');
            return back()->withInput();
        }
    }

    public function destroy(Client $client)
    {
        try {
            if ($client->delete()) {
                toastr()->success('Cliente excluido.', 'Operação realizada');
                return redirect()->route('clients');
            } else {
                toastr()->error('Cliente não encontrado.', 'Operação Falhou');
                return redirect()->route('clients');
            }

        } catch (\Exception $e) {
            $mensagemErro = $e->getMessage();
            toastr()->error("$mensagemErro", 'Operação Falhou');
            return redirect()->route('clients');
        }
    }

}
