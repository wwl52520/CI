<?php ?>
<div class="layui-left">
 
    <ul class="layui-nav layui-nav-tree">
        <div class="layui-left-nav "><i class="layui-icon">&#xe68e;</i><span>内容管理</span> </div>
        <li class="layui-nav-item layui-nav-itemed " >
            <a href="javascript:;"><i class="layui-icon">&#xe621;</i>新闻管理</a>
            <dl class="layui-nav-child layui-left-nav-child">
                <dd id='left_1'><a href="javascript:;" data-url="<?php echo  site_url() ?>News/index"  ><i class="layui-icon">&#xe60a;</i>新闻内容</a></dd>
                <dd id='left_2'><a href="javascript:;" data-url="<?php echo  site_url() ?>News_category/index"><i class="layui-icon">&#xe60a;</i>新闻分类</a></dd>
            </dl>
        </li>
        <li class="layui-nav-item " >
            <a href="javascript:;"><i class="layui-icon">&#xe621;</i>产品管理</a>
            <dl class="layui-nav-child layui-left-nav-child" id='goods_left'>
                <dd id='left_14'><a  href='javascript:;' data-url="<?php echo  site_url() ?>Goods/index"><i class="layui-icon">&#xe60a;</i>内容内容</a></dd>
                <dd id='left_15'><a   href="javascript:;" data-url="<?php echo  site_url() ?>Goods_category/index"><i class="layui-icon">&#xe60a;</i>分类管理</a></dd>

                <?php
                if ($this->session->userdata("sites")) {
                    $site = $this->session->userdata("sites");
                    if ($site['is_spec']) {
                        echo " <dd id='left_16'><a  href='javascript:;' data-url='" . site_url() . "Goods_spec/index'><i class='layui-icon'>&#xe60a;</i>规格管理</a></dd>";
                    }
                    if ($site['is_msg']) {
                        echo " <dd id='left_17'><a  href='javascript:;' data-url='" . site_url() . "Goods_comment/index'><i class='layui-icon'>&#xe60a;</i>评论管理</a></dd>";
                    }
                }
                ?>
            </dl>
        </li>
    </ul>
        <ul class="layui-nav layui-nav-tree layui-tab-item">
        <div class="layui-left-nav "><i class="layui-icon">&#xe68e;</i><span>系统管理</span> </div>
        <li class="layui-nav-item layui-nav-itemed " >
            <a href="javascript:;"><i class="layui-icon">&#xe621;</i>用户管理</a>
            <dl class="layui-nav-child layui-left-nav-child">
                <dd id='left_3'><a href="javascript:;" data-url="<?php echo  site_url() ?>Admin/index" ><i class="layui-icon">&#xe60a;</i>管理员管理</a></dd>
                <dd id='left_4'><a href="javascript:;" data-url="<?php echo  site_url() ?>Role/index"><i class="layui-icon">&#xe60a;</i>角色管理</a></dd>
                <dd id='left_5'><a href="javascript:;" data-url="<?php echo  site_url() ?>Admin_log/index"><i class="layui-icon">&#xe60a;</i>管理日志</a></dd>
            </dl>
        </li>
        <li class="layui-nav-item " >
            <a href="javascript:;"><i class="layui-icon">&#xe621;</i>系统管理</a>
            <dl class="layui-nav-child layui-left-nav-child">
                <dd id='left_6'><a href="javascript:;" data-url="<?php echo  site_url() ?>Systems/index"><i class="layui-icon">&#xe60a;</i>系统设置</a></dd>
                <dd id='left_7'><a href="javascript:;" data-url="<?php echo  site_url() ?>Navigation/index"><i class="layui-icon">&#xe60a;</i>栏目管理</a></dd>
            </dl>
        </li>
    </ul>
        <ul class="layui-nav layui-nav-tree layui-tab-item">
        <div class="layui-left-nav "><i class="layui-icon">&#xe68e;</i><span>会员管理</span> </div>
        <li class="layui-nav-item layui-nav-itemed " >
            <a href="javascript:;"><i class="layui-icon">&#xe621;</i>会员管理</a>
            <dl class="layui-nav-child layui-left-nav-child">
                <dd id='left_8'><a href="javascript:;" data-url="<?php echo  site_url() ?>User/index" ><i class="layui-icon">&#xe60a;</i>所有会员</a></dd>
                <dd id='left_9'><a href="javascript:;" data-url="<?php echo  site_url() ?>User_group/index"><i class="layui-icon">&#xe60a;</i>会员组别</a></dd>
            </dl>
        </li>
        <li class="layui-nav-item " >
            <a href="javascript:;"><i class="layui-icon">&#xe621;</i>会员日志</a>
            <dl class="layui-nav-child layui-left-nav-child">
                <dd id='left_10'><a href="javascript:;" data-url="<?php echo  site_url() ?>User/index"><i class="layui-icon">&#xe60a;</i>发送短信</a></dd>
                <dd id='left_11'><a href="javascript:;" data-url="<?php echo  site_url() ?>User_message/index"><i class="layui-icon">&#xe60a;</i>站内消息</a></dd>
                <dd id='left_12'><a href="javascript:;" data-url="<?php echo  site_url() ?>User_amount_log/index"><i class="layui-icon">&#xe60a;</i>消费记录</a></dd>
                <dd id='left_13'><a href="javascript:;" data-url="<?php echo  site_url() ?>User_recharge/index"><i class="layui-icon">&#xe60a;</i>充值记录</a></dd>
            </dl>
        </li>
    </ul>
        <ul class="layui-nav layui-nav-tree layui-tab-item">
        <div class="layui-left-nav "><i class="layui-icon">&#xe68e;</i><span>内容管理4</span> </div>
        <li class="layui-nav-item layui-nav-itemed " >
            <a href="javascript:;"><i class="layui-icon">&#xe621;</i>新闻管理</a>
            <dl class="layui-nav-child layui-left-nav-child">
                <dd><a href="javascript:;" data-url="<?php echo  site_url() ?>News/index" ><i class="layui-icon">&#xe60a;</i>新闻内容</a></dd>
                <dd><a href="javascript:;" data-url="<?php echo  base_url() ?>News_category/index"><i class="layui-icon">&#xe60a;</i>新闻分类</a></dd>
            </dl>
        </li>
        <li class="layui-nav-item " >
            <a href="javascript:;"><i class="layui-icon">&#xe621;</i>产品管理</a>
            <dl class="layui-nav-child layui-left-nav-child">
                <dd><a><i class="layui-icon">&#xe60a;</i>产品内容</a></dd>
                <dd><a><i class="layui-icon">&#xe60a;</i>产品分类</a></dd>
            </dl>
        </li>
    </ul>
   
</div>


