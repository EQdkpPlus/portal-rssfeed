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
 * $Id: module.php 4235 2009-03-16 11:02:35Z osr-corgan $
 */

if ( !defined('EQDKP_INC') ){
  header('HTTP/1.0 404 Not Found');exit;
}

$portal_module['rssfeed'] = array(
			'name'           => 'RSS Feed',
			'path'           => 'rssfeed',
			'version'        => '1.0.1',
			'author'         => 'Wallenium',
			'contact'        => 'http://www.eqdkp-plus.com',
			'description'    => 'Shows an RSS Feed in portal',
			'positions'      => array('left1', 'left2', 'right'),
      		'signedin'       => '0',
      		'install'        => array(
			                            'autoenable'        => '0',
			                            'defaultposition'   => 'left2',
			                            'defaultnumber'     => '9',
			                            ),
    );

$portal_settings['rssfeed'] = array(
  'pk_rssfeed_url'     => array(
        'name'      => 'pk_rssfeed_url',
        'language'  => 'pk_rssfeed_url',
        'property'  => 'text',
        'size'      => '40',
        'help'      => '',
      ),
  'pk_rssfeed_limit'     => array(
        'name'      => 'pk_rssfeed_limit',
        'language'  => 'pk_rssfeed_limit',
        'property'  => 'text',
        'size'      => '5',
        'help'      => '',
      ),
  'pk_rssfeed_length'	=> array(
  		'name'		=> 'pk_rssfeed_length',
  		'language'	=> 'pk_rssfeed_length',
  		'property'	=> 'text',
  		'size'		=> '3',
  		'help'		=> 'pk_rssfeed_length_h',
      )  	
);

if(!function_exists(rssfeed_module))
{
  function rssfeed_module()
  {
  	global $eqdkp , $plang, $pcache, $pm, $jqueryp, $conf_plus, $eqdkp_root_path;

    if($conf_plus['pk_rssfeed_url']){
    $pk_rssfeed_limit = ($conf_plus['pk_rssfeed_limit']) ? $conf_plus['pk_rssfeed_limit'] : 5;
    $pk_rssfeed_length = ($conf_plus['pk_rssfeed_length']) ? $conf_plus['pk_rssfeed_length'] : 80;
    $output  = "<style>
                  #rssfeed_module{
                  	margin:0;
                  	padding:5px;
                  	height:200px;
                  	overflow: auto;
                  }
                  #rssfeed_module a{
                  	color:#FF9900;
                  	font-size:11px;
                  }
                  #rssfeed_module .rss_readmore{
                  	color:#f5f5f5;
                  	font-size:10px;
                  	margin-bottom: 5px;
                  }
                  #rssfeed_module .date{
                  	margin:0;
                  	color:#999999;
                  	font-size:9px;
                  }
                  #rssfeed_module .description{
                   	margin:0;
                   	padding:0;
                  }
                  #rssfeed_module .description p{
                  	font-size:10px;
                  }
                  .loading{
                  	margin:20% 0% 0% 40%;
                  	float:left;
                  }
                </style>";
  	$output .= '<div id="rssfeed_module"></div>';

  	// JS Part
  	$output .= '<script type="text/javascript">
	               $(document).ready(function(){';
  	$output .= $jqueryp->rssFeeder('rssfeed_module', $eqdkp_root_path."portal/rssfeed/load.php?loadrss=true", $pk_rssfeed_limit, $pk_rssfeed_length);
  	$output .= '});
	             </script>';
    }else{
      $output  = $plang['pk_rssfeed_nourl'];
    }
    return $output;
  }
}
?>
