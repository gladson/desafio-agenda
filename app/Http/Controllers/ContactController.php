<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Requests\StoreContact;

use App\Contact;

class ContactController extends Controller
{
    private $contact;

    public function __construct(Contact $contact) {
        $this->contact = $contact;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contact = $this->contact->paginate(10);
        return compact('contact');
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
    public function store(StoreContact $request)
    {
        try{
            $validated = $request->validated();
            
            $data = $request->all();

            // Criando Contato usando Active Record
            // $contact = $this->contact;
            // $contact->nome = $data['nome'];
            // $contact->sobrenome = $data['sobrenome'];
            // $contact->email = $data['email'];
            // $contact->telefone = $data['telefone'];

            // $contact->save();
            //Criando Contato usando Mass Assignment
            $contact = $this->contact->create($data);

            return response()->json($contact);

        } catch(\Exception $e) {
            if(env('APP_DEBUG')) {
                return response()->json($e->getMessage());
            }
            return response()->json('Contato não foi criada com sucesso!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $contact = $this->contact->findOrFail($id);
            return compact('contact');
        } catch(\Exception $e) {
            if(env('APP_DEBUG')) {
                return response()->json($e->getMessage());
            }
            return response()->json('Contato não encontrado...');
        }
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
        try{
            $data = $request->all();
     
            $contact = $this->contact->findOrFail($id);
            $contact->update($data);
            return response()->json($data);
            
        } catch(\Exception $e) {
            if(env('APP_DEBUG')) {
                return response()->json($e->getMessage());
            }
            return response()->json('Contato não foi atualizado...');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $contact = $this->contact->findOrFail($id);
            $contact->delete();

            return response()->json('Contato removido com sucesso!');

        } catch(\Exception $e) {
            if(env('APP_DEBUG')) {
                return response()->json($e->getMessage());
            }
            return response()->json('Contato não pode ser removido...');
        }
    }
}
