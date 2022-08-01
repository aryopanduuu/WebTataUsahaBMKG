<?php

require '../../database/db.php';

$queryAndFirst = '';
$queryAndLast = '';
$queryIfMontExist='';
$role='';
$queryIfMontExist='';

if (isset($_POST['keyword']) || isset($_POST['pilihTahun']) || isset($_POST['pilihBulan'])) {
    $noUrut = 1;

    if(isset($_POST['role'])){
        $role = $_POST['role'];
    }
    if($role!='admin'){
        $queryAndFirst = "AND diteruskan LIKE '%".$role."%'";
        $queryAndLast = "diteruskan LIKE '%".$role."%' AND";
        $querySearch = "diteruskan LIKE '%".$role."%'";
      
    }
    if($_POST['role']=="public" || $_POST['role']=="admin"){
        $queryAndFirst = '';
        $queryAndLast = '';    
    }
    


    $keyword = $_POST['keyword'];
    $pilihTahun = $_POST['pilihTahun'];
    $pilihBulan = $_POST['pilihBulan'];


    $query = "SELECT*FROM surat_masuk WHERE YEAR(tgl_agenda) = '$pilihTahun' $queryAndFirst $queryIfMontExist AND (no_agenda LIKE'%" . $keyword . "%' OR
    tk_keamanan LIKE '%" . $keyword . "%' OR
    tgl_surat LIKE '%" . $keyword . "%' OR
    no_surat like '%" . $keyword . "%' OR
    asal_surat LIKE '%" . $keyword . "%' OR
    perihal like '%" . $keyword . "%')
    ORDER BY id DESC
    ";

    if($pilihBulan!=''){
        $queryIfMontExist =  'AND MONTH(tgl_agenda)='.$pilihBulan;
    }

    if($pilihTahun!='' && $pilihBulan!='' && $keyword!=''){
        $queryIfMontExist =  'AND MONTH(tgl_agenda)='.$pilihBulan;
        $query = "SELECT*FROM surat_masuk WHERE YEAR(tgl_agenda) = '$pilihTahun' $queryAndFirst $queryIfMontExist AND (no_agenda LIKE'%" . $keyword . "%' OR
        tk_keamanan LIKE '%" . $keyword . "%' OR
        tgl_surat LIKE '%" . $keyword . "%' OR
        no_surat like '%" . $keyword . "%' OR
        asal_surat LIKE '%" . $keyword . "%' OR
        perihal like '%" . $keyword . "%')
        ORDER BY id DESC
        ";

    }

    if($keyword == null){
        $query = "SELECT*FROM surat_masuk WHERE  YEAR(tgl_agenda) = '$pilihTahun' $queryAndFirst ORDER BY id DESC";
        if($pilihTahun!='' && $pilihBulan!=''){
            $query = "SELECT*FROM surat_masuk WHERE YEAR(tgl_agenda) = '$pilihTahun' $queryIfMontExist $queryAndFirst  ORDER BY id DESC
            ";
        }
    }
    if($pilihTahun == null){
        $query = "SELECT*FROM surat_masuk WHERE $queryAndLast (no_agenda LIKE'%" . $keyword . "%' OR
        tk_keamanan LIKE '%" . $keyword . "%' OR
        tgl_surat LIKE '%" . $keyword . "%' OR
        no_surat like '%" . $keyword . "%' OR
        asal_surat LIKE '%" . $keyword . "%' OR
        perihal like '%" . $keyword . "%')
        ORDER BY id DESC
        ";
    }
    
    $tampil = mysqli_query($conn, $query);

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
        $diteruskan=$data['diteruskan'];

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
        <?php
                        $id = $data['id'];
                        if($role != 'public' || $role == 'admin'){
                        echo '
                        <td>'.$diteruskan.'</td>
                        ';
                        }?>
        <?php
                          $id = $data['id'];
                          if($role=='admin'){
                          echo '
                            <td style="text-align:center;">
                              <a href="../suratmasuk/disposisi.php?id='.$id.'" target="_blank" class="view"  data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
                              <a href="../suratmasuk/editsurat.php?id='.$id.'" class="edit"  data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                              <a href="../suratmasuk/delete_masuk.php?id='.$id.'" class="delete"  data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                            </td>
                            ';
                         }?>
        </tr>
          
                         

<?php }
} ?>