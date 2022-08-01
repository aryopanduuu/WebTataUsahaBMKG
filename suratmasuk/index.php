<?php
require '../database/db.php';
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<!-- ======= HEAD ======= -->

<head>
  <title>TATA USAHA | SURAT MASUK</title>
  <?php require('../layout/head.php') ?>
  <link href="../public/css/indexsuratmasuk.css" rel="stylesheet">
  <script src="public/js/main.js"></script>
  <script scr="public/js/jquery.min.js"></script>
</head>
<!-- ======= END HEAD ======= -->


<!-- ======= BODY ======= -->

<body>
  <!-- ======= HEADER ======= -->
  <?php require('../layout/navbar.php') ?>
  <!-- ======= MAIN ======= -->
  <main id="main">
    <!-- ======= BREADCRUMBS1 ======= -->
    <section class="breadcrumbs1">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2><b>TATA USAHA | SURAT MASUK</b></h2>
        </div>
      </div>
    </section>
    <!-- ======= END BREADCRUMBS1 ======= -->

    <!-- ======= CONTAINER ======= -->
    <div class="containerbox">
      <div class="table-responsive">
        <h3><p class="text-center"><b>BULAN <?= strtoupper(strftime( "%B", time()));?>  <?=date('Y')?> </b></p></h3>
        <div class="table-wrapper">
          <br>
          <div class="row">
            <div class="position-relative">
              <div class="position-absolute top-0 start-0">
                <div class="form-group row">
                  <div class="col-sm-4">
                    <a href="../suratmasuk/login.php" style="display: block"><button type="submit" class="btn btn-info">LOGIN</button></a>
                  </div>
                </div>
              </div>
              <div class="position-absolute top-0 end-0">
                <div class="input-group">
                  <input type="text" name="keyword" size="40" placeholder="Masukkan kata pencarian" autocomplete="off" id="keyword">
                  <p>&ensp;&ensp;</p>
                  <select name="pilihTahun" id="pilihTahun">
                    <option value=''>Pilih Tahun</option>
                    <?php
                    $sql = "SELECT YEAR(tgl_agenda) FROM `surat_masuk` GROUP BY YEAR(tgl_agenda)";
                    $hasil = mysqli_query($conn, $sql);
                    while ($data = mysqli_fetch_array($hasil)) :
                    ?>
                      <option value="<?= $data[0]; ?>"><?= $data[0]; ?></option>
                    <?php endwhile; ?>
                  </select>
                  <p>&ensp;&ensp;</p>
                  <select name="pilihBulan" id="pilihBulan">
                  <option value=''>Pilih Bulan</option>
                    <?php
                    $sql = "SELECT MONTH(tgl_agenda) FROM `surat_masuk` GROUP BY MONTH(tgl_agenda)";
                    $hasil = mysqli_query($conn, $sql);
                    while ($data = mysqli_fetch_array($hasil)) :
                    ?>
                      <option value="<?= $data[0]; ?>"><?= $data[0]; ?></option>
                    <?php endwhile; ?>
                  </select>
                  <p>&ensp;&ensp;</p>
                  <a href="../suratmasuk/excel.php" style="display: block"><button type="submit" class="btn btn-primary">Export to Excel</button></a>
                </div>
              </div>
            </div>
            <br><br>
          </div>
        </div>
        <table class="table table-striped table-hover table-bordered">
          <thead>
            <tr>
              <th width="10px">No</th>
              <th width="10px">No Agenda</th>
              <th>Tanggal Agenda</th>
              <th>Tingkat Keamanan</th>
              <th>Tanggal Surat</th>
              <th width="10px">No Surat</th>
              <th>Asal Surat</th>
              <th>Perihal</th>
              <th>Lampiran</th>
              <th style="text-align: center; ">File</th>
              <th style="text-align: center; ">Disposisi</th>

            </tr>
          </thead>
          <tbody id="tampil">
            <?php
            $dataPerHal = 70;
            $banyakData = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM surat_masuk ORDER BY id DESC"));
            $banyakHal = ceil($banyakData / $dataPerHal);
            if (isset($_GET['halaman'])) {
              $halAktif = $_GET['halaman'];
            } else {
              $halAktif = 1;
            }

            $dataawal = ($halAktif * $dataPerHal) - $dataPerHal;

            $jumlahLink = 4;
            if ($halAktif > $jumlahLink) {
              $start_number = $halAktif - $jumlahLink;
            } else {
              $start_number = 1;
            }

            if ($halAktif < ($banyakHal - $jumlahLink)) {
              $end_number = $halAktif + $jumlahLink;
            } else {
              $end_number = $banyakHal;
            }

            
              $tampil = mysqli_query($conn, "SELECT * FROM surat_masuk ORDER BY id DESC LIMIT $dataawal, $dataPerHal ");
            

            $noUrut = 1;

            while ($data = mysqli_fetch_array($tampil)) {

              $noAgenda = $data['no_agenda'];
              $tglAgenda = $data['tgl_agenda'];
              $tk = $data['tk_keamanan'];
              $tglSurat = $data['tgl_surat'];
              $noSurat = $data['no_surat'];
              $asalSurat = $data['asal_surat'];
              $per = $data['perihal'];
              $lam = $data['lampiran'];
              $file = $data['file_pdf'];
            ?>
              <tr>
                <?php if ($data['catatan'] === null || trim($data['catatan']) === "") { ?>
              <tr style="background-color:#FFC07C;color:#994F01;">
              <?php } else { ?>
              <tr><?php } ?>
              <td><?= $noUrut++ ?></td>
              <td><?= $noAgenda ?></td>
              <td><?= $tglAgenda ?></td>
              <td><?= $tk ?></td>
              <td><?= $tglSurat ?></td>
              <td><?= $noSurat ?></td>
              <td> <?= $asalSurat ?></td>
              <td><?= $per ?></td>
              <td><?= $lam ?></td>
              <?php if ($data['file_pdf'] === null || trim($data['file_pdf']) === "") { ?>
                <td style="text-align: center; ">-</td>
              <?php } else { ?>
                <td style="text-align: center; "><a href="<?= "../berkas/" . $data['file_pdf']; ?>" target="_blank">&#x1F4C1;</a></td>
              <?php } ?>
              </td>
              <td style="text-align: center; ">
                <a href="../suratmasuk/cetak_disposisi.php?id=<?= $data['id'] ?>" target="_blank" class="view"><i class="material-icons">&#xE431;</i></a>
              </td>
              </tr>
            <?php
            };
            ?>
          </tbody>
        </table>
        <nav>
          <ul class="pagination justify-content-center" id='pagination'>
            <!-- ============Previous============ -->
            <?php
            if ($halAktif <= 1) {
            ?>
              <li class="page-item disabled"><a href="?halaman=<?php echo $halAktif - 1; ?>" class="page-link">Previous</a></li>
            <?php
            } else { ?>
              <li class="page-item"><a href="?halaman=<?php echo $halAktif - 1; ?>" class="page-link">Previous</a></li>
            <?php
            }
            ?>
            <!-- ==============end Previous=============== -->

            <?php for ($i = $start_number; $i <= $end_number; $i++) {
            ?>
              <li class="pge-item"><a href="?halaman=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a></li>
            <?php
            } //end for
            ?>

            <!-- ============Next============ -->
            <?php
            if ($halAktif >= $banyakHal) {
            ?>
              <li class="page-item disabled"><a href="?halaman=<?php echo $halAktif + 1; ?>" class="page-link">Next</a></li>
            <?php
            } else { ?>
              <li class="page-item"><a href="?halaman=<?php echo $halAktif + 1; ?>" class="page-link">Next</a></li>
            <?php
            }
            ?>
            <!-- ==============end Next=============== -->
          </ul>
        </nav>
      </div>
    </div>
    <!-- ======= END CONTAINER ======= -->
  </main>
  <!-- ======= END MAIN ======= -->

  <!-- ======= Live Search =======-->
  <!-- <script>
      $(document).ready(function(){
        $("#keyword").keyup(function(){
          $.ajax({
            type: 'POST',
            url: 'search/s-index.php',
            data: {
              keyword: $(this).val()
            },
            cache: false,
            success: function(data){
              $("#tampil").html(data);
            }
        });
        });
      });
    </script> -->
  <script>
    $(document).ready(function() {
      // load_data('','','');
      var role = 'public';
      function load_data(keyword, pilihTahun, pilihBulan) {
        $('#pagination').empty()
        $.ajax({
          method: "POST",
          url: "search/s-index.php",
          data: {
            keyword: keyword,
            pilihTahun: pilihTahun,
            pilihBulan: pilihBulan,
            role:'public'
          },
          success: function(data) {
            $('#tampil').html(data);
          }
        });
      }
      $('#keyword').keyup(function() {
        var keyword = $("#keyword").val();
        var pilihTahun = $("#pilihTahun").val();
        var pilihBulan = $("#pilihBulan").val();
        load_data(keyword, pilihTahun, pilihBulan);
      });
      $('#pilihTahun').change(function() {
        console.log('ok')
        var keyword = $("#keyword").val();
        var pilihTahun = $("#pilihTahun").val();
        var pilihBulan = $("#pilihBulan").val();
        load_data(keyword, pilihTahun, pilihBulan);
      });
      $('#pilihBulan').change(function() {
        console.log('ok')
        var keyword = $("#keyword").val();
        var pilihTahun = $("#pilihTahun").val();
        var pilihBulan = $("#pilihBulan").val();
        load_data(keyword, pilihTahun, pilihBulan);
      });

    });
  </script>
  <!-- ======= Tahun Live Search =======-->

</body>
<!-- ======= END BODY ======= -->

<!-- ======= FOOTER ======= -->
<?php require('../layout/footer.php') ?>
<!-- ======= END FOOTER ======= -->

</html>