<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\InvoiceBarang;
use App\Models\Keranjang;
use App\Models\Barang;
use App\Http\Requests\InvoiceRequest;
use Illuminate\Support\Facades\Auth;
use PDF;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = new Invoice;
        $datas = Invoice::all(); //SELECT * FROM invoice
        return view('invoice.index', compact(
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
        $model = new Invoice;

        return view('invoice.create', compact(
            'model'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvoiceRequest $request)
    {
        $model = new Invoice;
        $model->jumlah_transaksi = $request->get('jumlah_transaksi');
        $model->metode_pembayaran = $request->get('metode_pembayaran');
        $model->kode_transaksi = $request->get('kode_transaksi');
        $model->kurir  = $request->get('kurir'  );
        $model->ongkir = $request->get('ongkir');
        $model->no_resi = $request->get('no_resi');
        $model->id_keranjang = $request->get('id_keranjang');
        $model->waktu_sampai = $request->get('tanggal_sampai').' '.$request->get('jam_sampai');
        $model->customer_id = $request->get('customer_id');
        $model->created_by =  Auth::id();
        $model->updated_by =  Auth::id();
        
        $model->save();

        return redirect('invoice');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = Invoice::find($id);
        //mengambil daftar invoice_barang sesuai deangan id invoice
        $list_barang = InvoiceBarang::where('id_invoice', '=', $model->id)->get();
        $model_invoice = new InvoiceBarang;

        return view('invoice.show', compact(
            'model', 'list_barang', 'model_invoice'
        ));
    }

    public function print_pdf($id)
    {
        $model = Invoice::find($id);
        $list_barang = InvoiceBarang::where('id_invoice', '=', $model->id)->get();
        $model_invoice = new InvoiceBarang;

        $pdf = PDF::loadview('invoice.print_pdf', compact(
            'model', 'list_barang', 'model_invoice'
        ));
    	return $pdf->download($model->kode_transaksi.'.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $model = Invoice::find($id);
        // return view('invoice.edit', compact(
        //     'model'
        // ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InvoiceRequest $request, $id)
    {
        // $model = Invoice::find($id);
        // $model->jumlah_transaksi = $request->get('jumlah_transaksi');
        // $model->metode_pembayaran = $request->get('metode_pembayaran');
        // $model->kode_transaksi = $request->get('kode_transaksi');
        // $model->kurir  = $request->get('kurir'  );
        // $model->ongkir = $request->get('ongkir');
        // $model->no_resi = $request->get('no_resi');
        // $model->id_keranjang = $request->get('id_keranjang');
        // $model->waktu_sampai = $request->get('tanggal_sampai').' '.$request->get('jam_sampai');
        // $model->customer_id = $request->get('customer_id');
        // $model->updated_by =  Auth::id();
        // $model->save();

        // return redirect('invoice');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Invoice::find($id);
        
        if($model->delete()){
            //setelah berhasil mengahapus data invoice, kita juga akan melakukan hal berikut:
            //-hapus semua data invoice_barang
            //-rubah kembali status keranjang menjadi 1
            //-tambahkan jumlah barang, sesuai dengan data yang telah dikurangi dari invoice_barang
            $list_invoice_barang = InvoiceBarang::where('id_invoice', '=', $id)->get();

            //looping ini akan merubah status keranjang dan jumlah barang
            foreach($list_invoice_barang as $value){
                //definisikan model keranjang berdasarkan value pada invoice_barang
                //kemudian modifikasi status menjadi 1
                $keranjang = Keranjang::find($value->id_keranjang);
                $keranjang->status = 1;
                $keranjang->save();

                $barang = Barang::find($value->id_barang);
                $barang->jumlah = $barang->jumlah + $value->jumlah_barang;
                $barang->save();

                $value->delete();
            }
        }
        return redirect("invoice");
    }
}
