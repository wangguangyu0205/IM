<!DOCTYPE html>
<html>
<?= $this->include('chat/header', ['title' => '聊天室']) ?>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
  <div class="layui-header">
    <div class="layui-logo">IM</div>
    <ul class="layui-nav layui-layout-right">
      <li class="layui-nav-item">
        <a href="javascript:;"><img src="<?= $userInfo['avatar'] ?>" class="layui-nav-img"><?= $userInfo['username'] ?></a>
        <dl class="layui-nav-child">
          <dd><a href="javascript:;">修改头像</a></dd>
          <dd><a href="javascript:;">修改昵称</a></dd>
          <dd><a href="javascript:;">修改密码</a></dd>
        </dl>
      </li>
      <li class="layui-nav-item"><a href="/user/signOut">退出</a></li>
    </ul>
  </div>


  <div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
      <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
      <ul class="layui-nav layui-nav-tree" lay-filter="test">
        <?php foreach ($menus as $menu) {
          echo <<<EOF
        <li class="layui-nav-item">
          <a href="javascript:;">{$menu['title']}</a>
EOF;
          foreach ($menu['child'] as $child) {
            echo <<<EOF
          <dl class="layui-nav-child">
            <dd><a href="javascript:;" class="addIframe" im-title="{$child['title']}" im-id="{$child['id']}" im-url="{$child['url']}">{$child['title']}</a></dd>
          </dl>
        </li>
EOF;
          }
        } ?>
      </ul>
    </div>
  </div>


  <div class="layui-body">
    <!-- 内容主体区域 -->
    <div style="padding: 15px;">

    </div>
  </div>

  <div class="layui-footer">
    <!-- 底部固定区域 -->
    © layui.com - 底部固定区域
  </div>
</div>
<script type="module" src="/chat/js/init.js"></script>
<script type="module" src="/chat/js/socket.js"></script>
<script>
  layui.use(['layer', 'jquery', 'element'], function () {
    var layer = layui.layer;
    var $ = layui.jquery;
    var element = layui.element;

    $(".addIframe").click(function (e) {
      let title = $(this).attr('im-title');
      let id = $(this).attr('im-id');
      let url = $(this).attr('im-url');
      layer.open({
        title: title,
        type: 2,
        closeBtn: 1,
        area: ['1000px', '520px'],
        id: id,
        maxmin: true,
        zIndex: layer.zIndex,
        shade: 0,
        content: url,
        success: function (layero) {
          layer.setTop(layero);
        }
      });

    });
  });
</script>
</body>
</html>
