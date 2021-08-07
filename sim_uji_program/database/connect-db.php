<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ubaya_sim_uji_program";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Koneksi ke database gagal, pesan eror: " . $conn->connect_error);
    }
?>