<?php
/*
 * author: maosiji
 * url: https://jijiansuda.cn
 * date: 2021.10.13
 * update: 2022.09.22
 * description: 文件操作类
 * */
if ( !class_exists( 'Wpsuda_File' ) ) {
class Wpsuda_File {
	
	function __construct() {}
	
	/*
	 * 上传图片到 uploads
	 * 
	 * $file			$_FILES
	 * $input_name		文件标识
	 * */
	public function wp_upload_file( $file, $input_name ) {
		
		if( $file ) {
			
			if ( empty($file[$input_name]['name']) ) {
				return array( 'status'=>'0', 'msg'=>'未找到 input_name 附件！' );
			}
			
			require_once( ABSPATH . 'wp-admin/includes/image.php' );
	       	require_once( ABSPATH . 'wp-admin/includes/file.php' );
	       	require_once( ABSPATH . 'wp-admin/includes/media.php' );
			
			$attachment_id  = media_handle_upload( $input_name, '' );
			$attachment_url = wp_get_attachment_image_src( $attachment_id, 'full' )[0];
			
			if ( $attachment_url ) {
				return array( 'status'=>'1', 'msg'=>array('id'=>$attachment_id, 'url'=>$attachment_url) );
			} else {
				return array( 'status'=>'0', 'msg'=>'上传失败，请重试！' );
			}
			
		} else {
			return array( 'status'=>'0', 'msg'=>'FILES 为空！' );
		}
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
	public function upload_file( $folderpath, $filename_arr, $files, $url_head ) {
		
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
	public function delete_file( $filepath ) {
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
