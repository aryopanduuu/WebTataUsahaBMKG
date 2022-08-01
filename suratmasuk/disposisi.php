<?php
session_start();
// require '../suratmasuk/function.php';
if (isset($_GET['id'])) {
  $id_srt  = $_GET['id'];
} else {
  die("Error. No ID Selected!");
}
include("../suratmasuk/function.php");

$suratmasuk = mysqli_query($conn, "SELECT * FROM surat_masuk WHERE id ='$id_srt'");
$ambil_data = mysqli_fetch_array($suratmasuk);

?>


<!DOCTYPE html>
<html lang="en">

<!-- ======= HEAD ======= -->
  <head>
    <title>SURAT MASUK | DISPOSISI</title>
      <?php require('../layout/head.php')?>
      <link href="../public/css/disposisi.css" rel="stylesheet">
      <script src="public/js/main.js"></script>
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
                <h2><b>SURAT MASUK | DISPOSISI</b></h2>
              </div>
            </div>
          </section>
        <!-- ======= END BREADCRUMBS1 ======= -->

        <!-- ======= Inner Page ======= -->
        <section class="inner-page" style="color:black;">
          <div class="container">
            <br><br>
            <div style="text-align:center" >
              <div class="input-field-border-bottom" style="text-align:left; height:100%;" >
                <br>
                <h3 style="text-align:center"><b>DISPOSISI</b></h3>
                <br><br>
                <form method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-2">
                            <label for="colFormLabel" class="col-sm-12 col-form-label" style="color:black;" >No Agenda</label>
                    </div>
                    <div class="col-sm-10">
                            <label for="colFormLabel" class="col-sm-12 col-form-label" style="color:black;">: <?= $ambil_data['no_agenda'] ?></label>     
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2">
                            <label for="colFormLabel" class="col-sm-12 col-form-label" style="color:black;">Tk. Keamanan</label>
                    </div>
                    <div class="col-sm-10">
                            <label for="colFormLabel" class="col-sm-12 col-form-label" style="color:black;">: <?= $ambil_data['tk_keamanan'] ?></label>     
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2">
                            <label for="colFormLabel" class="col-sm-12 col-form-label" style="color:black;">Tanggal Terima</label>
                    </div>
                    <div class="col-sm-10">
                            <label for="colFormLabel" class="col-sm-12 col-form-label" style="color:black;">: <?= tanggal_indo($ambil_data['tgl_agenda']) ?></label>    
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2">
                            <label for="colFormLabel" class="col-sm-12 col-form-label" style="color:black;">Nomor Surat</label>
                    </div>
                    <div class="col-sm-10">
                            <label for="colFormLabel" class="col-sm-12 col-form-label" style="color:black;">: <?= $ambil_data['no_surat'] ?></label>     
                    </div>  
                </div>
                <div class="row">
                    <div class="col-sm-2">
                            <label for="colFormLabel" class="col-sm-12 col-form-label" style="color:black;">Tanggal Surat</label>
                    </div>
                    <div class="col-sm-10">
                            <label for="colFormLabel" class="col-sm-12 col-form-label" style="color:black;">: <?= tanggal_indo($ambil_data['tgl_surat']) ?></label>     
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2">
                            <label for="colFormLabel" class="col-sm-12 col-form-label" style="color:black;">Asal Surat</label>
                    </div>
                    <div class="col-sm-10">
                            <label for="colFormLabel" class="col-sm-12 col-form-label" style="color:black;">: <?= $ambil_data['asal_surat'] ?></label>     
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2">
                            <label for="colFormLabel" class="col-sm-12 col-form-label" style="color:black;">Perihal</label>
                    </div>
                    <div class="col-sm-10">
                            <label for="colFormLabel" class="col-sm-12 col-form-label" style="color:black;">: <?= $ambil_data['perihal'] ?></label>     
                    </div>
                </div>
                <br><hr width="100%">
                <?php 
                $getditeruskan = explode(',', $ambil_data['diteruskan']);
                $getpilihan = explode(',', $ambil_data['pilihan']);
                $getopsi = explode(',', $ambil_data['opsi']);
                ?>
                
                <div class="header text-center">
                    <div class="header1 font-weight-bold">
                            <label for="colFormLabel"  class="col-sm-12 col-form-label" style="color:black;"><h5><b>Diteruskan Kepada Yth:</b></h5></label>
                    </div><br>
                </div>
                <div class="row" style="color:black;">
                <br><br>
                  <div class="col-sm-2">
                              <div class="form-check form-check-primary position-absolute top-0 start-0">
                                <label class="form-check-label" style="color:black;">
                                  <input type="checkbox" class="form-check-input" value="kstu" name="diteruskan[]" <?php if (in_array('kstu',$getditeruskan)) {echo "checked";}else {echo "";}?> > Kasubag tata usaha </label>
                              </div>
                  </div>
                  <div class="col-sm-2">
                              <div class="form-check form-check-primary position-absolute top-0 start-45 end-0">
                                <label class="form-check-label" style="color:black;">
                                  <input type="checkbox" class="form-check-input" name="diteruskan[]" value="kdat" <?php if (in_array('kdat',$getditeruskan)) {echo "checked";}else {echo "";}?>> KoorBid Datin </label>
                              </div>
                  </div>
                  <div class="col-sm-3">
                              <div class="form-check form-check-primary position-absolute top-0 start-150 end-0">
                                <label class="form-check-label" style="color:black;">
                                  <input type="checkbox" class="form-check-input" name="diteruskan[]" value="kobs" <?php if (in_array('kobs',$getditeruskan)) {echo "checked";}else {echo "";}?>> KoorBid Observasi </label>
                              </div>
                  </div>
                  <div class="col-sm-2">
                              <div class="form-check form-check-primary position-absolute top-0 start-75 end-0">
                                <label class="form-check-label" style="color:black;">
                                  <input type="checkbox" class="form-check-input" name="diteruskan[]" value="ppk" <?php if (in_array('ppk',$getditeruskan)) {echo "checked";}else {echo "";}?>> PPK </label>
                              </div>
                  </div>
                  <div class="col-sm-2">
                              <div class="form-check form-check-primary position-absolute top-0 start-75 end-0">
                                <label class="form-check-label" style="color:black;">
                                  <input type="checkbox" class="form-check-input" name="diteruskan[]" value="lainnya"<?php if (in_array('lainnya',$getditeruskan)) {echo "checked";}else {echo "";}?>> Lainnya </label>
                              </div>
                  </div>
                  
                  <br>
                  <br>
                  <hr>
                
                <div class="row" style="color:black;">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-1">
                </div>    
                <div class="col-sm-2">
                              <div class="form-check form-check-primary position-absolute top-0 start-75 end-0">
                                <label class="form-check-label" style="color:black;">
                                <input type="checkbox" class="form-check-input" name ="pilihan[]" value="TL"/><h5 class="card-title" <?php if (in_array('TL',$getpilihan)) {echo "checked";}else {echo "";}?>><b>Tindak Lanjut</b></h5></label>
                              </div>
                </div>  

                  <div class="col-sm-2">
                              <div class="form-check form-check-primary position-absolute top-0 start-100 end-0">
                                <label class="form-check-label" style="color:black;">
                                <input type="checkbox" class="form-check-input" name="pilihan[]" value="diketahui"/><h5 class="card-title" <?php if (in_array('diketahui',$getpilihan)) {echo "checked";}else {echo "";}?>><b>Diketahui</b></h5></label>
                              </div>
                  </div>
                  
                </div>
                <br>
                <hr>


                <div class="row" style="color:black;">
                  <div class="col-md-3"><br>
                      <div class="form-group">
                        <div class="form-check">
                          <label class="form-check-label" style="color:black;">
                            <input type="checkbox" class="form-check-input" name="opsi[]" value="mewakil" <?php if (in_array('mewakili',$getopsi)) {echo "checked";}else {echo "";}?>> Harap Mewakili </label>
                        </div>
                        <div class="form-check">
                          <label class="form-check-label" style="color:black;">
                            <input type="checkbox" class="form-check-input" name="opsi[]" value="mendampingi" <?php if (in_array('mendampingi',$getopsi)) {echo "checked";}else {echo "";}?>> Hadir Mendampingi </label>
                        </div>
                        <div class="form-check">
                          <label class="form-check-label" style="color:black;">
                            <input type="checkbox" class="form-check-input" name="opsi[]" value="tindaklanjut"  <?php if (in_array('tindaklanjut',$getopsi)) {echo "checked";}else {echo "";}?>> Segera DitindakLanjuti </label>
                        </div>
                        <div class="form-check">
                          <label class="form-check-label" style="color:black;">
                            <input type="checkbox" class="form-check-input" name="opsi[]" value="tanggapan" <?php if (in_array('tanggapan',$getopsi)) {echo "checked";}else {echo "";}?>> Mohon Tanggapan/saran/masukan </label>
                        </div>
                        <div class="form-check">
                          <label class="form-check-label" style="color:black;">
                            <input type="checkbox" class="form-check-input" name="opsi[]" value="fasilitas" <?php if (in_array('fasilitas',$getopsi)) {echo "checked";}else {echo "";}?>> Fasilitasi sesuai Ketentuan Berlaku </label>
                        </div>
                      </div>
                  </div>
                  <div class="col-md-3"><br>
                    <div class="form-group">
                      <div class="form-check">
                        <label class="form-check-label" style="color:black;">
                          <input type="checkbox" class="form-check-input" name="opsi[]" value="konsultasi" <?php if (in_array('konsultasi',$getopsi)) {echo "checked";}else {echo "";}?>> Dikonsultasikan dengan </label>
                      </div>
                      <div class="form-check">
                        <label class="form-check-label" style="color:black;">
                          <input type="checkbox" class="form-check-input" name="opsi[]" value="jawaban" <?php if (in_array('jawaban',$getopsi)) {echo "checked";}else {echo "";}?>> Dibuat Surat Jawaban </label>
                      </div>
                      <div class="form-check">
                        <label class="form-check-label" style="color:black;">
                          <input type="checkbox" class="form-check-input" name="opsi[]" value="monitoring" <?php if (in_array('monitoring',$getopsi)) {echo "checked";}else {echo "";}?>> Bahan Monitoring </label>
                      </div>
                      <div class="form-check">
                        <label class="form-check-label" style="color:black;">
                          <input type="checkbox" class="form-check-input" name="opsi[]" value="edaran" <?php if (in_array('edaran',$getopsi)) {echo "checked";}else {echo "";}?>> Buat Surat Edaran </label>
                      </div>
                      <div class="form-check">
                        <label class="form-check-label" style="color:black;">
                          <input type="checkbox" class="form-check-input" name="opsi[]" value="tugas" <?php if (in_array('tugas',$getopsi)) {echo "checked";}else {echo "";}?>> Untuk Dibuat Surat Tugas </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3"><br>
                    <div class="form-group">
                      <div class="form-check">
                        <label class="form-check-label" style="color:black;">
                          <input type="checkbox" class="form-check-input" name="opsi[]" value="diteruskan" <?php if (in_array('diteruskan',$getopsi)) {echo "checked";}else {echo "";}?>> Untuk Diteruskan </label>
                      </div>
                      <div class="form-check">
                        <label class="form-check-label" style="color:black;">
                          <input type="checkbox" class="form-check-input" name="opsi[]" value="diselesaikan" <?php if (in_array('diselesaikan',$getopsi)) {echo "checked";}else {echo "";}?>> Untuk diselesaikan </label>
                      </div>
                      <div class="form-check">
                        <label class="form-check-label" style="color:black;">
                          <input type="checkbox" class="form-check-input" name="opsi[]" value="dipelajari" <?php if (in_array('dipelajari',$getopsi)) {echo "checked";}else {echo "";}?>> Untuk dipelajari </label>
                      </div>
                      <div class="form-check">
                        <label class="form-check-label" style="color:black;">
                          <input type="checkbox" class="form-check-input" name="opsi[]" value="diketahui" <?php if (in_array('diketahui',$getopsi)) {echo "checked";}else {echo "";}?>> Untuk diketahui </label>
                      </div>
                      <div class="form-check">
                        <label class="form-check-label" style="color:black;">
                          <input type="checkbox" class="form-check-input" name="opsi[]" value="direkap" <?php if (in_array('direkap',$getopsi)) {echo "checked";}else {echo "";}?>> Untuk direkap </label>
                      </div>
                  </div>
                  </div>
                  <div class="col-md-3"><br>
                    <div class="form-group">
                      <div class="form-check">
                        <label class="form-check-label" style="color:black;">
                          <input type="checkbox" class="form-check-input" name="opsi[]"value="monitor" <?php if (in_array('monitor',$getopsi)) {echo "checked";}else {echo "";}?>> Untuk dimonitor </label>
                      </div>
                      <div class="form-check">
                        <label class="form-check-label" style="color:black;">
                          <input type="checkbox" class="form-check-input" name="opsi[]" value="masukan" <?php if (in_array('masukan',$getopsi)) {echo "checked";}else {echo "";}?>> Untuk dijadikan bahan masukan </label>
                      </div>
                      <div class="form-check">
                        <label class="form-check-label" style="color:black;">
                          <input type="checkbox" class="form-check-input" name="opsi[]" value="diskusi" <?php if (in_array('diskusi',$getopsi)) {echo "checked";}else {echo "";}?>> Untuk didiskusikan dengan </label>
                      </div>
                      <div class="form-check">
                        <label class="form-check-label" style="color:black;">
                          <input type="checkbox" class="form-check-input" name="opsi[]"value="koordinasi" <?php if (in_array('koordinasi',$getopsi)) {echo "checked";}else {echo "";}?>> Untuk dikoordinasikan dengan </label>
                      </div>
                      <div class="form-check">
                        <label class="form-check-label" style="color:black;">
                          <input type="checkbox" class="form-check-input" name="opsi[]" value="diarsipkan"<?php if (in_array('diarsipkan',$getopsi)) {echo "checked";}else {echo "";}?>> Untuk diarsipkan </label>
                      </div>
                    </div>
                  </div>
                  </div>
                <div class="row" style="color:black;">
                  <div class="col-md-3">
                    <div class="form-group">
                  </div>
                  </div>
                  </div>
                  <hr>
                  <div class="header">
                  <div class="header1 font-weight-bold">
                          <label for="colFormLabel"  class="col-sm-12 col-form-label" style="color:black;" ><h5><b>Catatan</b></h5></label>
                  </div>
                </div> 
                        <div class="form-group row">
                          <div class="col-sm-12">
                            <textarea
                              class="form-control"
                              id="exampleTextarea1"
                              rows="5" name="catatan"
                              required
                            ><?= $ambil_data['catatan'] ?></textarea>
                          </div>
                        </div><br><br>

                <!-- ======= VIEW PDF ======= -->
                <div class="iframe-container">
                    <!--belum bisa manggil, hny contoh-->
                    <iframe src="<?= "../berkas/" . $ambil_data['file_pdf']; ?>" width="1000px" height="500px" style="text-align:center;"></iframe>
                </div>

                <br><br>
                  <br>
                  <div style="text-align:right;">
                  <button class="btn btn-warning"style="color:#fff" onclick="openDialog()"><a href="../suratmasuk/kepala.php"style="color:white;">Cancel</a></button>
                  <script>
                    function openDialog() {
                      let customMsg = "CANCEL DISPOSISI";
                      if (confirm(customMsg)) {
                        console.log("User clicked YES");
                      } else {
                        console.log("User Clicked NO");
                      }
                    }
                  </script>
                  <button type="submit" name="kirim" class="btn btn-primary me-2"> Disposisi  </button>
                </div>
                </div>
              </form>

        </div>

              <?php
        if (isset($_POST['kirim'])) {
          $id_dis  = $_GET['id'];
          $diteruskan = implode(",", $_POST['diteruskan']);
          $pilihan = implode(",", $_POST['pilihan']);
          $opsi = implode(",", $_POST['opsi']);
          $catatan = $_POST['catatan'];
  
          $query = ("update surat_masuk set diteruskan='$diteruskan', pilihan='$pilihan', opsi='$opsi', catatan='$catatan' where id='$id_dis'");
          mysqli_query($conn, $query);
          if ($query) {
            echo "<script>alert( 'disposisi berhasil diinput!' );</script>";
            echo "<script>location = 'admin.php';</script>";
           } 
        }
       ?>
                </form>
                </div><br><br>
              </div>
            </div>
          </div>
        </section>
    <!-- ======= End Inner Page ======= -->

      </main>
    <!-- ======= END MAIN ======= -->
  </body>
<!-- ======= END BODY ======= -->


<!-- ======= FOOTER ======= -->
<?php require('../layout/footer.php')?>
<!-- ======= END FOOTER ======= -->

</html>