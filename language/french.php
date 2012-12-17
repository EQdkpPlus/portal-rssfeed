<?php

if (!defined('EQDKP_INC')) {
	die('You cannot access this file directly.');
}

//Language: French	
//Created by EQdkp Plus Translation Tool on  2010-07-09 13:55
//File: module_rssfeed
//Source-Language: english

$alang = array( 
"rssfeed" => "Flux RSS",
"pk_rssfeed_limit" => "Nombre de flux à afficher",
"pk_rssfeed_url" => "Url du flus RSS",
"pk_rssfeed_nourl" => "Veuillez paramétrer le flux en premier",
"pk_rssfeed_length" => "Nombre de caractères du flux à afficher",
"pk_rssfeed_length_h" => "Si le module de flux devient trop gros, un probleme de suppression de tag HTML peut survenir, a cause du nombre limité de caractère. S'il y a trop de caractères dans espaces dans le tag, il n'y aura aucune ligne et la colonne de gauche sera extrêmement large!",
 );
$plang = array_merge($plang, $alang);
?>