<?php ?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>权限</title>
    <meta http-equiv="X-UA-Compatible" content="IE=emulateIE7" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>other/css/skin_/nav.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>other/css/skin_/main.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>other/css/skin_/form.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>other/css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>other/css/skin_/table.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>other/css/jquery.grid.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>other/css/admin.css" />
    <script type="text/javascript" src="<?php echo base_url(); ?>other/js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>other/js/WdatePicker.js"></script>
    <style>
        .newcz_div{width: 90%;height:40px;}
        .newcz_div ul {}
        .newcz_div ul li{float: left;margin:0 20px 0 10px;height:40px;line-height: 40px;}
        .news_div{width:100%}
        .news_div ul{}
        .news_div ul li{float: left;text-align:center;height:21px;padding:10px 10px 6px 6px;word-wrap:break-word;word-break:break-all;overflow:hidden;border-left:1px dotted #bfbfbf;/*border-bottom:1px solid #e6e6e6;*/}
       
        .ui-table-tbody td{border-right: 1px dotted #bfbfbf}
        .checkid{margin: 0 6px}
    </style>
    
  
    <script>
  window.onload = function()
     {
            $.ajax(
                    {
                        url:'<?php echo base_url() ?>/role/rule_load',
                        type:"post",
                        dateType:"",
                        data:{"id":'<?php echo $this->uri -> segment(3);?>'},
                        error:function()
                      {
                         alert('载入失败');
                      },
                       success:function(data)
                      {
                          $rules=data.split(',');
                          $ruleslist=$("input[name='allck[]']");
                            for(var j in $ruleslist)
                            {
                                for(var i in $rules)
                                {
                                    if($rules[i]===$ruleslist[j].value)
                                    {
                                      $ruleslist.eq(j).attr('checked',"checked");
                                    }
                                }
                         }         
                      }
                        }   
                     );
     };
     
        function checkall()
        {
            $(".checkall").each(function ()
            {
                if ($(this).is(":checked"))
                {
                   $(this).parent("td").siblings("td").children(".checkid").prop('checked', true);
            
                } else
                {
                    $(this).parent("td").siblings("td").children(".checkid").prop('checked', false);
                  
                }
            });
        }
    </script>
    
    
    
    
    
</head>
<body>
    <div id="container">
        <?php $this->load->view('header') ?>
        <div id="bd">
            <?php $this->load->view('Left_Nav') ?>
            <div id="main">
                <div class="location">
                    <a href="javascript:history.back(-1);" class="back"><i class="iconfont icon-up"></i><span>返回 &nbsp;&nbsp; ></span></a>
                    <a href="<?php echo base_url() ?>admin/index"><i class="iconfont icon-home"></i><span>首页&nbsp;&nbsp; ></span></a>
                    <i class="arrow iconfont icon-arrow-right"></i>
                    <span>管理中心</span>
                </div>
                <div class="line10"></div>
                <div class='newcz_div'>

                </div>
                <div class="ui-table-tbody ui-scroll-webkit" style="min-height:700px">
                    <div class="__tbodyMain ui-table-main" style="display: block; width: 100%; right: 100px;left:1px">
                        <form method="post" action="<?php echo base_url() ?>role/edit" enctype="multipart/form-data">
                            <div class='news_div'>
                                <div class="kv-item ue-clear">
                                    <label><span class="impInfo">*</span>角色名称</label>
                                    <div class="kv-item-content">
                         
                                        <input type="text" name="role_name" style="width:280px" placeholder="角色名称" value="<?php echo $role['role_name']?>" />
                                     <input type="hidden" name="role_id" value="<?php echo $role['id']?>">
                                    </div>

                                </div>
                                <div class="kv-item ue-clear" style="width:5%;float: left">
                                    <label><span class="impInfo">*</span>权限分配</label>
                                </div>
                                <table class="category_list" style="margin-top:0;width:93%">
                                    <tr style="margin-bottom:25px;background-color: #f3f3f3">
                                        <td class='l5'>导航名称</td>
                                        <td class='l2'>权限分配</td>
                                        <td  class='l3'>全选</td>
                                    </tr>


                                    <?php foreach ($list as $item) : ?>
                                        <?php if ($item['pid'] == 0) {
                                            ?>
                                            <tr>
                                          
                                                <td  class='l5' style='text-align:left;padding-left: 20px'><span class="folder-line"></span><span class="folder-open"></span><?php echo $item['title'] ?></td>
                                                <td class='l1' style='text-align:left'>
                                                    <?php
                                                    $items = explode(",", $item['powername']);
                                                    if (in_array("view", $items)) {
                                                            echo "<input id=" . $item['id'] . "  class='checkid' name='allck[]' value=" .$item['id'].'-' . $item['sub_title'] . "-view style='text-align:left' type='checkbox'>显示";
                                                    }
                                                    ?>
                                                </td>
                                                <td class='l1'><input type="checkbox" class='checkall' onclick='checkall()'/></td>
                                            </tr>
                                            <?php
                                            foreach ($list as $chitem) {
                                                if ($chitem['pid'] != 0 && $chitem['pid'] == $item['id']) {
                                                    $chtems = explode(",", $chitem['powername']);
                                                    echo "<tr>";
                                                    echo "<td  class='l5' style='padding-left:40px;text-align:left'><span class='folder-line'></span><span class='folder-open'></span>";
                                                    echo $chitem['title'];
                                                    echo "</td>";
                                                    echo "<td class='l1' style='text-align:left'>";
                                                    if (in_array("view", $chtems)) {

                                                        echo "<input id=" . $chitem['id'] . " class='checkid' name='allck[]'    value=".$chitem['id'].'-' . $chitem['sub_title'] . "-view type='checkbox'>显示";
                                                    }
                                                    echo "</td>";
                                                    echo "<td><input type='checkbox' class='checkall' onclick='checkall()'></td>";
                                                    echo "</tr>";

                                                    foreach ($list as $ctwoitem) {
                                                        if ($ctwoitem['pid'] != 0 && $ctwoitem['pid'] == $chitem['id']) {
                                                            $ctwotems = explode(",", $ctwoitem['powername']);
                                                            echo "<tr>";
                                                            echo "<td  class='l5' style='padding-left:70px;text-align:left'><span class='folder-line'></span><span class='folder-open'></span>";
                                                            echo $ctwoitem['title'];
                                                            echo "</td>";
                                                            echo "<td class='l1'  style='text-align:left'>";
                                                            if (in_array("index", $ctwotems)) {
                                                                echo "<input id=" . $ctwoitem['id'] . " class='checkid' name='allck[]' value=" .$ctwoitem['id'].'-'. $ctwoitem['controller'] . "-index type='checkbox'>显示";
                                                            }
                                                            if (in_array("show", $ctwotems)) {
                                                                echo "<input id=" . $ctwoitem['id'] . " name='allck[]' class='checkid'  value=" .$ctwoitem['id'].'-'. $ctwoitem['controller'] . "-show type='checkbox'>查看";
                                                            }

                                                            if (in_array("edit", $ctwotems)) {
                                                                echo "<input id=" . $ctwoitem['id'] . "  class='checkid' name='allck[]' value=" .$ctwoitem['id'].'-'. $ctwoitem['controller'] . "-edit type='checkbox'>修改";
                                                            }
                                                            if (in_array("add", $ctwotems)) {
                                                                echo "<input id=" . $ctwoitem['id'] . " class='checkid' name='allck[]' value=" .$ctwoitem['id'].'-'. $ctwoitem['controller'] . "-add type='checkbox'>新增";
                                                            }
                                                            if (in_array("delete", $ctwotems)) {
                                                                echo "<input id=" . $ctwoitem['id'] . " class='checkid' name='allck[]' value=" .$ctwoitem['id'].'-'. $ctwoitem['controller'] . "-delete type='checkbox'>删除";
                                                            }
                                                            echo "</td>";
                                                            echo "<td><input type='checkbox' class='checkall'  onclick='checkall()'></td>";
                                                            echo "</tr>";
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                        ?>
                                    <?php endforeach; ?>
                                </table>
                                <div class="buttons" style="clear:both"> 
                                    <input class="button"  type="submit" value="确认" />
                                    
                                </div>
                                <div style="clear: both"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>