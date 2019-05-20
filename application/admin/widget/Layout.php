<?php

namespace app\admin\widget;

use app\admin\model\LayoutDesc;
use app\admin\model\Item;
/**
 * 布局-组件
 * 
 * @author 牧羊人
 * @date 2019-05-06
 *
 */
class Layout extends AdminWidget
{
    /**
     * 初始化方法
     * 
     * @author 牧羊人
     * @date 2019-05-06
     * (non-PHPdoc)
     * @see \app\admin\widget\AdminWidget::initialize()
     */
    function initialize()
    {
        parent::initialize();
        // TODO...
    }
    
    /**
     * 布局描述选择
     * 
     * @author 牧羊人
     * @date 2019-05-06
     */
    function layout_select($page_id, $loc_id, $limit = 2)
    {
        $layout_arr = [
            1 => [
                'tname' => '站点',
                'code' => 'page',
            ],
            2 => [
                'tname' => '页面位置',
                'code' => 'loc',
            ],
        ];
        
        $layout_desc_model = new LayoutDesc();
        $result = $layout_desc_model->where(['page_id' => $page_id, 'mark' => 1])->column('id,page_id,loc_id,loc_desc');
        $item = array();
        if (is_array($result)) {
            foreach ($result as $k => $v) {
                $item[$v['loc_id']]['id'] = $v['loc_id'];
                $item[$v['loc_id']]['name'] = $v['loc_desc'];
            }
        }
        
        //获取站点
        $item_model = new Item();
        $item_list = $item_model->where(['status' =>1, 'mark' => 1])->column('id,name');
        $layout_arr[1]['list'] = $item_list;
        $layout_arr[1]['selected'] = $page_id;
        $layout_arr[2]['list'] = $item;
        $layout_arr[2]['selected'] = $loc_id;
        $layout_arr = array_slice($layout_arr, 0, $limit);
        $this->assign('layout_arr', $layout_arr);
        return $this->fetch("widget/layout/layout_select");
    }
    
}