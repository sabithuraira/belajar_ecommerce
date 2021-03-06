<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">

<style type="text/css">
    * {
        font-family: Segoe UI, Arial, sans-serif;
    }
    table{
        font-size: x-small;
        border-collapse: collapse;
    }

    tr, td{ padding-left: 8px; }

    .table-border{ border: 1px solid black; }
    
    .table-border td, th{ border: 1px solid black; }

    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }

    .gray { background-color: lightgray }
</style>

</head>
<body>
    Hai semuanya..
    <table style="min-width:100%;">
        <tr><th colspan="2">KETERANGAN DETAIL BARANG</th></tr>
        <tr>
            <td>Kode Transaksi</td>
            <td>{{ $model->kode_transaksi }}</td>
        </tr>
        <tr>
            <td>Metode Pembayaran</td>
            <td>{{ $model->metode_pembayaran }}</td>
        </tr>
        <tr>
            <td>Status</td>
            <td>{{ $model->status }}</td>
        </tr>
    </table>

    <br/>
    
    <table class="table-border" style="min-width:100%;">
        <tr><th colspan="3">Daftar Barang</th></tr>
        <tr>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Total Harga</th>
        </tr>
        @foreach($list_barang as $value)
            <tr>
                <td>{{ $value->barang->nama }}</td>
                <td>{{ $value->jumlah_barang }}</td>
                <td>{{ $value->jumlah_harga }}</td>
            </tr>
        @endforeach
        
    </table>
</body>
</html>