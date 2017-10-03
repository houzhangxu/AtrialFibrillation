<?php
/**
 * Created by PhpStorm.
 * User: 章旭
 * Date: 2017/10/3
 * Time: 21:42
 */

namespace App;


class ReproductiveHormone extends BaseModel
{   //生殖激素

    protected $table = "reproductive_hormone";   //指定表名
    protected $primaryKey = "id";   //指定主键

    protected $fillable = ["id_card","pid","testosterone","estradiol","follicule_stimulating_hormone",
        "luteinizing_hormone","prolactin","progesterone"];

}