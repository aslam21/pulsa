<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Dashboard
			<small>Control panel</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">

			<?php if ($this->session->userdata('level') == 'admin') { ?>

				<div class="col-lg-3 col-xs-6">
					<div class="small-box bg-aqua">
						<div class="inner">
							<h3><?php echo $jumlah_event ?></h3>

							<p>Jumlah event</p>
						</div>
						<div class="icon">
							<i class="ion ion-android-list"></i>
						</div>
					</div>
				</div>

				<div class="col-lg-3 col-xs-6">
					<div class="small-box bg-green">
						<div class="inner">
							<h3><?php echo $jumlah_halaman ?></h3>

							<p>Jumlah Halaman/Page</p>
						</div>
						<div class="icon">
							<i class="ion ion-android-document"></i>
						</div>
					</div>
				</div>


				<div class="col-lg-3 col-xs-6">
					<div class="small-box bg-red">
						<div class="inner">
							<h3><?php echo $jumlah_kategori ?></h3>

							<p>Jumlah Kategori</p>
						</div>
						<div class="icon">
							<i class="ion ion-pie-graph"></i>
						</div>
					</div>
				</div>

				<div class="col-lg-3 col-xs-6">
					<div class="small-box bg-yellow">
						<div class="inner">
							<h3><?php echo $jumlah_pengguna ?></h3>

							<p>Jumlah Pengguna</p>
						</div>
						<div class="icon">
							<i class="ion ion-pie-graph"></i>
						</div>
					</div>
				</div>

			<?php 
			}
			else if ($this->session->userdata('level') == 'penulis') { ?>
				<div class="col-lg-3 col-xs-6">
					<div class="small-box bg-aqua">
						<div class="inner">
							<h3><?php echo $jumlah_event_pengguna ?></h3>

							<p>Jumlah event</p>
						</div>
						<div class="icon">
							<i class="ion ion-android-list"></i>
						</div>
					</div>
				</div>

				<div class="col-lg-3 col-xs-6">
					<div class="small-box bg-green">
						<div class="inner">
							<h3><?php echo $jumlah_booking ?></h3>

							<p>Jumlah Booking</p>
						</div>
						<div class="icon">
							<i class="ion ion-android-list"></i>
						</div>
					</div>
				</div>
			<?php }
			else{ ?>

				<div class="col-lg-3 col-xs-6">
					<div class="small-box bg-green">
						<div class="inner">
							<h3><?php echo $jumlah_booking ?></h3>

							<p>Jumlah Booking</p>
						</div>
						<div class="icon">
							<i class="ion ion-android-list"></i>
						</div>
					</div>
				</div>

			<?php } ?>
			
		</div>

		<div class="row">
			<div class="col-lg-6">
				
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Dashboard</h3>
					</div>
					<div class="box-body">
						<h3>Selamat Datang !</h3>

						<p id="debug">
							<?php var_dump($cek_data) ?>
						</p>

						<?php

						$code = array();

					    $saldo = "Rp " . number_format($cek_saldo['balance'],0,',','.');

						?>

						<div class="table-responsive">
							<table class="table table-bordered table-hover">
								<tr>
									<th width="%">Nama</th>
									<th width="1px">:</th>
									<td>
										<?php 
										$id_user = $this->session->userdata('id');
										$user = $this->db->query("select * from pengguna where pengguna_id='$id_user'")->row();
										?>
										<p><?php echo $user->pengguna_nama; ?></p>
									</td>
								</tr>
								<tr>
									<th width="20%">Username</th>
									<th width="1px">:</th>
									<td><?php echo $this->session->userdata('username') ?></td>
								</tr>
								<tr>
									<th width="20%">Level</th>
									<th width="1px">:</th>
									<td><?php echo $this->session->userdata('level') ?></td>
								</tr>
								<tr>
									<th width="20%">Status</th>
									<th width="1px">:</th>
									<td>Aktif</td>
								</tr>
								<tr>
									<th width="20%">Saldo Sisa</th>
									<th width="1px">:</th>
									<td><?= $saldo; ?></td>
								</tr>
							</table>
						</div>
					</div>
				</div>

			</div>
			<div class="col-lg-6">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Cek harga</h3>
					</div>

					<div class="table-responsive">
							<table class="table table-bordered table-hover">
								<tr>
									<th width="20%">Pilihan</th>
									<th width="1px">:</th>
									<td>
										<select id="code">
											<option id="0">PLN</option>
											<option id="1">PULSA</option>
										</select>
									</td>
								</tr>
								<tr id="provider">
									<th width="20%">Provider</th>
									<th width="1px">:</th>
									<td>
										<select id="provider_select">
											
										</select>
									</td>
								</tr>
								<tr id="code2">
									<th width="20%">Code</th>
									<th width="1px">:</th>
									<td>
										<select id="code_harga">

										</select>
									</td>
								</tr>
								<tr>
									<th width="20%">Harga</th>
									<th width="1px">:</th>
									<td>
										<span id="harga"></span>
									</td>
								</tr>
								<tr>
									<td rowspan="3">
										<button class="btn btn-success" >Isi Pulsa</button>
									</td>
								</tr>
							</table>
						</div>
					
				</div>
			</div>
		</div>

		

	</section>

