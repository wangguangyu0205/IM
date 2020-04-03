var webSocket = createSocketConnection();
layui.use('layim', function(layim){

  //建立WebSocket通讯
  //注意：如果你要兼容ie8+，建议你采用 socket.io 的版本。下面是以原生WS为例
  //发送一个消息
  //连接成功时触发
  webSocket.onopen = function(){

  };

  //监听收到的消息
  webSocket.onmessage = function(res){
    //res为接受到的值，如 {"emit": "messageName", "data": {}}
    //emit即为发出的事件名，用于区分不同的消息
  };


  //基本上常用的就上面几个了，是不是非一般的简单？


});
function createSocketConnection() {
  return new WebSocket('ws://localhost:8090');
}
function sendMessage(msg = '') {
  webSocket.send(msg);
}
