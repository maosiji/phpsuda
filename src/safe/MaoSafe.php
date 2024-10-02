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
		 * @return void :判断是否连续点击按钮，并禁止
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
		
		/**
		 * @param string $captchaName	: 验证码名称
		 * @param string $captchaCode	: 验证码
		 * @param string $type		 	: 保存在 session 还是 cookie。默认值 all，全都保存；可选 session、cookie，只保存在其中一个。
		 * @param int    $timediff		: 时间间隔，默认600秒，即10分钟。单位是 秒。用于cookie的设置。
		 *
		 * @return true		: 设置 session或cookie，可用于验证码
		 */
		public function setCaptcha( string $captchaName, string $captchaCode, string $type='all', int $timediff=600 ): bool
		{
			$flag = TRUE;
			
			if ( $type==='all' ) {
				setcookie($captchaName, $captchaCode, $timediff, '/');
				$_SESSION[$captchaName] = $captchaCode;
			}
			else if ( $type==='session' ) {
				$_SESSION[$captchaName] = $captchaCode;
			}
			else if ( $type==='cookie' ) {
				setcookie($captchaName, $captchaCode, $timediff, '/');
			}
			else {
				$flag = FALSE;
			}
			
			return $flag;
		}
		
		/**
		 * @param string $captchaName	: 验证码名称
		 * @param string $captchaCode	: 验证码
		 * @param string $type			: all/session/cookie
		 * @param int    $isDelete		: 验证完成后是否删除。默认 1.
		 *                          0		不删除
		 *                          1		验证后删除
		 *                          2		验证成功后删除
		 *
		 * @return bool		: 验证设置的session或cookie
		 */
		public function checkCaptcha ( string $captchaName, string $captchaCode, string $type='all', int $isDelete=1 ): bool
		{
			$flag = FALSE;
			
			if ( $type==='all' ) {
				if ( $captchaCode===$_COOKIE[$captchaName] && $captchaCode===$_SESSION[$captchaName] ) {
					$flag = TRUE;
				}
			}
			else if ( $type==='session' ) {
				if ( $captchaCode===$_SESSION[$captchaName] ) {
					$flag = TRUE;
				}
			}
			else if ( $type==='cookie' ) {
				if ( $captchaCode===$_COOKIE[$captchaName] ) {
					$flag = TRUE;
				}
			}
			
			if ( $isDelete===2 && $flag===TRUE ) {
				setcookie("captcha", '', time() - 3600, '/');
				unset($_SESSION['captcha']);
			}
			else if ( $isDelete===1 ) {
				setcookie("captcha", '', time() - 3600, '/');
				unset($_SESSION['captcha']);
			}
			
			return $flag;
		}
		
		
		
	}
}
