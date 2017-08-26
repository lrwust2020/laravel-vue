<?php
namespace App\Repositories\Backend;

use App\Models\Dict;

abstract class BaseRepository
{
    protected static $instance;
    protected $data  = [];    //返回值data
    protected $dicts  = []; //字典
    const ERROR_STATUS = 0; //失败状态
    const SUCCESS_STATUS  = 1;  //成功状态
    

    //获取实例化
    public static function getInstance()
    {
        $class = get_called_class();
        if (!isset(self::$instance[$class])) {
            self::$instance[$class] = new $class;
        }
        return self::$instance[$class];
    }

    /**
     * 获取字典
     */
    public function getDicts($code_arr)
    {
        $result = [];
        if (arrayAndNotEmpty($code_arr)) {
            $lists = Dict::whereIn('code', $code_arr)->get();
            foreach ($code_arr as $item) {
                $result[$item] = $lists->where('code', $item)->values()->toArray();
            }
        }
        return $result;
    }
}