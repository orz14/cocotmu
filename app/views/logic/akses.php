<?php
if(!isset($_SESSION['cocotmulogin'])){
	echo "
		<script>
			alert('Anda harus login terlebih dahulu.');
			document.location.href = '".BASEURL."';
		</script>
	";
	exit;
}
?>
