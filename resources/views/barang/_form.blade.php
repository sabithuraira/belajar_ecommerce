<div id="app_vue">
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="form-group">
                <label>{{ $model->attributes()['kode_barang'] }}:</label>    
                <input type="text" class="form-control {{($errors->first('kode_barang') ? ' parsley-error' : '')}}" name="kode_barang" value="{{ old('kode_barang', $model->kode_barang) }}">
                @foreach ($errors->get('kode_barang') as $msg)
                    <p class="text-danger">{{ $msg }}</p>
                @endforeach
            </div>
            
            <div class="form-group">
                <label>{{ $model->attributes()['nama'] }}:</label> 
                <input type="text" class="form-control {{($errors->first('nama') ? ' parsley-error' : '')}}" name="nama" value="{{ old('nama', $model->nama) }}">
                @foreach ($errors->get('nama') as $msg)
                    <p class="text-danger">{{ $msg }}</p>
                @endforeach
            </div>

            <div class="form-group">
                <label>{{ $model->attributes()['harga'] }}:</label> 
                <input type="text" class="form-control {{($errors->first('harga') ? ' parsley-error' : '')}}" name="harga" value="{{ old('harga', $model->harga) }}">
            
                @foreach ($errors->get('harga') as $msg)
                    <p class="text-danger">{{ $msg }}</p>
                @endforeach</div>

            <div class="form-group">
                <label>{{ $model->attributes()['deskripsi'] }}:</label> 
                <input type="text" class="form-control {{($errors->first('deskripsi') ? ' parsley-error' : '')}}" name="deskripsi" value="{{ old('deskripsi', $model->deskripsi) }}">
                @foreach ($errors->get('deskripsi') as $msg)
                    <p class="text-danger">{{ $msg }}</p>
                @endforeach
            </div>
            
            <div class="form-group">
                <label>{{ $model->attributes()['jumlah'] }}:</label> 
                <input type="text" class="form-control {{($errors->first('jumlah') ? ' parsley-error' : '')}}" name="jumlah" value="{{ old('jumlah', $model->jumlah) }}">
                @foreach ($errors->get('jumlah') as $msg)
                    <p class="text-danger">{{ $msg }}</p>
                @endforeach
            </div> 

            
            <!-- 
            <div class="form-group">
                <label>Foto:</label> 
                <input type="file" class="form-control" name="foto">
                @foreach ($errors->get('foto') as $msg)
                    <p class="text-danger">{{ $msg }}</p>
                @endforeach
                @foreach($list_foto as $key=>$value)
                    <a href="{{ asset('foto/'.$value->url) }}">Unduh File</a>
                @endforeach
            </div>  
            -->

            &nbsp <button type="button" class="btn btn-primary" v-on:click="addRincian">Tambah Foto &nbsp &nbsp<i class="icon-plus text-info"></i></button>
            <br/>
            <table class="table table-bordered">
                <tr>
                    <th>File</th>
                    <th>Nama/Keterangan file</th>
                </tr>
                
                <tr v-for="(data, index) in rincian_foto" :key="data.id">
                    <td>
                        <input type="file" :name="'url'+data.id">
                        <a v-if="data.url.length>0" href="#">Unduh</a>
                    </td>
                    <td><input type="text" :value="data.nama_foto" :name="'nama_foto'+data.id"></td>
                </tr>
            </table>
        </div>
    </div>
    <input type="hidden" name="total_foto" v-model="total_foto">

    <br>
    <button type="submit" class="btn btn-primary">Simpan</button>
</div>

@section('script')
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script>
       var vm = new Vue({  
           el: "#app_vue",
           data:{
                rincian_foto: {!! json_encode($list_foto) !!},
            },
            //ini sama seperti data biasa, tapi data di dalam computed itu 
            //nilainya bergantung dari nilai, contoh, nilai total_foto
            //bergantung dari jumlah yang ada pada rincian_foto 
            computed: {
                total_foto: function() {
                    return this.rincian_foto.length;
                }
            },
            methods: {
                addRincian: function(){
                    var self = this;
                    
                    self.total_foto = self.rincian_foto.length;

                    self.rincian_foto.push({
                        'id': 'au'+(self.total_foto),
                        'nama_foto'   : '',
                        'url' : '',
                    });
                    self.total_foto++;
                }
            }
        });
    </script>
@endsection

