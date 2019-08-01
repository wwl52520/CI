<?php ?>
<div class="sidebar" >
        	<div class="sidebar-bg"></div>
            <i class="sidebar-hide"></i>
            <ul class="nav" id="news" style="display:none" >
                <h2><a href="javascript:;"><i class="h2-icon" title="切换到树型结构"></i><span>信息管理</span></a></h2>
                <li class="nav-li current">
                	<a  class="ue-clear"><i class="nav-ivon"></i><span class="nav-text">新闻管理</span></a>
                    <ul class="subnav">     
                        <li class="subnav-li current" data-id="1"><a href="<?php echo  site_url() ?>news/index" class="ue-clear"><i class="subnav-icon"></i><span class="subnav-text">内容管理</span></a></li>
                        <li class="subnav-li" href="news_category.php" data-id="9"><a href="<?php echo  base_url() ?>news_category/index" class="ue-clear"><i class="subnav-icon"></i><span class="subnav-text">分类管理</span></a></li>
                        <li class="subnav-li" href="table.html" data-id="10"><a href="javascript:;" class="ue-clear"><i class="subnav-icon"></i><span class="subnav-text">暂定</span></a></li>
                       
                    </ul>
                </li>
               
            </ul>

              <ul class="nav" style="display:none" id="admin">
                      <h2><a href="javascript:;"><i class="h2-icon" title="切换到树型结构"></i><span>系统管理</span></a></h2>
                <li class="nav-li current">
                	<a  class="ue-clear"><i class="nav-ivon"></i><span class="nav-text">邮箱管理</span></a>
                    <ul class="subnav">
                    	<li class="subnav-li current" data-id="1"><a href="<?php echo  site_url('systems/index') ?>" class="ue-clear"><i class="subnav-icon"></i><span class="subnav-text">邮箱配置</span></a></li>
                        <li class="subnav-li" href="news_category.php" data-id="9"><a href="" class="ue-clear"><i class="subnav-icon"></i><span class="subnav-text">留言管理</span></a></li>
                        <li class="subnav-li" href="table.html" data-id="10"><a href="javascript:;" class="ue-clear"><i class="subnav-icon"></i><span class="subnav-text">暂定</span></a></li>
                    </ul>
                </li>
                  <li class="nav-li current">
                	<a  class="ue-clear"><i class="nav-ivon"></i><span class="nav-text">系统用户</span></a>
                    <ul class="subnav">
                    	<li class="subnav-li current" data-id="1"><a href="<?php echo  site_url('admin/index') ?>" class="ue-clear"><i class="subnav-icon"></i><span class="subnav-text">管理员管理</span></a></li>
                        <li class="subnav-li" href="news_category.php" data-id="9"><a href="<?php echo  site_url('role/index') ?>" class="ue-clear"><i class="subnav-icon"></i><span class="subnav-text">角色管理</span></a></li>
                        <li class="subnav-li" href="table.html" data-id="10"><a href="<?php echo  site_url('admin_log/index') ?>" class="ue-clear"><i class="subnav-icon"></i><span class="subnav-text">管理日志</span></a></li>
                    </ul>
                </li>
                   <li class="nav-li current">
                	<a  class="ue-clear"><i class="nav-ivon"></i><span class="nav-text">导航栏目</span></a>
                    <ul class="subnav">
                    	<li class="subnav-li current" data-id="1"><a href="<?php echo  site_url('systems/index_nav') ?>" class="ue-clear"><i class="subnav-icon"></i><span class="subnav-text">导航栏目</span></a></li>
                   
                    </ul>
                </li>
            </ul>
               <ul class="nav" style="display:none" id="user">
                      <h2><a href="javascript:;"><i class="h2-icon" title="切换到树型结构"></i><span>会员管理</span></a></h2>
                <li class="nav-li current">
                	<a  class="ue-clear"><i class="nav-ivon"></i><span class="nav-text">会员管理</span></a>
                    <ul class="subnav">
                    	<li class="subnav-li current" data-id="1"><a href="<?php echo  site_url('user/index') ?>" class="ue-clear"><i class="subnav-icon"></i><span class="subnav-text">所有会员</span></a></li>
                        <li class="subnav-li" href="news_category.php" data-id="9"><a href="<?php echo  site_url() ?>user_group/index" class="ue-clear"><i class="subnav-icon"></i><span class="subnav-text">会员组别</span></a></li>
                    </ul>
                </li>
                 <li class="nav-li current">
                	<a  class="ue-clear"><i class="nav-ivon"></i><span class="nav-text">会员日志</span></a>
                    <ul class="subnav">
                    	<li class="subnav-li current" data-id="1"><a href="<?php echo  site_url('user_recharge/index') ?>" class="ue-clear"><i class="subnav-icon"></i><span class="subnav-text">充值记录</span></a></li>
                        <li class="subnav-li" href="news_category.php" data-id="9"><a href="<?php echo site_url('user_amount_log/index') ?>" class="ue-clear"><i class="subnav-icon"></i><span class="subnav-text">消费记录</span></a></li>
                         <li class="subnav-li" href="news_category.php" data-id="9"><a href="<?php echo  site_url('user_point_log/index') ?>" class="ue-clear"><i class="subnav-icon"></i><span class="subnav-text">积分记录</span></a></li>
                        
                    </ul>
                </li>
            </ul>
            
            
        </div>
