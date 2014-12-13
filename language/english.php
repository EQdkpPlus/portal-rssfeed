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
	'rssfeed_desc'			=> 'Shows an RSS Feed in portal',
	'rssfeed_f_limit'		=> 'Amount of feed items to show',
	'rssfeed_f_url'			=> 'URL of the RSS Feed',
	'pk_rssfeed_nourl'		=> 'Please setup a Feed first',
	'rssfeed_length'		=> 'Amount of characters from feed to show',
	'rssfeed_f_help_length'	=> 'If the feed-module becomes extreme wide, the problem may be a destroyed HTML-Tag, because of the limited characters. If there are many characters without a white-space in that tag, there will be no new line and so the whole left-column becomes very wide.',
);
?>