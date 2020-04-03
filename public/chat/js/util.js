let debug = true;

function output(info) {
  if (debug) {
    let title = arguments[1] || '';
    console.log("============ " + title + " start");
    console.log(info);
    console.log("============ " + title + " end");
  }
}

export {
  output
}






