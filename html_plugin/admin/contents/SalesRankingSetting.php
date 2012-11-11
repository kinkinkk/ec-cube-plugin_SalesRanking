<?php

// {{{ requires
require_once '../../../../admin/require.php';
require_once './LC_Page_Admin_Contents_SalesRanking.php';

// }}}
// {{{ generate page

$objPage = new LC_Page_Admin_Contents_SalesRanking();
register_shutdown_function(array($objPage, 'destroy'));
$objPage->init();
$objPage->process();
