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
var scheduleOn = false;
var switchOnByTimer = false;
var manualOn = false;
var desiredTemp = minimalTemp = 15;
var minTempOverrideIsOn = false;
var manualOn = false;

gpio.setMode(gpio.MODE_BCM);
gpio.setup(relayPin, gpio.DIR_OUT, logSetup);
http.listen(8080); //listen to port 8080

function scheduler(){
    if(!started){
        console.log("Starting scheduler.")
        started = true;
        setInterval(function(){
            // check the sensor for minimal temperature (no socket to pass as parameter yet, hence the null)
            readSensor(null);

            // check if the timer says the heater should activate
            switchOnByTimer = checkSchedule();

            var strOnOff = switchOnByTimer ? "ON.": "OFF.";

            // warn user and activate or deactivate heater if the scheduler is on or apply min temp safety
            if(minTempOverrideIsOn == false){
                if(scheduleOn){
                    if(switchOnByTimer != heaterIsOn){
                        write(switchOnByTimer);
                        console.log("Scheduler sent command to turn heater " + strOnOff);
                    }
                } else {
                    console.log("Scheduler is overriden but would have switched the heater " + strOnOff);
                }
            } else {
                console.log("Scheduler is overriden minimum temperature safety." + strOnOff);
            }

        }, 60000);
    }
}

function handler (req, res) { //create server
    scheduler();
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
    
    switch(data){
        case "on":
            manualOn = true;
            write(true);
            break;
        case "off":
            manualOn = false;
            write(false);
            break;
        case "scheduleOn":
            scheduleOn = true;
            break;
        case "scheduleOff":
            scheduleOn = false;
            break;
        default:
            if(data.indexOf("setDesiredTemp:") > -1){
                desiredTemp = parseInt(data.replace("setDesiredTemp:", ""));
                console.log("Set desired temp to: " + desiredTemp);
            }
            break;
    }
    
    
    /*
    //startReadings(socket);
    if (data === "on") {
        write(true);
    }
    
    if (data === "off") {
        write(false);
    }
    
    if(data == )
    */
    readSensor(socket);
  });
  
  socket.emit("status", "Connected");
});

function write(value) {
    if(value != heaterIsOn){
        gpio.write(relayPin, value, function(err) {
            if (err) throw err;
            console.log('Written to GPIO: ' + value);
        });
    } else {
        console.log('Not written to GPIO: no new GPIO state');
    }
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

/*
function startReadings(socket){
    if(!started){
        console.log("Starting sensor reads");
        started = true;
        setInterval(function(){
            readSensor(socket);
        }, 30000);
    }
}
*/
function readSensor(socket){
    readRelayState();   
    sensor.read(11, dht11Pin, function(err, temperature, humidity) {
        if (!err) {
            console.log(
                    'date: ' + getTheDate() + 
                    ', temp: ' + temperature.toFixed(0) + '°C, ' +
                    'humidity: ' + humidity.toFixed(0) + '%, ' + 
                    "heater is on: " + heaterIsOn + 
                    ", scheduled to turn heater on: " + checkSchedule(),
                    ", schedule is activated: " + scheduleOn,
                    ", manual activation is on: " + manualOn,
                    ", desired temperature: " + desiredTemp
            );
            
            // check for minimal temperature allowed
            checkTemp(temperature);
            
            if(socket){
                socket.emit("conditions", {temp:temperature.toFixed(0),hum:humidity.toFixed(0),dat:getTheDate(),stat:heaterIsOn,sched:checkSchedule(),schedIsOn:scheduleOn,mOn:manualOn,dTemp:desiredTemp});
            }
            
            return temperature;
        }
    });
}

function checkTemp(temperature){
    if(temperature <= minimalTemp){// if the temp is lower than the min allowed temp
        console.log("Temp lower than minimum allowed, turning heater on.");
        write(true); // turn heater on
        minTempOverrideIsOn = true; // set min temp override
    } else if(temperature > minimalTemp + 1 && minTempOverrideIsOn){ // if the temp is higher than the min temp allowed + 1°
        console.log("Temp at least 1 degree higher than minimum allowed, turning heater off.");
        write(false); // turn heater on
        minTempOverrideIsOn = false; // revert min temp override
    } else if(manualOn && temperature < desiredTemp){ // if manual operation is on and temp is lower then desired temp
        console.log("Manual on and temp lower than desired temp, turning heater on.");
        write(true); // turn heater on
    } else if (manualOn && temperature > desiredTemp + 1){
        console.log("Manual on and temp at least 1 degree higher than desired temp, turning heater off.");
        write(false); // turn heater off
    }
}

function getTheDate(){
    var dat = new Date();
    return dat;
};

// we want to schedule to turn heating on between 8:00 and 8:30 am
function checkSchedule(){
    var theDate = getTheDate();
    var dayOfWeek = theDate.getDay();
    
    if(theDate.getHours() >= 1 && theDate.getHours() < 8 && dayOfWeek > 0 && dayOfWeek < 6 ){// turn off heater and turn off manual control
        manualOn = false;
        console.log("Schedule checked: heater turned off between 1:00 and 8:00 from monday to friday.");
        return false;
    }
    
    if(theDate.getHours() === 8 && theDate.getMinutes() <= 30 && dayOfWeek > 0 && dayOfWeek < 6 ){// turn on heater and turn off manual control
        console.log("Schedule checked: heating turned on between 8:00 and 8:30 from monday to friday.");
        manualOn = false;
        return true;
    }
    
    if(theDate.getHours() === 8 && theDate.getMinutes() > 30 && dayOfWeek > 0 && dayOfWeek < 6 ){// turn off heater and turn off manual control
        console.log("Schedule checked: turning heater off again after morning heating period.");
        manualOn = false;
        return false;
    }
    
    // nothing sheduled
    var strHeaterIsOn = heaterIsOn ? "on" : "off";
    console.log("Schedule checked: nothing scheduled, setting heater to user choice (" + strHeaterIsOn + ").");
    return heaterIsOn; // turn on
}