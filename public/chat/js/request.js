function getRequest(url, params, callback) {
  layui.use(['jquery'], function () {
    let $ = layui.jquery;
    $.ajax({
      url: url,
      data: params,
      type: 'get',
      success: function (data) {
        if (data && data.code != 0) {
          layer.msg(data.code + ' : ' + data.msg);
          return false;
        }
        callback && callback(data);
      },
      error: function () {
        layer.msg('Interface cannot connect : ' + url)
      }
    })
  })
}

function postRequest(url, params, callback) {
  layui.use(['jquery'], function () {
    let $ = layui.jquery;
    $.ajax({
      url: url,
      data: params,
      type: 'post',
      success: function (data) {
        if (data && data.code != 0) {
          layer.msg(data.code + ' : ' + data.msg);
          return false;
        }
        callback && callback(data);
      },
      error: function () {
        layer.msg('Interface cannot connect : ' + url)
      }
    })
  })
}

export {
  getRequest,
  postRequest
}
