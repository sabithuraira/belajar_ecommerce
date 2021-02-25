<?php

namespace App\Http\Controllers;

use App\Models\Bandara;

use Illuminate\Http\Request;
use App\Http\Requests\BandaraRequest;
use Illuminate\Support\Facades\Auth;

class BandaraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = new Bandara;
        $datas = Bandara::all();
        return view('bandara.index', compact(
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
        $model = new Bandara;
        return view('bandara.create', compact('model'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BandaraRequest $request)
    {
        $model = new Bandara;
        $model->kode_bandara = $request->get('kode_bandara');
        $model->nama_bandara = $request->get('nama_bandara');
        $model->alamat_bandara = $request->get('alamat_bandara');
        $model->created_by =  Auth::id();
        $model->updated_by =  Auth::id();
        $model->save();

        return redirect('bandara');
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
        $model = Bandara::find($id);
        return view('bandara.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BandaraRequest $request, $id)
    {
        $model = Bandara::find($id);
        $model->kode_bandara = $request->get('kode_bandara');
        $model->nama_bandara = $request->get('nama_bandara');
        $model->alamat_bandara = $request->get('alamat_bandara');
        $model->updated_by =  Auth::id();
        $model->save();

        return redirect('bandara');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Bandara::find($id);
        $model->delete();
        return redirect("bandara");
    }
}
