<div class="layui-header layui-index-head">
    <div class="layui-row">
        <div class="layui-col-md2">
            <h2><a>后台管理内容</a></h2>
            <div class="layui-head-slide ">
                <i class="layui-icon">&#xe668;</i>
            </div>
             </div>
        <div class="layui-col-md4 lefts layui-tab" style="margin:0px ">
            <ul class="layui-nav layui-nav-left">
                <li id='head_1' class="layui-nav-item layui-this" layui-this><a hrf="javascript:;"><i class="layui-icon">&#xe653;</i>内容管理</a></li>
                <li id='head_2' class="layui-nav-item"><a><i class="layui-icon">&#xe631;</i>控制面板</a></li>
                <li id='head_3' class="layui-nav-item"><a><i class="layui-icon">&#xe770;</i>会员管理</a></li>
                <li id='head_4' class="layui-nav-item"><a><i class="layui-icon">&#xe63c;</i>订单管理</a></li>
            </ul>
            </div>
        <div class="layui-col-md3 layui-col-md-offset3">
            <ul class="layui-nav layui-nav-right" style="float: right">
                <li class="layui-nav-item"><a><i class="layui-icon">&#xe66f;</i> 
                            <?php
                            if ($user = $_SESSION['user_info']) {
                                echo $user['UserName'];
                            } else {
                                redirect('login/index');
                            }
                            ?></a></li>
                <li class="layui-nav-item"><a><i class="layui-icon">&#xe716;</i>设置</a>
                <dl class="layui-nav-child"> <!-- 二级菜单 -->
                    <dd><a href="javascript:;" data-url="<?php echo site_url()."admin/show/".$_SESSION['user_info']['ID'] ?>">密码修改</a></dd>
                    <dd><a href="javascript:;" data-url="<?php echo site_url()."index/main"; ?>">管理中心</a></dd>
    </dl>       
                </li>
                <li class="layui-nav-item"><a href="javascript:;"onclick="quit('<?php echo site_url()?>index/quit')" ><i style="margin-right: 0" class="layui-icon icon iconfont">&#xe61c; </i>退出</a></li>
            </ul>
        </div>
        </div>
    </div>
</div>

          
