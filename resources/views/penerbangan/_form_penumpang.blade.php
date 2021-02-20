<div class="row clearfix">
    <div class="col-md-12">
        PESAWAT PENERBANGAN : {{ $penerbangan->pesawat }}<br/>
        RUTE PENERBANGAN : 
        {{ $penerbangan->bandaraDari->nama_bandara }} 
                        - 
        {{ $penerbangan->bandaraTujuan->nama_bandara }} <br/>
        WAKTU PENERBANGAN : {{ date('d M Y G:i', strtotime($penerbangan->waktu_penerbangan)) }}<br/>
        STATUS : {{ $penerbangan->listStatus[$penerbangan->status_penerbangan] }}<br/>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>{{ $model->attributes()['nama'] }}:</label>    
            <input type="text" class="form-control {{($errors->first('nama') ? ' parsley-error' : '')}}" name="nama" value="{{ old('nama', $model->nama) }}">
            @foreach ($errors->get('nama') as $msg)
                <p class="text-danger">{{ $msg }}</p>
            @endforeach
        </div>
        
        <div class="form-group">
            <label>{{ $model->attributes()['no_ktp'] }}:</label>    
            <input type="text" class="form-control {{($errors->first('no_ktp') ? ' parsley-error' : '')}}" name="no_ktp" value="{{ old('no_ktp', $model->no_ktp) }}">
            @foreach ($errors->get('no_ktp') as $msg)
                <p class="text-danger">{{ $msg }}</p>
            @endforeach
        </div>
        
        <div class="form-group">
            <label>{{ $model->attributes()['alamat'] }}:</label>    
            <input type="text" class="form-control {{($errors->first('alamat') ? ' parsley-error' : '')}}" name="alamat" value="{{ old('alamat', $model->alamat) }}">
            @foreach ($errors->get('alamat') as $msg)
                <p class="text-danger">{{ $msg }}</p>
            @endforeach
        </div>
    </div>
</div>

<br>
<button type="submit" class="btn btn-primary">Simpan</button>

