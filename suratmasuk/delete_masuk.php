<?php
require '../suratmasuk/function.php';

$id = $_GET["id"];
if (hapus($id) > 0) {
    echo "
            <script>
                alert('Data Berhasil Dihapus');
                document.location.href = '../suratmasuk/index.php';
            </script>
                ";
} else {
    echo "
            <script>
                alert('data gagal ditambah!!!!');
                document.location.href = '../suratmasuk/index.php';
            </script>
                ";
}
?>