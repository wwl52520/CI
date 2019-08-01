<?php
?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>商品——评论</title>
    <meta http-equiv="X-UA-Compatible" content="IE=emulateIE7" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>other/_admin/css/index.css" media="all" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(''); ?>other/layui/css/layui.css" media="all" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(''); ?>other/layui/css/iconfont.css" media="all" />
     <script type="text/javascript" src="<?php echo base_url(); ?>other/_admin/js/jquery_3.3.1.min.js"></script>
     <script>
    $(function()
    {
       var $list='"rows":[{"id":"91","title":"上海甲子网络公司游戏上线了","Img":"Uploads\/images\/2019-04-15\/20190415180641_1670.png","NewType":"47","Status":"已审核","Content":"","click":"0","sort":"22","is_msg":"0","is_top":"0","is_red":"0","addate":"2019-02-10","author":"杰克","source":"本站","seo_title":null,"seo_keywords":null,"seo_description":null,"txt1":null,"txt2":null,"Id":"47","category_Name":"公司新闻","content":null,"img":null,"pid":null,"sum":"7","nsort":"11"},{"id":"103","title":"上海甲子网络公司游戏上线了","Img":"Uploads\/images\/2019-05-28\/20190528111454_5091.jpg","NewType":"47","Status":"未审核","Content":"","click":"22","sort":"22","is_msg":"0","is_top":"1","is_red":"1","addate":"2019-05-27","author":"杰克","source":"","seo_title":null,"seo_keywords":null,"seo_description":null,"txt1":null,"txt2":null,"Id":"47","category_Name":"公司新闻","content":null,"img":null,"pid":null,"sum":"7","nsort":"11"},{"id":"90","title":"上海甲子网络公司游戏上线了","Img":"Uploads\/images\/2019-04-15\/20190415174753_4133.jpg","NewType":"47","Status":"已审核","Content":"22222","click":"0","sort":"22","is_msg":"0","is_top":"0","is_red":"0","addate":"2019-05-09","author":"杰克","source":"本站","seo_title":null,"seo_keywords":null,"seo_description":null,"txt1":null,"txt2":null,"Id":"47","category_Name":"公司新闻","content":null,"img":null,"pid":null,"sum":"7","nsort":"22"},{"id":"93","title":"上海甲子网络公司游戏上线了","Img":"","NewType":"47","Status":"未审核","Content":"","click":"0","sort":"22","is_msg":"0","is_top":"0","is_red":"0","addate":"1970-01-01","author":"杰克","source":"本站","seo_title":null,"seo_keywords":null,"seo_description":null,"txt1":null,"txt2":null,"Id":"47","category_Name":"公司新闻","content":null,"img":null,"pid":null,"sum":"7","nsort":"22"},{"id":"104","title":"上海甲子网络公司游戏上线了","Img":"Uploads\/images\/2019-05-28\/20190528114033_4621.jpg","NewType":"47","Status":"未审核","Content":"","click":"33","sort":"22","is_msg":"0","is_top":"0","is_red":"0","addate":"2019-05-27","author":"杰克","source":"","seo_title":null,"seo_keywords":null,"seo_description":null,"txt1":null,"txt2":null,"Id":"47","category_Name":"公司新闻","content":null,"img":null,"pid":null,"sum":"7","nsort":"22"},{"id":"105","title":"上海甲子网络公司游戏上线了","Img":"","NewType":"47","Status":"未审核","Content":"","click":"33","sort":"22","is_msg":"0","is_top":"1","is_red":"1","addate":"2019-05-27","author":"杰克","source":"","seo_title":null,"seo_keywords":null,"seo_description":null,"txt1":null,"txt2":null,"Id":"47","category_Name":"公司新闻","content":null,"img":null,"pid":null,"sum":"7","nsort":"22"},{"id":"94","title":"上海甲子网络公司游戏上线了","Img":"","NewType":"52","Status":"未审核","Content":"","click":"33","sort":"22","is_msg":"0","is_top":"0","is_red":"0","addate":"2019-05-13","author":"杰克","source":"本站","seo_title":null,"seo_keywords":null,"seo_description":null,"txt1":null,"txt2":null,"Id":"52","category_Name":"活动新闻","content":null,"img":null,"pid":"0","sum":"7","nsort":"22"}]';
       var total=7;
       $.ajax({
           url:"http://import_url.ccjoy.cc/jieshou.ashx",
           type:'post',
           data:{'total':$total,'rows':$list},
              error: function (data, type, err) {
                 console.log("ajax错误类型：" + type);
                 console.log(err);
             },
             success: function (data) {
                 $res = jQuery.parseJSON(data)
                 console.log($res["total"]);
             }
       })
    })     
     </script>
     
</head>
<body>
    
</body>
</html>
