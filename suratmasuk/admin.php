<?php
require '../database/db.php';
setlocale (LC_TIME, 'IND');

session_start();
if (!isset($_SESSION["user"])) {
  echo "<script>alert('silahkan login dahulu');</script>";
  header("Location: login.php");
  exit;
}else{
  $role = $_SESSION["role"];
  $query = $_SESSION["query"];

}
?>

<!DOCTYPE html>
<html lang="en">

<!-- ======= HEAD ======= -->
  <head>
    <title>Surat Masuk </title>
      <?php require('../layout/head.php')?>
      <link href="../public/css/admin.css" rel="stylesheet">
      <script src="public/js/main.js"></script>
      <script scr="public/js/jquery.min.js"></script>
  </head>
<!-- ======= END HEAD ======= -->


<!-- ======= BODY ======= -->
  <body>
    <!-- ======= HEADER ======= -->
      <?php require('../layout/navbar.php')?>
    <!-- ======= MAIN ======= -->
      <main id="main">
        <!-- ======= BREADCRUMBS1 ======= -->
          <section class="breadcrumbs1">
            <div class="container">

              <div class="d-flex justify-content-between align-items-center">
                <h2><b>Surat Masuk <?=$_SESSION['role'];?></b></h2>
              </div>
            </div>
          </section>
        <!-- ======= END BREADCRUMBS1 ======= -->

        <!-- ======= CONTAINER ======= -->
        <div class="fixlogin">
        <a href="proses-logout.php" style="display: block"><button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin Logout ?')">LOGOUT</button></a>
        </div>
          <div class="containerbox">
            <div class="table-responsive">
              <h3><p class="text-center"><b>BULAN <?= strtoupper(strftime( "%B", time()));?>  <?=date('Y')?> </b></p></h3>
              <div class="table-wrapper">
                <br>
                <div class="row">
                <div class="position-relative">
                  <?php 
                  if($role=='admin'){
                    print
                    '<div class="position-absolute top-0 start-0">
                    <div class="form-group row">
                    <a href="../suratmasuk/tambahsurat.php" style="display: block"><button type="submit" class="btn btn-primary">Tambah Surat</button></a>
                    </div> 
                    </div>';
                  }
                  ?>
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
                      <th style="width:30px;">No</th>
                      <th>No Agenda</th>
                      <th>Tanggal Agenda</th>
                      <th>Tingkat Keamanan</th>
                      <th>Tanggal Surat</th>
                      <th>No Surat</th>
                      <th>Asal Surat</th>
                      <th>Perihal</th>
                      <th>Lampiran</th>
                      <th style="text-align:center;">File</th>
                      <th style="text-align:center;">Disposisi</th>
                      <th style="text-align: center; ">Status Disposisi</th>
                      <?php
                      if($role=='admin'){
                      echo '<th style="text-align:center;" width="120px">Actions</th>';
                        }
                      ?>
                  </tr>
                </thead>
                <tbody id="tampil">
                  <?php
                      $dataPerHal=70;
                      $banyakData=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM surat_masuk $query ORDER BY id DESC"));
                      $banyakHal=ceil($banyakData/$dataPerHal);
                          if(isset($_GET['halaman'])){
                              $halAktif=$_GET['halaman'];
                          }else{
                              $halAktif=1;
                          }

                      $dataawal=($halAktif*$dataPerHal)-$dataPerHal;

                      $jumlahLink = 4;
                      if($halAktif > $jumlahLink){
                        $start_number = $halAktif - $jumlahLink;
                      }else{
                        $start_number = 1;
                      }

                      if($halAktif < ($banyakHal - $jumlahLink)){
                        $end_number = $halAktif + $jumlahLink;
                      }else{
                        $end_number = $banyakHal; 
                      }
                      
            
                          $tampil = mysqli_query($conn,"SELECT * FROM surat_masuk   $query ORDER BY id DESC LIMIT $dataawal, $dataPerHal ");
                    

                      $noUrut = 1;

                      while($data = mysqli_fetch_array($tampil)){

                          $noAgenda=$data['no_agenda'];
                          $tglAgenda=$data['tgl_agenda'];
                          $tk=$data['tk_keamanan'];
                          $tglSurat=$data['tgl_surat'];
                          $noSurat=$data['no_surat'];
                          $asalSurat=$data['asal_surat'];
                          $per=$data['perihal'];
                          $lmpr=$data['lampiran'];
                          $file=$data['file_pdf'];
                          $diteruskan=$data['diteruskan'];

                  ?>
                    <tr>
                    <?php if ($data['catatan'] === null || trim($data['catatan']) === "") { ?>
                    <tr style="background-color:#FFC07C;color:#994F01;">
                    <?php } else { ?>
                    <tr><?php } ?>
                        <td style="width:30px;"><?=$noUrut++?></td>
                        <td><?=$noAgenda?></td>
                        <td><?=$tglAgenda?></td>
                        <td><?=$tk?></td>
                        <td><?=$tglSurat?></td>
                        <td><?=$noSurat?></td>
                        <td><?=$asalSurat?></td>
                        <td><?=$per?></td>
                        <td><?=$lmpr?></td>
                        <?php if ($data['file_pdf'] === null || trim($data['file_pdf']) === "") { ?>
                        <td style="text-align:center;">-</td>
                        <?php } else { ?>
                         <td style="text-align:center;"><a href="<?= "../berkas/" . $data['file_pdf']; ?>" target="_blank">&#x1F4C1;</a></td>
                        <?php } ?>
                        </td>
                        <td style="text-align:center;">
                          <a href="../suratmasuk/cetak_disposisi.php?id=<?=$data['id']?>" target="_blank" class="view"  data-toggle="tooltip"><i class="material-icons">&#xE431;</i></a>
                        </td>
                        <td><?=$diteruskan?></td>
                        <?php
                          $id = $data['id'];
                          if($role=='admin'){
                          echo '
                            <td style="text-align:center;">
                              <a href="../suratmasuk/disposisi.php?id=.$id." target="_blank" class="view"  data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
                              <a href="../suratmasuk/editsurat.php?id=.$id." class="edit"  data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                              <a href="../suratmasuk/delete_masuk.php?id=.$id." class="delete"  data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                            </td>';
                         }
                         ?>
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
    <script>

    $(document).ready(function() {
  
      var roleUser = `<?php echo $_SESSION["role"] ?>` || '';

      load_data('','','');

      function load_data(keyword, pilihTahun, pilihBulan) {
        $('#pagination').empty()
        $.ajax({
          method: "POST",
          url: "search/s-index.php",
          data: {
            keyword: keyword,
            pilihTahun: pilihTahun,
            pilihBulan: pilihBulan,
            role:roleUser

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
  </body>
<!-- ======= END BODY ======= -->

<!-- ======= FOOTER ======= -->
<?php require('../layout/footer.php')?>
<!-- ======= END FOOTER ======= -->

</html>