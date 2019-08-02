<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$hook['post_controller_constructor'][] = array(
    'class' => 'ManageAuth',            //类名
    'function' => 'auth',               //执行的方法
    'filename' => 'ManageAuth.php',     //文件名
    'filepath' => 'hooks'              //文件路径，默认是application/hooks
);