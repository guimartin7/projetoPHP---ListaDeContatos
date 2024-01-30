<?php
	//Constantes com as credenciais de acesso ao banco MySQL
	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASS', '');
	define('DB_NAME', 'crud');

	// Configuração da url da aplicação
	// se o localhost possuir outra porta é so trocar 80 pela porta específica
	define('URL', 'http://localhost:80'); 
	define('APP', URL . dirname($_SERVER['PHP_SELF']) . '/');

	//Habilita todas as exibições de erro
	ini_set('display_errors', true);
	error_reporting(E_ALL);

	// Define o horário
	date_default_timezone_set('America/Sao_Paulo');

	//Inclui o arquivo de banco de dados
	require_once 'config/DB.php';
?>