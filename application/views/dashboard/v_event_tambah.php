<div class="content-wrapper">
	<section class="content-header">
		<h1>
			event
			<small>Tulis event Baru</small>
		</h1>
	</section>

	<section class="content">

		<a href="<?php echo base_url().'dashboard/event'; ?>" class="btn btn-sm btn-primary">Kembali</a>

		<br/>
		<br/>

		<form method="post" action="<?php echo base_url('dashboard/event_aksi') ?>" enctype="multipart/form-data">
			<div class="row">
				<div class="col-lg-9">

					<div class="box box-primary">
						<div class="box-body">


							<div class="box-body">
								<div class="form-group">
									<label>Judul</label>
									<input type="text" name="judul" class="form-control" placeholder="Masukkan judul event.." value="<?php echo set_value('judul'); ?>">
									<br/>
									<?php echo form_error('judul'); ?>
								</div>
							</div>

							<div class="box-body">
								<div class="row">
									<div class="form-group col-md-4">
										<label>Tempat</label>
										<input type="text" name="tempat" class="form-control" placeholder="Masukkan tempat event.." value="Novotel">
									</div>
									<div class="form-group col-md-4">
										<label>Harga</label>
										  <div class="input-group mb-2 mr-sm-2 mb-sm-0">
										    <div class="input-group-addon">Rp.</div>
										    <input type="number" name="harga" class="form-control" id="inlineFormInputGroup" placeholder="Harga Tiket.." value="200000">
										  </div>
									</div>
									<div class="form-group col-md-4">
										<label>Kontak</label>
										  <div class="input-group mb-2 mr-sm-2 mb-sm-0">
										    <div class="input-group-addon">+62</div>
										    <input type="number" class="form-control" id="inlineFormInputGroup" placeholder="Nomor kontak.." name="kontak" value="82288830439">
										  </div>
									</div>
								</div>
							</div>

							<div class="box-body">
								<div class="row">
							        <div class='col-sm-12'>
							            <div class="form-group">
							                <div class='input-group date' id='datetimepicker2'>
							                    <input type='text' name="tanggal_dimulai" class="form-control" value="2020-02-30 16:05:20" />
							                    <span class="input-group-addon">
							                        <span class="glyphicon glyphicon-calendar"></span>
							                    </span>
							                </div>
							            </div>
							        </div>
							    </div>
							</div>

							<div class="box-body">
								<div class="form-group">
									<label>Konten</label>
									<?php echo form_error('konten'); ?>
									<br/>
									<textarea class="form-control" id="editor" name="konten"> <?php echo set_value('konten'); ?> </textarea>
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
										<option <?php if(set_value('kategori') == $k->kategori_id){echo "selected='selected'";} ?> value="<?php echo $k->kategori_id ?>"><?php echo $k->kategori_nama; ?></option>
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

	</section>

</div>

<script>
	$(document).ready(function() {
          $('#datetimepicker2').datetimepicker();
        });
</script>