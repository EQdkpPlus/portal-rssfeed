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

class rssfeed_rss extends gen_class {
	public static $shortcuts = array('puf'=>'urlfetcher');

	//Config
	var $cachetime			= 600;
	var $checkURL_first		= true ;
	var $blnWideContent		= false;
	var $moduleID			= 0;
	var $count				= 5;

	//return vars
	var $title 				= null;
	var $link 				= null;
	var $description		= null;
	var $lastcreate 		= null;
	var $feed				= null;
	var $news				= null;
	var $updated			= null;
	var $header				= '';
	var $output_left		= '';
	var $rssurl				= false;


	/**
	 * Constructor
	 *
	 */
	public function __construct($intModuleID){
		
		$this->output = 'RSS Feed not available.';
		
		$this->moduleID = $intModuleID;
		
		$this->count = $this->config->get('limit', 'pmod_'.$this->moduleID);
		$this->rssurl = $this->config->get('url', 'pmod_'.$this->moduleID);
		$this->layout = $this->config->get('layout', 'pmod_'.$this->moduleID);
		$this->length = $this->config->get('length', 'pmod_'.$this->moduleID);

		$this->parseXML($this->GetRSS($this->rssurl));
		if ($this->news){
			$this->createOutput();
		}
	}

	/**
	 * GetRSS get the RSS Feed from an given URL
	 * Check if an refresh is needed
	 *
	 * @param String $url must be an valid RSS Feed
	 * @return String
	 */
	private function GetRSS($url){
		$rss_string = $this->pdc->get('portal.rssfeed.rss.'.$this->moduleID);
		if ($rss_string == null) {
			//nothing cached or expired
			$this->tpl->add_js('$.get("'.$this->server_path.'portal/rssfeed/update.php'.$this->SID.'&mid='.$this->moduleID.'");');
			//Is there some expired data?
			$expiredData = $this->pdc->get('portal.rssfeed.rss.'.$this->moduleID, false, false, true);
			$rss_string = ($expiredData != null) ? $expiredData : "";
		}

		return $this->decodeRSS($rss_string);
	}

	public function updateRSS(){
		$this->puf->checkURL_first = $this->checkURL_first;
		$rss_string = $this->puf->fetch($this->rssurl);
		$rss_string = is_utf8($rss_string) ? $rss_string : utf8_encode($rss_string);
		if ($rss_string && strlen($rss_string)>1){
			$this->pdc->put('portal.rssfeed.rss.'.$this->moduleID, @base64_encode($rss_string), $this->cachetime);
		} else {
			$this->pdc->put('portal.rssfeed.rss.'.$this->moduleID, "", $this->cachetime);
		}
	}

	private function decodeRSS($rss){
		if (!strlen($rss)) return '';
		$rss_string = @base64_decode($rss);
		return $rss_string;
	}

	/**
	 * parseXML
	 * parse the XML Data into an Array
	 *
	 * @param RSS-XML $rss
	 */
	private function parseXML($strContent){
		try{
			$document = new \DOMDocument('1.0', 'UTF-8');
			$document->preserveWhiteSpace = false;
			
			$document->loadXML($strContent);
			
			$xpath = new \DOMXPath($document);
			
			if($document->documentElement !== null && $document->documentElement !== false && is_object($document->documentElement)){
				$namespace = $document->documentElement->getAttribute('xmlns');
				$xpath->registerNamespace('ns', $namespace);
			} else {
				
				return;
			}
			
			$rootNode = $xpath->query('/*')->item(0);
			
			if ($rootNode === null) {
				return;
			}
			
			if ($rootNode->nodeName == 'feed') {
				$data = $this->readAtomFeed($xpath);
			} else if ($rootNode->nodeName == 'rss') {
				$data = $this->readRssFeed($xpath);
			} else {
				return;
			}
			
			if (empty($data)) return;
			
			$this->news = $data;
			
		} catch(Exception $e){
			
		}

	} # end function
	
	public function createOutput(){	
		if (is_array($this->news)){
			
			if($this->layout == 'accordion'){
				$newstick_array = array();
				
				foreach ($this->news as $key => $value){
					
					// Generate an array fo an accordion
					// array style: title => content
					$newstick_array[(string)$value['title']] = $this->createBody(
							$value['description'],
							$value['link'],
							$value['time']
							);
					
				}#  end foreach
				
				$this->output = '<div style="white-space:normal;">'.$this->jquery->accordion('rssfeed_'.$this->moduleID,$newstick_array).'</div>';
			} else {
				$table = '<div class="rssfeed-wrapper">';
				
				foreach ($this->news as $key => $value){
					$desc = ($this->length != "") ? truncate($value['description'], $this->length, '…', false) : $value['description'];
					
					$table .= '<div class="tr"><div class="td">';
					$table .= '<h4>'.sanitize($value['title']).'</h4>';
					$table .= '<div class="small rssfeed-date">'.$this->time->user_date($value['time'], true).'</div>';
					$table .= '<div class="rssfeed-content"><a href="'.sanitize($value['link']).'" target="_blank">'.sanitize($desc).'</a></div>';
					$table .= '</div></div>';
				}
				
				$table .= '</div>';
				
				$this->output = $table;
			}

			

		}
	}

