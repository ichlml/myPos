<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Stock Report</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>">Home</a></li>
                    <li class="breadcrumb-item active">Stock Report</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <!-- <div class="float-sm-right">
                    <a href="<?= site_url('in/add') ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"> Add Stock In</i></a>
                </div> -->
            </div>
            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('pesan') ?>">
            </div>

            <!-- /.card-header -->
            <div class="card-body">
                <form action="<?= site_url('reports/stock_print')?>" method="post">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="tgl_a">Tanggal Awal</label>
                                <input type="date" name="tgl_a" id="tgl_a" class="form-control" value="" reuired>
                            </div> 
                            <div class="col-md-4">
                                <label for="tgl_b">Tanggal Akhir</label>
                                <input type="date" name="tgl_b" id="tgl_b" class="form-control" value="" reuired>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                                <button type="submit" formtarget="_blank" class="btn btn-sm btn-danger">Cari</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>