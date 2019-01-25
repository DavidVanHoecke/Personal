var http = require('http').createServer(handler); //require http server, and create server with function handler()
var fs = require('fs'); //require filesystem module
var io = require('socket.io')(http) //require socket.io module and pass the http object (server)
var url = require('url');
var gpio = require('rpi-gpio');
var sensor = require('node-dht-sensor');
var relayPin = 23;
var dht11Pin = 25;
var started = false;
var heaterIsOn = false;
var accesKey = "59997d31-3bd6-4565-b564-362920cf644e";
var timerSocket = null;
var scheduleOverride = false;
var switchOnByTimer = false;

gpio.setMode(gpio.MODE_BCM);
gpio.setup(relayPin, gpio.DIR_OUT, logSetup);
http.listen(8080); //listen to port 8080

setInterval(function(){
    // check if the timer says the heater should activate
    switchOnByTimer = false;
    if(checkSchedule()){
        switchOnByTimer = true;
    }
    
    // activate or deactivate if the schedule isn't overridden
    if(scheduleOverride === false){
        write(switchOnByTimer);
    }
    
    // timerSocket is assigned a value when this node is accessed and socket.io is initialized
    if(timerSocket){
        //timerSocket.emit("timer", getTheDate().getDay());
    }
}, 60000);


function handler (req, res) { //create server
  srvUrl = url.parse(`http://${req.url}`);
  if(srvUrl.path.indexOf(accesKey) > -1){
    fs.readFile('/home/pi/scripts/server/index.html', function(err, data) { //read file index.html in public folder
      if (err) {
        res.writeHead(404, {'Content-Type': 'text/html'}); //display 404 on error
        return res.end("404 Not Found");
      } 
      res.writeHead(200, {'Content-Type': 'text/html'}); //write HTML
      res.write(data); //write data from index.html
      return res.end();
    });
  }
}




io.sockets.on('connection', function (socket) {// WebSocket Connection
  timerSocket = socket;
  socket.on('cmd', function(data) { //get light switch status from client
    console.log("cmd data received: " + data); 
    
    //startReadings(socket);
    if (data === "on") {
        write(true);
    }
    
    if (data === "off") {
        write(false);
    }
    
    readSensor(socket);
  });
  
  socket.emit("status", "Connected");
});

function write(value) {
    gpio.write(relayPin, value, function(err) {
        if (err) throw err;
        console.log('Written to pin: ' + value);
    });
}

function readRelayState(){
    gpio.read(relayPin, function(readError, bHeaterState) {
        if (readError) throw readError;
        //console.log('The value is ' + heaterState);
        heaterIsOn = bHeaterState;
    });
}

function logSetup(err) {
    if (err) throw err;
    console.log('Pin(s) set up.');    
}

function startReadings(socket){
    if(!started){
        console.log("Starting sensor reads");
        started = true;
        setInterval(function(){
            readSensor(socket);
        }, 30000);
    }
}

function readSensor(socket){
    readRelayState();   
    sensor.read(11, dht11Pin, function(err, temperature, humidity) {
        if (!err) {
            console.log('date: ' + getTheDate() + ', temp: ' + temperature.toFixed(0) + '°C, ' +
                'humidity: ' + humidity.toFixed(0) + '%' + ", heater is on: " + heaterIsOn + ", scheduled on: " + checkSchedule()
            );
            socket.emit("conditions", {temp:temperature.toFixed(0),hum:humidity.toFixed(0),dat:getTheDate(),stat:heaterIsOn,sched:checkSchedule()});
        }
    });
}

function getTheDate(){
    var dat = new Date();
    return dat;
};

// we want to schedule to turn heating on between 8:00 and 8:30 am
function checkSchedule(){
    var theDate = getTheDate();
    
    if(theDate.getHours() >= 17 && theDate.getHours() < 22){// turn off
        return true;
    }
    
    if(theDate.getHours() === 8 && theDate.getMinutes() <= 30){// turn on
        return true;
    } else { // turn off
        return false;
    }
}