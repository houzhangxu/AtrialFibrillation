<?php
/**
 * Created by PhpStorm.
 * User: 章旭
 * Date: 2017/12/12
 * Time: 13:46
 */

namespace App;


class CAE extends BaseModel
{

    protected $table = "cae";   //指定表名
    protected $primaryKey = "id";   //指定主键

    protected $fillable = ["chinese_name","english_name"];

}