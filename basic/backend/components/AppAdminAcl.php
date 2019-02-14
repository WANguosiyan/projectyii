<?php
/**
 * 权限角色管理
 */

namespace app\backend\components;

use Yii;
class AppAdminAcl
{
//权限配制数据
    public static $aclList = [

        [
            'name'=>'企业信息',
            'module'=>'enterprise',
            'ctl'=>[
                [
                    'name'=>'企业信息',
                    'icon'=>'icon-wallet',
                    'list_ctl'=>['default'],
                    'act'=>[
                        'default'=>[
                            'name'=>'   企业信息',
                            'sidebar'=>true,
                            'default_id'=>'index',
                            'list_act'=>['index'=>'商家列表','create'=>'新增商家','update'=>'编辑商家','delete'=>'删除商家']
                        ],
                    ],
                ],
            ]
        ], 
        [
            'name'=>'课程体系',
            'module'=>'curriculum',
            'ctl'=>[
                [
                    'name'=>'课程体系',
                    'icon'=>'icon-wallet',
                    'list_ctl'=>['default'],
                    'act'=>[
                        'default'=>[
                            'name'=>'   课程体系列表',
                            'sidebar'=>true,
                            'default_id'=>'index',
                            'list_act'=>['index'=>'课程体系列表','create'=>'新增课程体系','update'=>'编辑课程体系','delete'=>'删除']
                        ],
                    ],
                ],
            ]
        ],
        [
                'name'=>'轮播图管理',
                'module'=>'banner',
                'ctl'=>[
                  [
                      'name'=>'轮播图管理',
                      'icon'=>'icon-wallet',
                      'list_ctl'=>['default'],
                        'act'=>[ 
                                'default'=>[
                                    'name'=>'   轮播图列表',
                                    'sidebar'=>true,
                                    'default_id'=>'index',
                                    'list_act'=>['index'=>'轮播图列表','create'=>'新增','update'=>'编辑','delete'=>'删除']
                                ],
                          ],
                    ],
                  ]
        ],
        [
            'name'=>'师资团队',
            'module'=>'teacherteam',
            'ctl'=>[
                [
                    'name'=>'师资团队',
                    'icon'=>'icon-wallet',
                    'list_ctl'=>['default'],
                    'act'=>[
                        'default'=>[
                            'name'=>'   师资团队列表',
                            'sidebar'=>true,
                            'default_id'=>'index',
                            'list_act'=>['index'=>'列表','create'=>'新增','update'=>'编辑','delete'=>'删除']
                        ],
                    ],
                ],
            ],
        ],
        [
            'name'=>'文件管理',
            'module'=>'file',
            'ctl'=>[
                [
                    'name'=>'文件管理',
                    'icon'=>'icon-wallet',
                    'list_ctl'=>['default'],
                    'act'=>[
                        'default'=>[
                            'name'=>'文件列表',
                            'sidebar'=>true,
                            'default_id'=>'index',
                            'list_act'=>['index'=>'文件列表','create'=>'新增文件','update'=>'编辑文件','delete'=>'删除文件']
                        ],
                    ],
                ],
            ]
        ],
        [
            'name'=>'电商管理',
            'module'=>'cloud_shop',
            'ctl'=>[
                [
                    'name'=>'电商管理',
                    'icon'=>'icon-wallet',
                    'list_ctl'=>['table','group','api','config','default','setting','order-default','promotioncoupon','cat','parentcat','collage-default'],
                    'act'=>[
                        'collage-default'=>[
                            'name'=>'   团购列表',
                            'sidebar'=>true,
                            'default_id'=>'index',
                            'list_act'=>['index'=>'团购列表', 'create'=>'新增','update'=>'编辑','delete'=>'删除']
                        ],
                        'collage-conf'=>[
                            'name'=>'   团购配置',
                            'sidebar'=>true,
                            'default_id'=>'index',
                            'list_act'=>['index'=>'团购配置']
                        ],
                        'default'=>[
                            'name'=>'   商品列表',
                            'sidebar'=>true,
                            'default_id'=>'index',
                            'list_act'=>['index'=>'订单列表', 'detail'=>'订单详情']
                        ],
                        'setting'=>[
                            'name'=>'   参数配置',
                            'sidebar'=>true,
                            'default_id'=>'index',
                            'list_act'=>['index'=>'订单列表', 'detail'=>'订单详情']
                        ],
                        'fregiht'=>[
                            'name'=>'   运费配置',
                            'sidebar'=>true,
                            'default_id'=>'index',
                            'list_act'=>['index'=>'运费配置列表', 'detail'=>'运费详情']
                        ],
                        'order-default'=>[
                            'name'=>'   普通订单管理',
                            'sidebar'=>true,
                            'default_id'=>'index',
                            'list_act'=>['index'=>'订单列表', 'detail'=>'订单详情']
                        ],

                        'collage-order'=>[
                            'name'=>'   自提订单管理',
                            'sidebar'=>true,
                            'default_id'=>'index',
                            'list_act'=>['index'=>'订单列表', 'detail'=>'订单详情']
                        ],

                        'promotioncoupon'=>[
                            'name'=>'   促销管理',
                            'sidebar'=>true,
                            'default_id'=>'index',
                            'list_act'=>['index'=>'订单列表', 'detail'=>'订单详情']
                        ],
                        'parentcat'=>[
                            'name'=>'   一级分类',
                            'sidebar'=>true,
                            'default_id'=>'index',
                            'list_act'=>['index'=>'订单列表', 'detail'=>'订单详情']
                        ],

                        'cat'=>[
                            'name'=>'   二级分类',
                            'sidebar'=>true,
                            'default_id'=>'index',
                            'list_act'=>['index'=>'订单列表', 'detail'=>'订单详情']
                        ],
                    ],
                ],
            ]
        ],
    ];

    /**
     * 后台菜单过滤
     *
     * @param $acl_list
     * @param $super
     * @return array
     */
    public static function filterMenu($acl_list,$super)
    {
        $item = self::$aclList;
        if ($super == 1) return $item;
        return $item;//gsy增加
        foreach ($item as $k=>$v) {
            foreach ($v['ctl'] as $kk=>$vv) {
                foreach ($vv['act'] as $kkk=>$vvv) {
                    $acl = $v['module'].'/'.$kkk.'/'.$vvv['default_id'];
                    if (strpos($acl_list, $acl) === false) {
                        unset($item[$k]['ctl'][$kk]['act'][$kkk]);
                    }
                }
                if (empty($item[$k]['ctl'][$kk]['act'])) unset($item[$k]['ctl'][$kk]);
            }
            if (empty($item[$k]['ctl'])) unset($item[$k]);
        }
        return $item;
    }

    /**
     * 判断按钮是否有权限
     *
     * @param $act
     * @param $button
     * @return string
     */
    public static function filterButton($act, $button = true)
    {
        if (Yii::$app->session['super'] == 1) return $button;
//        if (strpos(Yii::$app->session['acl'], $act) !== false) return $button;
        return $button;
    }
}