<?php
include_once("pagination.class.php");


$paginate = new oldPagination();
$paginateOld = new Pagination();


$total_items = 250;
$active_page = 2;


echo 'zaznamu: ' . $total_items;
echo '<br>';
echo 'aktivni stranka: ' . $active_page;
echo '<br>';

$paginate
		->setSize(5)	// optional
		->perPage(10) // optional
		->totalItems($total_items)	// required
		->activePage($active_page)	// required
		->setUrl($_SERVER['SERVER_NAME'])	// recommended, full http://www.somewhere.com/article/
		->setUrlParams("&active=1&sortby=2")	// optional
		->render();	// required

echo $paginate->out('html'); // output type, default is html
var_dump($paginate->out('array'));



$paginateOld
		->setSize(5)	// optional
		->perPage(10) // optional
		->totalItems($total_items)	// required
		->activePage($active_page)	// required
		->setUrl($_SERVER['SERVER_NAME'])	// recommended, full http://www.somewhere.com/article/
		->setUrlParams("?active=1&sortby=2")	// optional
		->render();	// required

echo $paginateOld->out('html'); // output type, default is html
var_dump($paginateOld->out('array'));

