<!--/ Intro Skew Star /-->


<?php

function rupiah($angka){

  if ($angka > 0) {
    $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
    return $hasil_rupiah;
  } else {
    return 'Gratis!';
  } 
}

$user = $user = $this->session->userdata('id');

 ?>

<div class="intro intro-single route bg-image" style="background-image: url(img/overlay-bg.jpg)">
  <div class="overlay-mf"></div>
  <div class="intro-content display-table">
    <div class="table-cell">
      <div class="container">
        <h2 class="intro-title mb-4">Event</h2>
        <ol class="breadcrumb d-flex justify-content-center">
          <li class="breadcrumb-item">
            <a href="<?php echo base_url(); ?>">Home</a>
          </li>
          <li class="breadcrumb-item">
            <a href="<?php echo base_url('blog'); ?>">Event</a>
          </li>
          <li class="breadcrumb-item active"><?= $judul; ?></li>
        </ol>
      </div>
    </div>
  </div>
</div>
<!--/ Intro Skew End /-->

<!--/ Section Blog-Single Star /-->

<section class="blog-wrapper sect-pt4" id="blog">
  <div class="container">
    <div class="row">
      <div class="col-md-8">

        <?php if(count($event) == 0){ ?>
          <center>
            <h3 class="mt-5">event Tidak Ditemukan.</h3>
          </center>
        <?php } ?>

        <?php foreach($event as $a){ ?>

          <div class="post-box">
            <div class="post-thumb text-center">
              <?php if($a->event_sampul != ""){ ?>
                <img style="min-height: 200px; max-height: 400px;" src="<?php echo base_url(); ?>gambar/event/<?php echo $a->event_sampul ?>" alt="<?php echo $a->event_judul ?>" class="img-fluid">
              <?php } ?>
            </div>
            <div class="post-meta">
              <div class="row">
                <div class="col-md-8">
                  <h1 class="article-title"><?php echo $a->event_judul ?></h1>
                </div>
                <div class="col-md-4"> 
                  <button type="button" id="booking" class="btn btn-success float-right">Booking!</button>
                </div>
              </div>
              <ul>
                <li>
                  <span class="ion-ios-person"></span>
                  <a href="#"><?php echo $a->pengguna_nama ?></a>
                </li>
                <li>
                  <span class="ion-pricetag"></span>
                  <a href="#"><?php echo $a->kategori_nama ?></a>
                </li>
              </ul>
            </div>

            <div class="container card card-no-border">
              <div class="card-body">
                <div class="row">
                  <table class="col-md-6">
                    <tbody>
                      <tr>
                        <th scope="row" style="width: 50%">Tempat</th>
                        <td style="width: 5%">:</td>
                        <td style="width: 45%"><?= $a->event_tempat?></td>
                      </tr>
                      <tr>
                        <th scope="row" style="width: 50%">Harga</th>
                        <td style="width: 5%">:</td>
                        <td style="width: 45%"><?= rupiah($a->event_harga) ?></td>
                      </tr>
                      <tr>
                        <th scope="row" style="width: 50%">Tanggal Event</th>
                        <td style="width: 5%">:</td>
                        <td style="width: 45%">
                          <?php 
                            $mysqlDateTime = $a->event_dimulai;
                            list($date, $time) = explode(" ", $mysqlDateTime);

                            echo date("l, d-m-Y", strtotime($mysqlDateTime));

                            $date2 = strtotime($mysqlDateTime);
                            $remaining = $date2 - time();
                            $days_remaining = floor($remaining / 86400);
                            $hours_remaining = floor(($remaining % 86400) / 3600);

                          ?>                       
                          </td>
                      </tr>
                    </tbody>
                  </table>
                  <table class="col-md-6">
                    <tbody>
                      <tr>
                        <th scope="row" style="width: 50%">Jam</th>
                        <td style="width: 5%">:</td>
                        <td style="width: 45%"><?= date("H:i", strtotime($time)); ?></td>
                      </tr>
                      <tr>
                        <th scope="row" style="width: 50%">Kontak Person</th>
                        <td style="width: 5%">:</td>
                        <td style="width: 45%"><?= $a->event_kontak?></td>
                      </tr>
                      <tr>
                        <th scope="row" style="width: 50%">Keterangan</th>
                        <td style="width: 5%">:</td>
                        <td style="width: 45%"><?php echo "Tinggal $days_remaining hari dan $hours_remaining jam tersisa";; ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <form action="<?= base_url(); ?>welcome/booking" method="post">

            <input type="hidden" name="har" id="har" value="<?= $a->event_harga; ?>">

            <input type="hidden" name="jumlah" value="1" id="jumlah">
            <input type="hidden" name="event_id" value="<?php echo $a->event_id?>">
            <input type="hidden" name="event_nama" value="<?php echo $a->event_judul?>">
            <input type="hidden" name="harga" id="harga" value="<?php echo $a->event_harga?>">
            <input type="hidden" name="tanggal_m" value="<?php echo $a->event_dimulai?>">
            <input type="hidden" id="pembeli" name="pembeli" value="<?= $this->session->userdata('id'); ?>">

            <input type="submit" value="booking!" id="booking2" class="btn btn-primary" />

            <br>


            <div class="article-content">
              <?php echo $a->event_konten ?>
            </div>
          </div>
        <?php } ?>
      </div>

      <div class="col-md-4">
        <?php $this->load->view('frontend/v_sidebar'); ?>
      </div>
    </div>
  </div>
</section>
  <!--/ Section Blog-Single End /-->


<script>
  $('#booking2').hide()

  $("#booking").click(function(e){
    let user = $("#pembeli").val();

    if (user > 0) {
        Swal.fire({
          title: 'Apakah anda yakin?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, Booking sekarang!'
        }).then((result) => {
            Swal.fire({
            title: 'Berapa tiket yang akan dibeli ?',
            input: 'number',
            inputValue: 1,
            inputAttributes: {
              min: 1,
              max: 5
            }
          }).then(function(result) {
            if (result.value) {
              const amount = result.value;
              const harga = $("#har").val();
              const total = amount * harga;
              Swal.fire({
                title: 'Apakah anda yakin?',
                text: 'Rp. '+ total +', jumlah tiket '+ amount +'',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Booking!'
              }).then((result) => {
                if (result.value) {
                  $('#harga').val(total);
                  $('#jumlah').val(amount);
                  Swal.fire(
                    'Booked!',
                    'Sudah dipesan, lanjutkan pembayaran.',
                    'success'
                  )
                  $("#booking2").click();
                }
              })    
            }
          })
        })         
    }else{
      Swal.fire({
          title: 'Apakah anda sudah punya akun?',
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: "Sudah!",
          cancelButtonText: "Belum!"   
        }).then((result) => {
          if (result.value) {
            document.location.href = "login";
          }else{
            document.location.href = "login/register";
          }
        })     
    }    
  });
    
</script>

