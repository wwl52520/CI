window.localStorage.removeItem("thisurl");  //
//session存储本页面，F5刷新时保证页面不会丢失
 //这里是设置了一个值，页面刷新时 页面会自动跳到main.php下面，该文件下则将设置的值赋给iframe的src，从而使地址得到保存
 window.localStorage.setItem("thisurl", window.location.href);

//记录锁定顶部导航栏当前位置
$(".layui-nav-left li", parent.document).click(function ()
{  
    window.localStorage.removeItem("thisid");
    window.localStorage.setItem("thisid", $(this).attr("id"));
    var ids=window.localStorage.getItem("thisid");
    console.log(ids);
});


//锁定左边导航栏当前位置
$(".layui-left ul li dl dd",parent.document).click(function()
{
     window.localStorage.removeItem("this_left_id");
     window.localStorage.setItem("this_left_id", $(this).attr("id"));
   //  var left_id=window.localStorage.getItem("this_left_id");
    // console.log(left_id);
});


     //控制全选
    $("#delall").click(function () {
        $("input:checkbox").next("div").toggleClass("layui-form-checked");
    });
    
    
     //列表数据删除
    function del_or_change($id,$url,$type="del") {
        $.ajax({
            url: $url,
            type: "post",
            dataType: "json",
            data: {
               'iditem': $id,'type':$type
            },
            error: function () {
                },
                success: function (data) {
                    if (data.count > 0) {
                  //     $(".layui-form-checked").parents("tr").remove(); //删除dom元素
                        layer.msg(data.msg+"成功", {
                            icon: 1,
                            time: 2000
                        });
                        window.location.reload();
                    }
                }
        });
    }
    







 
 KindEditor.ready(function (K) {
                                var editor1 = K.create('textarea[name="content"]', {
                                    cssPath: '"<?php echo site_url(); ?>other/kindeditor/plugins/code/prettify.css',
                                    uploadJson: '"<?php echo site_url(); ?>other/kindeditor/php/upload_json.php',
                                    fileManagerJson: '"<?php echo site_url(); ?>other/kindeditor/php/file_manager_json.php',
                                    allowFileManager: true,
                                    afterCreate: function () {
                                        var self = this;
                                        K.ctrl(document, 13, function () {
                                            self.sync();
                                            K('form[name=example]')[0].submit();
                                        });
                                        K.ctrl(self.edit.doc, 13, function () {
                                            self.sync();
                                            K('form[name=example]')[0].submit();
                                        });
                                    }
                                });
                            });
                            
                            
                            
                            
              