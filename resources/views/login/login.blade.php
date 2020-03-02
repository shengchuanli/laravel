<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bootstrap 实例 - 水平表单</title>
    <link rel="stylesheet" href="/static/css/bootstrap.min.css">
    <script src="/static/js/jquery.min.js"></script>
    <script src="/static/js/bootstrap.min.js"></script>
</head>
<center>
<h3>管理员登录页面</h3>
</center>
<body>
<form class="form-horizontal" role="form" action="{{url('/1908A/login_do')}}" method="post">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">管理员账号：</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" name="admin_tel" id="admin_tel" placeholder="请输入管理员账号">
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">管理员密码：</label>
        <div class="col-sm-2">
            <input type="password" class="form-control" name="admin_pwd" id="admin_pwd" placeholder="请输入管理员密码">
            <b style="color:red">{{session('msg')}}</b>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="button" id="dl" class="btn btn-default">登录</button>
        </div>
    </div>
</form>

</body>
</html>
<script>
    //账号的验证
    $(document).on('blur','#admin_tel',function(){
        var admin_tel = $(this).val();
        if(!admin_tel){
            alert('你的账号呢？');
            return false;
        }
    });
    //密码的验证
    $(document).on('blur','#admin_pwd',function(){
        var admin_pwd = $(this).val();
        if(!admin_pwd){
            alert('你的密码呢？');
            return false;
        }
    });
    //允许表单提交验证
    $(document).on('click',"#dl",function(){
        var tel = $("#admin_tel").val();
        if(tel==""){
            alert("请输入账号！！！");
            return false;
        }
        var pwd = $("#admin_pwd").val();
        if(pwd==""){
            alert("请输入密码！！！");
            return false;
        }

        $('form').submit();
    });
</script>