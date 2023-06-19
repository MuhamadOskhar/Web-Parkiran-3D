<?php

try {
    
    include "widget/koneksi.php";

    // MENGAMBIL DATA TEMPAT YANG TERISI DARI TABEL PLAT_NOMOR
    $sql = "SELECT lokasi,lantai FROM spot_parkir WHERE status=1";
    $result = mysqli_query($conn, $sql);
    $lokasi_ditempati = array(
        "lokasi" => [],
        "lantai" => []
    );

    // MEMASUKAN DATA LOKASI KE DALAM ARRAY
    while ($data = mysqli_fetch_assoc($result)) {
        array_push($lokasi_ditempati['lokasi'], $data['lokasi']);
        array_push($lokasi_ditempati['lantai'], $data['lantai']);
    }

} catch (\Throwable $er) {
    echo (" (index.php) pesan: " . $er);

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta charset="utf-8"><link href="assets/images/lightmode.jpg" alt="iniGambar" rel="icon" type="image/x-icon">
    <meta property="og:description" content="Web parkiran dengan disain konsep 3D">
    <meta property="og:image" content="myLogo.ico" alt="iniGambar">
    <meta name="description" content="
        Author: Mahasiswa,
        Category: Web Parkiran,
        Date: December 2023,
        Purpose: Comercial ">
    <link rel="stylesheet" href="style/halaman_utama.css">
    <title>Si Paling Parkir 😎</title>
</head>
<body>

    <!-- TOMBOL UNTUK PINDAH LANTAI -->
    <div id="lantai">
        <button><</button>
        <button id="l3" onclick="gantiLantai(this, 29)" <?php if(isset($_GET["lt"])) if($_GET["lt"] == 2) echo "class='active'" ?>>3</button>
        <button id="l2" onclick="gantiLantai(this, 16)" <?php if(isset($_GET["lt"])) if($_GET["lt"] == 1) echo "class='active'" ?>>2</button>
        <button id="l1" onclick="gantiLantai(this, 3)" <?php if(isset($_GET["lt"])) {if($_GET["lt"] == 0) echo "class='active'"; } else echo "class='active'"; ?>>1</button>
        <button>></button>
    </div>

    <!-- TOMBOL UNTUK KE HALAMAN LOGIN -->
    <button id="log_user" onclick="window.location='pages/loginUser.php';">Login User</button>
    <button id="log_admin" onclick="window.location='pages/loginAdmin.php';">Login Admin</button>

    <!-- UNTUK ALAMAT IMPORT KE THREE.JS -->
    <script type="importmap">
        {
            "imports": {
                "three": "./node_modules/three/build/three.module.js",
                "GLTFLoader": "./node_modules/three/examples/jsm/loaders/GLTFLoader.js"
            }
        }
    </script>

    <!-- MASUKAN DATA PHP KE JS -->
    <script>
        var sudah_ditempati = <?= json_encode($lokasi_ditempati) ?>;
        var lokasi_dipilih = <?= isset($_GET["lt"]) ? "[$_GET[lt], $_GET[loc]]" : "[]" ?>;
    </script>

    <!-- IMPORT MAIN SCRIPT UNTUK MENGATUR THREE.JS -->
    <script type="module" src="script/App.js"></script>
    
</body>
</html>