</div>

<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
<script>

	$('#provider').hide();
	$('#code2').hide();

	$("#code").on('change', function() {
		var code = $(this).val();
		if (code == 'PULSA') {
			$.ajax({
			data:{id: code},
			url:"<?php echo base_url('index.php/dashboard/cek_code'); ?>",
			type: 'POST',
            dataType: 'json',
			success: function(data){
				let message = data.message;
				content = '';
				$.each(message, function(i, data){
					content += `<option>`+ data.provider +`</option>`
				});
				let provider = $('#provider_select').val();
				let content2 = '';
				$.each(message, function(i, data){
					if (data.provider == provider) {
						content2 += `<option>`+ data.description +`</option>`
					}
				});
				$('#provider_select').html(content);
				$('#code_harga').html(content2);
				$('#provider').show();
				$('#code2').show();
				}
			});
		} else if (code == 'PLN') {
			$.ajax({
			data:{id: code},
			url:"<?php echo base_url('index.php/dashboard/cek_code'); ?>",
			type: 'POST',
            dataType: 'json',
			success: function(data){
				let content = '';
				$.each(data.message , function(i, data){
					content += `<option>`+ data.description +`</option>`
				});
				$('#code_harga').html(content);
				$('#code2').show();
				$('#provider').hide();
				}
			});
		}else{
			$.ajax({
			data:{id: code},
			url:"<?php echo base_url('index.php/dashboard/cek_code'); ?>",
			type: 'POST',
            dataType: 'json',
			success: function(data){
				let code2 = data.message;
				$.each(code2, function(i, data){
					$('#code_harga').append(`<option>`+ data.code +`</option>`);
				});
				$('#code2').show();
				$('#provider').hide();
				}
			});
		}
	});

	$("#provider_select").on('change', function() {
		var code = $('#code').val();
		$.ajax({
			data:{id: code},
			url:"<?php echo base_url('index.php/dashboard/cek_code'); ?>",
			type: 'POST',
            dataType: 'json',
			success: function(data){
				let provider = data.message;
				let provider2 = $('#provider_select').val();
				let content = '';
				$.each(provider, function(i, data){
					if (data.provider == provider2) {
						content += `<option>`+ data.description +`</option>`
					}
				});
				$('#provider').show();
				$('#code_harga').html(content);
				$('#code2').show();
			}
	});
	});


	$("#code_harga").on('change', function() {
		var code = $('#code').val();
		var code_harga = $(this).val();
		$.ajax({
			data:{id: code, id2 : code_harga},
			url:"<?php echo base_url('index.php/dashboard/cek_harga'); ?>",
			type: 'POST',
            dataType: 'json',
			success: function(data){
				let provider = data.message;
				let code = $('#code_harga').val();
				content = '';
				$.each(provider, function(i, data){
					if (data.description == code) {
						content = data.price;
					}
				});
				$('#harga').html(content);
			}
	});
	});

</script>