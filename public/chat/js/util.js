let debug = true;

function output(info) {
  if (debug) {
    let title = arguments[1] || '';
    console.log("============ " + title + " start");
    console.log(info);
    console.log("============ " + title + " end");
  }
}

function getCookie(cname) {
  var name = cname + "=";
  var ca = document.cookie.split(';');
  for (var i = 0; i < ca.length; i++) {
    var c = ca[i].trim();
    if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
  }
  return "";
}

export {
  output,
  getCookie
}






