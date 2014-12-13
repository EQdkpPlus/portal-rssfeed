<?php
/*	Project:	EQdkp-Plus
 *	Package:	RSS Feed Portal Module
 *	Link:		http://eqdkp-plus.eu
 *
 *	Copyright (C) 2006-2015 EQdkp-Plus Developer Team
 *
 *	This program is free software: you can redistribute it and/or modify
 *	it under the terms of the GNU Affero General Public License as published
 *	by the Free Software Foundation, either version 3 of the License, or
 *	(at your option) any later version.
 *
 *	This program is distributed in the hope that it will be useful,
 *	but WITHOUT ANY WARRANTY; without even the implied warranty of
 *	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *	GNU Affero General Public License for more details.
 *
 *	You should have received a copy of the GNU Affero General Public License
 *	along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

if ( !defined('EQDKP_INC') ){
	header('HTTP/1.0 404 Not Found');exit;
}

$lang = array(
	'rssfeed'				=> 'RSS Feeds',
	'rssfeed_name'			=> 'RSS Feed Module',
	'rssfeed_desc'			=> 'Zeigt einen RSS Feed im Portal an',
	'rssfeed_f_limit'		=> 'Anzahl der Feedeinträge zur Anzeige',
	'rssfeed_f_url'			=> 'URL des RSS Feeds',
	'pk_rssfeed_nourl'		=> 'Es wurde kein Feed angegeben',
	'rssfeed_f_length'		=> 'Anzahl Zeichen vom Feed zur Anzeige',
	'rssfeed_f_help_length'	=> 'Wenn das Feed-Modul extrem breit wird, liegt es unter Umständen daran, dass durch die Anzahl Zeichen ein HTML-Tag zerstört wird. Wenn in dem Tag sehr viele Zeichen stehen, kann kein Zeilenumbruch erfolgen und die linke Spalte wird sehr breit.',
);
?>