<?php
// +----------------------------------------------------------------------
// | RXThink框架 [ RXThink ]
// +----------------------------------------------------------------------
// | 版权所有 2017~2019 南京RXThink工作室
// +----------------------------------------------------------------------
// | 官方网站: http://www.rxthink.cn
// +----------------------------------------------------------------------
// | Author: 牧羊人 <rxthink@gmail.com>
// +----------------------------------------------------------------------

namespace app\admin\model;

use app\common\model\BaseModel;

/**
 * 广告-模型
 * 
 * @author 牧羊人
 * @date 2019-04-30
 *
 */
class Ad extends BaseModel
{
    // 设置数据表
    protected $table = 'think_ad';
    
    /**
     * 初始化模型
     * 
     * @author 牧羊人
     * @date 2019-04-30
     * (non-PHPdoc)
     * @see \app\common\model\BaseModel::initialize()
     */
    function initialize()
    {
        parent::initialize();
        // TODO...
    }
    
    /**
     * 获取缓存信息
     * 
     * @author 牧羊人
     * @date 2019-04-30
     * (non-PHPdoc)
     * @see \app\common\model\BaseModel::getInfo()
     */
    function getInfo($id)
    {
        $info = parent::getInfo($id, true);
        if ($info) {
            
            // 封面
            if ($info['cover']) {
                $info['cover_url'] = get_image_url($info['cover']);
            }
            
            // 广告类型
            if ($info['type']) {
                $info['type_name'] = config('config.ad_type')[$info['type']];
            }
            
            // 广告位
            if ($info['sort_id']) {
                $ad_sort_model = new AdSort();
                $ad_sort_info = $ad_sort_model->getInfo($info['sort_id']);
                $info['sort_name'] = $ad_sort_info['name'] . "=>" . $ad_sort_info['loc_id'];
            }
            
        }
        return $info;
    }
    
}