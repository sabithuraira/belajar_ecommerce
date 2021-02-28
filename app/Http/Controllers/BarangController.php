<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Review;
use App\Models\Keranjang;
use App\Models\FotoBarang;
use App\Http\Requests\BarangRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File; 
use PDF;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //untuk melakukan pencarian, tambahan parameter request
    //agar dapat mengambil isian form yang diiisi user pada pencarian
    public function index(Request $request)
    {
        $model = new Barang;
        // $datas = Barang::all(); //SELECT * FROM barang
        //untuk menangkap isian kata kunci pencarian
        $keyword = $request->get('search');

        //jika pada akhiran menggunakan ->get(), maka semua data akan tampil
        //hal ini jadi tidak efektif jika data mencapai ribuan, karena 
        //membebani aplikasi
        //untuk itu gunakan ->paginate(), agar data yang ditampilkan dapat dibatasi
        //proses menampilkan data selanjutnya juga dapat memilih pada halaman paging
        $datas = Barang::where('kode_barang', 'LIKE', '%' . $keyword . '%')
            ->orWhere('nama', 'LIKE', '%' . $keyword . '%')
            ->orWhere('deskripsi', 'LIKE', '%' . $keyword . '%')
            ->orderBy('id', 'DESC')
            ->paginate();

        $datas->withPath('barang');
        $datas->appends($request->all());
        return view('barang.index', compact(
            'datas', 'model', 'keyword'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Barang;
        $list_foto = [];
        return view('barang.create', compact(
            'model', 'list_foto'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BarangRequest $request)
    {
        $model= new Barang;
        $model->kode_barang =$request->get('kode_barang');
        $model->nama =$request->get('nama');
        $model->harga =$request->get('harga');
        $model->deskripsi =$request->get('deskripsi');
        $model->jumlah =$request->get('jumlah');
        $model->created_by = Auth::id();
        $model->updated_by = Auth::id();
        //INSERT INTO barang (kode_barang, nama, ....)
        //VALUES ($request->get(kode_barang), ....)

        //BERLAKU HANYA UNTUK MULTIPLE FILE
        $total_foto = $request->get('total_foto'); //mengambil jumlah total foto yang di upload
        if($model->save()){
            ////TUTORIAL MENYIMPAN SINGLE FILE////
            /////////////////////////////////////////////
            //jika tabel barang berhasil disimpan, maka baru simpan foto
            // if($request->file('foto')){
            //     $file = $request->file('foto');
            //     //penamaan file menggunakan time, untuk menghindari ada file dg nama yang sama
            //     //time ditambahkan dg nama asli file, namun dihilangkan spasi
            //     $nama_file = time().str_replace(" ","", $file->getClientOriginalName());
            //     //file yang diupload, di upload ke folder "public/foto"
            //     $file->move("foto", $nama_file);
                
            //     //menyimpan informasi foto di database
            //     $model_foto = new FotoBarang;
            //     $model_foto->nama_foto = "";
            //     $model_foto->url = $nama_file;
            //     $model_foto->id_barang = $model->id;
            //     $model_foto->created_by   = Auth::id();
            //     $model_foto->updated_by  = Auth::id();
            //     $model_foto->save();
                
            // }

            ////TUTORIAL MENYIMPAN SINGLE FILE////
            /////////////////////////////////////////////
            for($i=0;$i<3;$i++){
                if($request->file('urlau'.$i)){
                    $file = $request->file('urlau'.$i);
                    //penamaan file menggunakan time, untuk menghindari ada file dg nama yang sama
                    //time ditambahkan dg nama asli file, namun dihilangkan spasi
                    $nama_file = time().str_replace(" ","", $file->getClientOriginalName());
                    //file yang diupload, di upload ke folder "public/foto"
                    $file->move("foto", $nama_file);
                    
                    //menyimpan informasi foto di database
                    $model_foto = new FotoBarang;
                    $model_foto->nama_foto = $request->get("nama_fotoau".$i);
                    $model_foto->url = $nama_file;
                    $model_foto->id_barang = $model->id;
                    $model_foto->created_by   = Auth::id();
                    $model_foto->updated_by  = Auth::id();
                    $model_foto->save();
                    
                }
            }
        }
        
        return redirect('barang')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = Barang::find($id);
        //mengambil semua foto_barang sesuai id barang yang dipilih
        $list_foto = FotoBarang::where("id_barang", "=", $id)->get();
        return view('barang.show', compact(
            'model', 'list_foto'
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
        $model = Barang::find($id); //SELECT * FROM barang WHERE id=...
        $list_foto = FotoBarang::where("id_barang", "=", $id)->get();
        return view('barang.edit', compact(
            'model', 'list_foto'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BarangRequest $request, $id)
    {
        $model= Barang::find($id);
        $model->kode_barang =$request->get('kode_barang');
        $model->nama =$request->get('nama');
        $model->harga =$request->get('harga');
        $model->deskripsi =$request->get('deskripsi');
        $model->jumlah =$request->get('jumlah');
        $model->updated_by = Auth::id();
        //INSERT INTO barang (kode_barang, nama, ....)
        //VALUES ($request->get(kode_barang), ....)
        if($model->save()){
            //jika tabel barang berhasil disimpan, maka baru simpan foto
            if($request->file('foto')){
                $file = $request->file('foto');
                //penamaan file menggunakan time, untuk menghindari ada file dg nama yang sama
                //time ditambahkan dg nama asli file, namun dihilangkan spasi
                $nama_file = time().str_replace(" ","", $file->getClientOriginalName());
                //file yang diupload, di upload ke folder "public/foto"
                $file->move("foto", $nama_file);
                
                //mengambil foto barang pada inputan bertama, jika ada foto_barang nya
                $model_foto = FotoBarang::where("id_barang", "=", $id)->first(); 

                //ketika foto barang tidak ada pada data barang ini,
                //maka kondisinya akan membuat data baru pada foto barang
                if($model_foto==null){
                    $model_foto = new FotoBarang;
                }
                else{ //dan jika sudah sebelumnya, hapus foto yang lama
                    File::delete('foto/'.$model_foto->url);
                }

                $model_foto->nama_foto = "";
                $model_foto->url = $nama_file;
                $model_foto->id_barang = $model->id;
                $model_foto->created_by   = Auth::id();
                $model_foto->updated_by  = Auth::id();
                $model_foto->save();
                
            }
        }
        
        return redirect('barang')->with('success', 'Data berhasil ditambahkan');
    }

    //fungsi untuk menampilkan form review
    public function add_review($id){
        $model = Barang::find($id); 
        $list_review = Review::where('id_barang', '=', $id)->get();

        return view('barang.add_review', compact(
            'model', 'list_review'
        ));
    }

    //fungsi untuk menyimpan hasil review dari pengguna
    public function store_review(Request $request, $id){
        $model = new Review;
        $model->ulasan  = $request->get('ulasan');
        $model->id_barang  = $id;
        $model->id_customer  = Auth::id();
        $model->rating  = $request->get('rating');
        $model->created_by   = Auth::id();
        $model->updated_by   = Auth::id();
        $model->save();  
        
        return redirect('barang');
    }

    public function store_keranjang(Request $request){
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
        $model->id_customer = Auth::id();
        $model->created_by =  Auth::id();
        $model->updated_by =  Auth::id();
        
        $model->save();
        return redirect('barang');
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
        return redirect('barang');
    }
    
    public function print_pdf($id){
        $model = Barang::find($id);
        //barang.print_pdf adalah view yang ditampilkan
    	$pdf = PDF::loadview('barang.print_pdf', compact(
            'model'
        ));

        //ini contoh untuk melakukan pengaturan jenis kertas dan orientasi tampilan
        //$pdf = PDF::loadView('pdf1')->setPaper('a4', 'potrait');
        
        //mengunduh file PDF yang telah dibuat,
        //dengan nama "nama_file.pdf"
    	return $pdf->download('nama_file');
    }
}
