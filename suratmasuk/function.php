<?php

require '../database/db.php';


function tanggal_indo($tanggal)
{
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $split = explode('-', $tanggal);
    return $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];
}

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data)
{
    global $conn;
    $no_agenda = htmlspecialchars($data["no_agenda"]);
    $tgl_agenda = htmlspecialchars($data["tgl_agenda"]);
    $tk_keamanan = htmlspecialchars($data["tk_keamanan"]);
    $no_surat = htmlspecialchars($data["no_surat"]);
    $tgl_surat = htmlspecialchars($data["tgl_surat"]);
    $asal_surat = htmlspecialchars($data["asal_surat"]);
    $asal_surat = ucwords($asal_surat);
    $perihal = htmlspecialchars($data["perihal"]);
    $perihal = ucwords($perihal);
    $lampiran = htmlspecialchars($data["lampiran"]);
    $status_surat = htmlspecialchars($data["status_surat"]);

    //upload file_pdf
    $file_pdf = upload();

    // if (!$file_pdf) {
    //     return false;
    // }

    $query = "INSERT INTO surat_masuk (no_agenda, tgl_agenda, tk_keamanan, no_surat, tgl_surat, asal_surat, perihal, lampiran, status_surat, file_pdf)
                VALUES
                ('$no_agenda','$tgl_agenda','$tk_keamanan','$no_surat',
                '$tgl_surat','$asal_surat','$perihal','$lampiran','$status_surat','$file_pdf')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload()
{
    
    $perihal = htmlspecialchars($_POST["perihal"]);
    $no_agenda = htmlspecialchars($_POST["no_agenda"]);
    $tgl_agenda = htmlspecialchars($_POST["tgl_agenda"]);

    $namaFile = $_FILES['file_pdf']['name'];
    $ukuranFile = $_FILES['file_pdf']['size'];
    $error = $_FILES['file_pdf']['error'];
    $tmpName = $_FILES['file_pdf']['tmp_name'];

    //cek apakah tidak ada file_pdf yg diupload
    // if ($error === 4) {
    //     echo "<script>
    //             alert('pilih file_pdf dahulu');
    //             ";
    //     return false;
    // }
    //cek apakah yg d upload adalah file_pdf
    $ekstensiPdfValid = ['pdf', 'jpg', 'jpeg', 'png'];
    $ekstensiPdf = explode('.', $namaFile);
    $ekstensiPdf = strtolower(end($ekstensiPdf));
    
    if (!in_array($ekstensiPdf, $ekstensiPdfValid)) {
        echo "<script>
               alert('pilih file file_pdf untuk d upload');
               ";
        return false;
    }

    //cek jika ukuran file_pdf terlalu bersar
    if ($ukuranFile > 80000000) {
        echo "<script>
                alert('ukuran file terlalu besar');
                ";
        return false;
    }

    //lolos cek file_pdf siap upload
    //generate nma baru
    // $namaFileBaru = $no_agenda . '.' . $perihal . '.' . uniqid();
    $namaFileBaru = 'm-' . $no_agenda . '.' . date('Ym', strtotime($tgl_agenda)) . '.' . $perihal;
    $namaFileBaru = preg_replace("/[^a-zA-Z0-9]+/", "-", $namaFileBaru);
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiPdf;

    //checking if file exsists
    if (file_exists("/berkas/$namaFileBaru")) unlink("berkas/$namaFileBaru");

    //Place it into your "uploads" folder mow using the move_uploaded_file() function
    move_uploaded_file($tmpName, '../berkas/' . $namaFileBaru);
    return $namaFileBaru;
}

function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM surat_masuk WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function ubah($data)
{
    global $conn;
    $id = $data["id"];
    $no_agenda = htmlspecialchars($data["no_agenda"]);
    $tgl_agenda = htmlspecialchars($data["tgl_agenda"]);
    $tk_keamanan = htmlspecialchars($data["tk_keamanan"]);
    $no_surat = htmlspecialchars($data["no_surat"]);
    $tgl_surat = htmlspecialchars($data["tgl_surat"]);
    $asal_surat = htmlspecialchars($data["asal_surat"]);
    $asal_surat = ucwords($asal_surat);
    $perihal = htmlspecialchars($data["perihal"]);
    $perihal = ucwords($perihal);
    $lampiran = htmlspecialchars($data["lampiran"]);
    $status_surat = htmlspecialchars($data["status_surat"]);
    $pdfLama = htmlspecialchars($data["pdfLama"]);

    echo "<script type='text/javascript'>alert('$pdfLama');</script>";
    //cek apakah user pilih file_pdf baru atau tidak
    if ($_FILES['file_pdf']['error'] === 4) {
        $file_pdf = $pdfLama;
    } else {
        $file_pdf = upload();
    }


    $query = "UPDATE surat_masuk SET
                no_agenda = '$no_agenda',
                tgl_agenda = '$tgl_agenda',
                tk_keamanan = '$tk_keamanan',
                no_surat = '$no_surat',
                tgl_surat = '$tgl_surat',
                asal_surat = '$asal_surat',
                perihal = '$perihal',
                lampiran = '$lampiran',
                status_surat = '$status_surat',
                file_pdf = '$file_pdf'
                WHERE id = $id
                ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function registrasi($data)
{
    global $conn;
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    //cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
        alert('username sudah terdaftar')
        </script>";
        return false;
    }

    //cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
        alert('password tidak sama')
        </script>";
        return false;
    }

    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    //tambahkan ke database
    mysqli_query($conn, "INSERT INTO user(`username`, `password`)
     VALUES('$username','$password')");
    return mysqli_affected_rows($conn);
}

