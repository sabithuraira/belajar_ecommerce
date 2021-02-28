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
            <td>Nama</td>
            <td>{{ $model->kode_barang }} - {{ $model->nama }}</td>
        </tr>
    </table>
</body>
</html>