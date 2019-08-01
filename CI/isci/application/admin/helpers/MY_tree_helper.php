<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 获取分类节点
 * @param type $cate_nav 数据
 * @param type $pid  父ID 默认为0
 * @param type $control 需要调用的名称
 * @param type $id      一般是修改页面 要传入的具体的id
 * @param type $level   等级
 * @return type /
 */
if ( ! function_exists('tree_all'))
{
     function tree_all($cate_nav, $pid, $control, $id, $level = 0) {
          //  $CI = & get_instance();  //因为除了控制器之外，其他的自定义的类是没办法直接用CI类的东西的，所以要用实例化一个CI的对象  (如果要用他的东西就实例化，不用就不需要实例化 )
            $html = '';
            $level++;
            $items = '';
            foreach ($cate_nav as $i => $nav) {
                if ($cate_nav[$i]['pid'] == $pid && $control == "cate_list") {
                    $html .= "<tr>";
                    $html .= "<td><input type='checkbox'></td>";
                    $html .= "<td>" . $nav['Id'] . "</td>";
                    if ($level <= 1) {
                        $html .= "<td>" . str_repeat('&nbsp;&nbsp;', $level - 1) . '<i class="icon iconfont">&#xe65a;</i>' . $nav['category_Name'] . "</td>";   //函数把字符串重复指定的次数。
                    } else {
                        $html .= "<td>" . str_repeat('&nbsp;&nbsp;', $level - 1) . '<i class="icon iconfont">&#xe612;</i><i class="icon iconfont">&#xe65a;</i>' . $nav['category_Name'] . "</td>";   //函数把字符串重复指定的次数。
                    }
                    $html .= "<td>" . $nav['sort'] . "</td>";
                    $html .= "</tr>";
                    $html .= tree_all($cate_nav, $nav['Id'], $control, $id, $level);          //pid=1          //在类中 自己调用自己需要加$this  在视图中 不定义类的情况下  不需要$this
                } else if ($cate_nav[$i]['pid'] == $pid && $control == "cate_edit") {
                  if($nav['Id']==$id)
                  {
                    if ($level <= 1) {
                        $html .= "<option selected='selected'>" . str_repeat('&nbsp;&nbsp;', $level - 1) . $nav['category_Name'] . "</option>";   //函数把字符串重复指定的次数。
                    } else if ($level >= 1) {
                        $html .= "<option selected='selected'>" . str_repeat('&nbsp;', $level - 1) . '　├  ' . $nav['category_Name'] . "</option>";   //函数把字符串重复指定的次数。
                    }
                } else {
                    if ($level <= 1) {
                        $html .= "<option>" . str_repeat('&nbsp;&nbsp;', $level - 1) . $nav['category_Name'] . "</option>";   //函数把字符串重复指定的次数。
                    } else if ($level >= 1) {
                        $html .= "<option >" . str_repeat('&nbsp;', $level - 1) . '　├  ' . $nav['category_Name'] . "</option>";   //函数把字符串重复指定的次数。
                    }
                }
                $html .= tree_all($cate_nav, $nav['Id'], $control, $id, $level);          //pid=1          //在类中 自己调用自己需要加$this  在视图中 不定义类的情况下  不需要$this
                }
            }
            return $html;
        }
}