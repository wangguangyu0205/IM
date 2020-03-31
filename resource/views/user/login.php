<?php
/**
 * @var \Swoft\View\Renderer $this
 */
?>
<!DOCTYPE html>
<html lang="en">
<?= $this->include('chat/header', ['title' => '登录'])  ?>
<style>
  .father{width:1000px;height:auto;margin:0 auto;}
  .layui-input{width:300px;line-height:40px;}
  .login-main{margin-top:300px;margin-left:350px;width:300px;height:400px;/* border:1px solid #e6e6e6; */}
  .layui-form{margin-top:20px;}
  .layui-input-inline{margin-top:30px;}
  button{width:300px;}
</style>
<body>

<div class="father">
  <div class="login-main">
    ，<p style="color:#009688;font-size:25px;text-align:center;">欢迎登陆</p>
    <form class="layui-form">
      <div class="layui-input-inline">
        <input type="text" class="layui-input" name="username" required lay-verify="required" placeholder="请输入用户名" autocomplete="off"
               class="layui-input">
      </div>
      <br>
      <div class="layui-input-inline">
        <input type="password" name="password" required lay-verify="required" placeholder="请输入密码" autocomplete="off"
               class="layui-input">
      </div>
      <br>
      <div class="layui-input-inline login-btn">
        <button lay-submit lay-filter="login" class="layui-btn">登录</button>
      </div>
      <hr/>

      <p><a href="/user/register" class="fl">立即注册</a></p>
    </form>
  </div>
</div>

<?= $this->include('chat/footer') ?>
<script type="text/javascript">
  layui.use(['form','layer','jquery'], function () {

    // 操作对象
    var form = layui.form;
    var $ = layui.jquery;
    form.on('submit(login)',function (data) {
      // console.log(data.field);
      $.ajax({
        url:'login.php',
        data:data.field,
        dataType:'text',
        type:'post',
        success:function (data) {
          if (data == '1'){
            location.href = "../index.php";
          }else{
            layer.msg('登录名或密码错误');
          }
        }
      })
      return false;
    })

  });
</script>
</body>
</html>
