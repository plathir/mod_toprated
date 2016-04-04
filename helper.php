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

class modTopRatedHelper {

    public function getArticles(&$params) {
        $items = $params->get('items');
        $app = JFactory::getApplication();
        // DB connection
        $db = &jFactory::getDBO();

        $empty = 1;
        foreach ($params->get('catid') as $elm) {
            if (!empty($elm))
                $empty = 0;
        }

        if ($empty == 1) {
            $were_categ = 'WHERE state = 1 and language in (' . $db->quote(JFactory::getLanguage()->getTag()) . ',' . $db->quote('*') . ')';
        } else {
            $were_categ = 'WHERE state = 1 and language in (' . $db->quote(JFactory::getLanguage()->getTag()) . ',' . $db->quote('*') . ') and catid IN (' . implode(",", $params->get('catid')) . ')';
        }

        // Run DB Query
        $query = 'SELECT #__content.id, 
                         #__content.title, 
                         #__content.introtext,
                         #__content.catid,
                         #__content_rating.content_id ,
                         #__content_rating.rating_count ,
                       round( #__content_rating.rating_sum / #__content_rating.rating_count ) as ratenum
                    FROM #__content
                    INNER JOIN #__content_rating
                          ON #__content.id=#__content_rating.content_id ' .
                $were_categ .
                ' ORDER BY ratenum desc , rating_count desc';

        $db->setQuery($query, 0, $items);
        $rows = $db->loadObjectList();

        if ($db->getErrorNum()) {
            jError::raiseWarning(S00, $db->stderr(true));
        }
        return $rows;
    }

}

?>