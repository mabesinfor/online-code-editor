<?php
if (!isset($_COOKIE["nim"])) header("Location: login.php");
require "connection.php";

// Get directory name
$nim = $_COOKIE["nim"];
$sql = "SELECT * FROM akun WHERE nim='$nim';";
$query = mysqli_query($conn, $sql);

if (mysqli_num_rows($query) == 0) die("NIM tidak ditemukan");

$row = mysqli_fetch_assoc($query);
$paket = $row["paket"];
$dirname = str_replace("/","",$row["password"]);
$fulldir = "./Jawaban/" . $paket . "/" . $nim . $dirname;

// Create directory if it doesn't exist
$old = umask(0);
if (!is_dir($fulldir)) {
	if (!mkdir($fulldir, 0777, true)) {
		die("Gagal membuat direktori");
	}
}


umask($old);
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta http-equiv="content-type" content="text/html; charset=windows-1252">
	<title>Responsi Praktikum Pemrograman Web</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/w3.css">
	<link rel="stylesheet" href="css/codemirror.css">
	<link rel="stylesheet" href="css/fontello.css">
	
	<script src="js/codemirror/codemirror.js"></script>
	<script src="js/codemirror/addon/edit/closetag.js"></script>
	<script src="js/codemirror/addon/edit/closebrackets.js"></script>
	<script src="js/codemirror/addon/fold/xml-fold.js"></script>
	<script src="js/codemirror/mode/xml/xml.js"></script>
	<script src="js/codemirror/mode/javascript/javascript.js"></script>
	<script src="js/codemirror/mode/css/css.js"></script>
	<script src="js/codemirror/mode/htmlmixed/htmlmixed.js"></script>

	<script>
		function $Id(id) {return document.getElementById(id)};
		function $Tag(tag) {return document.getElementsByTagName(tag)};

		if (window.addEventListener) {
			window.addEventListener("resize", browserResize);
		} else if (window.attachEvent) {
			window.attachEvent("onresize", browserResize);
		}

		//window.onbeforeunload = function(e) { if (e) {e.returnValue = "You have unsaved changes."}; return "Are you sure?"; }

		function browserResize() {
			if (window.screen.availWidth <= 768) {
				restack(window.innerHeight > window.innerWidth);
			}
			showFrameSize();    
		}

	</script>

	<style>
		* {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
		}
		body {
			color: #000000;
			margin: 0px;
		}

		button {
			border-radius: 10px;
		}

		ul {
			list-style-type: none;
			margin: 0;
			padding: 0px 10px;
			overflow: hidden;
		}
		li {
			float: left;
			margin: 2px;
		}
		li a {
			display: inline-block;
		}
		li.dropdown {
			display: inline-block;
		}

		.dropdown-content {
			display: none;
			position: absolute;
			top: 44px;
			min-width: 160px;
			max-width: 300px;
			box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.5);
			border-radius: 5px;
			background-color: hsl(0, 0%, 5%);
			z-index: 10;
		}
		.dropdown-content p {
			color: white;
			padding: 2px 16px;
			font-size: 12px;
		}
		
		.switch {
			position: relative;
			display: inline-block;
			margin: 0 4px;
		}
		.switch input {
			display: none;
		}
		.slider {
			box-sizing: border-box;
			position: static;
			width: 50px;
			height: 40px;
			margin: 0px 4px;
			background: white;
			border: solid lightgrey;
			border-radius: 20%;
			border-width: 4px 20px 4px 4px;
			display: inline-block;
			vertical-align: -14px;
			cursor: pointer;
			transition: border 0.3s;
		} 
		/*.slider:hover { 		} */
		input:checked + .slider { 
			border-color: hsl(122, 39.4%, 49.2%);/*w3-green*/
			border-width: 4px 4px 4px 20px;
		} 

		.w3-bar .w3-bar-item:hover {
			color: #757575 !important;
		}
		.w3-bar .w3-bar-item {
			margin: 2px;
			height: calc(100% - (2px + 2px));
			padding: 2px 12px;
		}

		.dropdown {
			display: inline;
			z-index: 2;
		}

		.CodeMirror.cm-s-default {
			line-height: normal;
			padding: 4px;
			height: 100%;
			width: 100%;
		}

		#container {
			margin: 0px 10px;
			position: absolute;
			height: calc(100% - 10px - 44px);
			width: calc(100% - 20px);
			top: 44px; bottom: 0px; left: 0; right: 0;
		}
		#textareacontainer, #dragbar, #iframecontainer {
			float: left;
			height: 100%;
			width: calc(50% - 6px);
			box-shadow: 0px 3px 5px -1px rgb(182, 181, 181);
		}
		#dragbar {
			width: 12px;
			box-shadow: none;
			cursor: col-resize;
		}
		#filename {
			border: 1px solid hsl(130, 100%, 30%);
			background: white;
			width: 300px;
			padding: 7px 4px;
			text-align: left;
		}
		#shield {
			display: none;
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			z-index: 4;
		}
		#framesize span {
			font-family: Consolas, monospace;
		}
		#iframeResult {
			background-color: #ffffff;
			border: none;
			height: 100%;
			width: 100%;  
		}

		@media screen and (max-width: 1260px) {
			#container {
				top: 88px;
				height: calc(100% - 10px - 88px);
			}
		}
		@media screen and (max-width: 450px) {
			#container {
				top: 160px;
				height: calc(100% - 10px - 160px);
			}
		}
		@media only screen and (max-device-width: 768px) {
			#container     {min-width: 320px;}
		}

		[class*="icon-"] {
			/*font: normal normal normal 18px/1 tit-fontello;*/
			text-rendering: auto;
			-webkit-font-smoothing: antialiased;
			-moz-osx-font-smoothing: grayscale;
			padding: 8px 10px;
		}

		@keyframes spin {
				0% { transform: rotate(0deg); }
				100% { transform: rotate(360deg); }
		}
		/* this MUST be the last rule*/
		.show {display: block;}
		
		
	</style>
	<!--[if lt IE 8]>
	<style>
		#textareacontainer, #iframecontainer {width: 48%;}
		#container {height: 500px;}
		#textarea, #iframe {width: 90%;height: 450px;}
		#textareaCode, #iframeResult {height: 450px;}
	</style>
	<![endif]-->
