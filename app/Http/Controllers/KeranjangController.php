<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Barang;
use App\Http\Requests\KeranjangRequest;

class KeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Keranjang::all();
        $model = new Keranjang;
        return view('keranjang.index', compact(
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
        $model = new Keranjang;
        $list_barang = Barang::all(); //select & barang
        return view('keranjang.create', compact(
            'model', 'list_barang'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KeranjangRequest $request)
    {
        $model = new Keranjang;
        $model->id_barang = $request->get('id_barang');
        $model->jumlah_pesanan = $request->get('jumlah_pesanan');

        $barang = Barang::find($model->id_barang);
        $total_harga = $barang->harga * $model->jumlah_pesanan;
        $model->jumlah_harga = $total_harga;

        $model->id_customer = $request->get('id_customer');
        $model->created_by = 1;
        $model->updated_by = 1;
        
        $model->save();

        return redirect('keranjang');
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
        $model = Keranjang::find($id);
        $list_barang = Barang::all(); //select & barang
        return view('keranjang.edit', compact(
            'model', 'list_barang'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KeranjangRequest $request, $id)
    {
        $model = Keranjang::find($id);
        $model->id_barang = $request->get('id_barang');
        $model->jumlah_pesanan = $request->get('jumlah_pesanan');

        $barang = Barang::find($model->id_barang);
        $total_harga = $barang->harga * $model->jumlah_pesanan;
        $model->jumlah_harga = $total_harga;

        $model->id_customer = $request->get('id_customer');
        $model->updated_by = 1;
        
        $model->save();

        return redirect('keranjang');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Keranjang::find($id);
        $model->delete();
        return redirect("keranjang");
    }
}
