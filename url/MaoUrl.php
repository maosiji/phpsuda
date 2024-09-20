<?php

namespace MAOSIJI\phpsuda\url;
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
if ( !class_exists( 'MaoUrl' ) ) {
	class MaoUrl
	{
		
		function __construct ()
		{
		}
		
		
		/**
		 * @return string: 当前网页链接
		 */
		public function maoGet ()
		{
			
			$sys_protocal = isset( $_SERVER['SERVER_PORT'] ) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
			$php_self = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
			$path_info = isset( $_SERVER['PATH_INFO'] ) ? $_SERVER['PATH_INFO'] : '';
			$relate_url = isset( $_SERVER['REQUEST_URI'] ) ? $_SERVER['REQUEST_URI'] : $php_self . ( isset( $_SERVER['QUERY_STRING'] ) ? '?' . $_SERVER['QUERY_STRING'] : $path_info );
			
			return $sys_protocal . ( isset( $_SERVER['HTTP_HOST'] ) ? $_SERVER['HTTP_HOST'] : '' ) . $relate_url;
		}
		
		/**
		 * 给指定链接删除参数
		 *
		 * @param $url :指定链接。为空，则默认当前链接
		 * @param $arr :需要删除的参数数组。为空，则全部删除
		 *
		 * @return string 删除指定参数后的链接
		 */
		public function maoDeleteUrlParam ( $url, $arr )
		{
			$pageURL = 'http';
			if ( isset( $_SERVER['HTTPS'] ) && $_SERVER["HTTPS"] == "on" ) {
				$pageURL .= "s";
			}
			$pageURL .= "://";
			$this_page = $_SERVER["REQUEST_URI"];
			//过滤要提交的参数
			if ( empty( $arr ) ) {
				if ( strpos( $this_page, "?" ) !== FALSE ) {
					$this_pages = explode( "?", $this_page );
					$this_page = reset( $this_pages );
				}
			} else {
				parse_str( parse_url( $this_page, PHP_URL_QUERY ), $params );
				foreach ( $arr as $one ) {
					unset( $params[$one] );
				}
				$query = http_build_query( $params );
				$this_page = str_replace( '?' . $_SERVER['QUERY_STRING'], '', $this_page );
				$this_page .= !empty( $query ) ? '?' . $query : '';
			}
			
			$pageURL .= $_SERVER["SERVER_NAME"] . $this_page;
			
			return $pageURL;
		}
		
		/*
		 * 给指定链接添加参数
		 * */
		/**
		 * @param $url: 指定链接。为空，则默认当前链接
		 * @param $arr: 需要添加的参数数组。为空，则返回链接
		 *
		 * @return string    添加指定参数后的链接
		 */
		public function add_url_params ( $url, $arr )
		{
			
			$url = !empty( $url ) ? $url : $this->maoGet();
			$p = ( !empty( $arr ) && is_array( $arr ) ) ? $arr : array();
			
			if ( count( $p ) == 0 ) {
				return $url;
			}
			
			parse_str( parse_url( $url, PHP_URL_QUERY ), $params );
			
			foreach ( $p as $pkey => $pvalue ) {
				$params[$pkey] = $pvalue;
			}
			
			$query = http_build_query( $params );
			
			if ( strpos( $url, '?' ) ) {
				$this_url = strstr( $url, '?', TRUE );
			} else {
				$this_url = $url;
			}
			
			return $this_url . '?' . $query;
		}
		
		
	}
}
