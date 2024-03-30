<?php
$filename = "Data-Militante-" . gmdate('Ymd') . ".xls";

// The function header by sending raw excel
header("Content-type: application/vnd-ms-excel");
 
// Defines the name of the export file to "codelution-export.xls"
header("Content-Disposition: attachment; filename=\"$filename\"");

error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

?>
<h2>LIST OF MILITANTE</h2>

<table border="1">
    <tr>
                                           
                                            <th>No</th>
                                            <th>No Militante</th>
                                            <th>Tanggal</th>
                                            <th>No Elektoral</th>
                                            <th>Nama</th>
                                            <th>Municipiu</th>
                                            <th>Posto</th>
                                            <th>Suco</th>
                                            <th>Aldeia</th>
                                            
                                            <th>Tgl Terbit</th>
                                            <th>Valid Until</th>
                                            <th>Status</th>

	</tr>
                                        <?php
                                        $no = 1;
                                        foreach ($query as $militante) {
                                            if($militante->status) $status="<span class='btn btn-success btn-sm'>Active</span>";
                                            else $status="<span class='btn btn-danger btn-sm'>Not Active</span>";
                                            
                                            echo '<tr><td align="center">'.$no.'</td>';

                                            echo '<td align="left">'.$militante->no_militante.'</td>';
                                            echo '<td align="left">'.$militante->tanggal.'</td>';
                                            echo '<td align="left">'.$militante->no_elektor.'</td>';
                                            echo '<td align="left">'.$militante->nama.'</td>';
                                            echo '<td align="left">'.$militante->kabupaten_name.'</td>';
                                            echo '<td align="left">'.$militante->kecamatan_name.'</td>';
                                            echo '<td align="left">'.$militante->kelurahan_name.'</td>';
                                            echo '<td align="left">'.$militante->desa_name.'</td>';
                                            echo '<td align="left">'.$militante->tgl_terbit.'</td>';
                                            echo '<td align="left">'.$militante->valid_until.'</td>';
                                            echo '<td align="center">'.$status.'</td>';


                                            //add html for action


                                            echo '</tr>';

                                            $no++;
                                        }?>
	</table>
