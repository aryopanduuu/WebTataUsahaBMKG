<?php
session_start();

require '../suratmasuk/function.php';
// if (!isset($_SESSION["login"])) {
//     echo "<script>alert('silahkan login dahulu');</script>";
//     echo "<script>location='login.php';</script>";
//   }
//ambil data di URL
$id = $_GET["id"];
//query data mahasiswa
$mhs = query("SELECT * FROM surat_masuk WHERE id = $id")[0];


//cek apakah tombol submit ditekan atau belum
if (isset($_POST["edit"])) {
    // var_dump($_POST);
    //cek apaah data berhasil di ubah atau tidak

    if (ubah($_POST) > 0) {
        echo "
            <script>
                alert('data berhasil ubah');
                document.location.href = '../suratmasuk/admin.php';
            </script>
                ";
    } else {
        echo "
            <script>
                alert('data gagal ubah!!!');
                document.location.href = '../suratmasuk/editsurat.php';
            </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<!--HEAD-->
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Edit | Surat Masuk</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../public/img/logo.png" rel="icon">
  <link href="../public/img/logo.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- vendors CSS Files -->
  <link href="../public/vendors/aos/aos.css" rel="stylesheet">
  <link href="../public/vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../public/vendors/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../public/vendors/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../public/vendors/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../public/vendors/remixicon/remixicon.css" rel="stylesheet">
  <link href="../public/vendors/swiper/swiper-bundle.min.css" rel="stylesheet">
  
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="shortcut icon" href="public/img/logo.png" />
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

  <!-- Main CSS File -->
  <link href="../public/css/editsurat.css" rel="stylesheet">
</head>
<!--END HEAD-->

<script>
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
}); 
</script>

<!--BODY-->
<body>
  <!-- ======= Header1 ======= -->
  <header id="header1" class="fixed-top header1-inner-pages">
    <div class="container d-flex align-items-center justify-content-lg-between">
      <h1 class="logo me-auto me-lg-0"><a href="../index.php"><img src="../public/img/logo.png" style="width:40px;height:40px;"> BMKG <span>JUANDA</span></a></h1>
        <nav id="navbar1" class="navbar1 order-last order-lg-0">
          <ul>
            <li><a class="nav-link" href="../index.php">Home</a></li>
            <li class="dropdown"><a href="#"><span>Surat</span> <i class="bi bi-chevron-down"></i></a>
              <ul>
                <li><a href="../suratmasuk/login.php">Surat Masuk</a></li>
                <li><a href="../suratmasuk/login.php">Surat Keluar</a></li>
              </ul>
            <li class="dropdown"><a href="#"><span>SPT</span> <i class="bi bi-chevron-down"></i></a>
              <ul>
                <li><a href="sptjam.php">SPT Jam</a></li>
                <li><a href="sptharian.php">SPT Harian</a></li>
              </ul>
            </li>
            <li><a class="nav-link" href="https://juanda.jatim.bmkg.go.id/tata-usaha/usulan/login.php">Usulan</a></li>
            <li><a class="nav-link scrollto" href="https://juanda.jatim.bmkg.go.id/tata-usaha/cuti/index.php">Pengajuan Cuti</a></li>
            <li><a class="nav-link scrollto" href="https://docs.google.com/forms/d/1FFw69b9mUdI0VTd5VBa_yvCi5DoXNtH66P3r12tjrXE/viewform?edit_requested=true">IP ASN</a></li>
          </ul>
          <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
    </div>
  </header>
  <!-- ======= End Header ======= -->



  <!-- ======= Main ======= -->
  <main id="main">
    <!-- ======= breadcrumbs1 ======= -->
    <section class="breadcrumbs1">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2><b>Surat Masuk | Edit Surat</b></h2>
        </div>
      </div>
    </section>
    <!-- ======= End breadcrumbs1 ======= -->

    <div class="containerbox">
    <div class="table-responsive">
        <div class="table-wrapper">
        <div class="row">
                <div class="col-sm-12">
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-12 col-form-label">No Agenda Sebelumnya : </label>
                    </div>
                </div>
            </div>
            <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $mhs["id"]; ?>">
            <input type="hidden" name="pdfLama" value="<?= $mhs["file_pdf"]; ?>">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">No Agenda Sekarang</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" name="no_agenda" id="no_agenda" placeholder=""value="<?= $mhs["no_agenda"]; ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">No Surat</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" name="no_surat" id="no_surat" placeholder=""value="<?= $mhs["no_surat"]; ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-4 col-form-label">Tanggal Agenda</label>
                        <div class="col-sm-7">
                        <input type="date" class="form-control" name="tgl_agenda" id="tgl_agenda" placeholder="">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-3 col-form-label">Tanggal Surat</label>
                        <div class="col-sm-7">
                        <input type="date" class="form-control" name="tgl_surat" id="tgl_surat" placeholder=""value="<?= $mhs["tgl_surat"]; ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Asal Surat</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" name="asal_surat" id="asal_surat" placeholder=""value="<?= $mhs["asal_surat"]; ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Perihal</label>
                        <div class="col-sm-9">
                        <textarea
                            class="form-control"
                            id="exampleTextarea1" name="perihal"
                            rows="4"required><?= $mhs["perihal"];?>
                          </textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" name="status_surat" id="status_surat" placeholder=""value="<?= $mhs["status_surat"]; ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-4 col-form-label" for="inlineFormCustomSelect">Tingkat Keamanan</label>
                        <div class="col-sm-7">
                        <select class="custom-select mr-sm-2" name="tk_keamanan" id="inlineFormCustomSelect"value="<?= $mhs["tk_keamanan"]; ?>">
                            <option selected>-</option>
                            <option value="Biasa">Biasa</option>
                            <option value="Penting">Penting</option>
                            <option value="Segera">Segera</option>
                        </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-3 col-form-label">Lampiran</label>
                        <div class="col-sm-7">
                        <input type="text" class="form-control" name="lampiran" id="colFormLabel" placeholder=""value="<?= $mhs["lampiran"]; ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Dokumen </label>
                        <div class="col-sm-9">
                        <div class="custom-file">
                            <div><?= $mhs["file_pdf"]; ?></div>
                            <input type="file" class="form-control" name="file_pdf" id="formFile" placeholder="" src="file_pdf" value="<?= $mhs["file_pdf"]; ?>">
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="form-group row">
                <div class="col-sm-12">
                <button class="btn btn-primary" name="edit">Edit Surat</button>
                </div>
            </div>
            </form>
        </div>
    </div>  
</div>   
</body>
</div>   

    <!-- ======= Inner Page ======= -->
    
<!-- ======= End Inner Page ======= -->
  </main>
  <!-- ======= End Main ======= -->



  <!-- ======= Footer1 ======= -->
  <footer id="footer1">
    <div class="container">
      <div class="copyright1">
        &copy; Copyright <strong><span>2022 BMKG Juanda</span></strong>. All Rights Reserved.
      </div>
    </div>
  </footer>
  <!-- ======= End Footer1 ======= -->




  <!-- vendors JS Files -->
  <script src="public/vendors/purecounter/purecounter.js"></script>
  <script src="public/vendors/aos/aos.js"></script>
  <script src="public/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="public/vendors/glightbox/js/glightbox.min.js"></script>
  <script src="public/vendors/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="public/vendors/swiper/swiper-bundle.min.js"></script>
  <script src="public/vendors/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="public/js/main.js"></script>

</body>
<!--END BODY-->
</html>