<?php
/*------------------------------------------------------------------------
# mod_toprated - Top Rated Articles
# ------------------------------------------------------------------------
# author : developerpages
# copyright Copyright (C) 2013 developerpages.gr . All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.developerpages.gr
# Technical Support:  Forum - http://developerpages.gr/index.php/en/forum/index
-------------------------------------------------------------------------*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 

//include the syndicate functions only once
require_once(dirname(__file__).DIRECTORY_SEPARATOR.'helper.php');

// Load helper class and functions
$articles = modTopRatedHelper::getArticles($params);
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

// Load layout filefrom template views
require(JModuleHelper::getLayoutPath('mod_toprated'));

?>
