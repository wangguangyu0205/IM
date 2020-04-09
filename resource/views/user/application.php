<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <style>
    .layim-msgbox {
      margin: 15px;
    }

    .layim-msgbox li {
      position: relative;
      margin-bottom: 10px;
      padding: 0 130px 10px 60px;
      padding-bottom: 10px;
      line-height: 22px;
      border-bottom: 1px dotted #e2e2e2;
    }

    .layim-msgbox .layim-msgbox-tips {
      margin: 0;
      padding: 10px 0;
      border: none;
      text-align: center;
      color: #999;
    }

    .layim-msgbox .layim-msgbox-system {
      padding: 0 10px 10px 10px;
    }

    .layim-msgbox li p span {
      padding-left: 5px;
      color: #999;
    }

    .layim-msgbox li p em {
      font-style: normal;
      color: #FF5722;
    }

    .layim-msgbox-avatar {
      position: absolute;
      left: 0;
      top: 0;
      width: 50px;
      height: 50px;
    }

    .layim-msgbox-user {
      padding-top: 5px;
    }

    .layim-msgbox-content {
      margin-top: 3px;
    }

    .layim-msgbox .layui-btn-small {
      padding: 0 15px;
      margin-left: 5px;
    }

    .layim-msgbox-btn {
      position: absolute;
      right: 0;
      top: 12px;
      color: #999;
    }
  </style>
</head>
<?= $this->include('chat/header', ['title' => '消息盒子']) ?>
<body>

