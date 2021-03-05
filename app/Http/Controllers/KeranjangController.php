<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Barang;
use App\Models\InvoiceBarang;
use App\Http\Requests\KeranjangRequest;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //daftar keranjang yang ditampilkan adalah
        //yang memiliki status = 1 (dia masih aktif, belum dipindahkan ke pembelian)
        //dan yang memiliki id customer sesuai dengan pengguna yang sedang login
        $datas = Keranjang::where('status', '=', 1)
            ->where('id_customer', '=', Auth::id())
            ->get();
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
        //list_barang dipakai untuk menampilkan 
        //pilihan semua barang pada form
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

        //kita akan memanggil data pada tabel barang
        //sesuai dengan 'id_barang' yang dipilih pada form
        $barang = Barang::find($model->id_barang);
        //kemudian membuat sebuah variabel 'total_harga' yang 
        //otomatis diambil dari harga barang dan jumlah pesanan
        $total_harga = $barang->harga * $model->jumlah_pesanan;
        //selanjutnya isian jumlah_harga dibuat otomatis dari total_harga
        $model->jumlah_harga = $total_harga;

        $model->id_customer = $request->get('id_customer');
        $model->created_by =  Auth::id();
        $model->updated_by =  Auth::id();
        
        $model->save();

        return redirect('keranjang');
    }

    public function pindahKeInvoice($id){
        $model = Keranjang::find($id);

        $model_invoice = new InvoiceBarang;
        $model_invoice->id_barang = $model->id_barang; 
        $model_invoice->id_customer =  $model->id_customer;
        $model_invoice->jumlah_barang =  $model->jumlah_pesanan;
        $model_invoice->jumlah_harga =  $model->jumlah_harga;
        $model_invoice->created_by = Auth::id();
        $model_invoice->updated_by = Auth::id();
        $model_invoice->id_keranjang = $model->id;
        if($model_invoice->save()){
            $model->status = 2;
            $model->save();
        }
        
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
        $model->updated_by =  Auth::id();
        
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
