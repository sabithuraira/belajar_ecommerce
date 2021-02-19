<div class="row clearfix">
    <div class="col-md-12">
        <div class="form-group">
            <label>{{ $model->attributes()['id_customer'] }}:</label>    
            <input type="text" class="form-control {{($errors->first('id_customer') ? ' parsley-error' : '')}}" name="id_customer" value="{{ old('id_customer', $model->id_customer) }}">
            @foreach ($errors->get('id_customer') as $msg)
                <p class="text-danger">{{ $msg }}</p>
            @endforeach
        </div>
        
        <div class="form-group">
            <label>{{ $model->attributes()['isi_pesan'] }}:</label> 
            <input type="text" class="form-control {{($errors->first('isi_pesan') ? ' parsley-error' : '')}}" name="isi_pesan" value="{{ old('isi_pesan', $model->isi_pesan) }}">
            @foreach ($errors->get('isi_pesan') as $msg)
                <p class="text-danger">{{ $msg }}</p>
            @endforeach
        </div>

        <div class="form-group">
            <label>{{ $model->attributes()['id_chat_previous'] }}:</label> 
            <input type="text" class="form-control {{($errors->first('id_chat_previous') ? ' parsley-error' : '')}}" name="id_chat_previous" value="{{ old('id_chat_previous', $model->id_chat_previous) }}">
            @foreach ($errors->get('id_chat_previous') as $msg)
                <p class="text-danger">{{ $msg }}</p>
            @endforeach
        </div>

        <div class="form-group">
            <label>{{ $model->attributes()['chat_status'] }}:</label> 
            <select class="form-control {{($errors->first('chat_status') ? ' parsley-error' : '')}}" name="chat_status">
                <option value="">- Pilih Status -</option>
                @foreach($model->listChatStatus as $key=>$value)
                    <option value="{{ $key }}"
                    @if($model->chat_status==$key)
                        selected="selected"
                    @endif
                    >
                    {{ $value }}</option>
                @endforeach
            </select>
            @foreach ($errors->get('chat_status') as $msg)
                <p class="text-danger">{{ $msg }}</p>
            @endforeach
        </div>
    </div>
</div>

<br>
<button type="submit" class="btn btn-primary">Simpan</button>

