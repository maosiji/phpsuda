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
use MAOSIJI\phpsuda\time\MaoTime;

// 计算时间差
$beginTime = time();
//$endTime = strtotime("2025-02-02");
$endTime = time();
$maoTime = new MaoTime();
$timeDiff = $maoTime->maoTimeDiff($beginTime, $endTime);
print_r($timeDiff);
