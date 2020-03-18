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
			<small>Manajemen Booking</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-12">

				<br/>
				<br/>

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">List Booking</h3>
					</div>
					<div class="box-body">

						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th width="1%">NO</th>
										<th>Tanggal Booking</th>
										<th>Tanggal Event</th>
										<th>Event</th>
										<th>Pembeli</th>
										<th>Jumlah tiket</th>
										<th>Harga</th>
										<th width="10%">Bukti</th>
										<th>Status</th>
										<th width="15%">OPSI</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$no = 1;
									foreach($booking as $a){ 
										?>
										<tr>
											<td><?php echo $no++; ?></td>
											<td><?= $a->booking_tanggal; ?></td>
											<td><?= $a->booking_event_dimulai; ?></td>
											<td>
												<?php echo $a->event_judul; ?>
												<br/>
												<small class="text-muted">
													<?php echo base_url()."".$a->event_slug; ?>
												</small>
											</td>
											<td><?php echo $a->pengguna_nama; ?></td>
											<td><?php echo $a->booking_jumlah; ?></td>
											<td><?php echo rupiah($a->booking_harga); ?></td>

											<?php 
											if ($a->booking_status < 1) { ?>
												<td><img width="100%" class="img-responsive" src="<?php echo base_url().'/gambar/bukti/bukti_belum.png'; ?>"></td>
											<?php 
											} else { ?>
												<td><img width="100%" class="img-responsive" src="<?php echo base_url().'/gambar/bukti/'.$a->bukti_pembayaran; ?>"></td>
											<?php } ?>

											
											<td>
												<?php 
												if($a->booking_status<1){
													echo "<span class='badge badge-secondary'>Belum Bayar</span>"; 
												}else if ($a->booking_status == 1) {
													echo "<span style='background-color: #F39C12;' class='badge badge-warning'>Proses</span>";
												} else {
													echo "<span style='background-color: #008D4C;' class='badge badge-success'>Sudah Dibayar</span>";
												}
												?>

											</td>
											<td>
												<a target="_blank" href="<?php echo base_url().$a->event_slug; ?>" class="btn btn-success btn-sm"> <i class="fa fa-eye"></i> </a>
												<?php 
											// cek apakah penggun yang login adalah penulis
												if($this->session->userdata('level') == "penulis"){
												// jika penulis, maka cek apakah penulis event ini adalah si pengguna atau bukan

														?>
														<?php 
															if($a->booking_status<1){?>
																<a href="<?php echo base_url().'dashboard/booking_edit/'.$a->booking_id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-upload"></i> </a>
															<?php 
															}else if ($a->booking_status == 1) {?>
																<a href="<?php echo base_url().'dashboard/booking_edit/'.$a->booking_id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-upload"></i> </a>
															<?php 
															} else { ?>
																<a href="<?php echo base_url().'dashboard/booking_invoice/'.$a->booking_id; ?>" id="" class="btn btn-primary btn-sm"> <i class="fa fa-address-card"></i> </a>
															<?php } ?>
														
												<?php
												}else{
												// jika yang login adalah admin
													?>
													<a href="<?php echo base_url().'dashboard/booking_edit/'.$a->booking_id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-upload"></i> </a>
													<a href="<?php echo base_url().'dashboard/booking_hapus/'.$a->booking_id; ?>" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </a>
													<?php
												}
												?>
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

</div>