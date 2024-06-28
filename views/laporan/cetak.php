<?php
/* @var $this yii\web\View */
/* @var $items array */

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Print Out HTML</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Data Provinsi</h1>
    <table>
        <thead>
            <tr>
                <th>Nama Provinsi</th>
                <th>Jumlah Penduduk</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item) : ?>
                <tr>
                    <td><?= htmlspecialchars($item['nama_provinsi']) ?></td>
                    <td><?= htmlspecialchars($item['jumlah_penduduk']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>