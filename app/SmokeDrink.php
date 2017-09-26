<?php
/**
 * Created by PhpStorm.
 * User: 章旭
 * Date: 2017/9/24
 * Time: 23:35
 */

namespace App;

class SmokeDrink extends BaseModel
{
    protected $table = "smoke_drink";   //指定表名
    protected $primaryKey = "id";   //指定主键

    public $timestamps = true;   //维护时间戳

    protected $fillable = ["id_card","pid","drink","drink_type","ml","year","drink_year","quit_drink","quit_drink_year","smoke","somke_few","smoke_year","quit_smoke","quit_smoke_year"];

    protected $DRINK = [    //是否喝酒
        1=>"是",
        2=>"否"
    ];

    protected $DRINK_TYPE = [   //喝酒品种
        1=>"白酒",
        2=>"黄酒",
        3=>"红酒",
        4=>"啤酒"
    ];

    protected $DRINK_QUIT = [   //是否戒酒
        1=>"是",
        2=>"否"
    ];

    protected $SMOKE = [        //是否吸烟
        1=>"是",
        2=>"否"
    ];

    protected $SMOKE_QUIT = [   //是否戒烟
        1=>"是",
        2=>"否"
    ];



}