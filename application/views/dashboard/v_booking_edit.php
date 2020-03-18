<?php

function rupiah($angka){
  if ($angka > 0) {
    $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
    return $hasil_rupiah;
  } else {
    return 'Gratis!';
  } 
}

 ?>

<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Booking
			<small>Edit booking Baru</small>
		</h1>
	</section>

	<section class="content">

		<a href="<?php echo base_url().'dashboard/booking'; ?>" class="btn btn-sm btn-primary">Kembali</a>

		<br/>
		<br/>

		<?php foreach($booking as $a){ ?>

		<form method="post" action="<?php echo base_url('dashboard/booking_update') ?>" enctype="multipart/form-data">
			<div class="row">
				<div class="col-lg-9">

					<div class="box box-primary">
						<div class="box-body">
							<div class="box-body">
							</div>

							<div class="col-md-12 text-center">
								<h3 style="margin-top: 0; font-family: 'Breuer';"><?= rupiah($a->booking_harga); ?></h3>
							</div>
							
							<input type="hidden" name="id" value="<?= $a->booking_id; ?>">

							<div class="box-body">
							<div class="form-group">
								<label>Metode Pembayaran</label>
								<select class="form-control" name="metode">
									<option value="">- Pilih metode</option>
									<?php foreach($metode as $m){ ?>
										<option <?php if($a->metode == $m->metode_id){echo "selected='selected'";} ?> value="<?php echo $m->metode_id ?>"><?php echo $m->metode_pembayaran; ?></option>
									<?php } ?>
								</select>
								<br/>
								<?php echo form_error('metode'); ?>
							</div>

							<div class="form-group">
								<label>Upload Bukti Pembayaran</label>

								<input type="file" name="bukti">

								<br/>
								<?php 
								if(isset($gambar_error)){
									echo $gambar_error;
								}
								?>
								<?php echo form_error('bukti'); ?>
							</div>

						</div>

							<div class="box-body">
								<div class="form-group">
									<label>Deskripsi pembayaran</label>
									<?php echo form_error('konten'); ?>
									<br/>
									<textarea class="form-control" name="deskripsi"><?php echo $a->deskripsi_pembayaran; ?></textarea>
								</div>
							</div>

							<?php if ($this->session->userdata('level') == "admin") { ?>
								<div class="form-group">
									<label>Status Bayar</label>
									<select class="form-control" name="status_bayar">
										<option value="0">Belum</option>
										<option value="1" selected="selected">Proses</option>
										<option value="2">Sudah</option>
									</select>
								</div>
							<?php  
							} else { ?>
								<input type="hidden" name="status_bayar" value="1">
							<?php } ?>

							<?php echo form_error('status_bayar'); ?>
							
							<input type="submit" name="status" value="Bayar" class="btn btn-success btn-block">

						</div>
					</div>

				</div>


			</div>
		</form>
		<?php } ?>

	</section>

</div>