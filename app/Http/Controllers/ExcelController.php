<?php
/**
 * Created by PhpStorm.
 * User: 章旭
 * Date: 2017/10/5
 * Time: 15:08
 */

namespace App\Http\Controllers;

use Excel;
class ExcelController extends Controller
{   //Excel

    public function import(){

    }

    public function export(){
        $cellData = [
            ['学号','姓名','成绩'],
            ['10001','AAAAA','99'],
            ['10002','BBBBB','92'],
            ['10003','CCCCC','95'],
            ['10004','DDDDD','89'],
            ['10005','EEEEE','96'],
        ];
        Excel::create('学生成绩',function($excel) use ($cellData){  //创建excel
            $excel->sheet('score', function($sheet) use ($cellData){    //创建excel中的一个表格
                $sheet->rows($cellData);
            });


        })->export('xls');
    }


}