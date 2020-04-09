import {
  user_init,
  static_user_application,
  static_user_chat_history,
  user_get_unread_application_count
} from "./api.js";
import {output, getCookie} from "./util.js";
import {getRequest} from "./request.js";

layui.use('layim', function (layim) {
  //基础配置
  layim.config({
    init: {
      url: user_init,
      type: 'get',
      data: {
        token: getCookie('IM_TOKEN')
      }
    }

    //获取群员接口（返回的数据格式见下文）
    , members: {
      url: '' //接口地址（返回的数据格式见下文）
      , type: 'get' //默认get，一般可不填
      , data: {} //额外参数
    }

    //扩展工具栏，下文会做进一步介绍（如果无需扩展，剔除该项即可）
    , tool: [{
      alias: 'code' //工具别名
      , title: '代码' //工具名称
      , icon: '&#xe64e;' //工具图标，参考图标文档
    }]

    , msgbox: static_user_application
    , chatLog: static_user_chat_history
  });
  layim.on('ready', function (options) {
    getRequest(user_get_unread_application_count, {}, function (count) {
      if (count == 0) {
        return false;
      }
      layim.msgbox(count)
    })
  });
});
