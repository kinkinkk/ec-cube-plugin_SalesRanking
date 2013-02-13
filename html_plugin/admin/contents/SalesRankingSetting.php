<?php
require_once '../../../../../data/config/config.php';
// {{{ requires
require_once '../../../../' . ADMIN_DIR .'require.php';

require_once './LC_Page_Admin_Contents_SalesRanking.php';

// }}}
// {{{ generate page

$objPage = new LC_Page_Admin_Contents_SalesRanking();
register_shutdown_function(array($objPage, 'destroy'));
$objPage->init();
$objPage->process();
