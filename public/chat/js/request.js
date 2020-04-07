import {output, getCookie} from "./util.js";

function getRequest(url, params, callback) {
  layui.use(['jquery'], function () {
    let $ = layui.jquery;
    layer.load(2);
    $.ajax({
      url: url,
      data: params,
      type: 'get',
      beforeSend: function (request) {
        request.setRequestHeader("Authorization", 'Bearer ' + getCookie("IM_TOKEN"));
      },
      success: function (data) {
        output(data, url);
        layer.closeAll('loading');
        if ($.isEmptyObject(data)){
          return false;
        }
        if (data.code && data.code != 0) {
          layer.msg(data.code + ' : ' + data.msg);
          return false;
        }
        callback && callback(data);
      },
      error: function () {
        layer.closeAll('loading');
        layer.msg('Interface cannot connect : ' + url)
      }
    })
  })
}

function postRequest(url, params, callback) {
  layui.use(['jquery'], function () {
    let $ = layui.jquery;
    layer.load(2);
    $.ajax({
      url: url,
      data: params,
      type: 'post',
      beforeSend: function (request) {
        request.setRequestHeader("Authorization", 'Bearer ' + getCookie("IM_TOKEN"));
      },
      success: function (data) {
        output(data, url);
        layer.closeAll('loading');
        if ($.isEmptyObject(data)){
          return false;
        }
        if (data.code && data.code != 0) {
          layer.msg(data.code + ' : ' + data.msg);
          return false;
        }
        callback && callback(data);
      },
      error: function () {
        layer.closeAll('loading');
        layer.msg('Interface cannot connect : ' + url)
      }
    })
  })
}

export {
  getRequest,
  postRequest
}
