<?php
/**
 * Created by PhpStorm.
 * User: 章旭
 * Date: 2017/10/3
 * Time: 22:06
 */

namespace App;


class BNP extends BaseModel
{   //BNP

    protected $table = "bnp";   //指定表名
    protected $primaryKey = "id";   //指定主键

    protected $fillable = ["id_card","bnp","TNI",
        "CK","CK_MB","CRP"];

}