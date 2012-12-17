<?php
/*
 * Project:     EQdkp-Plus
 * License:     Creative Commons - Attribution-Noncommercial-Share Alike 3.0 Unported
 * Link:		http://creativecommons.org/licenses/by-nc-sa/3.0/
 * -----------------------------------------------------------------------
 * Began:       2008
 * Date:        $Date: 2009-03-16 12:02:35 +0100 (Mo, 16 Mrz 2009) $
 * -----------------------------------------------------------------------
 * @author      $Author: osr-corgan $
 * @copyright   2006-2008 Corgan - Stefan Knaak | Wallenium & the EQdkp-Plus Developer Team
 * @link        http://eqdkp-plus.com
 * @package     eqdkp-plus
 * @version     $Rev: 4235 $
 *
 * $Id: english.php 4235 2009-03-16 11:02:35Z osr-corgan $
 */

if ( !defined('EQDKP_INC') ){
    header('HTTP/1.0 404 Not Found');exit;
}

$plang = array_merge($plang, array(
  'rssfeed'             => 'RSS Feeds',
  'pk_rssfeed_limit'    => 'Amount of feed items to show',
  'pk_rssfeed_url'      => 'URL of the RSS Feed',
  'pk_rssfeed_nourl'    => 'Please setup a Feed first',
  'pk_rssfeed_length'	=> 'Amount of characters from feed to show',
  'pk_rssfeed_length_h' => 'If the feed-module becomes extreme wide, the problem may be a destroyed HTML-Tag, because of the limited characters. If there are many characters without a white-space in that tag, there will be no new line and so the whole left-column becomes very wide.',
));
?>