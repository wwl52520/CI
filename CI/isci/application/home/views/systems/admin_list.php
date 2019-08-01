<?php ?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>管理员列表</title>
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
        .newcz_div{width: 90%;height:40px;background: url(__PUBLIC__/frame/img/skin_/toolbarbg.png) repeat-x;}
        .newcz_div ul {}
        .newcz_div ul li{float: left;margin:0 20px 0 10px;height:40px;line-height: 40px;}
        .news_div{width:100%}
        .news_div ul{}
        .news_div ul li{float: left;text-align:center;height:21px;padding:10px 10px 6px 6px;word-wrap:break-word;word-break:break-all;overflow:hidden;border-left:1px dotted #bfbfbf;/*border-bottom:1px solid #e6e6e6;*/}
        .l1{width: 5%}
        .l2{width: 15%;text-align: center}
        .l3{width: 10%}
        .l4{width: 150px;}
        .l5{width: 5%}
        .search{width:90%;height:40px;margin: 30px}
        .search ul{}
        .search ul li{float:left;width:320px;text-align:center;font-size: 14px;height:40px;line-height: 40px}
        .search ul li input,select{height:30px;width: 173px;padding-left:5px;}
        .serbtn{width: 70px;height:30px;height:30px;margin-top:5px;}

        .pages {margin:35px 35%}
        .category_list{width: 100%}
        .category_list tr td{text-align: center;}
    </style>
    <script>
        function all_id()
        {
            if ($("#delall").is(":checked"))
            {
                $(".allid").prop('checked', true);
            } else
            {
                $(".allid").prop('checked', false);
            }
        };
       
        function deletes()
        {
            var $id = '';
            $(".allid").each(function ()
            {
                if ($(this).is(":checked"))
                {
                    $id+= ',' + $(this).val();
                }
            });

          if($id.length===0)
          {
              alert('没有选择要删除的内容');
          }
          else
          {
              $.ajax
              (
                {
                 url:"<?php echo base_url()?>admin/delete",
                 type:"post",
                 dataType: "json",
                 data:{'iditem':$id},
                 error:function()
                {
                    alert('删除失败');
                },
                 success:function(data)
                {
                 if(data.count>0)
                 {
                  alert('删除成功');
                  location.reload();
              }
                }
                }
              );
          }
          
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
                    <ul>
                        <li><a href="<?php echo base_url() ?>admin/show/">增加</a><li>
                        <li><input id="delall" type="checkbox"  onclick="all_id()">全选<li>
                        <li><p onclick="deletes()">删除</p><li>
                      
                    </ul>
                </div>
                <div class="ui-table-tbody ui-scroll-webkit" style="min-height:390px">
                    <div class="__tbodyMain ui-table-main" style="display: block; width: 100%; right: 100px;left:1px">
                        <div class='news_div'>

                            <table class="category_list" style="margin-top:0">
                                <tr style="margin-bottom:25px">
                                    <td class='l5'>选择</td>
                                    <td class='l2'>用户名</td>
                                    <td class='l1'>昵称</td> 
                                    <td  class='l3'>角色</td>
                                    <td  class='l3'>添加时间</td>
                                    <td class='l1'>状态</td>
                                    <td  class='l3'>操作</td>
                                </tr>
                                
                                <?php foreach ($admin_list as $item) : ?>
                                    <tr>
                                        <td  class='l5'><input type="checkbox"class="allid"  value="<?php echo $item['ID'] ?>"/></td>
                                        <td class='l1'><a href="<?php echo base_url() ?>admin/show/<?php echo $item['ID'] ?>"><?php echo $item['UserName'] ?></a></td>
                                        <td class='l1'><?php echo $item['nikename'] ?></td>
                                        <?php
                                        foreach ($admin_role as $role) {
                                            //role_type==管理员类型
                                            if ($role['id'] == $item['role_id']) {
                                                ?>
                                                <td class='l2'><?php echo $role['role_name'] ?></td>
                                            <?php
                                            }
                                        };
                                        ?>
                                        <td class='l3'><?php echo date('Y-m-d H:i:s', $item['createtime']); ?></td>
                                        <td class='l1'><?php echo $item['islock'] ?></td>
                                        <td class='l3'> <a href='<?php echo base_url() ?>admin/show/<?php echo $item['ID'] ?>'>修改</a></td>
                                    </tr>
<?php endforeach; ?>
                            </table>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>