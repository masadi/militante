<?php
$file_mimes = array('application/vnd.ms-excel', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

if (isset($_FILES['file']['name']) && in_array($_FILES['file']['type'], $file_mimes)) {

    $arr_file = explode('.', $_FILES['file']['name']);
    $extension = end($arr_file);

    if ('xls' == $extension) {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
    } else {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    }

    $spreadsheet = $reader->load($_FILES['file']['tmp_name']);

    $sheetData = $spreadsheet->getActiveSheet()->toArray();
    $sukses = $gagal = 0;
    $exec = mysqli_query($koneksi, "TRUNCATE siswa");
    for ($i = 1; $i < count($sheetData); $i++) {
        $business_model = $sheetData[$i]['0'];
        $bud_bus_name = $sheetData[$i]['1'];
        $businessfield_name = $sheetData[$i]['2'];
        $company_client_name  = $sheetData[$i]['3'];
        $client_contact_name = $sheetData[$i]['4'];
        $client_contact_phone = $sheetData[$i]['5'];
        $client_contact_email = $sheetData[$i]['6'];
        $client_contact_jobposition = $sheetData[$i]['7'];

        $project_understanding = $sheetData[$i]['8'];
        $termin_payment = $sheetData[$i]['9'];
        $project_status = $sheetData[$i]['10'];
        $sustain_scaling_status = $sheetData[$i]['11'];
        $persen_level_confidence = $sheetData[$i]['12'];

        $project_value = $sheetData[$i]['13'];
        $persen_gpm_bud = $sheetData[$i]['14'];
        $persen_gpm_bus = $sheetData[$i]['15'];
        $win_estimated_period = $sheetData[$i]['16'];
        $billcomp_estimated_period = $sheetData[$i]['17'];
        $contract_duration = $sheetData[$i]['18'];
        $TREG_area = $sheetData[$i]['19'];
        $category_reason = $sheetData[$i]['20'];
        $employee_relation = $sheetData[$i]['20'];
        $client_payment_capability = $sheetData[$i]['20'];
        $client_history_performance = $sheetData[$i]['20'];

        $tgldaftar=date('Y-m-d H:i:s');
        
        if(!empty($username)) {
        $exec = mysqli_query($koneksi, "INSERT INTO calon (username,password,nama,nisn,jenis_kelamin,tempat_lahir,tanggal_lahir,smpasal,tanggaldaftar)VALUES('$username','$password','$nama','$nis','$jeniskelamin','$tempat','$tanggallahir','$asal','$tgldaftar')");
        ($exec) ? $sukses++ : $gagal++;
        
        }
    }
    echo "Berhasil: $sukses | Gagal: $gagal ";
} else {
    echo "Pilih file yang bertipe xlsx or xls";
}
?>