<ul class="layim-msgbox" id="LAY_view"></ul>
<textarea title="消息模版" id="LAY_tpl" style="display:none;">
            {{# layui.each(d.data, function(index, item){
                if(item.application_role == 'create'){ }}
                        <li data-uid="{{ item.receiver_id }}">
                          <a href="javascript:void(0);">
                            <img src="{{ item.avatar }}" class="layui-circle layim-msgbox-avatar">
                          </a>
                          <p class="layim-msgbox-user">
                            <a href="javascript:void(0);"><b>{{ item.name }}</b></a>
                            <span>{{ item.created_at }}</span>
                          </p>
                          <p class="layim-msgbox-content">
                            {{# if(item.application_type == 'friend'){ }}
                            申请添加对方为好友
                            {{# }else{ }}
                            申请加入该群
                            {{# } }}
                            <span>{{ item.application_reason ? '附言: '+item.application_reason : '' }}</span>
                          </p>
                          <p class="layim-msgbox-btn">
                            等待验证
                          </p>
                        </li>


                {{# } else if(item.application_role == 'receiver') { }}



                  {{#  if(item.application_status == 0){ }}
                    <li data-uid="{{ item.from }}" data-id="{{ item.msgIdx }}" data-type="{{item.msgType}}"
                        data-name="{{ item.name }}"">
                                                <a href="javascript:void(0);">
                                                  <img src="{{ item.avatar }}"
                                                       class="layui-circle layim-msgbox-avatar">
                                                </a>
                                                <p class="layim-msgbox-user">
                                                  <a href="javascript:void(0);"><b>{{ item.name }}</b></a>
                                                  <span>{{ item.created_at }}</span>
                                                </p>
                                                <p class="layim-msgbox-content">
                                                  {{# if(item.application_type == 'friend'){ }}
                                                  申请添加你为好友
                                                  {{# }else{ }}
                                                  申请加入 {{ item.name }} 群
                                                  {{# } }}
                                                  <span>{{ item.application_reason ? '附言: '+item.application_reason : '' }}</span>
                                                </p>
                                                <p class="layim-msgbox-btn">
                                                  <button class="layui-btn layui-btn-small"
                                                          data-type="agree">同意</button>
                                                  <button class="layui-btn layui-btn-small layui-btn-primary"
                                                          data-type="refuse">拒绝</button>
                                                </p>
  </li>

                  {{#  } else { }}
                        <li>
                          <a href="javascript:void(0);">
                            <img src="{{ item.avatar }}" class="layui-circle layim-msgbox-avatar">
                          </a>
                          <p class="layim-msgbox-user">
                            <a href="javascript:void(0);"><b>{{ item.name }}</b></a>
                            <span>{{ item.created_at }}</span>
                          </p>
                          <p class="layim-msgbox-content">
                            申请添加你为好友
                            <span>{{ item.application_reason ? '附言: '+item.application_reason : '' }}</span>
                            {{# if(item.application_status == 2){ }}
                            <button class="layui-btn layui-btn-xs btncolor chat" data-name="{{ item.name }}"
                                    data-chattype="friend" data-type="chat" data-uid="{{item.user_id}}">发起会话</button>
                            {{# } }}
                          </p>
                          <p class="layim-msgbox-btn">
                            {{ item.application_status_text }}
                          </p>
                        </li>

                  {{#  } }}




                {{# }else if(item.application_role == 'system'){ }}

                  {{#  if(item.application_type == 'friend'){ }}

                      <li class="layim-msgbox-system">
                          <p><em>系统：</em><b>{{ item.name }}</b>
                          {{# if(item.application_status == 2){ }}
                          已同意你的好友申请 <button class="layui-btn layui-btn-xs btncolor chat"
                                            data-name="{{ item.name }}" data-chattype="friend" data-type="chat"
                                            data-uid="{{item.receiver_id}}">发起会话</button>
                          {{# }else{ }}
                          已拒绝你的好友申请
                          {{# } }}
                          <span>{{ item.updated_at }}</span></p>
                      </li>
                  {{#  } else { }}

                      <li class="layim-msgbox-system">
                            <p><em>系统：</em> 管理员 {{ item.name }}
                            {{# if(item.application_status == 2){ }}
                            已同意你加入群 <b>{{ item.name }}</b> <button class="layui-btn layui-btn-xs btncolor chat"
                                                                   data-name="{{ item.name }}"
                                                                   data-chattype="group" data-type="chat"
                                                                   data-uid="{{item.group_id}}">发起会话</button>
                            {{# }else{ }}
                            已拒绝你加入群 <b>{{ item.name }}</b>
                            {{# } }}
                            <span>{{ item.updated_at }}</span></p>
                        </li>
                  {{#  } }}

                {{# }
            }); }}
        </textarea>

<script type="module">
  import {user_get_application} from '/chat/js/api.js';
  import {postRequest} from '/chat/js/request.js';

  layui.use(['layim', 'flow'], function () {
    var layim = layui.layim, layer = layui.layer, laytpl = layui.laytpl, $ = layui.jquery, flow = layui.flow;

    var formatDate = function (now) {
      var myDate = new Date(now);
      var month = myDate.getMonth() + 1;
      var date = myDate.getDate();
      return month + "月" + date + "日";
    };
    //请求消息
    var renderMsg = function (page, callback) {
      postRequest(user_get_application, {
        page: page || 1,
        size: 20
      }, function (data) {
        let list = data.list;
        callback && callback(list, data.pageCount);
      });
    };


    //消息信息流
    flow.load({
      elem: '#LAY_view' //流加载容器
      , isAuto: false
      , end: '<li class="layim-msgbox-tips">暂无更多新消息</li>'
      , done: function (page, next) { //加载下一页
        renderMsg(page, function (data, pages) {
          var html = laytpl(LAY_tpl.value).render({
            data: data
            , page: page
          });
          next(html, page < pages);
        });
      }
    });
    //操作
    var active = {
      IsExist: function (avatar) { //判断头像是否存在
        var ImgObj = new Image();
        ImgObj.src = avatar;
        if (ImgObj.fileSize > 0 || (ImgObj.width > 0 && ImgObj.height > 0)) {
          return true;
        } else {
          return false;
        }
      },
      agree: function (othis) {
        parent.layui.im.receiveAddFriendGroup(othis, 2);//type 1添加好友 3添加群
      }
      //拒绝
      , refuse: function (othis) {
        layer.confirm('确定拒绝吗？', function (index) {
          parent.layui.im.receiveAddFriendGroup(othis, 3);//type 1添加好友 3添加群
        });
      }, chat: function (othis) {//发起好友聊天
        var uid = othis.data('uid'), avatar = "http://test.guoshanchina.com/uploads/person/" + uid + '.jpg';
        parent.layui.layim.chat({
          name: othis.data('name')
          , type: othis.data('chattype')
          , avatar: avatar
          , id: uid
        });
      }

    };
    //打开页面即把系统消息标记为已读
    $(function () {
      $.get('../../../../../../class/doAction.php?action=set_allread', {}, function (res) {
      });
    });
    $('body').on('click', '.layui-btn', function () {
      var othis = $(this), type = othis.data('type');
      active[type] ? active[type].call(this, othis) : '';
    });
    // layer.close(index);

  });
</script>
</body>
</html>
