<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penerbangan;
use App\Models\Bandara;

class PenerbanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = new Penerbangan;
        $datas = Penerbangan::all();
        return view('penerbangan.index', compact(
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
        $model = new Penerbangan;
        $list_bandara = Bandara::all(); //SELECT * FROM bandara
        return view('penerbangan.create', compact(
            'model', 'list_bandara'
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
        $model = new Penerbangan;
        $model->pesawat = $request->get('pesawat');
        $model->bandara_dari = $request->get('bandara_dari');
        $model->bandara_tujuan = $request->get('bandara_tujuan');
        $model->status_penerbangan = $request->get('status_penerbangan');
        $model->waktu_penerbangan = $request->get('tanggal_penerbangan').' '.$request->get('jam_penerbangan');
        $model->created_by = 1;
        $model->updated_by = 1;
        $model->save();

        return redirect('penerbangan');
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
        $model = Penerbangan::find($id);
        $list_bandara = Bandara::all(); //SELECT * FROM bandara
        return view('penerbangan.edit', compact(
            'model', 'list_bandara'
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
        $model = Penerbangan::find($id);
        $model->pesawat = $request->get('pesawat');
        $model->bandara_dari = $request->get('bandara_dari');
        $model->bandara_tujuan = $request->get('bandara_tujuan');
        $model->status_penerbangan = $request->get('status_penerbangan');
        $model->waktu_penerbangan = $request->get('tanggal_penerbangan').' '.$request->get('jam_penerbangan');
        $model->updated_by = 1;
        $model->save();

        return redirect('penerbangan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Penerbangan::find($id);
        $model->delete();
        return redirect("penerbangan");
    }
}
