<?php

namespace MAOSIJI\phpsuda\connection;
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
if ( !class_exists( 'MaoCurl' ) ) {
	class MaoCurl
	{
		
		function __construct ()
		{
		}
		
		public function _getHeaderArray ( $headerArray, $headerNewArray, $isOverWrite )
		{
			if ( !empty( $headerNewArray ) ) {
				if ( !empty( $isOverWrite ) ) {
					$headerArray = $headerNewArray;
				} else {
					$headerArray = array_merge( $headerArray, $headerNewArray );
				}
			}
			
			return $headerArray;
		}
		
		/*
		 * @param string $url	链接
		 * @param int	$isOverWriteHeader	是否覆盖 Header
		 * @param array $headerNewArray	Header数组
		 *
		 * @return array
		 *
		 * @throw
		 * @see
		 * @example
		 * */
		public function maoGet ( $url, $isOverWriteHeader = 0, $headerNewArray = array() )
		{
			
			$headerArray = array( "Content-type:application/json;", "Accept:application/json" );
			$headerArray = $this->_getHeaderArray( $headerArray, $headerNewArray, $isOverWriteHeader );
			
			$ch = curl_init();
			curl_setopt( $ch, CURLOPT_URL, $url );
			curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
			curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, FALSE );
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
			curl_setopt( $ch, CURLOPT_HTTPHEADER, $headerArray );
			$output = curl_exec( $ch );
			curl_close( $ch );
			
			return json_decode( $output, TRUE );
		}
		
		public function maoPost ( $url, $data, $isOverWriteHeader = 0, $headerNewArray = array() )
		{
			
			$data = json_encode( $data );
			$headerArray = array( "Content-type:application/json;charset='utf-8'", "Accept:application/json" );
			$headerArray = $this->_getHeaderArray( $headerArray, $headerNewArray, $isOverWriteHeader );
			
			$curl = curl_init();
			curl_setopt( $curl, CURLOPT_URL, $url );
			curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, FALSE );
			curl_setopt( $curl, CURLOPT_SSL_VERIFYHOST, FALSE );
			curl_setopt( $curl, CURLOPT_POST, 1 );
			curl_setopt( $curl, CURLOPT_POSTFIELDS, $data );
			curl_setopt( $curl, CURLOPT_HTTPHEADER, $headerArray );
			curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
			$output = curl_exec( $curl );
			curl_close( $curl );
			
			return json_decode( $output, TRUE );
		}
		
		public function maoPut ( $url, $data, $isOverWriteHeader = 0, $headerNewArray = array() )
		{
			
			$data = json_encode( $data );
			$headerArray = array( 'Content-type:application/json' );
			$headerArray = $this->_getHeaderArray( $headerArray, $headerNewArray, $isOverWriteHeader );
			
			$ch = curl_init(); //初始化CURL句柄
			curl_setopt( $ch, CURLOPT_URL, $url ); //设置请求的URL
			curl_setopt( $ch, CURLOPT_HTTPHEADER, $headerArray );
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 ); //设为TRUE把curl_exec()结果转化为字串，而不是直接输出
			curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, "PUT" ); //设置请求方式
			curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );//设置提交的字符串
			$output = curl_exec( $ch );
			curl_close( $ch );
			
			return json_decode( $output, TRUE );
		}
		
		public function maoDelete ( $url, $data, $isOverWriteHeader = 0, $headerNewArray = array() )
		{
			
			$data = json_encode( $data );
			$headerArray = array( 'Content-type:application/json' );
			$headerArray = $this->_getHeaderArray( $headerArray, $headerNewArray, $isOverWriteHeader );
			
			$ch = curl_init();
			curl_setopt( $ch, CURLOPT_URL, $url );
			curl_setopt( $ch, CURLOPT_HTTPHEADER, $headerArray );
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
			curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, "DELETE" );
			curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
			$output = curl_exec( $ch );
			curl_close( $ch );
			
			return json_decode( $output, TRUE );
		}
		
		public function maoPatch ( $url, $data, $isOverWriteHeader = 0, $headerNewArray = array() )
		{
			
			$data = json_encode( $data );
			$headerArray = array( 'Content-type:application/json' );
			$headerArray = $this->_getHeaderArray( $headerArray, $headerNewArray, $isOverWriteHeader );
			
			$ch = curl_init();
			curl_setopt( $ch, CURLOPT_URL, $url );
			curl_setopt( $ch, CURLOPT_HTTPHEADER, $headerArray );
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
			curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, "PATCH" );
			curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );     //20170611修改接口，用/id的方式传递，直接写在url中了
			$output = curl_exec( $ch );
			curl_close( $ch );
			
			return json_decode( $output );
		}
		
	}
	
}
