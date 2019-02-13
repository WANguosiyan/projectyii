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
            'name'=>'商家中心',
            'module'=>'businesscenter',
            'ctl'=>[
                [
                    'name'=>'商家中心',
                    'icon'=>'icon-wallet',
                    'list_ctl'=>['table','group','api','config','default','type'],
                    'act'=>[
                        'default'=>[
                            'name'=>'   商家列表',
                            'sidebar'=>true,
                            'default_id'=>'index',
                            'list_act'=>['index'=>'商家列表','create'=>'新增商家','update'=>'编辑商家','delete'=>'删除商家']
                        ],
                        'type'=>[
                            'name'=>'   商家类型',
                            'sidebar'=>true,
                            'default_id'=>'index',
                            'list_act'=>['index'=>'类型列表','create'=>'新增','update'=>'编辑','delete'=>'删除']
                        ],
                      
                    ],
                ],
            ]
        ], 
        [
            'name'=>'图文管理',
            'module'=>'txt',
            'ctl'=>[
                [
                    'name'=>'图文管理',
                    'icon'=>'icon-wallet',
                    'list_ctl'=>['newslist','newscat','table','group','api','config'],
                    'act'=>[
                        'newslist'=>[
                            'name'=>'   图文列表',
                            'sidebar'=>true,
                            'default_id'=>'index',
                            'list_act'=>['index'=>'图文列表','create'=>'新增图文','update'=>'编辑图文','delete'=>'删除图文']
                        ],
                        'newscat'=>[
                            'name'=>'   图文类型库',
                            'sidebar'=>true,
                            'default_id'=>'index',
                            'list_act'=>['index'=>'图文类型列表','create'=>'新增图文类型','update'=>'编辑图文类型','delete'=>'删除图文类型']
                        ],
                    ],
                ],
            ]
        ],
        [
                'name'=>'轮播图管理管理',
                'module'=>'banner',
                'ctl'=>[
                  [
                      'name'=>'轮播图管理管理',
                      'icon'=>'icon-wallet',
                      'list_ctl'=>['default','table','group','api','config','bannermanage'],
                        'act'=>[ 
                                'bannermanage'=>[
                                    'name'=>'   轮播图列表',
                                    'sidebar'=>true,
                                    'default_id'=>'index',
                                    'list_act'=>['index'=>'会员列表','create'=>'新增会员','update'=>'编辑会员','delete'=>'删除会员']
                                ],
                                'bannertype'=>[
                                    'name'=>'   轮播图分类',
                                    'sidebar'=>true,
                                    'default_id'=>'index',
                                    'list_act'=>['index'=>'分类列表','create'=>'新增分类','update'=>'编辑分类','delete'=>'删除分类']
                                ],
                          ],
                    ],
                  ]
        ],
        [
            'name'=>'产品管理',
            'module'=>'product',
            'ctl'=>[
                [
                    'name'=>'产品管理',
                    'icon'=>'icon-wallet',
                    'list_ctl'=>['default','producttype','productspec','table','group','api','config'],
                    'act'=>[
                        'default'=>[
                            'name'=>'   产品列表',
                            'sidebar'=>true,
                            'default_id'=>'index',
                            'list_act'=>['index'=>'产品列表','create'=>'新增','update'=>'编辑','delete'=>'删除']
                        ],
                        'producttype'=>[
                            'name'=>'   产品分类',
                            'sidebar'=>true,
                            'default_id'=>'index',
                            'list_act'=>['index'=>'产品分类列表','create'=>'新增','update'=>'编辑','delete'=>'删除']
                        ],
                        'productspec'=>[
                            'name'=>'   产品类属性规格',
                            'sidebar'=>true,
                            'default_id'=>'index',
                            'list_act'=>['index'=>'产品类属性规格列表','create'=>'新增','update'=>'编辑','delete'=>'删除']
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
        [
            'name'=>'系统',
            'module'=>'desktop',
            'ctl'=>[
                [
                    'name'=>'管理员和权限',
                    'icon'=>'icon-settings',
                    'module'=>'admin',
                    'list_ctl'=>['role','admin','seo'],
                    'act'=>[
                        'role'=>[
                            'name'=>'角色管理',
                            'sidebar'=>true,
                            'default_id'=>'index',
                            'list_act'=>['index'=>'角色列表','create'=>'角色创建','update'=>'角色编辑','cancel'=>'角色冻结']
                        ],
                        'admin'=>[
                            'name'=>'操作员管理',
                            'sidebar'=>true,
                            'default_id'=>'index',
                            'list_act'=>['index'=>'操作员列表','create'=>'操作员创建','update'=>'操作员编辑','cancel'=>'操作员冻结']
                        ],
                        'seo' => [
                            'name'      => 'SEO关键词管理',
                            'sidebar'   => true,
                            'default_id'=> 'index',
                            'list_act'  => ['index'=>'角色列表','create'=>'角色创建','update'=>'角色编辑','cancel'=>'角色冻结']
                        ]
                    ]
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