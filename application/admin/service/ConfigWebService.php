<?php


namespace app\admin\service;


use app\admin\model\Config as ConfigModel;

/**
 * 网站配置-服务类
 * @author 牧羊人
 * @date 2020/1/3
 * Class ConfigWebService
 * @package app\admin\service
 */
class ConfigWebService extends BaseService
{
    /**
     * 初始化模型
     * @author 牧羊人
     * @date 2020/1/3
     */
    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $this->model = new ConfigModel();
    }

    /**
     * 分组信息编辑
     * @return BaseService|void
     * @author 牧羊人
     * @date 2019/4/24
     */
    public function group()
    {
        $data = request()->param();
        if (empty($data)) {
            return message("数据不能为空", false);
        }
        foreach ($data as $key => $val) {
            if (strpos($key, 'checkbox')) {
                $item = explode('__', $key);
                $key = $item[0];
                $val = implode(',', array_keys($val));
            } elseif (strpos($key, 'upimage')) {
                $item = explode('__', $key);
                $key = $item[0];
                if (strpos($val, "temp")) {
                    //新上传图片
                    $val = save_image($val, 'config');
                }
            } elseif (strpos($key, 'upimgs')) {
                $item = explode('__', $key);
                $key = $item[0];

                $imgArr = explode(',', $val);
                $imgStr = [];
                foreach ($imgArr as $kt => $vt) {
                    if (strpos($vt, "temp")) {
                        //新上传图片
                        $imgStr[] = save_image($vt, 'config');
                    } else {
                        //过滤已上传图片
                        $imgStr[] = str_replace(IMG_URL, "", $vt);
                    }
                }
                $val = serialize($imgStr);
            } elseif (strpos($key, 'ueditor')) {
                $item = explode('__', $key);
                $key = $item[0];
                //内容处理
                save_image_content($val, '', "config");
            }
            $info = $this->model->getInfoByAttr([
                ['name', '=', $key],
            ]);
            if (!$info) {
                continue;
            }
            $this->model->edit([
                'id' => $info['id'],
                'value' => $val,
            ]);
        }
        return message();
    }
}