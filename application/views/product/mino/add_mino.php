<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Minimal Order</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>">Home</a></li>
                    <li class="breadcrumb-item active">Add Minimal Order</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">
                    Add Minimal Order
                </h3>
                <div class="float-sm-right">
                    <a href="<?= site_url('mino') ?>" class="btn btn-info btn-sm"><i class="fa fa-undo"> Back</i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 offset-md-4">
                        <form action="<?= site_url('mino/process'); ?>" method="post">
                            <div class="form-group">
                                <label for="tgl_input" class="col-form-label">Date <font color="#f00">*</font></label>
                                <input type="date" name="tgl_input" class="form-control" value="<?= date('Y-m-d') ?>">
                            </div>
                            <div class="form-group">
                                <label for="min_order" class="col-form-label">Minimal Order <font color="#f00">*</font></label>
                                <input type="number" name="min_order" id="min_order" class="form-control" autofocus>
                            </div>
                            <div class="form-group">
                                <label for="potongan" class="col-form-label">Potongan <font color="#f00">*</font></label>
                                <input type="number" name="potongan" id="potongan" class="form-control" autofocus>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success btn-flat" type="submit" name="add_mino"><i class="fa fa-paper-plane"></i> Save</button>
                                <button type="reset" class="btn btn-default btn-flat">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
