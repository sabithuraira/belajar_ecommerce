<div class="modal" id="form_penumpang" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <b class="title" id="defaultModalLabel">Tambah Penumpang</b>
            </div>
            <div class="modal-body">
                <div class="form-group">Nama
                    <div class="form-line">
                        <input class="form-control form-control-sm" type="text" v-model="cur_penumpang.nama">
                        @{{ cur_penumpang.nama }}
                    </div>
                </div>
                
                <div class="form-group">Alamat
                    <div class="form-line">
                        <input class="form-control form-control-sm" type="text" v-model="cur_penumpang.alamat">
                    </div>
                </div>
                
                <div class="form-group">Nomor KTP
                    <div class="form-line">
                        <input class="form-control form-control-sm" type="text" v-model="cur_penumpang.no_ktp">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" v-on:click="saveRincian()">SAVE</button>
                <button type="button" class="btn btn-simple" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>