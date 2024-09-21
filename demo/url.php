<?php
/*
 * author               : 猫斯基
 * url                  : maosiji.com
 * email                : code@maosiji.cn
 * date                 : 2024-09-20 17:50
 * update               :
 * project              : phpsuda
 * official website     : maosiji.com
 * official name        : PHP速搭
 * description          : 这家伙很懒，没有写介绍
 * read me              :
 * remind               ：
 */
require __DIR__ . '/../vendor/autoload.php';
use MAOSIJI\phpsuda\url\MaoUrl;

$maoUrl = new MaoUrl();

// 获取当前 URL
$currentUrl = $maoUrl->getUrl();
//var_dump($currentUrl);

// 给url添加参数
$addParam = array(
	'name'=>'maosiji',
	'age'=>'80',
);
$urlAddParam = $maoUrl->urlAddParam($currentUrl, $addParam);
//var_dump($urlAddParam); // ?name=maosiji&age=80

// 给url删除参数
$deleteParam = array(
	'age'=>'80',
);
$urlDeleteParam = $maoUrl->urlDeleteParam($urlAddParam, $deleteParam);
//	var_dump($urlDeleteParam); // ?name=maosiji
