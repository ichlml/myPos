<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Dashboard</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Dashboard</li>
				</ol>
			</div>
		</div>
	</div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<!-- Info boxes -->
		<div class="berhasil-login" data-flashdata="<?= $this->session->flashdata('pesan') ?>">
		</div>
		<div class="row">
			<div class="col-12 col-sm-6 col-md-3">
				<div class="info-box">
					<span class="info-box-icon bg-info elevation-1"><i class="fas fa-th"></i></span>

					<div class="info-box-content">
						<span class="info-box-text">Items</span>
						<span class="info-box-number"><?= COUNT($item) ?></span>
					</div>
					<!-- /.info-box-content -->
				</div>
				<!-- /.info-box -->
			</div>
			<!-- /.col -->
			<div class="col-12 col-sm-6 col-md-3">
				<div class="info-box mb-3">
					<span class="info-box-icon bg-danger elevation-1"><i class="fas fa-truck"></i></span>

					<div class="info-box-content">
						<span class="info-box-text">Suppliers</span>
						<span class="info-box-number"><?= COUNT($supplier) ?></span>
					</div>
					<!-- /.info-box-content -->
				</div>
				<!-- /.info-box -->
			</div>
			<!-- /.col -->

			<!-- fix for small devices only -->
			<div class="clearfix hidden-md-up"></div>

			<div class="col-12 col-sm-6 col-md-3">
				<div class="info-box mb-3">
					<span class="info-box-icon bg-success elevation-1"><i class="fas fa-dollar-sign"></i></span>

					<div class="info-box-content">
						<span class="info-box-text">Omset Hari Ini</span>
						<span class="info-box-number"><?= indo_currency($untungperhari->harga); ?></span>
					</div>
					<!-- /.info-box-content -->
				</div>
				<!-- /.info-box -->
			</div>
			<!-- /.col -->
			<?php if ($this->fungsi->user_login()->level == 1) { 
				$a = $untungperhari->harga;
				$b = $untungperhari->hargaawal;

				$untung = $a - $b;
				?>
				<div class="col-12 col-sm-6 col-md-3">
					<div class="info-box mb-3">
						<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-dollar-sign"></i></span>

						<div class="info-box-content">
							<span class="info-box-text">Untung Hari Ini</span>
							<span class="info-box-number"><?= indo_currency($untung); ?></span>
						</div>
						<!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
				</div>
			<?php } ?>
			<!-- /.col -->
		</div>
		<?php if ($this->fungsi->user_login()->level == 2) { ?>
		<div class="row">
			<div class="col-12">
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
					<strong>Hallo Admin!</strong> Terdapat <?= $stok_habis->kosong?> Barang Dengan Stok Hampir Habis. <a href="<?= site_url('stock/stokhabis')?>">Cek disini</a>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			</div>
		</div>
		<?php } ?>
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header border-0">
						<h3 class="card-title">Produk Terlaris</h3>
						
					</div>
					<div class="card-body table-responsive p-0">
						<table class="table table-striped table-valign-middle">
							<thead>
								<tr>
									<th>Product</th>
									<th>Price</th>
									<th>Sales</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($product as $p) { ?>
									<tr>
										<td>
											<?= $p->name ?>
										</td>
										<td><?= indo_currency($p->price); ?></td>
										<td>
											<small class="text-success mr-1">
												<i class="fas fa-arrow-up"></i>
												12%
											</small>
											<?= $p->qty.' Item' ?> Sold
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