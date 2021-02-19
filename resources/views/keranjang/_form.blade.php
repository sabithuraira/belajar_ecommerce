<div class="row clearfix">
    <div class="col-md-12">
        <div class="form-group">
            <label>{{ $model->attributes()['id_barang'] }}:</label>    
            
            <select class="form-control {{($errors->first('id_barang') ? ' parsley-error' : '')}}" name="id_barang">
                <option value="">- Pilih Barang -</option>
                @foreach($list_barang as $key=>$value)
                    <option value="{{ $value->id }}"
                    @if($model->id_barang==$value->id)
                        selected="selected"
                    @endif
                    >
                    {{ $value->kode_barang }} - {{ $value->nama }}</option>
                @endforeach
            </select>
            @foreach ($errors->get('id_barang') as $msg)
                <p class="text-danger">{{ $msg }}</p>
            @endforeach
        </div>
        
        <div class="form-group">
            <label>{{ $model->attributes()['jumlah_pesanan'] }}:</label> 
            <input type="text" class="form-control {{($errors->first('jumlah_pesanan') ? ' parsley-error' : '')}}" name="jumlah_pesanan" value="{{ old('jumlah_pesanan', $model->jumlah_pesanan) }}">
            @foreach ($errors->get('jumlah_pesanan') as $msg)
                <p class="text-danger">{{ $msg }}</p>
            @endforeach
        </div>

        <div class="form-group">
            <label>{{ $model->attributes()['id_customer'] }}:</label> 
            <input type="text" class="form-control {{($errors->first('id_customer') ? ' parsley-error' : '')}}" name="id_customer" value="{{ old('id_customer', $model->id_customer) }}">
        
            @foreach ($errors->get('id_customer') as $msg)
                <p class="text-danger">{{ $msg }}</p>
            @endforeach
        </div>
    </div>
</div>

<br>
<button type="submit" class="btn btn-primary">Simpan</button>

