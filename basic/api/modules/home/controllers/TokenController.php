<?php
namespace app\api\modules\home\controllers;

use app\api\components\SNhelper;
use app\backend\modules\app\models\CloudAppList;
use yii\helpers\Json;
use \yii\web\Controller;
use Yii;
use yii\web\Session;

class TokenController extends Controller
{
    /**
     * 获取access_token
     */
    public function actionIndex($appid = '', $secret = ''){
        if($appid == null || $secret == null){
            return Json::encode(['code'=>4000,'msg'=>'appid is empty']);
        }
        $b = CloudAppList::find()->where(['app_id'=>$appid,'app_secret'=>$secret])->asArray()->one();
        if(!$b){
            return Json::encode(['code'=>4001,'msg'=>'Invalid appid']);
        }
        $access_token['access_token'] = md5(sha1($appid).$secret.time());
        $access_token['lifetime'] = 7200;
        SNhelper::set($access_token['access_token'],$access_token);
        return Json::encode(['code'=>200,'access_token'=>$access_token['access_token']]);
    }
}