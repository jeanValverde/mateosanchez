<?php
	session_start();
	session_destroy();
	if (isset($_COOKIE['nombre_cuenta'])) {
		unset($_COOKIE['nombre_cuenta']);
		setcookie('nombre_cuenta', '', time()-3600, '/'); // empty value and old timestamp
	}
	if (isset($_COOKIE['correo_cuenta'])) {
		unset($_COOKIE['correo_cuenta']);
		setcookie('correo_cuenta', '', time()-3600, '/'); // empty value and old timestamp
	}
	if (isset($_COOKIE['clave_cuenta'])) {
		unset($_COOKIE['clave_cuenta']);
		setcookie('clave_cuenta', '', time()-3600, '/'); // empty value and old timestamp
	}
	if (isset($_COOKIE['nivel_cuenta'])) {
		unset($_COOKIE['nivel_cuenta']);
		setcookie('nivel_cuenta', '', time()-3600, '/'); // empty value and old timestamp
	}
	if (isset($_COOKIE['id_cuenta'])) {
		unset($_COOKIE['id_cuenta']);
		setcookie('id_cuenta', '', time()-3600, '/'); // empty value and old timestamp
	}
	if (isset($_COOKIE['id_franquicia'])) {
		unset($_COOKIE['id_franquicia']);
		setcookie('id_franquicia', '', time()-3600, '/'); // empty value and old timestamp
	}
	header("location: ../index.html");
?>