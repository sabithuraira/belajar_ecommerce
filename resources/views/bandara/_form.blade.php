<div class="row clearfix">
    <div class="col-md-12">
        <div class="form-group">
            <label>{{ $model->attributes()['kode_bandara'] }}:</label>    
            <input type="text" class="form-control {{($errors->first('kode_bandara') ? ' parsley-error' : '')}}" name="kode_bandara" value="{{ old('kode_bandara', $model->kode_bandara) }}">
            @foreach ($errors->get('kode_bandara') as $msg)
                <p class="text-danger">{{ $msg }}</p>
            @endforeach
        </div>
        
        <div class="form-group">
            <label>{{ $model->attributes()['nama_bandara'] }}:</label> 
            <input type="text" class="form-control {{($errors->first('nama_bandara') ? ' parsley-error' : '')}}" name="nama_bandara" value="{{ old('nama_bandara', $model->nama_bandara) }}">
            @foreach ($errors->get('nama_bandara') as $msg)
                <p class="text-danger">{{ $msg }}</p>
            @endforeach
        </div>

        <div class="form-group">
            <label>{{ $model->attributes()['alamat_bandara'] }}:</label> 
            <input type="text" class="form-control {{($errors->first('alamat_bandara') ? ' parsley-error' : '')}}" name="alamat_bandara" value="{{ old('alamat_bandara', $model->alamat_bandara) }}">
        
            @foreach ($errors->get('alamat_bandara') as $msg)
                <p class="text-danger">{{ $msg }}</p>
            @endforeach
        </div>
    </div>
</div>

<br>
<button type="submit" class="btn btn-primary">Simpan</button>

