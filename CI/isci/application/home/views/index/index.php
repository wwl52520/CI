<?php ?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>other/layui/css/layui.css" />

       <script src="https://cdn.staticfile.org/vue/2.2.2/vue.min.js"></script>
        <title>首页</title>
      
            
    </head>

    <body>
        <div id="app">
            {{message}}
        </div>
        <div id="app2">
            <span v-bind:title="message">鼠标悬停几秒钟查看此处动态绑定的信息</span>
        </div>
        <div id="app-3">
            <p v-if="seen">现在你看到我了</p>
        </div>
        <div id="app-4">
            <ol>
                <li v-for="todo in todos">
                    {{todo.text}}
                </li>
            </ol>
        </div>
    </body>
    <script>
        var app=new Vue({
            el:'#app',
            data:{message:'hello vue!'}
        });
        var app2=new Vue({
            el:"#app2",
            data:{
                message:'页面加载与'+new Date().toLocaleString()
            }
        });
        var app3=new Vue({
            el:'#app-3',
            data:{
                seen:true
            }
        });
        var app4=new Vue({
            el:'#app-4',
            data:{
                todos:[
                    {text:'学些javascript'},
                    {text:'VUE'},
                    {text:'整个项目'}
                ]
            }
        });
        </script>
</html>