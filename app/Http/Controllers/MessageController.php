<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Requests\StoreMessage;

use App\Contact;
use App\Message;

class MessageController extends Controller
{
    private $message;

    public function __construct(Message $message) {
        $this->message = $message;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $message = $this->message->paginate(10);
        return compact('message');
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
    public function store(StoreMessage $request)
    {
        try{
            $validated = $request->validated();

            $data = $request->all();
            //Criando Mensagem usando Mass Assignment
            $message = $this->message->create($data);

            return response()->json($message);

        } catch(\Exception $e) {
            if(env('APP_DEBUG')) {
                return response()->json($e->getMessage());
            }
            return response()->json('Mensagem não foi criada com sucesso!');
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
            $message = $this->message->findOrFail($id);
            return compact('message');
        } catch(\Exception $e) {
            if(env('APP_DEBUG')) {
                return response()->json($e->getMessage());
            }
            return response()->json('Mensagem não encontrado...');
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
     
            $message = $this->message->findOrFail($id);
            $message->update($data);
            return response()->json($data);
            
        } catch(\Exception $e) {
            if(env('APP_DEBUG')) {
                return response()->json($e->getMessage());
            }
            return response()->json('Mensagem não foi atualizado...');
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

            $message = $this->message->findOrFail($id);
            $message->delete();

            return response()->json('Mensagem removido com sucesso!');

        } catch(\Exception $e) {
            if(env('APP_DEBUG')) {
                return response()->json($e->getMessage());
            }
            return response()->json('Mensagem não pode ser removido...');
        }
    }

    public function showFilterContactMessage($contacts_id)
    {
        try{
            $message = $this->message->findOrFail($contacts_id);
            return compact('message');
        } catch(\Exception $e) {
            if(env('APP_DEBUG')) {
                return response()->json($e->getMessage());
            }
            return response()->json('Mensagem não encontrado...');
        }
    }
}
