var http = require('http').createServer(handler); //require http server, and create server with function handler()
var fs = require('fs'); //require filesystem module
var io = require('socket.io')(http) //require socket.io module and pass the http object (server)
var gpio = require('rpi-gpio');
var sensor = require('node-dht-sensor');
var relayPin = 23;
var dht11Pin = 25;
var started = false;
gpio.setMode(gpio.MODE_BCM);
gpio.setup(relayPin, gpio.DIR_OUT, logSetup);
http.listen(8080); //listen to port 8080

function handler (req, res) { //create server
  fs.readFile('index.html', function(err, data) { //read file index.html in public folder
    if (err) {
      res.writeHead(404, {'Content-Type': 'text/html'}); //display 404 on error
      return res.end("404 Not Found");
    } 
    res.writeHead(200, {'Content-Type': 'text/html'}); //write HTML
    res.write(data); //write data from index.html
    return res.end();
  });
}




io.sockets.on('connection', function (socket) {// WebSocket Connection
  socket.on('cmd', function(data) { //get light switch status from client
    console.log("cmd data received: " + data); 
    readSensor(socket);
    //startReadings(socket);
    if (data === "on") {
        write(true);
        
    }
    
    if (data === "off") {
        write(false);
    }
  });
  
  socket.emit("status", "initialized");
});

function write(value) {
    gpio.write(relayPin, value, function(err) {
        if (err) throw err;
        console.log('Written to pin');
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
    sensor.read(11, dht11Pin, function(err, temperature, humidity) {
        if (!err) {
            console.log('date: ' + getTheDate() + ', temp: ' + temperature.toFixed(0) + '°C, ' +
                'humidity: ' + humidity.toFixed(0) + '%'
            );
            socket.emit("conditions", {t:temperature.toFixed(0),h:humidity.toFixed(0),d:getTheDate()});
        }
    });
}

function getTheDate(){
    var dat = new Date();
    return dat.toLocaleDateString() + " " + dat.toLocaleTimeString();
};