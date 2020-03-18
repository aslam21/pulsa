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

	<section class="content">

		<?php foreach($booking as $a){ ?>

			<div class="row">
				<div class="col-lg-9">

					<div class="box box-primary">
						<div class="box-body">
							<div class="box-body">
							</div>

							<div class="col-md-12 text-center logo logo-lg">
								<h3 style="margin-top: 0;">
									<span class="logo-lg"><b>Event</b>Lampung</span>
								</h3>
							</div>

							<br>
							<br>
							<br>

							<table class="table" width="100%" cellpadding="5">
					        	<tr>
					        		<td width="250">Pembayaran dengan metode</td>
					        		<td width="1">:</td>
					            	<td>Transfer Bank</td>
					        	</tr>
					        	<tr>
					        		<td>Jumlah pembayaran</td>
					        		<td>:</td>
					        		<td>
					            		<div class="nilai_dibayar"><?= rupiah($a->booking_harga); ?></div>
					            	</td>
					            </tr>
					        	<tr valign="top"><td>Jumlah tiket</td>
					        		<td>:</td>
					        		<td>
					            	 	<?= $a->booking_jumlah; ?> Tiket
					            	</td>
					            </tr>
					            <tr valign="top"><td>Untuk acara</td>
					        		<td>:</td>
					        		<td>
					            	 	<?= $a->booking_event; ?>
					            	</td>
					            </tr>
					            <tr valign="top"><td>Kategori acara</td>
					        		<td>:</td>
					        		<td>
					            	 	<?= $a->booking_event; ?>
					            	</td>
					            </tr>
					        </table>

					        <br>
					        <br>
					        <br>

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
							
							<a href="<?php echo base_url().'dashboard/booking'; ?>" class="btn btn-success btn-block">Kembali</a>
							</div> 
						</div>
					</div>

				</div>


			</div>
		</form>
		<?php } ?>

	</section>

</div>