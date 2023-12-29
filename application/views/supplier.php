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
		<!-- <div class="row">
			<div class="col-12 col-sm-6 col-md-3">
				<div class="info-box">
					<span class="info-box-icon bg-info elevation-1"><i class="fas fa-th"></i></span>

					<div class="info-box-content">
						<span class="info-box-text">Items</span>
						<span class="info-box-number"></span>
					</div>

				</div>

			</div>
			
			<div class="col-12 col-sm-6 col-md-3">
				<div class="info-box mb-3">
					<span class="info-box-icon bg-danger elevation-1"><i class="fas fa-truck"></i></span>

					<div class="info-box-content">
						<span class="info-box-text">Suppliers</span>
						<span class="info-box-number"></span>
					</div>
					
				</div>

			</div> -->
			

			
			<!-- <div class="clearfix hidden-md-up"></div>

			<div class="col-12 col-sm-6 col-md-3">
				<div class="info-box mb-3">
					<span class="info-box-icon bg-success elevation-1"><i class="fas fa-dollar-sign"></i></span>

					<div class="info-box-content">
						<span class="info-box-text">Omset Hari Ini</span>
						<span class="info-box-number"></span>
					</div>

				</div>
			</div> -->
		<!-- </div> -->
		<div class="row">
			<div class="col-12">
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
					<strong>Hallo Supplier!</strong> Terdapat <?= COUNT($req_stok)?> Barang Dengan Stok Hampir Habis. <a href="">Cek disini</a>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			</div>
		</div>
	</div>
</section>