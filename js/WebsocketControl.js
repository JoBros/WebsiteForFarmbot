let pflanzendaten = [];

var msg = {
  type: "befehl"
};


//Wichtig!!!IP-Adresseändern!
let socket = new WebSocket("ws://192.168.188.25:9010");
socket.onopen = function(e) {

};

socket.onmessage = function(event) {
  var str = "";
  str = event.data;
  let found = true;
  while(found){
    try {
        if(obj.type.toString() === "robot_pos"){
        //console.log("Positionsdaten empfangen");
        let position_y =  obj.y;
        let position_x =  obj.x;
        document.getElementById("-" + position_x.toString() + "," + position_y.toString() + "-").style.stroke = 'black';
        document.getElementById("-" + position_x.toString() + "," + position_y.toString() + "-").style.strokeWidth = '3px';
        for (let x_2 = 0; x_2 < 16; x_2++) {
          for (let y_2 = 0; y_2 < 6; y_2++) {
            if ( "-" + x_2 + "," + y_2 + "-" === "-" + obj.x + "," + obj.y + "-") {
              //console.log('ich werde erreicht!');
            } else {
              document.getElementById("-" + x_2.toString() + "," + y_2.toString() + "-").style.stroke = 'rosybrown';
              document.getElementById("-" + x_2.toString() + "," + y_2.toString() + "-").style.strokeWidth = '1px';
            }
          }
        }
      }else{

      }

    }catch (e) {
      found = false;
    }
  }
};


let send = 'nop';

document.getElementById("wasserbtn").onmousedown = function(){
  send = 'w';
}
document.getElementById("wasserbtn").onmouseup = function(){
  send = 'nop';
}
let oneh = true;
document.getElementById("hakbtn").onmouseup = function(){
  send = 'nop';
}
document.getElementById("hakbtn").onmousedown = function(){
  send = 'h'
}

document.getElementById("saatbtn").onmousedown = function(){
  let value = document.getElementById("frucht").getAttribute('value');
  send = 'P';
}

document.getElementById("saatbtn").onmouseup = function(){
  send = 'nop';
}

document.getElementById("A").onmousedown = function(){
  send = 'A';
}
document.getElementById("A").onmouseup = function(){
  send = 'nop';
}
document.getElementById("D").onmousedown = function(){
  send = 'D';
}
document.getElementById("D").onmouseup = function(){
  send = 'nop';
}
document.getElementById("W").onmousedown = function(){
  send = 'W';
}
document.getElementById("W").onmouseup = function(){
  send = 'nop';
}
document.getElementById("S").onmousedown = function(){
  send = 'S';
}
document.getElementById("S").onmouseup = function(){
  send = 'nop';
}
document.getElementById("Q").onmousedown = function(){
  send = 'Q';
}
document.getElementById("Q").onmouseup = function(){
  send = 'nop';
}
document.getElementById("E").onmousedown = function(){
  send = 'E';
}
document.getElementById("E").onmouseup = function(){
  send = 'nop';
}

function sendingFunction(){
  console.log((new Date()) + " - " + send );
  if(oneh === true && send === 'h') {
    socket.send(send);
    oneh = false;
  } else if(oneh === false && send === 'h'){
    socket.send('nop');
  }else{
    socket.send(send);
    oneh = true;
  }
}

setInterval(function() {
  sendingFunction()
}, 125);

socket.onclose = function(event) {
  if (event.wasClean) {} else {

  }
};

socket.onerror = function(error) {
  alert(`[error] ${error.message}`);
};
