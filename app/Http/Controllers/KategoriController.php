<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Http\Requests\KategoriRequest;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Kategori::all();
        $model = new Kategori;
        return view('Kategori.index', compact(
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
        $model = new Kategori;
        //karena induk kategori akan mengarah ke tabel kategori itu sendiri
        //maka kita akan memanggil semua data kategori
        $list_kategori = Kategori::all(); //select & barang
        return view('kategori.create', compact(
            'model', 'list_kategori'
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
        $model = new Kategori;
        $model->nama = $request->get('nama');
        $model->deskripsi = $request->get('deskripsi');
        $model->induk_kategori = $request->get('induk_kategori');
        $model->created_by = 1;
        $model->updated_by = 1;
        
        $model->save();

        return redirect('kategori');
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
        $model = Kategori::find($id);
        $list_kategori = Kategori::all();
        return view('kategori.edit', compact(
            'model', 'list_kategori'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KategoriRequest $request, $id)
    {
        $model = Kategori::find($id);
        $model->nama = $request->get('nama');
        $model->deskripsi = $request->get('deskripsi');
        $model->induk_kategori = $request->get('induk_kategori');
        $model->updated_by = 1;
        $model->save();
        return redirect('kategori');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Kategori::find($id);
        $model->delete();
        return redirect("kategori");
    }
}
