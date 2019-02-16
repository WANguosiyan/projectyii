<?php
/**
 * 控制器基础类，所有控制器均需继承此类
 * @author chenfenghua <843958575@qq.com>
 * version v2.0
 */

namespace app\api\components;

use app\backend\modules\cloud_shop\components\BaseModel;
use app\models\member\MemberAccount;
use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\backend\modules\app\models\CloudAppList;


class ApiController extends Controller
{
    public static $CODE_SUC = 200;
    public static $CODE_ERR = 400;
    public $data = [];
    public $member_id;
    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        $this->member_id = Yii::$app->request->post('member_id');
        Yii::$app->response->format = Response::FORMAT_JSON;
    }

    /**
     * token验证
     *
     * @param $member_id
     * @param $token
     * @return bool
     */
    public function verifyAuth($member_id,$token)
    {
        if (!$token) return false;
        $member_info = Yii::$app->get('usercenter')->createCommand(
            'SELECT member_id,login_account,create_time FROM '.MemberAccount::tableName().' WHERE member_id = '.$member_id
        )->queryOne();

//        $member_info = MemberAccount::find()
//            ->select(['member_id','login_account','create_time'])
//            ->where(['member_id'=>$member_id])
//            ->asArray()
//            ->one();

//        $data = array(
//            'member_id'=>$member_info['member_id'],
//            'login_account'=>$member_info['login_account'],
//            'create_time'=>$member_info['create_time'],
//        );
        $result = Auth::getInstance()->verifyToken($member_info,$token);
        if (!$result) return false;
        return true;
    }

    /**
     * 返回json消息
     *
     * @param $message
     * @param string $code
     * @return array
     */
    public static function sendMessageJson($message, $code = '',$data=[])
    {
        $code = empty($code) ? self::$CODE_ERR : $code;
        if(empty($data)){
            $data = new \StdClass();
        }

        return ['code' => $code, 'msg' => $message, 'data' => $data];
    }
    /**
     * 根据access_token查询appid
     * @return array
     */
    public static function getAppid($access_token){
        $list = CloudAppList::find()->where(['access_token'=>$access_token])->one();
        return $list;
    }
}