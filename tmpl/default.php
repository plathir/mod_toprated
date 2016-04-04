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
$mainframe = &JFactory::getApplication('site');

foreach ($articles as $articles) {
    for ($i = 1; $i <= 5; $i++) {
        if (round($articles->ratenum, 0) >= $i) {
            if ($params->get('star') != '') {
                echo '<img src=' . JURI::base() . $params->get('star') . ' alt="">';
            } else {
                if (file_exists('templates/' . $mainframe->getTemplate() . '/images/system/rating_star.png')) {
                    echo '<img src=' . JURI::base() . '/templates/' . $mainframe->getTemplate() . '/images/system/rating_star.png alt="">';
                } else {
                    echo '<img src=' . JURI::base() . 'media/system/images/rating_star.png alt="">';
                }
            }
        } else {
            if ($params->get('star_blank') != '') {
                echo '<img src=' . JURI::base() . $params->get('star_blank') . ' alt="">';
            } else {
                if (file_exists('templates/' . $mainframe->getTemplate() . '/images/system/rating_star_blank.png')) {
                    echo '<img src=' . JURI::base() . '/templates/' . $mainframe->getTemplate() . '/images/system/rating_star_blank.png alt="">';
                } else {
                    echo '<img src=' . JURI::base() . 'media/system/images/rating_star_blank.png alt="">';
                }
            }
        }
    }
    echo ' (' . $articles->rating_count . ') ';
    ?>
    <a href="<?php echo ContentHelperRoute::getArticleRoute($articles->id, $articles->catid); ?>"><?php echo $articles->title ?></a><br>
    <?php
    if ($params->get('introtext') == '1') {
        echo $articles->introtext . '<br><br>';
    }
}
?>