</head>
<body class="w3-black">

<!-- Tool Buttons -->
<ul class="w3-black">
	<li class="dropdown">
		<button class="w3-button w3-bar-item w3-hover-text-black w3-hover-yellow icon-folder-open" title="Show file tree"
			onclick='$Id("file-tree").classList.toggle("show")'
		>
		</button>
		<div class="dropdown-content" id="file-tree">
			<?php

				function listFolderFiles($dir)
				{
					$fileFolderList = scandir($dir);
					foreach ($fileFolderList as $fileFolder) {
						if ($fileFolder != '.' && $fileFolder != '..') {
							if (!is_dir($dir.'/'.$fileFolder)) {
								$ext = pathinfo($fileFolder, PATHINFO_EXTENSION);
								echo '<p><a href="javascript:void(0);" onclick="loadFile(\''.$fileFolder.'\')"><i class="icon-file-code"></i>'.$fileFolder.'</a></p>';
							} else {
								echo '<p><a href="javascript:void(0);">'.$fileFolder.'</a></p>';
							}
							if (is_dir($dir.'/'.$fileFolder)) {
								listFolderFiles($dir.'/'.$fileFolder);
							}
						}
					}
				}

				if (count(scandir($fulldir)) == 2) {
					echo '<p>Folder kosong</p>';
				} else {
					listFolderFiles($fulldir);
				}
			?>
		</div>
	</li>
	<li><button class="w3-button w3-bar-item w3-yellow w3-hover-white w3-hover-text-black" onclick="window.open('unduh-paket.php', '_blank')" title="Unduh paket yang sesuai">Unduh Paket</button></li>
	<li class="dropdown">
		<button class="w3-button w3-bar-item w3-hover-text-black w3-hover-yellow icon-help " title="Show info"
			onclick='this.nextElementSibling.classList.toggle("show")' onblur='this.nextElementSibling.classList.remove("show")'
		>
		</button>
		<div class="dropdown-content">
			<p><b>Panduan: </b></p>
			<p>Silakan kerjakan soal responsi melalui editor ini. Kamu bisa membuat file baru, merename, menyimpan, dan menghapus file menggunakan tombol di toolbar yang sesuai.</p>
			<p>Gunakan tombol di pojok kanan atas untuk memilih file yang telah kamu buat.</p>
			<p>Kamu tidak perlu submit atau mengirim apapun ke asisten praktikum. Cukup simpan saja file jawaban responsimu menggunakan tombol simpan yang sudah ada di toolbar.</p>
			<p><b>Peraturan: </b></p>
			<p>- Dilarang membuka internet.</p>
			<p>- Dilarang bekerja sama dengan orang lain.</p>
			<p>- Dilarang mem-paste code dari luar ke editor.</p>
		</div>
	</li>
	<li><button class="w3-button w3-bar-item w3-hover-text-black w3-hover-yellow icon-arrows-cw" onclick="restack()" title="Change orientation"></button></li>
	<li class="dropdown">
		<button class="w3-button w3-bar-item w3-hover-text-black w3-hover-yellow icon-doc" title="New file"
			onclick='$Id("new-file-dialog").classList.toggle("show")'
		>
		</button>
		<div class="dropdown-content" id="new-file-dialog">
			<form action="add-file.php" method="POST" onSubmit="return createFile()">
				<p>Filename:<br>
					<input class="w3-bar-item" type="text" name="add-file-name" id="add-file-name" required>
					<button name="file-add-submit" class="w3-button w3-bar-item w3-yellow w3-hover-white w3-hover-text-black">Buat</button>
				</p>
			</form>
		</div>
	</li>
	<li><button id="current-filename" class="w3-button w3-bar-item w3-hover-text-black w3-hover-yellow"">Current file: </button></li>
	<li class="dropdown">
		<button class="w3-button w3-bar-item w3-hover-text-black w3-hover-yellow icon-edit" title="Rename file"
			onclick='$Id("rename-file-dialog").classList.toggle("show")'
		>
		</button>
		<div class="dropdown-content" id="rename-file-dialog">
			<form action="rename-file.php" method="POST" onSubmit="return renameFile()">
				<p>New filename:<br>
					<input type="hidden" name="old-file-name" id="old-file-name">
					<input class="w3-bar-item" type="text" name="rename-file-name" id="rename-file-name" required>
					<button name="file-rename-submit" class="w3-button w3-bar-item w3-yellow w3-hover-white w3-hover-text-black">Simpan</button>
				</p>
			</form>
		</div>
	</li>
	<li>
		<form action="save-file.php" method="POST" onSubmit="return saveFile()">
			<input type="hidden" name="save-file-name" id="save-file-name">
			<textarea name="file-content" id="file-content" cols="0" rows="0" hidden></textarea>
			<button name="file-save-submit" class="w3-button w3-bar-item w3-hover-text-black w3-hover-yellow icon-floppy" title="Save file"></button>
		</form>
	</li>
	<li class="dropdown">
		<button class="w3-button w3-bar-item w3-hover-text-black w3-hover-yellow icon-trash" title="Delete file"
			onclick='$Id("delete-file-dialog").classList.toggle("show")'
		>
		</button>
		<div class="dropdown-content" id="delete-file-dialog" style="text-align: center;">
			<form action="delete-file.php" method="POST" onSubmit="return deleteFile()">
				<input type="hidden" name="delete-file-name" id="delete-file-name">
				<p>Apakah kamu yakin?<br><br>
					<button name="file-delete-submit" class="w3-button w3-bar-item w3-yellow w3-hover-white w3-hover-text-black">Ya</button>
				</p>
			</form>
		</div>
	</li>
	<!-- <li><button class="w3-button w3-bar-item w3-green w3-hover-white w3-hover-text-black w3-hover-yellow" onclick="submitTryit(1)" title="Show HTML output">Run &raquo;</button></li> -->
	<li style="float: right"><button class="w3-button w3-bar-item w3-hover-text-black w3-hover-yellow icon-cancel" onclick="logout()" title="Logout"></button></li>
	<li style="float: right"><span class="w3-right w3-bar-item" style="padding: 9px 0;display: block;" id="framesize"></span></li>
  </ul>
  
