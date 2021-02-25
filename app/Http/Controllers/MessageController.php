<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Http\Requests\MessageRequest;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Message::all();
        $model = new Message;
        return view('message.index', compact(
            'datas', 'model'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Message;
        return view('message.create', compact(
            'model'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = new Message;
        $model->id_customer = $request->get('id_customer');
        $model->isi_pesan = $request->get('isi_pesan');
        $model->tanggal_waktu = date('Y-m-d G:i:s');
        $model->id_chat_previous = $request->get('id_chat_previous');
        
        if(auth()->user()->hasRole('superadmin')){
            $model->chat_status = 3;
        }
        else{
            $model->chat_status = $request->get('chat_status');
        }

        $model->created_by =  Auth::id();
        $model->updated_by =  Auth::id();
        
        $model->save();

        return redirect('message');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Message::find($id);
        return view('message.edit', compact(
            'model'
        ));
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
        $model = Message::find($id);
        $model->id_customer = $request->get('id_customer');
        $model->isi_pesan = $request->get('isi_pesan');
        $model->id_chat_previous = $request->get('id_chat_previous');
        $model->chat_status = $request->get('chat_status');
        $model->updated_by =  Auth::id();
        
        $model->save();

        return redirect('message');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $model = Message::find($id);
        $model->delete();
        return redirect("message");
    }
}
