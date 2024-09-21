<?php

namespace MAOSIJI\phpsuda\upload;
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
if ( !class_exists( 'MaoUpload' ) ) {
	class MaoUpload
	{
		function __construct ()
		{
		
		}
		
		/*
	 * 上传图片到自定义目录（非wp-content/uploads/2022/05/）
	 *
	 * $folderpath		文件夹路径
	 * $filename_arr	文件名数组  key 为 input name，value 为自定义的文件名，注意与上传时的后缀一致
	 * 					array(
	 * 						'sfz_a' => 1.jpg
	 * 						'sfz_b' => 2.jpg
	 * 					)
	 * $files			即 $_FILES
	 * $url_head		图片url前缀地址，即不包括图片文件名及后缀的链接
	 * 					如：http://www.shuidi.net/wp-content/uploads/myfolder/
	 * return			array(
	 * 						'status'=>'1',
	 * 						'msg'	=> array(
	 * 							'sfz_a' => http://www.shuidi.net/wp-content/uploads/myfolder/1.jpg
	 * 							'sfz_b' => http://www.shuidi.net/wp-content/uploads/myfolder/2.jpg
	 * 						),
	 * 					)
	 * */
		public function uploadFile( $folderpath, $filename_arr, $files, $url_head ) {
			
			$image_url_arr = array();
			
			if ( !file_exists($folderpath) ) {
				if ( !mkdir($folderpath, 0777, TRUE) ) {
					return array( 'status'=>'0', 'msg'=> '目录创建失败！' );
				}
			}
			
			if ( is_array($filename_arr) ) {
				foreach ( $filename_arr as $key=>$value ) {
					$filepath = $folderpath.$value;
					if ( move_uploaded_file( $files[$key]['tmp_name'], $filepath ) ) {
						$image_url_arr[$key] = $url_head.$value;
					} else {
						return array( 'status'=>'0', 'msg'=> '上传失败！' );
					}
				}
			} else {
				return array( 'status'=>'0', 'msg'=> '参数：文件路径，格式错误！' );
			}
			
			return array( 'status'=>'1', 'msg'=> $image_url_arr );
		}
		
		/*
		 * 删除图片（在服务器上）
		 *
		 * $filepath 包含后缀的文件路径
		 * */
		public function deleteFile( $filepath ) {
			if ( file_exists($filepath) ) {
				if ( unlink($filepath) ) {
					return array( 'status' => '1', 'msg' => '删除成功！' );
				} else {
					return array( 'status' => '0', 'msg' => '删除失败！' );
				}
			} else {
				return array( 'status' => '0', 'msg' => '文件不存在！' );
			}
		}
		
		
		
		
		
	}
}
