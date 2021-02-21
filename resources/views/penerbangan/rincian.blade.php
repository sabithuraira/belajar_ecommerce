<b>Daftar Penumpang</b> -
&nbsp <a href="#" id="add-utama" data-toggle="modal" data-target="#form_penumpang">Tambah Penumpang &nbsp &nbsp<i class="icon-plus text-info"></i></a>
<table class="table table-bordered">
    <tr>
        <th>Nama</th>
        <th>No KTP</th>
        <th>Alamat</th>
    </tr>
        <tr v-for="(data, index) in rincian_penumpang" :key="data.id">
            <td>@{{ data.nama }}</td>
            <td>@{{ data.no_ktp }}</td>
            <td>
                @{{ data.alamat }}
                <!-- 
                    input type hidden digunakan untuk menangkap nilai pada proses simpan
                    dimana menggunakan hidden agar tidak mengganggu tampilan 
                    dan tidak bisa di edit langsung oleh user
                -->
                <input type="hidden" :value="data.alamat" :name="'alamat'+data.id">
                <input type="hidden" :value="data.nama" :name="'nama'+data.id">
                <input type="hidden" :value="data.no_ktp" :name="'no_ktp'+data.id">
            </td>
        </tr>
</table>