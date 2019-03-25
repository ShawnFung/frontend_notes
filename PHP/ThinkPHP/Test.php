<?php
namespace app\index\controller;
use think\Controller;

class Test extends Controller
{
	public function html()
	{
		$str = '<p><strong>教室传来 朗朗读书声</strong></p>
			<center><img id="33924998" title="" border="0" src="./uploads/test1.jpeg" sourcedescription="编辑提供的本地文件" sourcename="本地文件"/></center>
			<p><img id="33924998" title="" border="0" src="./uploads/test2.jpeg" sourcedescription="编辑提供的本地文件" sourcename="本地文件"/>
			<img id="33924998" title="" border="0" src="./uploads/test3.jpeg" sourcedescription="编辑提供的本地文件" sourcename="本地文件"/></p>';
    	$images = Test::getSrc($str);
    	$status = Test::delFiles($images);
    	return $status;
	}

	// 匹配所有img标签中的src的值
	public function getSrc($str)
	{
		$pattern='/<img.*?src="(.*?)".*?\/?>/i';
		preg_match_all($pattern, $str, $out);
    	return $out[1];
	}

	// 删除文件
	public function delFiles($images)
	{
		
    	foreach ($images as $value)
    	{
    		// $src = substr($value, strrpos($value, "/"));
    		if(file_exists($value))
    		{
    			$status = unlink($value);    
				if($status){  
					echo "File deleted successfully";    
				}else{  
					return "error";    
				}  
    		}
    		
    	}
    	return 'success';
	}

	public function upload()
	{
		$file = request()->file('image');
    
	    // 移动到框架应用根目录/public/uploads/ 目录下
	    if($file){
	        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
	        if($info){
	            return json([
	            	'errno' => 0,
	            	'data' => './uploads/'. $info->getFilename()
	            ]);
	        }else{
	            return json([
	            	'errno' => 1,
	            	'data' => ''
	            ]);
	        }
	    }
	}
}	