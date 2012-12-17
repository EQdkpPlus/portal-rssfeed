<?php 
define('EQDKP_INC', true);
$eqdkp_root_path = './../../';
include_once($eqdkp_root_path . 'common.php');

if($in->get('loadrss')){
  $jqueryp->loadRssFeed($conf_plus['pk_rssfeed_url']);
}
?>