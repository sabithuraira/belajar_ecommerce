<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penerbangan;
use App\Models\Bandara;
use App\Models\Penumpang;
use Illuminate\Support\Facades\Auth;

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

    public function tambah_penumpang($id){
        $penerbangan = Penerbangan::find($id);
        $model = new Penumpang;

        return view('penerbangan.tambah_penumpang', compact(
            'penerbangan', 'model'
        ));
    }

    public function store_penumpang(Request $request, $id){
        $model = new Penumpang;
        $model->penerbangan_id = $id;
        $model->nama = $request->get('nama');
        $model->no_ktp = $request->get('no_ktp');
        $model->alamat = $request->get('alamat');
        $model->created_by =  Auth::id();
        $model->updated_by =  Auth::id();
        $model->save();
        
        return redirect('penerbangan');
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
        $model->created_by =  Auth::id();
        $model->updated_by =  Auth::id();
        $model->save();

        return redirect('penerbangan');
    }

    public function create_many()
    {
        $model = new Penerbangan;
        $list_bandara = Bandara::all(); 
        return view('penerbangan.create_many', compact(
            'model', 'list_bandara'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_many(Request $request)
    {
        $model = new Penerbangan;
        $model->pesawat = $request->get('pesawat');
        $model->bandara_dari = $request->get('bandara_dari');
        $model->bandara_tujuan = $request->get('bandara_tujuan');
        $model->status_penerbangan = $request->get('status_penerbangan');
        $model->waktu_penerbangan = $request->get('tanggal_penerbangan').' '.$request->get('jam_penerbangan');
        $model->created_by =  Auth::id();
        $model->updated_by =  Auth::id();

        //jika ingin mengecek nilai yang dihasilkan dari POST atau GET, gunakan code berikut
        // print_r($request->all());die();
        if($model->save()){
            //mengetahui jumlah penumpang yang ada
            $total_penumpang = $request->get('total_penumpang');
            //setelah tahu jumlah penumpang
            //kita melakukan looping sesuai dg jumlah penumpang tersebut
            for($i=1;$i<$total_penumpang;$i++){
                //menyimpan data penumpang baru
                $model_penumpang = new Penumpang;
                $model_penumpang->nama = $request->get('namaau'.$i);
                $model_penumpang->alamat = $request->get('alamatau'.$i);
                $model_penumpang->no_ktp = $request->get('no_ktpau'.$i);
                $model_penumpang->penerbangan_id = $model->id; //diambil dari id model penerbangan yang disimpan sebelumnya
                $model_penumpang->created_by =  Auth::id();
                $model_penumpang->updated_by =  Auth::id();
                $model_penumpang->save();
            }
        }

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
        //pada halaman detail, kita akan menampilkan informasi penerbangan
        //dan daftar penumpang
        $model = Penerbangan::find($id);
        $list_penumpang = Penumpang::where('penerbangan_id','=',$id)->get();

        return view('penerbangan.show', compact(
            'model', 'list_penumpang'
        ));
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
        $model->updated_by =  Auth::id();
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