	/**
	 * createBody
	 *
	 * @param  String $disc
	 * @param  String $author
	 * @param  String $date
	 * @return String
	 */
	private function createBody($desc, $link, $date=""){
		$desc = ($this->length != "") ? truncate($desc, $this->length, '…', false) : $desc;
		
		$content = '<a href="'.sanitize($link).'" target="_blank">'.sanitize($desc).'</a>';
		$footer = '<div class="small">'.$this->time->user_date($date, true).'</div>';
		return $content.'<br />'.$footer;
	}
	
	protected function readAtomFeed($xpath) {
		// get items
		$items = $xpath->query('//ns:entry');
		$data = array();
		$i = 0;
		foreach ($items as $item) {
			$strAlternateLink = "";
			$childNodes = $xpath->query('child::*', $item);
			$itemData = array();
			foreach ($childNodes as $childNode) {
				//  && $childNode->getAttribute('rel') == 'alternate'
				if($childNode->nodeName == 'link'){
					$rel = $childNode->getAttribute('rel');
					if($rel && $rel != "" && $rel == 'alternate'){
						$strAlternateLink = $childNode->getAttribute('href');
					} elseif(!$rel || $rel == ''){
						if($strAlternateLink == "") $strAlternateLink = $childNode->getAttribute('href');
					}
				} else {
					$itemData[$childNode->nodeName] = $childNode->nodeValue;
				}
			}
			
			// validate item data
			if (empty($itemData['title']) || empty($itemData['id']) || (empty($itemData['content']) && empty($itemData['summary']))) {
				continue;
			}
			
			$hash = sha1($itemData['id']);
			if (isset($itemData['published'])) {
				$time = strtotime($itemData['published']);
				if ($time > $this->time->time) continue;
			} elseif(isset($itemData['updated'])) {
				$time = strtotime($itemData['updated']);
				if ($time > $this->time->time) continue;
			} else {
				$time = $this->time->time;
			}
			
			if (!empty($itemData['textContent'])) {
				$description = $itemData['textContent'];
			}elseif (!empty($itemData['content'])) {
				$description = $itemData['content'];
			} else {
				$description = $itemData['summary'];
			}
			
			// get data
			$data[$hash] = array(
					'title'			=> $itemData['title'],
					'link'			=> (strlen($strAlternateLink)) ? $strAlternateLink : $itemData['id'],
					'description'	=> strip_tags($description),
					'time'			=> $time,
					'hash'			=> $hash,
			);
			
			// check max results
			$i++;
			if ($i == $this->count) {
				break;
			}
		}
		
		return $data;
	}
	
	protected function readRssFeed($xpath) {
		// get items
		$items = $xpath->query('//channel/item');
		$data = array();
		$i = 0;
		foreach ($items as $item) {
			$childNodes = $xpath->query('child::*', $item);
			$itemData = array();
			foreach ($childNodes as $childNode) {
				if ($childNode->nodeName != 'category') {
					$itemData[$childNode->nodeName] = $childNode->nodeValue;
				}
			}
			
			// validate item data
			if (empty($itemData['title']) || empty($itemData['link']) || (empty($itemData['description']) && empty($itemData['content:encoded']))) {
				continue;
			}
			if (!empty($itemData['guid'])) {
				$hash = sha1($itemData['guid']);
			}
			else {
				$hash = sha1($itemData['link']);
			}
			if (isset($itemData['pubDate'])) {
				$time = strtotime($itemData['pubDate']);
				if ($time > $this->time->time) continue;
			}
			else {
				$time = $this->time->time;
			}
			

			if(!empty($itemData['description'])){
				$description = strip_tags($itemData['description']);
			} elseif(!empty($itemData['content:encoded'])){
				$description = strip_tags($itemData['content:encoded']);
			}

			// get data
			$data[$hash] = array(
					'title' 		=> $itemData['title'],
					'link' 			=> $itemData['link'],
					'description'	=> $description,
					'time'			=> $time,
					'hash'			=> $hash,
			);
			
			// check max results
			$i++;
			if ($i == $this->count) {
				break;
			}
		}
		
		return $data;
	}
}
?>