<div id="shield"></div>

<div id="container">

	<!-- Text Editor -->
	<div id="textareacontainer">
		<textarea autocomplete="off" id="textareaCode" onpaste="return false;" ondrop="return false;" wrap="logical" spellcheck="false">Silakan klik tombol <b>Unduh Paket</b> kemudian buat file baru menggunakan tombol yang berbentuk kertas</textarea>
	</div>
	<div id="dragbar">  </div>

	<!-- Preview Window -->
	<div id="iframecontainer">
	</div>
</div>

<script>
	var framecontentedit = false;
	submitTryit()

	function submitTryit(n) {
		if (window.editor) {
			window.editor.save();
		}
		var text = $Id("textareaCode").value;
		text = text.replaceAll(/(?<=href=['"])#/g, $Id("current-filename").innerHTML.replace("Current file: ", ""));
		text = text.replaceAll("href='", "href='" + "<?php echo $fulldir . '/' ?>");
		text = text.replaceAll('href="', 'href="' + '<?php echo $fulldir . "/" ?>');

		text = text.replaceAll(/(?<=<)(?<!\/)(form)(?!.*action)/g, "form action='#'");
		text = text.replaceAll(/(?<=action=['"])#/g, $Id("current-filename").innerHTML.replace("Current file: ", ""));
		text = text.replaceAll("action='", "action='" + "<?php echo $fulldir . '/' ?>");
		text = text.replaceAll('action="', 'action="' + '<?php echo $fulldir . "/" ?>');

		var ifr = document.createElement("iframe");
		ifr.setAttribute("frameborder", "0");
  		ifr.setAttribute("id", "iframeResult");
  		ifr.setAttribute("name", "iframeResult");
		ifr.setAttribute("allowfullscreen", "true");

		$Id("iframecontainer").innerHTML = "";
		$Id("iframecontainer").appendChild(ifr);

		var ifrw = (ifr.contentWindow) ? ifr.contentWindow : (ifr.contentDocument.document) ? ifr.contentDocument.document : ifr.contentDocument;
		ifrw.document.open();
		ifrw.document.write(text);
		ifrw.document.close();

		// const lastFile = document.cookie
  		// 	.split("; ")
  		// 	.find((row) => row.startsWith("lastOpened="))
  		// 	?.split("=")[1];
		// if (lastFile) ifr.setAttribute("src",  "<?php echo $fulldir . '/'  ?>" + $Id("current-filename").innerHTML.replace("Current file: ", ""));

		//23.02.2016: contentEditable is set to true, to fix text-selection (bug) in firefox.
		//(and back to false to prevent the content from being editable)
		//(To reproduce the error: Select text in the result window with, and without, the contentEditable statements below.)  
		if (ifrw.document.body && !ifrw.document.body.isContentEditable) {
			ifrw.document.body.contentEditable = true;
			ifrw.document.body.contentEditable = false;
		}
	}

	function reEdited() {
		var text = frameHTML();
		$Id("textareaCode").value = text;
		window.editor.getDoc().setValue(text);
	}

	function showFrameSize() {
		$Id("framesize").innerHTML = "Result Size: <span>" + $Id("iframecontainer")["clientWidth"] + " x " + $Id("iframecontainer")["clientHeight"] + "</span>";
	}

	var layout = "horizontal";
	var leftwidthperc = 50 ; var leftheightperc = 50 ;

	if ((window.screen.availWidth <= 768 && window.innerHeight > window.innerWidth) ) {restack();}

	function restack() {
		var l = $Id("textareacontainer");
		var c = $Id("dragbar");
		var r = $Id("iframecontainer");

		if (layout == "vertical") {
			l.style["height"] = c.style["height"] = r.style["height"] = "100%";
			l.style["width"] = "calc(" + leftwidthperc + "% - 6px)";
			c.style["width"] = "12px";
			c.style["cursor"] = "col-resize";
			r.style["width"] = "calc(" + (100 - leftwidthperc) + "% - 6px)";
			layout = "horizontal"
		} else {
			l.style["width"] = c.style["width"] = r.style["width"] = "100%";
			l.style["height"] = "calc(" + leftheightperc + "% - 6px)";
			c.style["height"] = "12px";
			c.style["cursor"] = "row-resize";
			r.style["height"] = "calc(" + (100 - leftheightperc) + "% - 6px)";
			layout = "vertical"		
		}

		showFrameSize();
	}

	dragBalance($Id(("dragbar")));

	function dragBalance(balancer) {
		if (window.addEventListener) {
			balancer.addEventListener("mousedown", function(e) {dragstart(e);});
			balancer.addEventListener("touchstart", function(e) {dragstart(e);});
			window.addEventListener("mousemove", function(e) {dragmove(e);});
			window.addEventListener("touchmove", function(e) {dragmove(e);});
			window.addEventListener("mouseup", dragend);
			window.addEventListener("touchend", dragend);
		}

		var dragging = false;
		var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;

		function dragstart(e) {
			e.preventDefault();
			e = e || window.event;
			// get the mouse cursor position at startup:
			pos3 = e.clientX;
			pos4 = e.clientY;
			dragging = true;
		}

		function dragmove(e) {
			var perc;
			if (dragging) {
				// show overlay to avoid interfering of mouse moving with textarea
				$Id("shield").style.display = "block";        
				e = e || window.event;
				// calculate the new cursor position:
				pos1 = pos3 - e.clientX;
				pos2 = pos4 - e.clientY;
				pos3 = e.clientX;
				pos4 = e.clientY;

				// set the element's new size:
				if (layout == "vertical") {
					var pos = pos2;
					var axe1 = "clientHeight";
					var axe2 = "height";
					perc = (balancer.previousElementSibling[axe1] + (balancer[axe1] / 2) - pos) * 100 / balancer.parentElement[axe1];
					leftheightperc = perc;
				} else {
					var pos = pos1;
					var axe1 = "clientWidth";
					var axe2 = "width";
					perc = (balancer.previousElementSibling[axe1] + (balancer[axe1] / 2) - pos) * 100 / balancer.parentElement[axe1];
					leftwidthperc = perc;
				}
				if (perc > 5 && perc < 95) {
					balancer.previousElementSibling.style[axe2] = "calc(" + (perc) + "% - " + (balancer[axe1] / 2) + "px)";
					balancer.nextElementSibling.style[axe2] = "calc(" + (100 - perc) + "% - " + (balancer[axe1] / 2) + "px)";
				}
				showFrameSize();
			}
		}

		function dragend() {
			$Id("shield").style.display = "none";
			dragging = false;
			if (window.editor) {
				window.editor.refresh();
			}
		}
	}

	function keypressed(e) {
		if (e.key != "ArrowLeft" && e.key != "ArrowRight" && e.key != "ArrowUp" && e.key != "ArrowDown") {submitTryit(1)};
	}

	function keypressedinframe(e) {
		if (e.key != "ArrowLeft" && e.key != "ArrowRight" && e.key != "ArrowUp" && e.key != "ArrowDown") {reEdited()};
		setTimeout(reEdited,100);
	}

	if (window.addEventListener) {
		window.addEventListener("load", showFrameSize);
		$Id("textareacontainer").addEventListener("keyup", function(e) {keypressed(e);});
		$Id("textareacontainer").addEventListener("paste", function(e) {e.preventDefault();});
	}
	frameWindow().addEventListener("keyup", keypressedinframe);

	/*
	function setFocusIframe() {frameWindow().focus();}
	$Id("iframeResult").contentWindow.addEventListener("mousedown", function(e) {setTimeout(setFocusIframe, 100);return false});
	*/

	function colorcoding() {  
		window.editor = CodeMirror.fromTextArea($Id("textareaCode"), {
			mode: "text/html",
			htmlMode: true,
			lineWrapping: true,
			smartIndent: false,
			indentUnit: 2,
			tabSize: 2,
			indentWithTabs: true,
			addModeClass: true,
			autoCloseTags: false,
			autoCloseBrackets: false
		});
		window.editor.on("beforeChange", function(_, change) {

  			if (change.origin == "paste") {
				change.cancel()
				alert("Gak boleh copas, ya ^_^");
			}
		})
		//window.editor.on("change", function () {window.editor.save();});
		//window.editor.on("change", function () {submitTryit(1)}); better avoid this due to "conflict" with contentEditable
	}
	colorcoding();

	function frameWindow(){
		var ifr = $Id("iframeResult");
		var ifrw = (ifr.contentWindow) ? ifr.contentWindow : (ifr.contentDocument.document) ? ifr.contentDocument.document : ifr.contentDocument;
		return ifrw;
	}

	function frameHTML() {
		var ifrw = frameWindow();
		ifrw.document.body.removeAttribute("contentEditable");// = false;
		var text = ifrw.document.documentElement.innerHTML;
		ifrw.document.body.contentEditable = framecontentedit;
		return text;
	}

	function createFile() {
		var filename = $Id("add-file-name").value;
		updateLastFile(filename);
		return true;
	}

	function renameFile() {
		var newfilename = $Id("rename-file-name").value;
		updateLastFile(newfilename);
		var filename = $Id("old-file-name");
		filename.value = "<?php echo $fulldir . '/' ?>" + $Id("current-filename").innerHTML.replace("Current file: ", "");
		return true;
	}

	function saveFile() {
		var content = $Id("textareaCode").value;
		var content_field = $Id("file-content");
		content_field.value = content;
		var filename = $Id("save-file-name");
		filename.value = "<?php echo $fulldir . '/' ?>" + $Id("current-filename").innerHTML.replace("Current file: ", "");
		alert("File berhasil disimpan");
		window.editor.clearHistory();
		window.editor.getDocl().setValue("");
		location.reload(true);
		return true;
	}

	async function loadFile(name) {
		try {
			let currentFile = $Id("current-filename");
			currentFile.innerHTML = "Current file: " + name;
			document.cookie = "lastOpened=" + name;
			let filepath = "<?php echo $fulldir . "/"; ?>" + name;
			let content = await loadFileContent(filepath);
			$Id("textareaCode").innerHTML = content;
			window.editor.getDoc().setValue(content);
			frameWindow().location.href = filepath;
		}
		catch (e) {
			alert(e.message);
		}
		setTimeout(submitTryit,1000);
	}

	async function loadFileContent(filepath) {
		let response = await fetch(filepath, {
			headers: {
				'Cache-Control': 'no-cache'
			}});
		if (response.status != 200) {
			throw new Error("Ok");
		}
		let content = await response.text();
		return content;
	}

	function deleteFile() {
		document.cookie = "lastOpened=; expires=Thu, 01 Jan 1970 00:00:00 UTC;"; 
		var filename = $Id("delete-file-name");
		filename.value = "<?php echo $fulldir . '/' ?>" + $Id("current-filename").innerHTML.replace("Current file: ", "");
		return true;
	}

	function updateLastFile(name) {
		document.cookie = "lastOpened=" + name;
	}

	function getName() {
		var name = $Id("filename").value;
		return name = name.slice(name.lastIndexOf("/") + 1);	
	}

	function downloadFile() {
		var text = frameHTML();
		//text = window.editor.getDoc().getValue("\n");
		var blob = new Blob([text], {type: "text/html;charset=utf-8"});
		saveAs(blob, getName());
	}

	function loadFromLocalStorage() {
		//Load saved Content
		var text = localStorage.getItem(getName());
		if (text != null) {
			$Id("textareaCode").value = text;
			window.editor.getDoc().setValue(text);
			submitTryit();
		}
	}

	function saveToLocalStorage() {
		if (typeof(Storage) !== "undefined") {
			var sHTML = frameHTML(); //Get content
			localStorage.setItem(getName(), sHTML);
			alert('Saved Successfully');
		} else {
			alert("No localStorage available")
		}
	}

	function viewSource() {
		var source = frameHTML();
		//now we need to escape the html special chars, javascript has escape
		//but this does not do what we want
		source = source.replace(/</g, "&lt;");
		//now we add <pre> tags to preserve whitespace
		source = "<pre>" + source + "</pre>";
		var sourceWindow = window.open('Nice Title','Source of page','');
		sourceWindow.document.write(source);
		sourceWindow.document.close(); //close the document for writing, not the window
	}

	function frameEditable() {
		$Id("checkedit").value = ~ $Id("checkedit").value;
		if ($Id("checkedit").value == 0) {
			framecontentedit = true;
			$Id("switchflag").innerHTML = "ON";
		} else {
			framecontentedit = false;
			$Id("switchflag").innerHTML = "OFF";
		}
		submitTryit();
		reEdited();
	}

	function logout() {
		if (confirm("Apakah kamu yakin ingin logout?")) {
			document.cookie = "lastOpened=; expires=Thu, 01 Jan 1970 00:00:00 UTC;";
			window.location.replace('logout.php');
		}
	}

	// Open last opened file
	window.onload = function() {
		const lastFile = document.cookie
  			.split("; ")
  			.find((row) => row.startsWith("lastOpened="))
  			?.split("=")[1];
		if (lastFile) loadFile(lastFile);
	}

</script>
<script src="js/FileSaver.js"></script>
<script>
	/* alert before leaving page
	window.addEventListener("beforeunload", function (e) {
		var confirmationMessage = 'It looks like you have been editing something. '
								+ 'If you leave before saving, your changes will be lost.';

		(e || window.event).returnValue = confirmationMessage; //Gecko + IE
		return confirmationMessage; //Gecko + Webkit, Safari, Chrome etc.
	});
	*/
</script>

</body>
</html>