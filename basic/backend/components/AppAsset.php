<?php
/**
 * 动态加载js/css
 * @author chenfenghua <843958575@qq.com>
 * version 2.0
 */
namespace app\backend\components;

use yii;
use yii\web\AssetBundle;
use yii\web\View;

class AppAsset extends AssetBundle
{
    public $basePath = '@app/backend/themes';
    public $baseUrl = '@web';
    public $css = [
        /***** BEGIN GLOBAL MANDATORY STYLES *****/
        'themes/global/plugins/font-awesome/css/font-awesome.min.css',
        'themes/global/plugins/simple-line-icons/simple-line-icons.min.css',
        'themes/global/plugins/bootstrap/css/bootstrap.min.css',
        'themes/global/plugins/uniform/css/uniform.default.css',
        'themes/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css',
        /***** END GLOBAL MANDATORY STYLES *****/

        /***** BEGIN PAGE LEVEL PLUGINS *****/
        'themes/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css',
        'themes/global/plugins/morris/morris.css',
        'themes/global/plugins/fullcalendar/fullcalendar.min.css',
        'themes/global/plugins/jqvmap/jqvmap/jqvmap.css',
        'themes/global/plugins/datatables/datatables.min.css',
        'themes/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css',
        'themes/global/plugins/bootstrap-select/css/bootstrap-select.min.css',
        'themes/pages/css/error.min.css',
        'themes/global/plugins/jquery-tree/css/SimpleTree.css',
        /***** END PAGE LEVEL PLUGINS *****/

        /***** BEGIN THEME GLOBAL STYLES *****/
        'themes/global/css/components.min.css',
        'themes/global/css/plugins.min.css',
        /***** END THEME GLOBAL STYLES *****/

        /***** BEGIN THEME LAYOUT STYLES *****/
        'themes/layouts/layout/css/layout.css',
        'themes/layouts/layout/css/themes/darkblue.min.css',
        'themes/layouts/layout/css/custom.min.css',
        'themes/backend/css/public.css',
        /***** END THEME LAYOUT STYLES *****/
    ];
    public $js = [
        /***** BEGIN CORE PLUGINS *****/
        'themes/global/plugins/jquery.min.js',
        'themes/global/plugins/bootstrap/js/bootstrap.min.js',
        'themes/global/plugins/js.cookie.min.js',
        'themes/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js',
        'themes/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js',
        'themes/global/plugins/jquery.blockui.min.js',
        'themes/global/plugins/uniform/jquery.uniform.min.js',
        'themes/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js',
        /***** END CORE PLUGINS *****/

        /***** BEGIN PAGE LEVEL PLUGINS *****/
        'themes/global/plugins/jquery-validation/js/jquery.validate.min.js',
        'themes/global/plugins/bootbox/bootbox.min.js',
        'themes/global/plugins/bootstrap-select/js/bootstrap-select.min.js',
        'themes/global/plugins/jquery-tree/js/SimpleTree.js',
        /***** END PAGE LEVEL PLUGINS *****/

        /***** BEGIN THEME GLOBAL SCRIPTS *****/
        'themes/global/scripts/app.min.js',
        /***** END THEME GLOBAL SCRIPTS *****/

        /***** BEGIN THEME LAYOUT SCRIPTS *****/
        'themes/layouts/layout/scripts/layout.min.js',
        'themes/layouts/layout/scripts/demo.min.js',
        'themes/layouts/global/scripts/quick-sidebar.min.js',
        /***** END THEME LAYOUT SCRIPTS *****/

        /***** BEGIN backend common *****/
        'themes/backend/global/table-databases-managed.js',
        'themes/backend/global/form-validate.js',
        'themes/backend/global/form-select.js',
        'themes/backend/global/public.js',
        /***** END backend common *****/
    ];
    public $depends = [
    ];

    /**
     * 加入js
     *
     * @param $view
     * @param $file
     * @param $position
     */
    public static function addScript($view, $file, $position = View::POS_END)
    {
        if (is_array($file)) {
            foreach ($file as $v)
                $view->registerJsFile('@web/themes/' . $v, ['position' => $position, 'depends' => 'app\backend\components\AppAsset']);
        } else {
            $view->registerJsFile('@web/themes/' . $file, ['position' => $position, 'depends' => 'app\backend\components\AppAsset']);
        }
    }

    /**
     * 加入js
     *
     * @param $view
     * @param $file
     * @param $position
     */
    public static function addScriptAjax($view, $file, $position = View::POS_END)
    {
        if (is_array($file)) {
            foreach ($file as $v)
                $view->registerJsFile('@web/themes/' . $v, ['position' => $position]);
        } else {
            $view->registerJsFile('@web/themes/' . $file, ['position' => $position]);
        }
    }

    /**
     * 加入css
     *
     * @param $view
     * @param $file
     * @param $position
     */
    public static function addStyle($view, $file, $position = View::POS_HEAD)
    {
        if (is_array($file)) {
            foreach ($file as $v)
                $view->registerCssFile('@web/themes/' . $v, ['position' => $position, 'depends' => 'app\backend\components\AppAsset']);
        } else {
            $view->registerCssFile('@web/themes/' . $file, ['position' => $position, 'depends' => 'app\backend\components\AppAsset']);
        }
    }

    /**
     * 加载ueditor
     *
     * @param $view
     */
    public static function addEdit($view)
    {
        self::addScript($view, [
            'backend/uedit/ueditor.config.js',
            'backend/uedit/ueditor.all.js'
        ]);
    }

    /**
     * 加载日期、时间
     *
     * @param $view
     */
    public static function addDateTime($view)
    {
        self::addStyle($view, [
            'global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css',
            'global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css',
        ]);
        self::addScript($view, [
            'global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
            'global/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.zh-CN.min.js',
            'global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js',
            'global/plugins/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js',
        ]);
    }

    /**
     * 上传图片
     *
     * @param $view
     */
    public static function addUploads($view)
    {
        self::addStyle($view, [
            'global/plugins/bootstrap-fileinput/bootstrap-fileinput.css',
            'global/plugins/fancybox/source/jquery.fancybox.css',
            'global/plugins/bootstrap-fileinput/fileinput.css'
        ]);
        self::addScript($view, [
            'global/plugins/bootstrap-fileinput/bootstrap-fileinput.js',
            'global/plugins/bootstrap-fileinput/fileinput.js',
            'global/plugins/bootstrap-fileinput/fileinput_locale_zh.js',
            'global/plugins/fancybox/source/jquery.fancybox.pack.js',
        ]);
    }
}