<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-7-2
 * Time: 19:15
 */

namespace app\models;

use Yii;
use yii\helpers\FileHelper;
use yii\helpers\Json;

class Common
{
    /**
     * base64上传
     *
     * @param $content base_64
     * @param string $model 存放目录
     * @param array $thumb [['width'=>'300', 'height'=>'150', 'prefix'=>'thumb'],['width'=>'200', 'height'=>'100', 'prefix'=>'thumb2']]
     * @return bool|string
     */
    public static function common($content, $model = 'common', $thumb = [])
    {
        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $content, $result))
        {
            $type = $result[2];
            $file = time().rand(1000,9999);
            $file_name = $file.'.'.$type;
            $model_path = Yii::$app->basePath.'/images/'.$model;
            $savePath = '/images/'.$model.'/'.date("Ymd",time());
            $path = Yii::$app->basePath.$savePath.'/';

            if (!file_exists($model_path)) mkdir($model_path,0777,true);
            if (!file_exists($path)) mkdir($path,0777,true);
            $targetFile = str_replace('//','/',$path).$file_name;

            if (!file_put_contents($targetFile, base64_decode(str_replace($result[1], '',$content), true))) return false;

            if ($thumb) {

                foreach ($thumb as $v) {
                      self::imgthumb($targetFile,
                        self::prep_filename($targetFile, '_'.$v['prefix']),
                        $v['width'], $v['height'],
                        isset($v['cut'])?$v['cut']:0,
                        isset($v['proportion'])?$v['proportion']:0
                    );

                }

            }

            return $savePath.'/'.$file_name;
        }
    }

    public static function common2($content, $model = 'common', $thumb = [])
    {
        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $content, $result))
        {
            $type = $result[2];
            $file = time().rand(1000,9999);
            $file_name = $file.'.'.$type;
            $model_path = Yii::$app->basePath.'/images/'.$model;
            $savePath = '/images/'.$model.'/'.date("Ymd",time());
            $path = Yii::$app->basePath.$savePath.'/';

            if (!file_exists($model_path)) mkdir($model_path,0777);
            if (!file_exists($path)) mkdir($path,0777);
            $targetFile = str_replace('//','/',$path).$file_name;

            if (!file_put_contents($targetFile, base64_decode(str_replace($result[1], '',$content), true))) return false;

            if ($thumb) {
                foreach ($thumb as $v) {
                    self::imgthumb2(
                        $targetFile,
                        self::prep_filename($targetFile, '_'.$v['prefix']),
                        $v['width'],
                        $v['height'],
                        $v['x'],
                        $v['y']
                    );
                }
            }

            return $savePath.'/'.$file_name;
        }
    }

    public function avatar($content, $model = 'member')
    {
        $content = base64_decode(str_replace('data:image/jpeg;base64,','',$content));

        $model_path = Yii::$app->basePath.'/images/'.$model;
        $savePath = '/images/'.$model.'/'.date("Ymd",time());
        $path = Yii::$app->basePath.$savePath.'/';

        if (!file_exists($model_path)) mkdir($model_path,0777);
        if (!file_exists($path)) mkdir($path,0777);

        $fileNewName = time().rand(1000,9999);
        $file_name = $fileNewName.'.jpg';
        $targetFile =  str_replace('//','/',$path).$file_name;

        if (!file_put_contents($targetFile, $content, true)) return '';
        return $savePath.'/'.$file_name;
    }

    /**
     * 文件上传
     *
     * @param $file
     * @param string $model
     * @param array $thumb [['prefix'=>'l', 'width'=>'800', 'height'=>'600']]
     * @return bool|string
     */
    public static function file($file, $model = 'goods', $thumb = [])
    {
        $file_name = time().rand(1000,9999).self::get_extension($file['name']);
        $savePath = '/images/'.$model.'/'.date("Ymd",time());
        $model_path = Yii::$app->basePath.'/images/'.$model;
        $path = Yii::$app->basePath.$savePath.'/';

        if (!file_exists($model_path)) mkdir($model_path,0777);
        if (!file_exists($path)) mkdir($path,0777);
        $targetFile = str_replace('//','/',$path).$file_name;

        if(!move_uploaded_file($file['tmp_name'], $targetFile)) return false;
        if ($thumb) {
            foreach ($thumb as $v) {
                self::imgthumb($targetFile,
                    self::prep_filename($targetFile, '_'.$v['prefix']),
                    $v['width'], $v['height'],
                    isset($v['cut'])?$v['cut']:0,
                    isset($v['proportion'])?$v['proportion']:0
                );
            }
        }
        return $savePath.'/'.$file_name;
    }

    public static function file2($path, $model = 'goods', $thumb = [])
    {
        $path2 = Yii::$app->basePath.$path;

        $targetFile = str_replace('//','/',$path2);
        $arr = [];
        if ($thumb) {
            foreach ($thumb as $v) {
                self::imgthumb2(
                    $targetFile,
                    self::prep_filename($targetFile, '_'.$v['prefix']),
                    $v['width'],
                    $v['height'],
                    $v['x'],
                    $v['y']
                );

                $arr = self::prep_filename($path, '_'.$v['prefix']);
            }

        }
        return $arr;
    }

    /**
     * 自定义上传
     *
     * @param $file
     * @param string $model
     * @param string $base
     * @return bool|string
     */
    public static function setup($file, $base, $model = 'goods')
    {
        $file_name = $file['name'];
        $savePath = $base.$model;
        $path = Yii::$app->basePath.$savePath.'/';
        if (!file_exists($path)) mkdir($path,0777);
        $targetFile = str_replace('//','/',$path).$file_name;

        if(!move_uploaded_file($file['tmp_name'], $targetFile)) return false;
        return $savePath.'/'.$file_name;
    }
    /**
     * 自定义上传
     *
     * @param $file
     * @param string $model
     * @param string $base
     * @return bool|string
     */
    public static function setup2($file, $model = 'goods')
    {
//        $size = $file->size;
//        if(!$size) {
//            return Json::encode(['code' => 400, 'msg' => '请上传文件']);
//        }
//        //允许上传的文件格式
//        $allowTypes = [
//                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',//docx
//                'application/msword',//doc
//            ];
//        if(!in_array($file->type,$allowTypes)){//验证文件类型
//            return false;
//        }
//        if($file->size > 10*1024*1024){//验证文件大小
//            return false;
//        }
        $savepath = '/files/'.$model.'/'.date("Ymd",time()).'/';
        $path = Yii::$app->basePath.$savepath;

        if (!file_exists($path)) mkdir($path,0777,true);

        $ext = $file->extension;
        $file_name = date("YmdHis",time()).rand(1000,9999).'.'.$ext;
        $targetFile = str_replace('//','/',$path).$file_name;

        if(!move_uploaded_file($file->tempName, $targetFile)) return false;
        return $savepath.$file_name;
    }

    /**
     * 重命名
     *
     * @param $path
     * @param $filename
     * @param $file_ext
     * @param bool $encrypt_name
     * @return bool|string
     */
    function set_filename($path, $filename, $file_ext, $encrypt_name = FALSE)
    {
        if ($encrypt_name == TRUE)
        {
            mt_srand();
            $filename = md5(uniqid(mt_rand())).$file_ext;
        }

        if ( ! file_exists($path.$filename))
        {
            return $filename;
        }

        $filename = str_replace($file_ext, '', $filename);

        $new_filename = '';
        for ($i = 1; $i < 100; $i++)
        {
            if ( ! file_exists($path.$filename.$i.$file_ext))
            {
                $new_filename = time().$i.$file_ext;
                break;
            }
            $new_filename = time().$file_ext;
        }

        if ($new_filename == '')
        {
            return FALSE;
        }
        else
        {
            return $new_filename;
        }
    }

    /**
     * 重构文件名
     *
     * @param $filename
     * @param $prefix
     * @return string
     */
    public static function prep_filename($filename,$prefix) {
        if (strpos($filename, '.') === FALSE) {
            return $filename;
        }
        $parts = explode('.', $filename);
        $ext = array_pop($parts);
        $filename = array_shift($parts);
        foreach ($parts as $part) {
            $filename .= '.'.$part;
        }
        $filename .= $prefix.'.'.$ext;
        return $filename;
    }

    /**
     * 获取文件名后缀
     *
     * @param $filename
     * @return string
     */
    public static function get_extension($filename) {
        $x = explode('.', $filename);
        return '.'.end($x);
    }

    /**
     * 获取文件名后缀
     *
     * @param $file
     * @return string
     */
    public static function fileext($file)
    {
        return pathinfo($file, PATHINFO_EXTENSION);
    }

    /**
     * 生成缩略图
     *
     * @param $src_img string     源图绝对完整地址{带文件名及后缀名}
     * @param $dst_img string     目标图绝对完整地址{带文件名及后缀名}
     * @param $width   int        缩略图宽{0:此时目标高度不能为0，目标宽度为源图宽*(目标高度/源图高)}
     * @param $height  int        缩略图高{0:此时目标宽度不能为0，目标高度为源图高*(目标宽度/源图宽)}
     * @param $cut     int        是否裁切{宽,高必须非0}
     * @param $proportion       int/float  缩放{0:不缩放, 0<this<1:缩放到相应比例(此时宽高限制和裁切均失效)}
     * @return boolean
     */
    public static function imgthumb($src_img, $dst_img, $width = 75, $height = 75, $cut = 0, $proportion = 0)
    {
        if(!is_file($src_img))
        {
            return false;
        }
        $ot = self::fileext($dst_img);
        $otfunc = 'image' . ($ot == 'jpg' ? 'jpeg' : $ot);
        $srcinfo = getimagesize($src_img);
        $src_w = $srcinfo[0];
        $src_h = $srcinfo[1];
        $type  = strtolower(substr(image_type_to_extension($srcinfo[2]), 1));
        $createfun = 'imagecreatefrom' . ($type == 'jpg' ? 'jpeg' : $type);

        $dst_h = $height;
        $dst_w = $width;
        $x = $y = 0;

        /**
         * 缩略图不超过源图尺寸（前提是宽或高只有一个）
         */
        if(($width> $src_w && $height> $src_h) || ($height> $src_h && $width == 0) || ($width> $src_w && $height == 0))
        {
            $proportion = 1;
        }
        if($width> $src_w)
        {
            $dst_w = $width = $src_w;
        }
        if($height> $src_h)
        {
            $dst_h = $height = $src_h;
        }

        if(!$width && !$height && !$proportion)
        {
            return false;
        }
        if(!$proportion)
        {
            if($cut == 0)
            {
                if($dst_w && $dst_h)
                {
                    if($dst_w/$src_w> $dst_h/$src_h)
                    {
                        $dst_w = $src_w * ($dst_h / $src_h);
                        $x = 0 - ($dst_w - $width) / 2;
                    }
                    else
                    {
                        $dst_h = $src_h * ($dst_w / $src_w);
                        $y = 0 - ($dst_h - $height) / 2;
                    }
                }
                else if($dst_w xor $dst_h)
                {
                    if($dst_w && !$dst_h)  //有宽无高
                    {
                        $propor = $dst_w / $src_w;
                        $height = $dst_h  = $src_h * $propor;
                    }
                    else if(!$dst_w && $dst_h)  //有高无宽
                    {
                        $propor = $dst_h / $src_h;
                        $width  = $dst_w = $src_w * $propor;
                    }
                }
            }
            else
            {
                if(!$dst_h)  //裁剪时无高
                {
                    $height = $dst_h = $dst_w;
                }
                if(!$dst_w)  //裁剪时无宽
                {
                    $width = $dst_w = $dst_h;
                }
                $propor = min(max($dst_w / $src_w, $dst_h / $src_h), 1);
                $dst_w = (int)round($src_w * $propor);
                $dst_h = (int)round($src_h * $propor);
                $x = ($width - $dst_w) / 2;
                $y = ($height - $dst_h) / 2;
            }
        }
        else
        {
            $proportion = min($proportion, 1);
            $height = $dst_h = $src_h * $proportion;
            $width  = $dst_w = $src_w * $proportion;
        }

        $src = $createfun($src_img);
        $dst = imagecreatetruecolor($width ? $width : $dst_w, $height ? $height : $dst_h);
        $white = imagecolorallocate($dst, 255, 255, 255);
        imagefill($dst, 0, 0, $white);

        if(function_exists('imagecopyresampled'))
        {
            imagecopyresampled($dst, $src, $x, $y, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
        }
        else
        {
            imagecopyresized($dst, $src, $x, $y, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
        }
        $otfunc($dst, $dst_img);
        imagedestroy($dst);
        imagedestroy($src);
        return true;
    }

    public static function imgthumb2($src_img, $dst_img, $width = 75, $height = 75, $x = 0, $y = 0)
    {
        if(!is_file($src_img))
        {
            return false;
        }
        $ot = self::fileext($dst_img);
        $otfunc = 'image' . ($ot == 'jpg' ? 'jpeg' : $ot);
        $srcinfo = getimagesize($src_img);
        $src_w = $srcinfo[0];
        $src_h = $srcinfo[1];
        $type  = strtolower(substr(image_type_to_extension($srcinfo[2]), 1));
        $createfun = 'imagecreatefrom' . ($type == 'jpg' ? 'jpeg' : $type);

        $dst_w = $width;
        $dst_h = $height;
        if($width> $src_w)
        {
            $dst_w = $width = $src_w;
        }
        if($height> $src_h)
        {
            $dst_h = $height = $src_h;
        }

        $dst_w = min($dst_w,$dst_h);
        $dst_h = min($dst_w,$dst_h);

        $src = $createfun($src_img);
        $dst = imagecreatetruecolor(300, 300);
//        $white = imagecolorallocate($dst, 255, 255, 255);
//        imagefill($dst, 0, 0, $white);

//        $src_w = min($src_w, $src_h);
//        $src_h = min($src_w, $src_h);

        if(function_exists('imagecopyresampled'))
        {
            imagecopyresampled($dst, $src, 0, 0,  $x, $y,300,300,$dst_w, $dst_h);
        }
        else
        {
            imagecopyresized($dst, $src,  0, 0, $x, $y,$dst_w, $dst_h, $src_w, $src_h);
        }
        $otfunc($dst, $dst_img);
        imagedestroy($dst);
        imagedestroy($src);
        return true;
    }

    /**
     * 图片等比例压缩
     *
     * @param $im
     * @param $maxwidth
     * @param $maxheight
     * @param $name
     * @param $filetype
     */
    function resizeImage($im,$maxwidth,$maxheight,$name,$filetype)
    {
        $pic_width = imagesx($im);
        $pic_height = imagesy($im);
        if(($maxwidth && $pic_width > $maxwidth) || ($maxheight && $pic_height > $maxheight)) {
            $resizewidth_tag = true;
            $widthratio = 1;
            if($maxwidth && $pic_width>$maxwidth) {
                $widthratio = $maxwidth/$pic_width;
                $resizewidth_tag = true;
            }
            if($maxheight && $pic_height>$maxheight) {
                $heightratio = $maxheight/$pic_height;
                $resizeheight_tag = true;
            }
            if($resizewidth_tag && $resizeheight_tag) {
                if($widthratio<$heightratio)
                    $ratio = $widthratio;
                else
                    $ratio = $heightratio;
            }
            if($resizewidth_tag && !$resizeheight_tag)
                $ratio = $widthratio;
            if($resizeheight_tag && !$resizewidth_tag)
                $ratio = $heightratio;
            $newwidth = $pic_width * $ratio;
            $newheight = $pic_height * $ratio;
            if(function_exists("imagecopyresampled")) {
                $newim = imagecreatetruecolor($newwidth,$newheight);//PHP系统函数
                imagecopyresampled($newim,$im,0,0,0,0,$newwidth,$newheight,$pic_width,$pic_height);//PHP系统函数
            }
            else {
                $newim = imagecreate($newwidth,$newheight);
                imagecopyresized($newim,$im,0,0,0,0,$newwidth,$newheight,$pic_width,$pic_height);
            }
            $name = $name.$filetype;
            imagejpeg($newim,$name);
            imagedestroy($newim);
        } else {
            $name = $name.$filetype;
            imagejpeg($im,$name);
        }
    }

    /**
     * @param object $obj
     * @return array
     */
    public static function objToArray($obj = []){
        $res = [];
        foreach($obj as $k=>$v){
            $res[$k] = $v;
        }
        return $res;
    }

    /**
     * @param $model
     * @param $query_params
     * @return mixed
     */
    public static function urlWhere($model,$query_params){
        $where = [];
        if($query_params){
            unset($query_params['r']);
            foreach($query_params as $k=>$v){
                if(strpos($k,'search_' ) !== false){
                    $where = empty($v)?[]:['like','title',substr($k,7)];
                    continue;
                }
                $where[$k] = $v;
            }

            return $model->andfilterWhere($where);
        }

    }
}