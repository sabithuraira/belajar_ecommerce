<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InvoiceBarang;
use Illuminate\Support\Facades\Auth;

class InvoiceBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //daftar barang yang ditampilkan adalah barang yang memiliki
        //id_customer sesuai user yang telah login
        //dan memiliki status =1 
        $datas = InvoiceBarang::where('id_customer', '=', Auth::id())
            ->where('status', '=', 1)
            ->get();
        
        $model = new InvoiceBarang;
        return view('invoice_barang.index', compact(
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = InvoiceBarang::find($id);
        $model->delete();
        return redirect("invoice_barang");
    }
}
