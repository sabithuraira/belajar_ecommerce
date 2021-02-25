<div class="modal" id="form_keranjang" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
    
        <form method="post" action="{{ url('barang/store_keranjang') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <b class="title" id="defaultModalLabel">Tambah Keranjang</b>
                </div>
                <div class="modal-body">
                    <div class="form-group">Jumlah Barang
                        <div class="form-line">
                            <input class="form-control form-control-sm" type="text" name="jumlah_pesanan">
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