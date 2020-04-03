function getRequest(url, params) {
  layui.use(['jquery'], function () {
    let $ = layui.jquery;
    $.ajax({
      url: url,
      data: params,
      type: 'get',
      success: function (data) {
        layer.msg(data.code+' : '+data.msg)
      },
      error: function () {
        layer.msg('api接口异常')
      }
    })
  })
}

function postRequest(url, params,callback) {
  layui.use(['jquery'], function () {
    let $ = layui.jquery;
    $.ajax({
      url: url,
      data: params,
      type: 'post',
      success: function (data) {
        if(!callback || typeof callback == 'undefined' || callback == undefined){
          return false;
        }
        callback(data);
        layer.msg(data.code+' : '+data.msg)
      },
      error: function () {
        layer.msg('api接口异常')
      }
    })
  })
}
export {
  getRequest,
  postRequest
}
