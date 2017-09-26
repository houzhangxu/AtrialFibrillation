<?php
/**
 * Created by PhpStorm.
 * User: 章旭
 * Date: 2017/9/4
 * Time: 17:05
 */

namespace App;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Integer;

class Account extends Model
{

    protected $table = "account";   //指定表名

    protected $primaryKey = "id";   //指定主键

    public $timestamps = true;   //维护时间戳

    protected $fillable = ["username","password","sex"];    //指定允许批量赋值的字段

    protected $guarded = [];        //指定不允许批量赋值的字段

    public $SEX = [
        1=>"男",
        0=>"女"
    ];

    private $UN = "未知";

    /**
     * 测试输出
     * @return string
     */
    public static function hello(){
        return "Hello Account";
    }

    /**
     * 使用facade查询数据
     * @return Collection
     */
    public static function selectData(){
        $result = DB::select("select * from account");      //返回实体
        return $result;
    }

    /**
     * 使用facade添加数据
     * @return bool
     */
    public static function addData(){
        $result = DB::insert("insert into account(username,password,sex) values(?,?,?)",["hou","123456",1]);     //返回布尔值
        return $result;
    }

    /**
     * 使用facade更新数据
     * @param $id int
     * @return int
     */
    public static function updateData($id){
        $result = DB::update("update account set username = ? where id = ?",["zhang",$id]);     //返回受影响行数
        return $result;
    }

    /**
     * 使用facade删除数据
     * @param $id int
     * @return int
     */
    public static function deleteData($id){
        $result = DB::delete("delete from account where id = ? ",[$id]);        //返回受影响行数
        return $result;
    }

    /**
     * 使用查询构造器查询数据
     * @return Collection
     */
    public static function querySelect(){
        /*
        $result = DB::table("account")->get();  //获取表中所有数据,返回集合
        foreach ($result as $key => $value){
            dump($value);
        }
        */

        //$result = DB::table("account")->where("id",">","1")->get();   //查询语句附加条件,返回行的结果集

        //$result = DB::table("account")->whereRaw("id > ? and sex = ?",[2,1])->get();   //查询语句多条件,返回行的结果集

        //$result = DB::table("account")->whereRaw("id > ? and sex = ?",[2,1])->orderBy("id","desc")->first();   //查询语句多条件,返回首条记录,返回一行

        //$result =DB::table("account")->pluck("username");      //返回一列数据

        //$result =DB::table("account")->pluck("username","id");   //返回一列数据,下标为id

        //$result = DB::table("account")->whereRaw("id > ? and sex = ?",[2,1])->select("username","password")->get();
        //查询语句多条件,返回指定字段的数据

        /*
         * 分段操作
        DB::table("account")->orderBy("id","desc")->chunk(2,function ($result){
            dump($result);
        });
        */


        //聚合函数
        $count = DB::table("account")->count();     //求总数
        $max = DB::table("account")->max("sex");    //求最大值
        $min = DB::table("account")->min("sex");    //求最小值
        $avg = DB::table("account")->avg("sex");    //求平均数
        $num = DB::table("account")->sum("sex");    //求总和

        dump($count);
        dump($max);
        dump($min);
        dump($avg);
        dump($num);

        //return $result;
    }

    /**
     * 使用查询构造器添加数据
     * @return int
     */
    public static function queryAdd(){
        //$result = DB::table("account")->insert(["username"=>"query","password"=>"123456","sex"=>1]);  //返回布尔值

        $result = DB::table("account")->insertGetId(["username"=>"queryGetId","password"=>"123456","sex"=>1]);  //返回插入的ID

        /*
        //插入多条数据
        $result = DB::table("account")->insert([
            ["username"=>"query1","password"=>"123456","sex"=>1],
            ["username"=>"query2","password"=>"123456","sex"=>0]
        ]); //返回布尔值

        */

        return $result;
    }

    /**
     * 使用查询构造器修改数据
     * @param $id int
     * @return int 受影响行数
     */
    public static function queryUpdate($id){

        //$result = DB::table("account")->where(["id"=>$id])->update(["username" => "queryUdpate"]);  //普通更新

        //$result = DB::table("account")->where(["id"=>$id])->increment("sex");      //使符合条件的记录的sex字段增加1
        //$result = DB::table("account")->where(["id"=>$id])->increment("sex",3);    //使符合条件的记录的sex字段增加3

        //$result = DB::table("account")->where(["id"=>$id])->decrement("sex");      //使符合条件的记录的sex字段减少1
        //$result = DB::table("account")->where(["id"=>$id])->decrement("sex",3);    //使符合条件的记录的sex字段减少3


        $result = DB::table("account")->where(["id"=>$id])->decrement("sex",1,["username"=>"increment"]);
        //一边递减sex字段,一边修改username

        return $result;
    }

    /**
     * 使用查询构造器删除数据
     * @param $id int
     * @return int
     */
    public static function queryDelete($id){
        //$result = DB::table("account")->where("id",$id)->delete();    //删除等于$id的数据,返回受影响行数

        $result = DB::table("account")->where("id",">=",$id)->delete();     //删除大于等于$id的数据,返回受影响行数

        //DB::table("account")->trunkcate();  //清空表,不返回任何结果,谨慎使用!!!

        return $result;
    }

    protected function getDateFormat()
    {   //重写向数据库写入时间戳方法
        return "U";
    }

    protected function asDateTime($value)
    {   //重写从数据库中读取时间戳以后的操作
        //dump($value);
//        if ($value instanceof DateTimeInterface) {
//            return new Carbon(
//                $value->format('Y-m-d H:i:s.u'), $value->getTimezone()
//            );
//        }
        return $value;
    }

    public function fromDateTime($value) {  //将日期转换为时间戳
        return is_null($value) ? $value : strtotime($value);
        //return $value;
    }

    protected function addDateAttributesToArray(array $attributes)
    {
        foreach ($this->getDates() as $key) {
            if (! isset($attributes[$key])) {
                continue;
            }

            $attributes[$key] = $this->serializeDate(
                parent::asDateTime($attributes[$key])
            );
        }

        return $attributes;
    }

    public function sex($ind = null){
        if($ind != null){
            return array_key_exists($ind,$this->SEX) ? $this->SEX[$ind] : $this->UN;
        }

        return $this->SEX;
    }

}