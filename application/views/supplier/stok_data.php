<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Request Stock</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>">Home</a></li>
                    <li class="breadcrumb-item active">Request Stock</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">&nbsp;</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    &times;
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="<?= site_url('stock/prosesminta')?>" target="_self" name="formku" id="formku" class="eventInsForm">
                                    <div class="form-row">
                                        <div class="col-md-4 col-xs-4">
                                            <label for="name" class="col-form-label">Date <font color="#f00">*</font></label>
                                        </div>
                                        <div class="col-md-8 col-xs-8 input-group date" id="reservationdate" data-target-input="nearest">
                                            <input type="date" name="date" class="form-control" value="<?= date('Y-m-d') ?>" style="margin-bottom: 5px;">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-4 col-xs-4">
                                            <label for="item_name" class="col-form-label">Item Name <font color="#f00">*</font></label>
                                        </div>
                                        <div class="col-md-8 col-xs-8">
                                            <input type="text" name="item_name" id="item_name" class="form-control" style="margin-bottom: 5px;" autofocus readonly>
                                        </div>
                                        <div class="col-md-8 col-xs-8">
                                            <input type="hidden" name="item_id" id="item_id" class="form-control" style="margin-bottom: 5px;" autofocus readonly>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-4 col-xs-4">
                                            <label for="stock" class="col-form-label">Inital Stock</label>
                                        </div>
                                        <div class="col-md-8 col-xs-8">
                                            <input type="text" name="stock" id="stock" class="form-control" style="margin-bottom: 5px;" value="-" readonly autofocus>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-4 col-xs-4">
                                            <label for="detail" class="col-form-label">Detail <font color="#f00">*</font></label>
                                        </div>
                                        <div class="col-md-8 col-xs-8">
                                            <input type="text" name="detail" id="detail" class="form-control" style="margin-bottom: 5px;" autofocus>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-4 col-xs-4">
                                            <label for="supplier" class="col-form-label">Supplier</label>
                                        </div>
                                            <input type="hidden" name="id_supp" id="id_supp" class="form-control" style="margin-bottom: 5px;" value="" readonly autofocus>
                                        
                                        <div class="col-md-8 col-xs-8">
                                            <input type="text" name="supllier_name" id="supllier_name" class="form-control" style="margin-bottom: 5px;" value="" readonly autofocus>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-4 col-xs-4">
                                            <label for="qty" class="col-form-label">Qty <font color="#f00">*</font></label>
                                        </div>
                                        <div class="col-md-8 col-xs-8">
                                            <input type="number" name="qty" id="qty" class="form-control" style="margin-bottom:5px;" autofocus>
                                        </div>
                                    </div>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                                
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="float-sm-right">
                            <!-- <a onclick="tambahData()" class="btn btn-success btn-sm" style="color: aliceblue;"><i class="fa fa-plus"> Create</i></a> -->
                        </div>
                    </div>
                    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('pesan') ?>">
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 10px">No.</th>
                                    <th>Nama Barang</th>
                                    <th>Stok Lama</th>
                                    <th>Satuan</th>
                                    <th>Permintaan Stok</th>
                                    <th>Nama Supplier</th>
                                    <th>Alamat</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $no=1;
                                foreach($req_stok as $r){ ?>
                                <tr>
                                    <td><?= $no++?></td>
                                    <td><?= $r->nm_brg?></td>
                                    <td><?= $r->stock?></td>
                                    <td><?= $r->kategori?></td>
                                    <td><?= $r->jml_perm?></td>
                                    <td><?= $r->nm_supp?></td>
                                    <td><?= $r->almt?></td>
                                    <td><?= $r->tanggal?></td>
                                    <td>
                                        <button class="btn btn-sm btn-danger" disabled><?= $r->status_stock?></button>    
                                    </td>
                                    <td align="center">
                                        <form action="<?= site_url('stock/validasi_req') ?>" method="POST" class="d-inline">
                                            <input type="hidden" name="stock_id" value="<?= $r->stock_id; ?>">
                                            <input type="hidden" name="qty" value="<?= $r->qty; ?>">
                                            <input type="hidden" name="item_id" value="<?= $r->item_id; ?>">
                                            <button class="btn btn-danger btn-sm tombol-konfirm" style="margin-bottom:4px;" type="submit">
                                                <!-- <i class="fa fa-paper-plane"></i> --> Valdasi
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function () {
        $(document).on('click', '#send', function () {
            var item_id = $(this).data('id_barang');
            var nama_barang = $(this).data('nama_brg');
            var nama_supp = $(this).data('nama_supp');
            var supp_id = $(this).data('id_supplier');
            var stock = $(this).data('stock');
            console.log(supp_id)
            $('#item_id').val(item_id);
            $('#item_name').val(nama_barang);
            $('#id_supp').val(supp_id);
            $('#supllier_name').val(nama_supp);
            $('#stock').val(stock);

            $("#myModal").find('.modal-title').text('Request Item');
            $("#myModal").modal('show', {
            backdrop: 'true'
        });
        })
    })
</script>
