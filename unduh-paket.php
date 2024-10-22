<?php

if (!isset($_COOKIE["nim"]))
	header("Location: login.php");
require "connection.php";

// Dapatkan data akun
$nim = $_COOKIE["nim"];
$sql = "SELECT * FROM akun WHERE nim='$nim';";
$query = mysqli_query($conn, $sql);

if (mysqli_num_rows($query) == 0)
	die("Data akun tidak ditemukan");

$row = mysqli_fetch_assoc($query);
$paket = $row["paket"];
$dir = str_replace("/", "", $row["password"]);
$fulldir = "./Jawaban/" . $paket . "/" . $nim . $dir . "/";

// Dapatkan file soal sesuai paket
$filename = "";
$filepath = "./P4k3tt999100/";
echo "Memproses paket...";
switch ($paket) {
	case "tes":
		copy("./images/test.jpg", $fulldir . "test.jpg");
		$filename = "RESPONSI 1_PAKET TESTING.pdf";
		$filepath .= $filename;
		break;
	case "Blater":
		copy("./images/paket_blater.jpg", $fulldir . "paket_blater.jpg");
		$filename = "RESPONSI 1_PAKET BLATER.pdf";
		$filepath .= $filename;
		break;
	case "Kalimanah":
		copy("./images/paket_kalimanah.jpg", $fulldir . "paket_kalimanah.jpg");
		$filename = "RESPONSI 1_PAKET KALIMANAH.pdf";
		$filepath .= $filename;
		break;
	case "Resep":
		copy("./images/topi.png", $fulldir . "topi.png");
		$filename = "RESPONSI 1_PAKET RESEP.pdf";
		$filepath .= $filename;
		break;
	case "Susu":
		copy("./images/cat.jpg", $fulldir . "cat.jpg");
		$filename = "RESPONSI 1_PAKET SUSU.pdf";
		$filepath .= $filename;
		break;
	case "Bimbel":
		copy("./images/buku.png", $fulldir . "buku.png");
		copy("./images/ronaldo.jpg", $fulldir . "ronaldo.jpg");
		$filename = "RESPONSI 1_PAKET BIMBEL.pdf";
		$filepath .= $filename;
		break;
	case "Resto":
		copy("./images/resto.jpg", $fulldir . "resto.jpg");
		copy("./images/ayambakar.jpg", $fulldir . "ayambakar.jpg");
		copy("./images/ikangoreng.jpg", $fulldir . "ikangoreng.jpg");
		copy("./images/esteh.jpg", $fulldir . "esteh.jpg");
		copy("./images/esjeruk.jpg", $fulldir . "esjeruk.jpg");
		$filename = "RESPONSI 1_PAKET RESTO.pdf";
		$filepath .= $filename;
		break;
	case "Toko Buah":
		copy("./images/pisang.jpg", $fulldir . "pisang.jpg");
		copy("./images/apel.jpg", $fulldir . "apel.jpg");
		$filename = "RESPONSI 1_PAKET TOKO BUAH.pdf";
		$filepath .= $filename;
		break;
	case "adila":
		copy("./images/shift_c/sepatu1.jpg", $fulldir . "sepatu1.jpg");
		copy("./images/shift_c/sepatu2.jpg", $fulldir . "sepatu2.jpg");
		copy("./images/shift_c/sepatu3.jpg", $fulldir . "sepatu3.jpg");
		copy("./images/shift_c/sepatu4.jpg", $fulldir . "sepatu4.jpg");
		copy("./images/shift_c/logo asprak.png", $fulldir . "logo asprak.png");
		$filename = "RESPONSI 1_PAKET ADILA.pdf";
		$filepath .= $filename;
		break;
	case "emma":
		copy("./images/shift_c/ayambakar.jpe", $fulldir . "ayambakar.jpe");
		copy("./images/shift_c/ikabakar.jpe", $fulldir . "ikabakar.jpe");
		copy("./images/shift_c/nasibakar.jpe", $fulldir . "nasibakar.jpe");
		copy("./images/shift_c/esteh.jpg", $fulldir . "esteh.jpg");
		copy("./images/shift_c/esjeruk.jpg", $fulldir . "esjeruk.jpg");
		copy("./images/shift_c/kopi.jpg", $fulldir . "kopi.jpg");
		copy("./images/shift_c/logo asprak.png", $fulldir . "logo asprak.png");
		$filename = "RESPONSI 1_PAKET EMMA.pdf";
		$filepath .= $filename;
		break;
	case "hasna":
		copy("./images/shift_c/sepatu1.jpg", $fulldir . "sepatu1.jpg");
		copy("./images/shift_c/sepatu2.jpg", $fulldir . "sepatu2.jpg");
		copy("./images/shift_c/sepatu3.jpg", $fulldir . "sepatu3.jpg");
		copy("./images/shift_c/sepatu4.jpg", $fulldir . "sepatu4.jpg");
		copy("./images/shift_c/logo asprak.png", $fulldir . "logo asprak.png");
		$filename = "RESPONSI 1_PAKET HASNA.pdf";
		$filepath .= $filename;
		break;
	case "rassya":
		copy("./images/shift_c/ayambakar.jpe", $fulldir . "ayambakar.jpe");
		copy("./images/shift_c/ikabakar.jpe", $fulldir . "ikabakar.jpe");
		copy("./images/shift_c/nasibakar.jpe", $fulldir . "nasibakar.jpe");
		copy("./images/shift_c/esteh.jpg", $fulldir . "esteh.jpg");
		copy("./images/shift_c/esjeruk.jpg", $fulldir . "esjeruk.jpg");
		copy("./images/shift_c/kopi.jpg", $fulldir . "kopi.jpg");
		copy("./images/shift_c/logo asprak.png", $fulldir . "logo asprak.png");
		$filename = "RESPONSI 1_PAKET RASSYA.pdf";
		$filepath .= $filename;
		break;
	case "Nabila":
		$filename = "RESPONSI 1_PAKET NABILLA.pdf";
		$filepath .= $filename;
		break;
	case "regita":
		$filename = "RESPONSI 1_PAKET REGITA.pdf";
		$filepath .= $filename;
		break;
	case "bertha":
		$filename = "RESPONSI 1_PAKET BERTHA.pdf";
		$filepath .= $filename;
		break;
	case "zaki":
		$filename = "RESPONSI 1_PAKET ZAKI.pdf";
		$filepath .= $filename;
		break;
	case "ebel":
		$filename = "RESPONSI 1_PAKET EBEL.pdf";
		$filepath .= $filename;
		break;
	case "diva":
		$filename = "RESPONSI 1_PAKET DIVA.pdf";
		$filepath .= $filename;
		break;
	case "bagus":
		$filename = "RESPONSI 1_PAKET BAGUS.pdf";
		$filepath .= $filename;
		break;
	case "azzam":
		$filename = "RESPONSI 1_PAKET AZZAM.pdf";
		$filepath .= $filename;
		break;
	case "fadhila":
		$filename = "RESPONSI 1_PAKET FADHILA.pdf";
		$filepath .= $filename;
		break;
	case "athifa":
		$filename = "RESPONSI 1_PAKET ATHIFA.pdf";
		$filepath .= $filename;
		break;
	case "arindra":
		$filename = "RESPONSI 1_PAKET ARINDRA.pdf";
		$filepath .= $filename;
		break;
	case "ageng":
		$filename = "RESPONSI 1_PAKET AGENG.pdf";
		$filepath .= $filename;
		break;
	case "zia":
		$filename = "RESPONSI 1_PAKET ZIA.pdf";
		$filepath .= $filename;
		break;
	case "rafli":
		$filename = "RESPONSI 1_PAKET RAFLI.pdf";
		$filepath .= $filename;
		break;
	case "hendra":
		$filename = "RESPONSI 1_PAKET HENDRA.pdf";
		$filepath .= $filename;
		break;
	case "rafi":
		$filename = "RESPONSI 1_PAKET RAFI.pdf";
		$filepath .= $filename;
		break;
	case "karakter":
		copy("./images/shift_d/dwarf.jpg", $fulldir . "dwarf.jpg");
		copy("./images/shift_d/elf.png", $fulldir . "elf.png");
		copy("./images/shift_d/orc.png", $fulldir . "orc.png");
		copy("./images/shift_d/human.png", $fulldir . "human.png");
		copy("./images/shift_d/profile.png", $fulldir . "profile.png");
		$filename = "RESPONSI 1_PAKET KARAKTER.pdf";
		$filepath .= $filename;
		break;
	case "inventory":
		copy("./images/shift_d/hero.jpg", $fulldir . "hero.jpg");
		$filename = "RESPONSI 1_PAKET INVENTORY.pdf";
		$filepath .= $filename;
		break;
	case "infor":
		copy("./images/shift_a/teknik.jpg", $fulldir . "teknik.jpg");
		$filename = "RESPONSI 1_PAKET INFOR.pdf";
		$filepath .= $filename;
		break;
	case "kominfo":
		copy("./images/shift_a/kominfo.jpg", $fulldir . "kominfo.jpg");
		$filename = "RESPONSI 1_PAKET KOMINFO.pdf";
		$filepath .= $filename;
		break;
	case "Penulis":
		copy("./images/penulis/myPicture.png", $fulldir . "myPicture.png");
		$filename = "RESPONSI 1_PAKET PENULIS.pdf";
		$filepath .= $filename;
		break;
	case "Warung":
		copy("./images/warung/ayam_bakar.jpg", $fulldir . "ayam_bakar.jpg");
		copy("./images/warung/es_teh.jpg", $fulldir . "es_teh.jpg");
		copy("./images/warung/kopi.jpg", $fulldir . "kopi.jpg");
		copy("./images/warung/nasi_goreng.jpg", $fulldir . "nasi_goreng.jpg");
		copy("./images/warung/ttd.jpg", $fulldir . "ttd.jpg");
		copy("./images/warung/unsoed.png", $fulldir . "unsoed.png");
		$filename = "RESPONSI 1_PAKET WARUNG.pdf";
		$filepath .= $filename;
		break;
	case "Wisata":
		copy("./images/wisata/ntt.jpg", $fulldir . "ntt.jpg");
		$filename = "RESPONSI 1_PAKET WISATA.pdf";
		$filepath .= $filename;
		break;
	default:
		die("Paket tidak ditemukan");
}
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="' . $filename . '"');
readfile($filepath);

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>

<body>

</body>

</html>