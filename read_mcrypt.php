<?php
/*Dekripcija podataka sa MCrypt*/
session_start(); 

//Postoje li kriptirani podaci
if (isset($_SESSION['podaci'], $_SESSION['iv'])) {

	//Stvori ključ
	$key = md5('jed4n j4k0 v3l1k1 kljuc');
	
	//Otvori cipher Rijndael 256 u CBC modu
	$m = mcrypt_module_open('rijndael-256', '', 'cbc', '');
	
	//Dekodiraj IV
	$iv = base64_decode($_SESSION['iv']);
	
	//Inicijalizacija enkripcije
	mcrypt_generic_init($m, $key, $iv);
	
	// Dekriptiraj podatke:
	$data = mdecrypt_generic($m, base64_decode($_SESSION['podaci']));
	
	//Zatvori handler za enkripciju
	mcrypt_generic_deinit($m);
	
	//Zatvori cipher
	mcrypt_module_close($m);
	
	//Ispiši podatke
	echo '<p>Dekriptirani podaci su "' . trim($data) . '".</p>';

} else {
	echo '<p>Nema podataka.</p>';
}
?>