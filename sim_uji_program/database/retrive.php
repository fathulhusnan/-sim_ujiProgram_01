<?php
    require "connect-db.php";

    if ($_GET['action'] == "detail") {
        $sql = "SELECT m.Nrp, m.ThnTerima, m.Nama, m.TglLahir, m.Email, m.Ipk, p.IdProdi AS Prodi, f.IdFakultas AS Fakultas FROM mahasiswa AS m
                INNER JOIN prodi AS p ON m.IdProdi = p.IdProdi
                INNER JOIN fakultas AS f ON p.IdFakultas = f.IdFakultas
                WHERE m.Nrp = {$_GET['nrp']}";
                
        $result = $conn->query($sql);
        $student = [];

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $student = [
                    'Fakultas' => $row['Fakultas'],
                    'Prodi' => $row['Prodi'],
                    'Nrp' => $row['Nrp'],
                    'ThnTerima' => $row['ThnTerima'],
                    'Nama' => $row['Nama'],
                    'TglLahir' => $row['TglLahir'],
                    'Email' => $row['Email'],
                    'Ipk' => $row['Ipk'],
                ];
            }
        }
    }
    
    $sql = "SELECT * FROM prodi";
            
    $result = $conn->query($sql);
    $prodi = [];

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $prodi[$row['IdFakultas']][] = [
                'IdProdi' => $row['IdProdi'],
                'Nama' => $row['Nama'],
                'PrefixNrp' => $row['PrefixNrp'],
            ];
        }
    }
    
    $sql = "SELECT * FROM fakultas";
            
    $result = $conn->query($sql);
    $fakultas = [];

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $fakultas[] = [
                'IdFakultas' => $row['IdFakultas'],
                'Nama' => $row['Nama'],
            ];
        }
    }
    
    $conn->close();
?>