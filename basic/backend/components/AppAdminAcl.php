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
            'name'=>'管理员',
            'module'=>'administrators',
            'ctl'=>[
                [
                    'name'=>'管理员',
                    'icon'=>'icon-wallet',
                    'list_ctl'=>['default'],
                    'act'=>[
                        'default'=>[
                            'name'=>'   管理员列表',
                            'sidebar'=>true,
                            'default_id'=>'index',
                            'list_act'=>['index'=>'列表','create'=>'新增','update'=>'编辑','delete'=>'删除']
                        ],
                    ],
                ],
            ]
        ],
        [
            'name'=>'企业信息',
            'module'=>'enterprise',
            'ctl'=>[
                [
                    'name'=>'企业信息',
                    'icon'=>'icon-wallet',
                    'list_ctl'=>['default','company'],
                    'act'=>[
                        'default'=>[
                            'name'=>'   企业信息',
                            'sidebar'=>true,
                            'default_id'=>'index',
                            'list_act'=>['index'=>'列表','update'=>'编辑']
                        ],
                        'company'=>[
                            'name'=>'   公司简介',
                            'sidebar'=>true,
                            'default_id'=>'index',
                            'list_act'=>['index'=>'列表','update'=>'编辑']
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
            'name'=>'品牌方案',
            'module'=>'brandplan',
            'ctl'=>[
                [
                    'name'=>'品牌方案',
                    'icon'=>'icon-wallet',
                    'list_ctl'=>['default'],
                    'act'=>[
                        'default'=>[
                            'name'=>'品牌方案列表',
                            'sidebar'=>true,
                            'default_id'=>'index',
                            'list_act'=>['index'=>'列表','create'=>'新增文件','update'=>'编辑文件','delete'=>'删除文件']
                        ],
                    ],
                ],
            ]
        ],
        [
            'name'=>'精彩回顾',
            'module'=>'review',
            'ctl'=>[
                [
                    'name'=>'精彩回顾',
                    'icon'=>'icon-wallet',
                    'list_ctl'=>['default'],
                    'act'=>[
                        'default'=>[
                            'name'=>'   回顾列表',
                            'sidebar'=>true,
                            'default_id'=>'index',
                            'list_act'=>['index'=>'回顾列表', 'create'=>'新增','update'=>'编辑','delete'=>'删除']
                        ],
                    ],
                ],
            ]
        ],
        [
            'name'=>'预约试听',
            'module'=>'appointment',
            'ctl'=>[
                [
                    'name'=>'预约试听',
                    'icon'=>'icon-wallet',
                    'list_ctl'=>['default'],
                    'act'=>[
                        'default'=>[
                            'name'=>'   预约列表',
                            'sidebar'=>true,
                            'default_id'=>'index',
                            'list_act'=>['index'=>'列表', 'create'=>'新增','update'=>'编辑','delete'=>'删除']
                        ],
                    ],
                ],
            ]
        ],
        [
            'name'=>'申请加盟',
            'module'=>'joinin',
            'ctl'=>[
                [
                    'name'=>'申请加盟',
                    'icon'=>'icon-wallet',
                    'list_ctl'=>['default'],
                    'act'=>[
                        'default'=>[
                            'name'=>'   申请加盟列表',
                            'sidebar'=>true,
                            'default_id'=>'index',
                            'list_act'=>['index'=>'列表', 'create'=>'新增','update'=>'编辑','delete'=>'删除']
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