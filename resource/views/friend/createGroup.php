<?= $this->include('chat/header', ['title' => '创建好友分组']) ?>
<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
  <legend>创建好友分组</legend>
</fieldset>

<form class="layui-form" action="">
  <div class="layui-form-item">
    <label class="layui-form-label">分组名称</label>
    <div class="layui-input-block">
      <input type="text" name="friend_group_name" style="width: auto;" lay-verify="required" autocomplete="off" placeholder="请输入好友分组名称"
             class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <div class="layui-input-block">
      <button type="submit" class="layui-btn" lay-submit lay-filter="createFriendGroup">创建</button>
      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
    </div>
  </div>
</form>

<script type="module">
  import {friend_create_group} from '/chat/js/api.js';
  import {postRequest} from '/chat/js/request.js';
  import {addFriendGroup} from '/chat/js/panel.js';


  layui.use(['form', 'layer', 'jquery'], function () {
    var form = layui.form;
    form.on('submit(createFriendGroup)', function (data) {
      postRequest(friend_create_group, data.field, function (data) {
        layer.msg(data.msg);
        addFriendGroup(data.data);
        setTimeout(function () {
          let index = parent.layer.getFrameIndex(window.name);
          parent.layer.close(index);
        },1000)
      });
      return false;
    })
  });
</script>
