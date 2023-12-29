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
    <p class="judul"><b>LAPORAN PENJUALAN UD. VISTA MART</b></p>
    <p class="alm">Jetak Kedungdowo RT6/5 Kaliwungu, kudus</p>
    <hr>
    <p>Periode <?= $tgl_a?> - <?= $tgl_b?></p>
    </center>
    <?php
        $hasil = $keu->total - $keu->total_awal;
    ?>
    <p><b>Omset : Rp. <?= number_format($keu->total, 2)?></b></p>
    <p><b>Keuntungan : Rp. <?= number_format($hasil, 2)?></b></p>

    
    
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Invoice</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Unit</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total Harga Awal</th>
                <th>Total Harga</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $no = 1;
                foreach($get_sale as $d){
            ?>
            <tr>
                <td><?= $no++?>.</td>
                <td><?= $d->invoice?></td>
                <td><?= $d->barcode?></td>
                <td><?= $d->nm_brg?></td>
                <td><?= $d->category?></td>
                <td><?= $d->unit?></td>
                <td>Rp. <?= number_format($d->harga, 2)?></td>
                <td><?= $d->jumlah?></td>
                <td>Rp. <?= number_format($d->tot_price_a, 2) ?></td>
                <td>Rp. <?= number_format($d->total, 2)?></td>
                <td><?= $d->tanggal?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
<script>
    window.print();
</script>