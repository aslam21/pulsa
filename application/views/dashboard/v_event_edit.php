<div class="content-wrapper">
	<section class="content-header">
		<h1>
			event
			<small>Edit event Baru</small>
		</h1>
	</section>

	<section class="content">

		<a href="<?php echo base_url().'dashboard/event'; ?>" class="btn btn-sm btn-primary">Kembali</a>

		<br/>
		<br/>

		<?php foreach($event as $a){ ?>

		<form method="post" action="<?php echo base_url('dashboard/event_update') ?>" enctype="multipart/form-data">
			<div class="row">
				<div class="col-lg-9">

					<div class="box box-primary">
						<div class="box-body">


							<div class="box-body">
								<div class="form-group">
									<label>Judul</label>
									<input type="hidden" name="id" value="<?php echo $a->event_id; ?>">
									<input type="text" name="judul" class="form-control" placeholder="Masukkan judul event.." value="<?php echo $a->event_judul; ?>">
									<?php echo form_error('judul'); ?>
								</div>
							</div>

							<div class="box-body">
								<div class="row">
									<div class="form-group col-md-4">
										<label>Tempat</label>
										<input type="text" name="tempat" class="form-control" placeholder="Masukkan tempat event.." value="<?php echo $a->event_tempat; ?>">
										<?php echo form_error('tempat'); ?>
									</div>
									<div class="form-group col-md-4">
										<label>Harga</label>
										  <div class="input-group mb-2 mr-sm-2 mb-sm-0">
										    <div class="input-group-addon">Rp.</div>
										    <input type="number" name="harga" class="form-control" id="inlineFormInputGroup" placeholder="Nomor kontak.." value="<?php echo $a->event_harga; ?>">
										    <?php echo form_error('harga'); ?>
										  </div>
									</div>
									<div class="form-group col-md-4">
										<label>Kontak</label>
										  <div class="input-group mb-2 mr-sm-2 mb-sm-0">
										    <div class="input-group-addon">+62</div>
										    <input type="number" name="kontak" class="form-control" id="inlineFormInputGroup" placeholder="Nomor kontak.." value="<?php echo $a->event_kontak; ?>">
										    <?php echo form_error('kontak'); ?>
										  </div>
									</div>
								</div>
							</div>

							<div class="box-body">
								<div class="row">
									<div class='col-sm-12'>
							            <div class="form-group">
							                <div class='input-group date' id='datetimepicker1'>
							                    <input type='text' name="tanggal_dimulai" class="form-control" value="<?php echo $a->event_dimulai; ?>" />
							                    <span class="input-group-addon">
							                        <span class="glyphicon glyphicon-calendar"></span>
							                    </span>
							                </div>
							            </div>
							        </div>
								</div>
							</div>
							<?php echo form_error('tanggal_dimulai'); ?>

							<div class="box-body">
								<div class="form-group">
									<label>Deskripsi Event</label>
									<?php echo form_error('konten'); ?>
									<br/>
									<textarea class="form-control" id="editor" name="konten"> <?php echo $a->event_konten; ?> </textarea>
								</div>
							</div>


						</div>
					</div>

				</div>

				<div class="col-lg-3">
					<div class="box box-primary">
						<div class="box-body">
							<div class="form-group">
								<label>Kategori</label>
								<select class="form-control" name="kategori">
									<option value="">- Pilih Kategori</option>
									<?php foreach($kategori as $k){ ?>
										<option <?php if($a->event_kategori == $k->kategori_id){echo "selected='selected'";} ?> value="<?php echo $k->kategori_id ?>"><?php echo $k->kategori_nama; ?></option>
									<?php } ?>
								</select>
								<br/>
								<?php echo form_error('kategori'); ?>
							</div>

							<br/><br/>

							<div class="form-group">
								<label>Gambar Sampul</label>

								<input type="file" name="sampul">

								<br/>
								<?php 
								if(isset($gambar_error)){
									echo $gambar_error;
								}
								?>
								<?php echo form_error('sampul'); ?>
							</div>

							<br/><br/>

							<input type="submit" name="status" value="Draft" class="btn btn-warning btn-block">
							<input type="submit" name="status" value="Publish" class="btn btn-success btn-block">

						</div>
					</div>

				</div>
			</div>
		</form>
		<?php } ?>

	</section>

</div>