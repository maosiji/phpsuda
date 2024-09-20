<?php

namespace MAOSIJI\phpsuda;
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
if ( !class_exists( 'MaoTool' ) ) {
	class MaoTool
	{
		
		function __construct ()
		{
		}
		
		
		/*
		 *
		 * 版本号格式一：10.0.24.458
		 * 版本号格式一：10.0.24
		 * 版本号格式一：10.0
		 * 版本号格式一：10
		 * */
		/**
		 * @param $version	: 版本号
		 *
		 * @return bool		版本号检测结果：true 是，false 否
		 */
		public function maoCheckVersion ( $version )
		{
			
			$one = preg_match( '/^[1-9][0-9]*$/', $version );
			$two = preg_match( '/^[0-9]*\.[0-9]*$/', $version );
			$three = preg_match( '/^[0-9]*\.[0-9]*\.[0-9]*$/', $version );
			$four = preg_match( '/^[0-9]*\.[0-9]*\.[0-9]*\.[0-9]*$/', $version );
			
			return ( $one || $two || $three || $four ) ? TRUE : FALSE;
		}
		
		/*
		 * 价格转换器  最终效果：10.00
		 *
		 * 应用：
		 * 		玄鸟支付
		 * */
		public function format_price ( $price )
		{

//		if ( !is_numeric($price) ) { $price = 0.00; }
			
			if ( doubleval( $price ) <= 0.00 ) {
				$price = 0.00;
			}
			// 判断是否为小数
			if ( strpos( $price, '.' ) ) {
				$price = ceil( $price * 100 ) / 100;
			}
			
			return sprintf( "%.2f", $price );
		}
		
		/**
		 * @param $length	int 随机数位数
		 *
		 * @return int		指定位数的随机数
		 */
		public function maoGetRandNumber ( $length = 6 )
		{
			return rand( pow( 10, $length - 1 ), pow( 10, $length ) - 1 );
		}
		
		
	}
}
