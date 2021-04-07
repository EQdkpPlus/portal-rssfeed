<?php
/*	Project:	EQdkp-Plus
 *	Package:	RSS Portal Module
 *	Link:		http://eqdkp-plus.eu
 *
 *	Copyright (C) 2006-2018 EQdkp-Plus Developer Team
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
			'version'		=> '4.0.1',
			'author'		=> 'GodMod',
			'icon'			=> 'fa-rss-square',
			'contact'		=> EQDKP_PROJECT_URL,
			'description'	=> 'Shows an RSS Feed in portal',
			'lang_prefix'	=> 'rssfeed_',
			'multiple'		=> true,
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
			),
			'layout'	=> array(
					'type'		=> 'dropdown',
					'options'	=> array('direct' => 'Direct', 'accordion' => 'Accordion'),
			)
	);
	protected static $install	= array(
			'autoenable'		=> '1',
			'defaultposition'	=> 'left2',
			'defaultnumber'		=> '9',
	);
	
	protected static $apiLevel = 20;

	public function output() {
		//Calculate Max Width
		if($this->user->style['column_left_width'] != ""){
			if(strpos($this->user->style['column_left_width'], 'px') !== false){
				$max_width = (intval($this->user->style['column_left_width']) - 30).'px';
			} else {
				$max_width = '97%';
			}
			
		} else {
			$max_width = "180px";
		}
		
		$this->tpl->add_css(
			'.rssfeed_portal .ui-accordion .ui-accordion-content {
				padding: 4px;
			}
			
			.rssfeed-wrapper {
				height:250px;
				overflow: auto;
			}

			.rssfeed-content {
				max-width: '.$max_width.';
				word-wrap:break-word;
				padding-top: 5px;
			}

			'	
		);
		
		include_once($this->root_path .'portal/rssfeed/rssfeed_rss.class.php');
		$class = registry::register('rssfeed_rss', array($this->id));
		$output = $class->output;

		return $output;
	}
}
?>
