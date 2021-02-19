<div class="row clearfix">
    <div class="col-md-12">
        <div class="form-group">
            <label>{{ $model->attributes()['jumlah_transaksi'] }}:</label>    
            <input type="text" class="form-control {{($errors->first('jumlah_transaksi') ? ' parsley-error' : '')}}" name="jumlah_transaksi" value="{{ old('jumlah_transaksi', $model->jumlah_transaksi) }}">
            @foreach ($errors->get('jumlah_transaksi') as $msg)
                <p class="text-danger">{{ $msg }}</p>
            @endforeach
        </div>
        
        <div class="form-group">
            <label>{{ $model->attributes()['kode_transaksi'] }}:</label> 
            <input type="text" class="form-control {{($errors->first('kode_transaksi') ? ' parsley-error' : '')}}" name="kode_transaksi" value="{{ old('kode_transaksi', $model->kode_transaksi) }}">
            @foreach ($errors->get('kode_transaksi') as $msg)
                <p class="text-danger">{{ $msg }}</p>
            @endforeach
        </div>

        <div class="form-group">
            <label>{{ $model->attributes()['metode_pembayaran'] }}:</label> 
            <select class="form-control {{($errors->first('metode_pembayaran') ? ' parsley-error' : '')}}" name="metode_pembayaran">
                @foreach($model->listMetodePembayaran as $key=>$value)
                    <option value="{{ $key }}"
                    @if($model->metode_pembayaran==$key)
                        selected="selected"
                    @endif
                    >
                    {{ $value }}</option>
                @endforeach
            </select>
            @foreach ($errors->get('metode_pembayaran') as $msg)
                <p class="text-danger">{{ $msg }}</p>
            @endforeach</div>

        <div class="form-group">
            <label>{{ $model->attributes()['kurir'] }}:</label> 
            <input type="text" class="form-control {{($errors->first('kurir') ? ' parsley-error' : '')}}" name="kurir" value="{{ old('kurir', $model->kurir) }}">
            @foreach ($errors->get('kurir') as $msg)
                <p class="text-danger">{{ $msg }}</p>
            @endforeach
        </div>
        
        <div class="form-group">
            <label>{{ $model->attributes()['ongkir'] }}:</label> 
            <input type="text" class="form-control {{($errors->first('ongkir') ? ' parsley-error' : '')}}" name="ongkir" value="{{ old('ongkir', $model->ongkir) }}">
            @foreach ($errors->get('ongkir') as $msg)
                <p class="text-danger">{{ $msg }}</p>
            @endforeach
        </div> 
        
        <div class="form-group">
            <label>{{ $model->attributes()['no_resi'] }}:</label> 
            <input type="text" class="form-control {{($errors->first('no_resi') ? ' parsley-error' : '')}}" name="no_resi" value="{{ old('no_resi', $model->no_resi) }}">
            @foreach ($errors->get('no_resi') as $msg)
                <p class="text-danger">{{ $msg }}</p>
            @endforeach
        </div> 
        
        <div class="form-group">
            <label>{{ $model->attributes()['id_keranjang'] }}:</label> 
            <input type="text" class="form-control {{($errors->first('id_keranjang') ? ' parsley-error' : '')}}" name="id_keranjang" value="{{ old('id_keranjang', $model->id_keranjang) }}">
            @foreach ($errors->get('id_keranjang') as $msg)
                <p class="text-danger">{{ $msg }}</p>
            @endforeach
        </div> 
        
        <div class="form-group">
            <label>{{ $model->attributes()['waktu_sampai'] }}:</label> 
            @php 
                if($model->waktu_sampai==null || strlen($model->waktu_sampai)==0){
                    $tanggal = date('Y-m-d');
                }
                else{
                    $tanggal = date('Y-m-d', strtotime($model->waktu_sampai));
                }
                $jam = date('h:i', strtotime($model->waktu_sampai));
            @endphp
            <input type="date" class="form-control {{($errors->first('waktu_sampai') ? ' parsley-error' : '')}}" name="tanggal_sampai" value="{{ $tanggal }}">
            <input type="time" class="form-control {{($errors->first('waktu_sampai') ? ' parsley-error' : '')}}" name="jam_sampai" value="{{ $jam }}">
    
            
            @foreach ($errors->get('waktu_sampai') as $msg)
                <p class="text-danger">{{ $msg }}</p>
            @endforeach
        </div> 
        
        <div class="form-group">
            <label>{{ $model->attributes()['customer_id'] }}:</label> 
            <input type="text" class="form-control {{($errors->first('customer_id') ? ' parsley-error' : '')}}" name="customer_id" value="{{ old('customer_id', $model->customer_id) }}">
            @foreach ($errors->get('customer_id') as $msg)
                <p class="text-danger">{{ $msg }}</p>
            @endforeach
        </div> 
    </div>
</div>

<br>
<button type="submit" class="btn btn-primary">Simpan</button>

