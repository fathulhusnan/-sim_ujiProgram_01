<?php
    require "connect-db.php";

    $sql = "SELECT m.Nrp, m.Nama, m.Ipk, p.Nama AS Prodi, f.Nama AS Fakultas FROM mahasiswa AS m
            INNER JOIN prodi AS p ON m.IdProdi = p.IdProdi
            INNER JOIN fakultas AS f ON p.IdFakultas = f.IdFakultas
            ORDER BY m.Nrp DESC";
            
    $result = $conn->query($sql);
    $students = [];

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $students[] = [
                'Fakultas' => $row['Fakultas'],
                'Prodi' => $row['Prodi'],
                'Nrp' => $row['Nrp'],
                'Nama' => $row['Nama'],
                'Ipk' => $row['Ipk'],
            ];
        }
    }
    $conn->close();
?>