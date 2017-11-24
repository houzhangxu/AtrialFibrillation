<?php
/**
 * Created by PhpStorm.
 * User: 章旭
 * Date: 2017/11/23
 * Time: 3:37
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

class AdminController extends Controller
{   //后台管理控制器

    public function login(){
        return "I am login.";
    }

    public function index(){
        return "Admin index";
    }

}