<?php
// {{{ requires
require_once HTML_REALDIR . 'require.php';
require_once 'frontparts_bloc/SalesRankingBloc.php';

// }}}
// {{{ generate page

$objPage = new SalesRankingBloc();
$objPage->blocItems = $params['items'];
register_shutdown_function(array($objPage, 'destroy'));
$objPage->init();
$objPage->process();
