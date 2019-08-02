<?php
?>
 <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>ThinkPHP</title>
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
            .news_div ul{}
            .news_div ul li{float: left;text-align:center;height:21px;padding:10px 10px 6px 6px;word-wrap:break-word;word-break:break-all;overflow:hidden;border-left:1px dotted #bfbfbf;/*border-bottom:1px solid #e6e6e6;*/}
            .l1{width: 100px}
            .l2{width: 270px;text-align: center}
            .l3{width: 175px;}
            .l4{width: 150px;}
            .l5{width: 50px;}
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
                            <li><a href="<?php echo  base_url()?>news/show">增加</a><li>
                          <li><input id="delall" type="checkbox"  onclick="all_id()">全选<li>
                        <li><p onclick="deletes()">删除</p><li>
                        </ul>
                    </div>
                    <form action="__URL__/serach" method="post" enctype="multipart/form-data" >
                        <div class="search">
                            <ul><li><span>游戏名称：</span><input name='serach_title' type="text" ></li>
                                <li><span>游戏分类：</span>
                                    <select id='serachsel'>
                                        <option>请选择</option>
                                       <?php foreach ($category as $catelist): ?> 
                                            <?php if ($catelist['pid'] == 0) { ?>
                                                <option value="<?php echo $catelist['Id']; ?>"> <?php echo $catelist['category_Name']; ?></option>
                                            <?php } ?>
                                            <?php
                                            foreach ($category as $catechild) {
                                                if ($catechild['pid'] == $catelist['Id']) {
                                                    echo " --- <option value=" . $catelist['Id'] . ">" . $catelist['category_Name'] . "</option>";
                                                }
                                            }
                                            ?>
                                        <?php endforeach; ?>  
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
                                <ul style='width:100%;height:33px;background: url(__PUBLIC__/frame/img/skin_/thbg.png) repeat-x;'>
                                    <li class='l5'><input type="radio"></li>
                                    <li class='l1'>ID</li>
                                    <li class='l2'>标题</li>
                                    <li  class='l3'>所属类别</li>
                                    <li class='l1'>排序</li>
                                    <li  class='l1'>点击量</li>
                                    <li  class='l2'>发布时间</li>
                                    <li  class='l3'>是否审核</li>
                                    <li  class='l3'>操作</li>
                                </ul>
                                <table>
                                    
                                    
                                        <tr style='background-color:#eee'>
                                               <?php foreach ($list as $news): ?>
                                            <tr>
                                            <td class="ui-table-checkbox"  ><div style="width:50px;text-align: center"><input type="checkbox"class="allid"  value="<?php echo $news['id'] ?>"/></div></td>
                                            <td name="id" >
                                                <div class="ui-table-td list_id" style="width:100px"><?php echo $news['id'] ?></div>
                                            </td>
                                            <td name="name">                               
                                                <div class="ui-table-td l2" ><a href='<?php echo  base_url()?>news/show/<?php echo $news['id']?>'><?php echo $news['title']?></a></div>
                                            </td>
                                       
                                     <?php foreach ($category as  $item): ?>
                                                <?php
                                                if ($item['Id'] == $news['NewType']) {
                                                    ?>
                                                    <td><div class= 'ui-table-td list_category l3' ><?php echo $item['category_Name'] ?></div></td>
                                                <?php } ?>
                                            <?php endforeach; ?>
                                        <td>
                                            <div class="ui-table-td list_sort l1"><?php echo $news['sort'] ?></div>
                                        </td>
                                        <td>
                                            <div class="ui-table-td list_click l1" ><?php echo $news['click'] ?></div>
                                        </td>
                                        <td>
                                            <div class="ui-table-td list_time l2" ><?php echo date('Y-m-d H:i:s',$news['addate']); ?></div>
                                        </td>
                                        <td>
                                       <?php
                                                if ($news['Status'] == '1')
                                                    echo "<div class='ui-table-td list_status l3'>已审核</div>";
                                                else 
                                                    echo "<div class='ui-table-td list_status l3'>未审核</div>";
                                                
                                                ?>
                                        </td>
                                        <td class="ui-table-blank list_operation l3" >
                                            <a href='<?php echo  base_url()?>news/show/<?php echo $news['id']?>'>编辑</a>   <a href='<?php base_url()?>delete?id=<?php echo $news['id']?>'>删除</a>
                                        </td>
                                        </tr>
                                  <?php endforeach;?>
                                 
                                </table>
                            </div>
                               <div class="pages"><?php echo $this->pagination->create_links(); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>