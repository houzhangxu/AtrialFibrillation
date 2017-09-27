<?php
/**
 * Created by PhpStorm.
 * User: 章旭
 * Date: 2017/9/24
 * Time: 23:46
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{

    public $timestamps = true;   //维护时间戳

    protected $UN = "未知";

    public function option($ind = -1,$filed = null){  //通用获取选项方法
        if($filed == null){
            return $this->UN;
        }

        if($ind != -1){
            return array_key_exists($ind,$this->$filed) ? $this->$filed[$ind] : $this->UN;
        }

        return $this->$filed;
    }

    public function isNullFieLd($field,$type = null){
        if(empty($field)){
            if($type == "int"){
                return 0;
            }else{
                return "无";
            }
        }

        return $field;
    }


    /**
     * 获取当前时间
     *
     * @return int
     */
    public function freshTimestamp() {
        return time();
    }

    /**
     * 避免转换时间戳为时间字符串
     *
     * @param DateTime|int $value
     * @return DateTime|int
     */
    public function fromDateTime($value) {
        return $value;
    }

    /**
     * 从数据库获取的为获取时间戳格式
     *
     * @return string
     */
    public function getDateFormat() {
        return 'U';
    }

}