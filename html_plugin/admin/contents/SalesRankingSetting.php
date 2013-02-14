<?php
// {{{ requires
require_once '../require.php';

require_once PLUGIN_HTML_REALDIR . '/SalesRankingKNZTK/admin/contents/LC_Page_Admin_Contents_SalesRanking.php';

// }}}
// {{{ generate page

$objPage = new LC_Page_Admin_Contents_SalesRanking();
register_shutdown_function(array($objPage, 'destroy'));
$objPage->init();
$objPage->process();
