<?php
    require "connect-db.php";

    $sql = "SELECT PrefixNrp FROM prodi WHERE IdProdi = {$_POST['Prodi']}";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $nrp = $row['PrefixNrp'];
        }
    }

    $nrp .= $nrp . $_POST['ThnTerima'][2]. $_POST['ThnTerima'][3];

    $sql = "SELECT m.Nrp FROM mahasiswa AS m
            INNER JOIN prodi AS p ON m.IdProdi = p.IdProdi
            INNER JOIN fakultas AS f ON p.IdFakultas = f.IdFakultas
            WHERE f.IdFakultas = {$_POST['Fakultas']} ORDER BY m.Nrp DESC LIMIT 1";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $nrp .= str_pad($row['Nrp'][strlen($row['Nrp']) - 1], 3, '0', STR_PAD_LEFT);
        }
    }

    $sql = "INSERT INTO Mahasiswa (Nrp, ThnTerima, Nama, TglLahir, Email, Ipk, IdProdi)
            VALUES ('".$nrp."', '".$_POST['ThnTerima']."', '".$_POST['Nama']."', '".$_POST['TglLahir']."', '".$_POST['Email']."', '0', '".$_POST["Prodi"]."')";

    if ($conn->query($sql) === TRUE) {
        header("location: ../index.php");
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
?>