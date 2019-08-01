<?php ?>
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
    <style>
        .newcz_div{width: 90%;height:40px;background: url(__PUBLIC__/frame/img/skin_/toolbarbg.png) repeat-x;}
        .newcz_div ul {}
        .newcz_div ul li{float: left;margin:0 20px 0 10px;height:40px;line-height: 40px;}
        .news_div{width:100%}
        .news_div ul{}
        .news_div ul li{float: left;text-align:center;height:21px;padding:10px 10px 6px 6px;word-wrap:break-word;word-break:break-all;overflow:hidden;border-left:1px dotted #bfbfbf;/*border-bottom:1px solid #e6e6e6;*/}
        .l1{width: 8%}
        .l2{width: 30%;text-align: center}
        .l3{width: 17%}
        .l4{width: 150px;}
        .l5{width: 8%}
        .search{width:90%;height:40px;margin: 30px}
        .search ul{}
        .search ul li{float:left;width:320px;text-align:center;font-size: 14px;height:40px;line-height: 40px}
        .search ul li input,select{height:30px;width: 173px;padding-left:5px;}
        .serbtn{width: 70px;height:30px;height:30px;margin-top:5px;}

        .pages {margin:35px 35%}
        .category_list{width: 100%}
        .category_list tr td{text-align: center;}



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
        <?php $this->load->view('header') ?>
        <div id="bd">
            <?php $this->load->view('Left_Nav') ?>

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
                        <li><a href="<?php echo base_url() ?>news_category/show">增加</a><li>
                        <li><a href="__URL__/news_delete">删除</a><li>
                        <li><a href="__URL__/news_sort">排序</a><li>
                        <li><a>切换</a><li>
                    </ul>
                </div>

                <div class="ui-table-tbody ui-scroll-webkit" style="min-height:390px">
                    <div class="__tbodyMain ui-table-main" style="display: block; width: 100%; right: 100px;left:1px">
                        <div class='news_div'>
                            <ul style='width:100%;height:33px;background: url(__PUBLIC__/frame/img/skin_/thbg.png) repeat-x;'>
                                <li class='l5'>选择</li>
                                <li class='l1'>ID</li>
                                <li class='l2'>标题</li>
                                <li  class='l3'>所属类别</li>
                                <li class='l1'>排序</li>
                                <li  class='l3'>操作</li>
                            </ul>
                            <table class="category_list">
                                <?php foreach ($category as $item) : ?>
                                    <?php
                                    if ($item['pid'] == '0') {
                                        ?>
                                        <tr>
                                            <td  class='l5'><input type="radio" /></td>
                                            <td class='l1'><?php echo $item['Id'] ?></td>
                                            <td class='l2'  style="text-align:left;padding-left:100px;"><a href="<?php echo base_url() ?>news_category/show/<?php echo $item['Id'] ?>"><?php echo $item['category_Name'] ?></a></td>
                                            <td class='l3'></td>
                                            <td class='l1'><?php echo $item['sort'] ?></td>
                                            <td class='l3'><a href='<?php echo base_url() ?>news_category/show?add=<?php echo $item['Id'] ?>'>添加子类</a>   <a href='<?php echo base_url() ?>news_category/show?edit=<?php echo $item['Id'] ?>'>修改</a></td>
                                        <?php } ?>
                                    </tr>
                                    <?php foreach ($category as $sitem): ?>
                                        <?php
                                        if ($sitem['pid'] == $item['Id']) {
                                            ?>
                                            <tr>
                                                <td class='l5'><input type="radio"></td>
                                                <td class='l1'><?php echo $sitem['Id'] ?></td>
                                                <td class='l2'  style="text-align:left;padding-left:130px;"><?php echo "├" . $sitem['category_Name'] ?></td>
                                                <td class='l3'></td>
                                                <td class='l1'><?php echo $sitem['sort'] ?></td>
                                                <td class='l3'><a href='<?php echo base_url() ?>news_category/show?edit=<?php echo $sitem['Id'] ?>'>修改</a>   <a href='<?php echo base_url() ?>news_category/edit/<?php echo $sitem['Id'] ?>'>删除</a></td>
                                            </tr>
                                        <?php } ?>
                                    <?php endforeach; ?>
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