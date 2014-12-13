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

class rssfeed_portal extends portal_generic {

	protected static $path		= 'rssfeed';
	protected static $data		= array(
		'name'			=> 'RSS Feed',
		'version'		=> '2.0.0',
		'author'		=> 'WalleniuM',
		'icon'			=> 'fa-rss-square',
		'contact'		=> EQDKP_PROJECT_URL,
		'description'	=> 'Shows an RSS Feed in portal',
		'lang_prefix'	=> 'rssfeed_'
	);
	protected static $positions = array('left1', 'left2', 'right');
	protected $settings	= array(
		'url'	=> array(
			'type'		=> 'text',
			'size'		=> '40',
		),
		'limit'	=> array(
			'type'		=> 'text',
			'size'		=> '5',
		),
		'length'	=> array(
			'type'		=> 'text',
			'size'		=> '3',
		)
	);
	protected static $install	= array(
		'autoenable'		=> '1',
		'defaultposition'	=> 'left2',
		'defaultnumber'		=> '9',
	);
	
	protected static $apiLevel = 20;

	public function output() {
		if($this->config('url')){
			$pk_rssfeed_limit = ($this->config('limit')) ? $this->config('limit') : 5;
			$pk_rssfeed_length = ($this->config('length')) ? $this->config('length') : 80;
			$this->tpl->add_css("
				#rssfeed_module{
					margin:0;
					padding:5px;
					height:200px;
					overflow: auto;
				}
				#rssfeed_module a {
					color:#FF9900;
					margin-bottom: 3px;
				}
				#rssfeed_module .rss_readmore{
					font-size:10px;
					margin-bottom: 5px;
				}
				#rssfeed_module .date{
					color:#999999;
					font-size:9px;
					margin: 3px 0 3px 0;
				}
				#rssfeed_module .description{
					margin:0;
					padding:0;
				}
				#rssfeed_module .description p {
					font-size:10px;
				}
				.mf-viral {display:none;}
				.loading{
					margin:25% 0% 0% 25%;
					float:left;
				}");
			$output = '<div id="rssfeed_module"></div>';

			// JS Part
			$this->jquery->rssFeeder('rssfeed_module', $this->server_path."portal/rssfeed/load.php".$this->SID."&loadrss=true", $pk_rssfeed_limit, $pk_rssfeed_length);
		}else{
			$output  = $this->user->lang('pk_rssfeed_nourl');
		}
		return $output;
	}
}
?>