<?php
?>
 <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>会员列表</title>
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
           <script type="text/javascript" src="<?php echo base_url(); ?>other/js/Common.js"></script>
        <style>
            .newcz_div{width: 90%;height:40px;background: url(__PUBLIC__/frame/img/skin_/toolbarbg.png) repeat-x;}
            .newcz_div ul {}
            .newcz_div ul li{float: left;margin:0 20px 0 10px;height:40px;line-height: 40px;}
            .news_div{width:100%}
            .news_div_ul{width:100%;height:33px;background: url(__PUBLIC__/frame/img/skin_/thbg.png) repeat-x;background: #e3e3e3}
              .news_div_ul li{height:25px !important;line-height: 30px !important;padding: 0 10px 0 6px !important;}
            .news_div ul li{height: 80px;line-height: 80px;float: left;text-align:center;padding:10px 10px 6px 6px;word-wrap:break-word;word-break:break-all;overflow:hidden;border-bottom:1px solid #e6e6e6;}
           
            .l1{width: 20%}
            .l2{width: 9%;text-align: center}
            .l3{width: 9%;}
            .l4{width: 12%;}
            .l5{width: 9%;}
            .search{width:90%;height:40px;margin: 30px}
            .search ul{}
            .search ul li{float:left;width:320px;text-align:center;font-size: 14px;height:40px;line-height: 40px}
            .search ul li input,select{height:30px;width: 173px;padding-left:5px;}
            .serbtn{width: 70px;height:30px;height:30px;margin-top:5px;}
            .pages {margin:35px 35%}
        </style>
        <script type="text/javascript">
            $(function ()
            {
                $("#serachsel").change(function ()
                {
                    var $cateval = $("#serachsel option:selected").val();
                    $("input[name='serach_category']").val($cateval);
                })
            });
      
        </script>
    </head>
    
      <body>
        <div id="container">
           <?php $this->load->view('header')?>
            <div id="bd">
               <?php $this->load->view('Left_Nav')?>

                <div id="main">
                        <div class="location">
                        <a href="javascript:history.back(-1);" class="back"><i class="iconfont icon-up"></i><span>返回 &nbsp;&nbsp; ></span></a>
                        <a href="javascript:;"><i class="iconfont icon-home"></i><span>首页&nbsp;&nbsp; ></span></a>
                        <i class="arrow iconfont icon-arrow-right"></i>
                        <span>管理中心</span>
                    </div>
                    <div class="line10"></div>
                    <div class='newcz_div'>
                        <ul>
                            <li><a href="<?php echo  base_url()?>user/show">增加</a><li>
                            <li><input id="delall" type="checkbox"  onclick="all_id()">全选<li>
                        <li><p onclick="deletes()">删除</p><li>
                        </ul>
                    </div>
                    <form style='display:none' action="<?php echo  base_url()?>user/add" method="post" enctype="multipart/form-data" >
                        <div class="search">
                            <ul><li><span>游戏名称：</span><input name='serach_title' type="text" ></li>
                                <li><span>游戏分类：</span>
                                    <select id='serachsel'>
                                        <option>请选择</option>
                                       <?php foreach ($category as $catelist): ?> 
                                        <option value="<?php echo $catelist['Id'];  ?>"> <?php echo $catelist['category_Name'];  ?></option>
                                         <?php endforeach;?>  
                                        <input type='hidden' name='serach_category' value='0'>
                                    </select>
                                </li>
                                <li>
                                    <span>开始时间：</span>
                                    <input type="text" name="serach_begintime"  onfocus="WdatePicker({dateFmt: 'yyyy-MM-dd HH:mm:ss'})" value="<?php echo date(('Y-m-d'),time()); ?>" />
                                </li>
                                <li>
                                    <span>结束时间：</span>
                                    <input type="text" name="serach_endtime"  onfocus="WdatePicker({dateFmt: 'yyyy-MM-dd HH:mm:ss'})" value="<?php echo date(('Y-m-d'),time()); ?>" />
                                </li>
                                <input type="submit" class="serbtn" value="搜索">
                            </ul>    
                        </div>
                    </form>
                    <div class="ui-table-tbody ui-scroll-webkit" style="min-height:390px">
                        <div class="__tbodyMain ui-table-main" style="display: block; width: 100%; right: 100px;left:1px">
                            <div class='news_div'>
                                <ul  class="news_div_ul">
                                    <li class='l5'><input type="radio"></li>
                                    <li class='l1'>用户名</li>
                                    <li class='l4'>会员组</li>
                                    <li  class='l3'>邮箱</li>
                                    <li class='l2'>余额</li>
                                    <li  class='l2'>积分</li>
                                    <li  class='l2'>状态</li>
                                    <li  class='l3'>操作</li>
                                </ul>
                                <div class="user_list">
                                   <?php foreach ($user as $list) : ?>
                                    <ul>
                                   <li class='l5'><input type="checkbox"class="allid"  value="<?php echo $list['id'] ?>"/></li>
                                   <li class='l1'>
                                       <div class='left_name'><a href=''><img src="/<?php echo $list['img'] ?>"/></a></div>
                                       <div class='right_name'>
                                           <h4><b><?php echo $list['user_name'] ?></b>(昵称：<?php echo $list['nickname'] ?>)</h4>
                                            <i>注册时间:<?php echo Date('Y-m-d H:i:s',$list['createtime']) ?></i>
                                           <span>
                                          <a class="amount" href="" title="消费记录">余额</a>
                                          <a class="card" href="" title="充值记录">充值</a>
                                          <a class="point" href="" title="积分记录">积分</a>
                                          <a style="display:none" class="msg" href="" title="消息记录">短消息</a>
                                          <a style="display:none" class="sms" href="javascript:;" onclick="PostSMS('13800138000');" title="发送手机短信通知">短信通知</a>
                                        </span>
                                       </div>
                                   </li>
                                   <?php foreach ($user_group as $group)
                                   {
                                       if($group['id']==$list['group_id'])
                                       {
                                           echo "<li class='l4'>".$group['title']."</li>";
                                       }
                                   }
                                    ?>
                                    <li  class='l3'><?php echo $list['email'] ?></li>
                                    <li class='l2'><?php echo $list['amount'] ?></li>
                                    <li  class='l2'><?php echo $list['point'] ?></li>
                                    <?php
                                            if ($list['status'] == 1) {
                                                echo "<li  class='l2'>正常</li>";
                                            } else if ($list['status'] == 2) {
                                                echo "<li  class='l2'>待审核</li>";
                                            } else {
                                                echo "<li  class='l2'>禁用</li>";
                                            }
                                            ?>
                                    <li  class='l3'><a href="<?php echo base_url()?>user/show/<?php echo $list['id']?>">修改</a></li>
                                    </ul>
                                    <?php endforeach;?>
                                </div>
                                
                            </div>
                               <div class="pages"><?php echo $this->pagination->create_links(); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>