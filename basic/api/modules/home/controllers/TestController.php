<?php
/**
 * Created by PhpStorm.
 * User: chenfenghua
 * Date: 2016/8/9
 * Time: 15:03
 */

namespace app\api\modules\home\controllers;


use app\api\components\ApiController;
use QL\QueryList;


class TestController extends ApiController
{
    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
    }

    public function actionIndex()
    {
//        $data = QueryList::Query('http://cms.querylist.cc/bizhi/453.html',array(
//            'image' => array('img','src')
//        ))->data;
//        //打印结果
//        print_r($data);
        //使用插件
//        $urls = QueryList::run('Request',array(
//            'target' => 'http://list.jd.com/list.html?cat=9987,653,655',
//            'referrer'=>'http://list.jd.com',
//            'method' => 'GET',
//            'params' => ['var1' => 'testvalue', 'var2' => 'somevalue'],
//            'user_agent'=>'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.8; rv:21.0) Gecko/20100101 Firefox/21.0',
//            'cookiePath' => './cookie.txt',
//            'timeout' =>'30'
//        ))->setQuery(array('link' => array('li>a','href','',function($content){
//            //利用回调函数补全相对链接
//            $baseUrl = 'http://list.jd.com';
//            return $baseUrl.$content;
//        })),'.sl-v-logos')->getData(function($item){
//            return $item['link'];
//        });
//        print_r($urls);

        $hj = QueryList::Query(
            'http://list.jd.com/list.html?cat=9987,653,655',
            array("link"=>array('.sl-v-logos li>a','href', '', function($content){
                $baseUrl = 'http://list.jd.com';
                return $baseUrl.$content;
            }))
        );
        print_r($hj->data);
    }

    public function actionList()
    {
        $hj = QueryList::Query(
            'http://list.jd.com/list.html?cat=9987,653,655&ev=exbrand%5F27306&trans=1&JL=3_%E5%93%81%E7%89%8C_360#J_crumbsBar',
            array(
                'link'=>array('.p-name>a','href'),
                'title'=>array('.p-name>a>em','text'),
                'sku'=>array('.j-sku-item','data-sku')
            )
        );
        print_r($hj->data);
    }

    public function actionYmx()
    {

    }
}