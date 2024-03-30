<?php
$filename = "DataLead-CompanyClient-" . gmdate('Ymd') . ".xls";

// The function header by sending raw excel
header("Content-type: application/vnd-ms-excel");

// Defines the name of the export file to "codelution-export.xls"
header("Content-Disposition: attachment; filename=\"$filename\"");

error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

?>
<h2>List of {{$judulhalmana}}</h2>

<table border="1">
    <tr>
        <th>No</th>
        <th>Name</th>
        <th>Value</th>
	</tr>
                <?php $no = 1;?>
                <?php foreach ($data as $list) : ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td>
                    <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_even('{{$list->id}}')"><i class="fa fa-edit"></i></a>
                      <button class="btn btn-sm btn-danger" onclick="delete_even({{$list->id}})" title="Delete">
                        <i class="fa fa-fw fa-trash"></i>
                      </button>
                    </td>
                    <td><?= $list->name ?></td>
                    <td><?= $list->value ?></td>
                  </tr>
                <?php endforeach; ?>
	</table>
