<?php

namespace MAOSIJI\phpsuda\version;
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
if ( !class_exists('MaoVersion') ) {
	class MaoVersion {
		
		function __construct (  )
		{
			
		}
		
		/**
		 * @param $version	: 版本号，空值则返回false
		 *
		 * @return bool		检测版本号是否是正确的格式。检测结果：true 是，false 否
		 *               版本号格式一：10.0.24.458
		 *  			 版本号格式一：10.0.24
		 *  			 版本号格式一：10.0
		 *  			 版本号格式一：10
		 */
		public function checkVersion ( $version ): bool
		{
			if (empty($version)) {return false;}
			
			$one = preg_match( '/^[1-9][0-9]*$/', $version );
			$two = preg_match( '/^[0-9]*\.[0-9]*$/', $version );
			$three = preg_match( '/^[0-9]*\.[0-9]*\.[0-9]*$/', $version );
			$four = preg_match( '/^[0-9]*\.[0-9]*\.[0-9]*\.[0-9]*$/', $version );
			
			return $one || $two || $three || $four;
		}
		
		
	}
}
