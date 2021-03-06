<div class="modal" id="form_keranjang" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
    
        <form method="post" action="{{ url('invoice/rubah_status/barang') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <b class="title" id="defaultModalLabel">Rubah Status</b>
                </div>
                <div class="modal-body">
                    <div class="form-group">Status
                        <div class="form-line">
                            <select class="form-control form-control-sm" name="status" >
                                @foreach($model_invoice->listStatus as $key=>$value)
                                    <option value="{{ $key}}">{{ $value }}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="id_barang" v-model="id_barang_saat_ini">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">SAVE</button>
                    <button type="button" class="btn btn-simple" data-dismiss="modal">CLOSE</button>
                </div>
            </div>
        </form>
    </div>
</div>