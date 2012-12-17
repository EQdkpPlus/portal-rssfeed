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
 * $Id: german.php 4235 2009-03-16 11:02:35Z osr-corgan $
 */

if ( !defined('EQDKP_INC') ){
    header('HTTP/1.0 404 Not Found');exit;
}

$plang = array_merge($plang, array(
  'rssfeed'             => 'RSS Feeds',
  'pk_rssfeed_limit'    => 'Anzahl der Feedeinträge zur Anzeige',
  'pk_rssfeed_url'      => 'URL des RSS Feeds',
  'pk_rssfeed_nourl'    => 'Es wurde kein Feed angegeben',
  'pk_rssfeed_length'	=> 'Anzahl Zeichen vom Feed zur Anzeige',
  'pk_rssfeed_length_h' => 'Wenn das Feed-Modul extrem breit wird, liegt es unter Umständen daran, dass durch die Anzahl Zeichen ein HTML-Tag zerstört wird. Wenn in dem Tag sehr viele Zeichen stehen, kann kein Zeilenumbruch erfolgen und die linke Spalte wird sehr breit.',
));
?>