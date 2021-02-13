<div class="row clearfix">
    <div class="col-md-12">
        <div class="form-group">
            <label>Kode Barang:</label>    
            <input type="text" class="form-control {{($errors->first('kode_barang') ? ' parsley-error' : '')}}" name="kode_barang" value="{{ old('kode_barang', $model->kode_barang) }}">
        
        </div>
        
        <div class="form-group">
            <label>Nama:</label>
            <input type="text" class="form-control {{($errors->first('nama') ? ' parsley-error' : '')}}" name="nama" value="{{ old('nama', $model->nama) }}">
        </div>

        <div class="form-group">
            <label>Harga:</label>
            <input type="text" class="form-control {{($errors->first('harga') ? ' parsley-error' : '')}}" name="harga" value="{{ old('harga', $model->harga) }}">
        </div>

        <div class="form-group">
            <label>Deskripsi:</label>
            <input type="text" class="form-control {{($errors->first('deskripsi') ? ' parsley-error' : '')}}" name="deskripsi" value="{{ old('deskripsi', $model->deskripsi) }}">
        </div>
        
        <div class="form-group">
            <label>Jumlah:</label>
            <input type="text" class="form-control {{($errors->first('jumlah') ? ' parsley-error' : '')}}" name="jumlah" value="{{ old('jumlah', $model->jumlah) }}">
        </div>
        
        
        
    </div>
</div>

<br>
<button type="submit" class="btn btn-primary">Simpan</button>

