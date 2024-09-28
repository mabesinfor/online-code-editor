<?php

if (!isset($_COOKIE["nim"])) header("Location: login.php");
require "connection.php";

// Dapatkan data akun
$nim = $_COOKIE["nim"];
$sql = "SELECT * FROM akun WHERE nim='$nim';";
$query = mysqli_query($conn, $sql);

if (mysqli_num_rows($query) == 0) die("Data akun tidak ditemukan");

$row = mysqli_fetch_assoc($query);
$paket = $row["paket"];
$dir = str_replace("/","",$row["password"]);
$fulldir = "./Jawaban/" . $paket . "/" . $nim . $dir .  "/";

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