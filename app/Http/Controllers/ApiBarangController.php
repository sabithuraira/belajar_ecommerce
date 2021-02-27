<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class ApiBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Barang::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model= new Barang;
        $model->kode_barang =$request->get('kode_barang');
        $model->nama =$request->get('nama');
        $model->harga =$request->get('harga');
        $model->deskripsi =$request->get('deskripsi');
        $model->jumlah =$request->get('jumlah');
        $model->created_by = 1;
        $model->updated_by = 1;
        $model->save();
        
        return "sukses";
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model= Barang::find($id);
        $model->kode_barang =$request->get('kode_barang');
        $model->nama =$request->get('nama');
        $model->harga =$request->get('harga');
        $model->deskripsi =$request->get('deskripsi');
        $model->jumlah =$request->get('jumlah');
        $model->updated_by = 1;
        $model->save();
        
        return "sukses";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Barang::find($id);
        $model->delete();
        return "sukses menghapus";
    }
}
