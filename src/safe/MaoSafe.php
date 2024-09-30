<?php

namespace MAOSIJI\phpsuda\safe;
session_start();
/*
 * author               : 猫斯基
 * url                  : maosiji.com
 * email                : code@maosiji.cn
 * date                 : 2024-09-30 12:26
 * update               : 
 * project              : phpsuda
 * official website     : wpsuda.cn
 * official name        : WP速搭
 * official email       : wpsuda@qq.com
 * description          : 
 * read me              : 感谢您使用 WP速搭 的产品。您的支持，是我们最大的动力；您的反对，是我们最大的阻力
 * remind               ：使用盗版，存在风险；支持正版，将会有跟多的产品与您见面
 */
if ( !class_exists('MaoSafe') ) {
	class MaoSafe {
		
		function __construct() {
		
		}
		
		/**
		 * @param int $timediff :自定义时间间隔，默认5秒
		 *
		 * @return void 需要在页面顶部添加 session_start();
		 */
		public function checkTooManyRequests( int $timediff=5 ) {
			// 检查session中是否有上一次请求的时间戳
			if (isset($_SESSION['last_request_time'])) {
				$lastRequestTime = $_SESSION['last_request_time'];
				$currentTime = time();
				
				// 计算两次请求之间的时间差
				$timeDifference = $currentTime - $lastRequestTime;
				
				// 设定最小请求间隔时间（秒）
				$minInterval = $timediff;
				
				if ($timeDifference < $minInterval) {
					header("HTTP/1.1 429 Too Many Requests");
					exit();
				}
			}
			
			// 更新session中的请求时间
			$_SESSION['last_request_time'] = time();
		}
		
	}
}
