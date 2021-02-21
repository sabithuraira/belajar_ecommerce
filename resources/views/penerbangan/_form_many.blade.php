<div id="app_vue">
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="form-group">
                <label>{{ $model->attributes()['pesawat'] }}:</label>    
                <input type="text" class="form-control {{($errors->first('pesawat') ? ' parsley-error' : '')}}" name="pesawat" value="{{ old('pesawat', $model->pesawat) }}">
                @foreach ($errors->get('pesawat') as $msg)
                    <p class="text-danger">{{ $msg }}</p>
                @endforeach
            </div>
            
            <div class="form-group">
                <label>{{ $model->attributes()['bandara_dari'] }}:</label> 
                <select class="form-control {{($errors->first('bandara_dari') ? ' parsley-error' : '')}}" name="bandara_dari">
                    @foreach($list_bandara as $value)
                        <option value="{{ $value->id }}" 
                        @if($model->bandara_dari==$value->id)
                            selected="selected"
                        @endif
                        >{{ $value->nama_bandara }}</option>
                    @endforeach
                </select>
                @foreach ($errors->get('bandara_dari') as $msg)
                    <p class="text-danger">{{ $msg }}</p>
                @endforeach
            </div>

            <div class="form-group">
                <label>{{ $model->attributes()['bandara_tujuan'] }}:</label> 
                <select class="form-control {{($errors->first('bandara_tujuan') ? ' parsley-error' : '')}}" name="bandara_tujuan">
                    @foreach($list_bandara as $value)
                        <option value="{{ $value->id }}"
                        @if($model->bandara_tujuan==$value->id)
                            selected="selected"
                        @endif
                        >
                        {{ $value->nama_bandara }}</option>
                    @endforeach
                </select>
                @foreach ($errors->get('bandara_tujuan') as $msg)
                    <p class="text-danger">{{ $msg }}</p>
                @endforeach
            </div>

            
            <div class="form-group">
                <label>{{ $model->attributes()['waktu_penerbangan'] }}:</label> 
                @php 
                    $tanggal = date('Y-m-d', strtotime($model->waktu_penerbangan));
                    $jam = date('h:i', strtotime($model->waktu_penerbangan));
                @endphp
                <input type="date" class="form-control {{($errors->first('waktu_penerbangan') ? ' parsley-error' : '')}}" name="tanggal_penerbangan" value="{{ $tanggal }}">
                <input type="time" class="form-control {{($errors->first('waktu_penerbangan') ? ' parsley-error' : '')}}" name="jam_penerbangan" value="{{ $jam }}">
            
                @foreach ($errors->get('waktu_penerbangan') as $msg)
                    <p class="text-danger">{{ $msg }}</p>
                @endforeach
            </div>

            
            <div class="form-group">
                <label>{{ $model->attributes()['status_penerbangan'] }}:</label> 
                <select class="form-control {{($errors->first('status_penerbangan') ? ' parsley-error' : '')}}" name="status_penerbangan">
                    @foreach($model->listStatus as $key=>$value)
                        <option value="{{ $key }}"
                        @if($model->status_penerbangan==$key)
                            selected="selected"
                        @endif
                        >
                        {{ $value }}</option>
                    @endforeach
                </select>
                @foreach ($errors->get('status_penerbangan') as $msg)
                    <p class="text-danger">{{ $msg }}</p>
                @endforeach
            </div>
        </div>
    </div>
    
    @include('penerbangan.rincian')
    @include('penerbangan.modal_penumpang')

    <!--
        digunakan untuk mengetahui total penumpang yang ditambahkan oleh user
        dari jumlah inilah, kita akan melakukan looping penyimpanan
    -->
    <input name="total_penumpang" type="hidden" :value="total_penumpang">

    <br>
    <button type="submit" class="btn btn-primary">Simpan</button>
</div>

@section('script')
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script>
       var vm = new Vue({  
           el: "#app_vue",
           data:{
                //rincian penumpang, adalah variabel yang menyimpan daftar penumpang
                //setiap rincian, memiliki field sesuai DB penumpang yaitu:
                //nama, no_ktp, alamat, dsb
                rincian_penumpang: [],
                //variabel ini digunakan untuk menyimpan informasi 
                //penumpang yang saat ini sedang di modifikasi
                cur_penumpang: {
                    nama: '',
                    no_ktp: '',
                    alamat: '',
                    id: '',
                    index: ''
                },
                total_penumpang: 1,
            }, 
            methods: {
                //fungsi untuk menambah list binatang
            //       tambahBinatang: function(){
            //           this.list_binatang.push("Kucing")
            //       },
                saveRincian: function(){
                    var self = this;

                    if(self.cur_penumpang.id){
                        self.rincian_penumpang[self.cur_penumpang.index] = {
                            'id': self.cur_penumpang.id,
                            'nama'   : self.cur_penumpang.nama,
                            'no_ktp'   : self.cur_penumpang.no_ktp,
                            'alamat'   : self.cur_penumpang.alamat,
                        };
                    }
                    else{
                        self.rincian_penumpang.push({
                            'id': 'au'+(self.total_penumpang),
                            'nama'   : self.cur_penumpang.nama,
                            'no_ktp'   : self.cur_penumpang.no_ktp,
                            'alamat'   : self.cur_penumpang.alamat,
                        });
                        self.total_penumpang++;
                    // }
                    }
                    
                    self.cur_penumpang.nama = '';
                    self.cur_penumpang.no_ktp = '';
                    self.cur_penumpang.alamat = '';
                    self.cur_penumpang.id = '';
                    //////////
                    $('#form_penumpang').modal('hide');

                    console.log(self.rincian_penumpang);
                }
            }
        });
    </script>
@endsection

