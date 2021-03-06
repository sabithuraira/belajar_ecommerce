<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Barang;
use App\Models\Invoice;
use App\Models\InvoiceBarang;
use App\Http\Requests\KeranjangRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
            ->select('keranjang.*', 'barang.created_by as penjual')
            ->where('id_customer', '=', Auth::id())
            //digunakan untuk melakukan query dengan kondisi
            //pada tabel relasi lain
            // ->whereHas('barang', function($query) {
            //     $query->where('kode_barang','=', 'PN001');
            // })
            //kode di bawah melakukan join pada suatu eloquent
            //dimana kita bisa menggunakan attribut pada tabel relasi pada contoh di bawah
            ->join('barang', 'barang.id', '=', 'keranjang.id_barang')
            //contoh melakukan pengururan suatu data menggunakan field dari tabel relasi
            ->orderBy('barang.created_by')
            ->get();
        //gunakan dd untuk melihat detail suatu variabel
        //dd($datas)

        //variabel untuk menyimpan informasi apakah ada barang yang kosong
        $apakahAdaKosong = 0;
        //ini kode untuk mengecek apakaha ada barang yang stock 0
        //satu per satu dengan foreach
        foreach($datas as $value){
            //memanggil data pada tabel barang sesuai dengan id_barang
            $barang = Barang::find($value->id_barang);
            if($barang->jumlah==0){
                $apakahAdaKosong = 1;
                break;
            }
        }

        $model = new Keranjang;
        $modelBarang = new Barang;
        return view('keranjang.index', compact(
            'datas', 'model', 'apakahAdaKosong', 'modelBarang'
        ));
    }

    //fungsi ini digunakan untuk memasukkan semua barang 
    //pada keranjang ke invoice
    public function beli_semua(){
        //kita ambil terlebih semua keranjang yang dimiliki oleh user yang sedang login
        //dan memiliki status = 1 yang artinya masih hanya dalam keranjang
        $datas = Keranjang::where('status', '=', 1)
            ->select('keranjang.*', 'barang.created_by as penjual')
            ->where('id_customer', '=', Auth::id())
            ->join('barang', 'barang.id', '=', 'keranjang.id_barang')
            ->orderBy('barang.created_by')
            ->get();

        //mengambil jumlah harga dari semua barang yang ada pada keranajng
        // $total_harga = Keranjang::where('status', '=', 1)
        //     ->where('id_customer', '=', Auth::id())
        //     ->sum('jumlah_harga');


        $model = new Invoice;
        $model->jumlah_transaksi = 0;
        $model->kode_transaksi = Str::random(32);//memanggil sebuah string acak sepanjang 32 karakter
        $model->customer_id = Auth::id();
        $model->created_by = Auth::id();
        $model->updated_by = Auth::id();

        //digunakan untuk menangkap penjual terakhir yang ada pada seluruh list keranjang
        $current_penjual = "";
        $jumlah_invoice = 1;

        if($model->save()){ //jika invoice telah disimpan, maka simpan rincian invoice_barang
            foreach($datas as $key=>$value){
                //kita harus tahu siapa user yang memiliki barang
                $barang = Barang::find($value->id_barang); 
                //variabel si penjual barang
                $user_penjual = $barang->created_by;

                //jika penjual pada keranjang barang terakhir berbeda dengan
                //penjual saat ini, maka invoice harus dibedakan
                //pada kode ini, kita akan membuat invoice baru
                if($current_penjual!="" && $user_penjual!=$current_penjual){
                    $model = new Invoice;
                    $model->jumlah_transaksi = 0;
                    $model->kode_transaksi = Str::random(32);//memanggil sebuah string acak sepanjang 32 karakter
                    $model->customer_id = Auth::id();
                    $model->created_by = Auth::id();
                    $model->updated_by = Auth::id();
                    if($model->save()){
                        $jumlah_invoice++;
                    }
                }
                
                $current_penjual = $barang->created_by;

                $invoice_barang = new InvoiceBarang;
                $invoice_barang->id_invoice = $model->id;
                $invoice_barang->id_barang = $value->id_barang;
                $invoice_barang->id_customer = $value->id_customer;
                $invoice_barang->jumlah_barang = $value->jumlah_pesanan;
                $invoice_barang->jumlah_harga = $value->jumlah_harga;
                $invoice_barang->id_keranjang = $value->id;
                $invoice_barang->status = 1;
                $invoice_barang->created_by = Auth::id();
                $invoice_barang->updated_by = Auth::id();


                if($invoice_barang->save()){
                    //jumlah transaksi pada invoice secara default di set = 0
                    //sehingga setiap menyimpan barang pada invoice_barang, kita akan jumlahkan 
                    //jumlah transaksi sebelumnya, dengan harga barang pada invoice_barang saat ini
                    $model->jumlah_transaksi = $model->jumlah_transaksi + $invoice_barang->jumlah_harga;
                    $model->save();

                    //jika barang telah berhasil masuk ke dalam rincian invoice barang
                    //maka ubah status menjadi 2, agar daftar keranajng tersebut
                    //tidak lagi tampil pada KERANJANG
                    $keranjang = Keranjang::find($value->id);
                    $keranjang->status = 2;
                    $keranjang->save();

                    $barang->jumlah = $barang->jumlah - $value->jumlah_pesanan;
                    $barang->save();
                }
            }
        }
        
        if($jumlah_invoice==1)
            return redirect('invoice/'.$model->id);
        else
            return redirect('invoice');
    }

    public function beli_sebagian(){

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
