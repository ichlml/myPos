<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    table, th, td{
        border:1px solid;
    }

    table, tr{
        width:100%;
    }

    h3{
        margin-bottom:0px;
    }

    hr{
        border:2px solid;
    }
    .judul{
        font-size:22px;
        margin-bottom:0px
    }
    .alm{
        margin-top:0px
        font-size:15px;
    }
</style>
<body>
    <center>
    <p class="judul"><b>LAPORAN STOK UD. VISTA MART</b></p>
    <p class="alm">Jetak Kedungdowo RT6/5 Kaliwungu, kudus</p>
    <hr>
    </center>

    <h5>PERIODE</h5>
    <p>Awal : <?= $tgl_a?></p>
    <p>Akhir : <?= $tgl_b?></p>
    
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Barang</th>
                <th>Qty</th>
                <!-- <th>Detail</th>
                <th>Type</th>
                <th>Supplier</th>
                <th>Tanggal</th> -->
            </tr>
        </thead>
        <tbody>
            <?php 
                $no = 1;
                foreach($get_stock as $d){
            ?>
            <tr>
                <td><?= $no++?>.</td>
                <td><?= $d->name?></td>
                <td><?= $d->stock?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
<script>
    window.print();
</script>