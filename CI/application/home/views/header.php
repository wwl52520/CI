<?php ?>
<script>
    $(function ()
    {
        $rule_id = '<?php
$user = $_SESSION['user_info'];
echo $user['role_id']
?>';

        if ($rule_id !== null)
        {
            $(".hd-bottom .nav li").css("display", "block");
            $(".sidebar .nav").eq(0).css('display', 'block');


            if ($rule_id !== "1")
            {
                $.ajax(
                        {
                            url: '<?php echo site_url() ?>index/getrole',
                            type: "post",
                            dataType: "json",
                            data: {"role_id": $rule_id},
                            error: function (XMLHttpRequest, textStatus, errorThrown)
                            {
                                alert(XMLHttpRequest.status);    //XMLHttpRequest 对象
                                alert(XMLHttpRequest.readyState); //错误信息
                                alert(textStatus);                //errorThrown
                            },
                            success: function (data)
                            {
                                $(".nav-wrap ul li").remove();
                                $(".sidebar ul").remove();
                                 $subnav_li=[];
                                for (var i in data.title)
                                {
                                    $onetitle = data.title[i].split('-');
                                    $addnav = "<li><a onclick='leftclick()' >" + $onetitle[1] + "</a></li>";
                                    $nav_wrap = "<ul class='nav'id=" + $onetitle[2] + " ><h2><a href='javascript:;'><i class='h2-icon' ></i><span>" + $onetitle[1] + "</span></a></h2></ul>"
                                    $(".nav-wrap ul").append($addnav);
                                    $(".sidebar").append($nav_wrap);
                                    for (var k in data.twotitle)
                                    {
                                        $twotitle = data.twotitle[k].split('-');
                                        if ($twotitle[0] === $onetitle[0])
                                        {

                                            $addnav_li = "<li class='nav-li current'><a  class='ue-clear'><i class='nav-ivon'></i><span class='nav-text'>" + $twotitle[1] + "</span></a><ul id=" + $twotitle[2] + " class='subnav'></ul></li>";
                                            $(".sidebar .nav").eq(i - 1).append($addnav_li);

                                            for (var j in data.threetitle)
                                            {
                                                $threetitle = data.threetitle[j].split('-');

                                                $(".nav-li ul.subnav").each(function ()
                                                {
                                                    if ($threetitle[0] === $(this).attr('id'))
                                                    {
                                                        $subnav_li[j-0] += '<li id='+$threetitle[3]+' class="subnav-li " data-id="1"><a href="<?php echo site_url() ?>' + $threetitle[2] + '" class="ue-clear"><i class="subnav-icon"></i><span class="subnav-text">' + $threetitle[1] + '</span></a></li>';
                                                        $(this).append($subnav_li);
                                                        
                                                    
                                                    }
                                                });
                                            }
                                        }
                                    }
                                }
                            //      
                                 
                                                   
                                $(".hd-bottom .nav li").css("display", "block");
                                $("div.sidebar .nav").hide();
                                $(".sidebar .nav").eq(0).css('display', 'block');
                                $("ul.ue-clear li").click(function ()
                                {
                                    var index = $(this).index();
                                    $(".sidebar .nav").eq(index).show();
                                    $(".sidebar .nav").eq(index).siblings(".sidebar .nav").hide();
                                });

                            }

                        });
            } else
            {
                $(".nav-wrap ul li").click(function ()
                {
                    var index = $(this).index();
                    $(".sidebar .nav").eq(index).show();
                    $(".sidebar .nav").eq(index).siblings(".sidebar .nav").hide();
                })

            }

        } else
        {
            alert("您还没有登录");
            redirect('login/index');
        }

    });

    window.onload = function ()
    {
        $linkid = '<?php echo $this->router->fetch_class(); ?>';
        //页面点击之后，显示对应的左边栏目
        $(".sidebar .nav").each(function ()
        {
            if ($linkid.indexOf($(this).attr('id')) >= 0)
            {

                $(this).show();
                $(this).siblings(".nav").hide();
            }

        });


    };
</script>

<div id="hd">
    <div class="hd-top">
        <h1 class="logo"><a href="javascript:;" class="logo-icon"></a></h1>
        <div class="user-info">
            <a href="javascript:;" class="user-avatar"><span><img style="width:34px;height:34px;border-radius:15px" src="/<?php
                    $admin = $_SESSION['user_info'];
                    echo $admin['img'];
                    ?>"></span></a>
            <span class="user-name">
                <?php
                $user = $_SESSION['user_info'];
                echo $user['UserName']
                ?>
            </span>
            <a href="javascript:;" class="more-info"></a>
        </div>
        <div class="setting ue-clear">

            <ul class="setting-main ue-clear">
                <li><a href="javascript:;">桌面</a></li>
                <li><a href="javascript:;">设置</a></li>
                <li><a href="javascript:;">帮助</a></li>
                <li><a href="<?php echo site_url() ?>index/quit" class="close-btn exit"></a></li>
            </ul>
        </div>
    </div>
    <div class="hd-bottom">
        <i class="home"><a href="javascript:;"></a></i>
        <div class="nav-wrap">
            <ul class="nav ue-clear">
                <li><a href="javascript:;">平台管理</a></li>
                <li><a href="javascript:;">系统管理</a></li>
                <li><a href="javascript:;">会员管理</a></li>
                <li><a href="javascript:;">订单管理</a></li>
            </ul>
        </div>
        <div class="nav-btn">
            <a href="javascript:;" class="nav-prev-btn"></a>
            <a href="javascript:;" class="nav-next-btn"></a>
        </div>
    </div>
</div>

