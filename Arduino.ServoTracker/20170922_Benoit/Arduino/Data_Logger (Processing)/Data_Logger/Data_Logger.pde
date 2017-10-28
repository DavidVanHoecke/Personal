/*
 * ReceiveMultipleFieldsBinaryToFile_P
 * 
 * PortIndex must be set to the port connected to the Arduino
 * based on ReceiveMultipleFieldsBinary, this version saves data to file
 * Press any key to stop logging and save file
 */

import processing.serial.*;
import java.text.SimpleDateFormat; 
import java.text.DateFormat; 


PrintWriter output;
DateFormat fnameFormat = new SimpleDateFormat("yyMMdd_HHmm");
DateFormat timeFormat = new SimpleDateFormat("hh:mm:ss");
String fileName;

Serial myPort;          //Create object from Serial class
int portIndex = 1;      //Select the COM port, 0 is the first port
char HEADER = 'H';      //A single character header to indicate the start of a message

void setup() {
 
 size(600,400);
 //Open whatever serial port is connected to Arduino
String portName = Serial.list()[portIndex];
println(Serial.list());
println("Connecting to -> " + Serial.list()[portIndex]);
myPort = new Serial(this, portName, 9600);
fileName = fnameFormat.format(System.currentTimeMillis());
output = createWriter(fileName + ".txt");    //save the file in the sketch folder
}

void draw(){

  int val;
  String time;

  if (myPort.available() >= 15){    //wait for the entire message to arrive
    if (myPort.read()==HEADER){     //is this the header

      String timeString = timeFormat.format(System.currentTimeMillis());
      println("Message received at " + timeString);
      output.println(timeString);
      //header found
      //get the integer containing the bit values
      val = readArduinoInt();
      //print the value of each bit
      for(int pin=22, bit=1; pin <=36; pin++){
        print("digital pin " + pin + " = ");
        output.print("digital pin" + pin + " = ");
        int isSet = (val & bit);
        if(isSet ==0){
          println("0");
          output.println("0");
        }

        else{
          println("1");
          output.println("0");
        }
        bit = bit*2;    //shift the bit
      }
      //print the analog values
      for(int i=0; i<=15; i++){
        val = readArduinoInt();
        println("analog port " + i + "=" + val);
        output.println("analog port " + i + "=" + val);
      }
      println("----");
      output.println("----");
    }
  }
}

void keyPressed(){

  output.flush();   //Writes remaining data to the file
  output.close();   //finishes the file
  exit();           //Stops the program
}

//return the integer value from bytes received on the serial port
//(in low, high order)
int readArduinoInt(){
  int val;          //Data received from the serial port

  val = myPort.read();               //Read the least significant byte
  val = myPort.read() * 256 + val;   //Add the most significant byte
  return val;
}

void loop() {
}