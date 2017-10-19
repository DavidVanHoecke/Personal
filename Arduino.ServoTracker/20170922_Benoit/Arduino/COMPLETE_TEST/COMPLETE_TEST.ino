#include "RunningAverage.h"
#include <Servo.h>
#include <Chrono.h> 

Servo servo1;
Servo servo2;
Servo servo3;
Servo servo4;
Servo servo5;
Servo servo6; 
Servo servo7;
Servo servo8;

int pos = 0;                             // variable to store the servo position

RunningAverage tempRA1(10);
RunningAverage currRA1(10);
RunningAverage totalTempRA1(10);
RunningAverage totalCurrRA1(10);

RunningAverage tempRA2(10);
RunningAverage currRA2(10);
RunningAverage totalTempRA2(10);
RunningAverage totalCurrRA2(10);

RunningAverage tempRA3(10);
RunningAverage currRA3(10);
RunningAverage totalTempRA3(10);
RunningAverage totalCurrRA3(10);

RunningAverage tempRA4(10);
RunningAverage currRA4(10);
RunningAverage totalTempRA4(10);
RunningAverage totalCurrRA4(10);

RunningAverage tempRA5(10);
RunningAverage currRA5(10);
RunningAverage totalTempRA5(10);
RunningAverage totalCurrRA5(10);

RunningAverage tempRA6(10);
RunningAverage currRA6(10);
RunningAverage totalTempRA6(10);
RunningAverage totalCurrRA6(10);

RunningAverage tempRA7(10);
RunningAverage currRA7(10);
RunningAverage totalTempRA7(10);
RunningAverage totalCurrRA7(10);

RunningAverage tempRA8(10);
RunningAverage currRA8(10);
RunningAverage totalTempRA8(10);
RunningAverage totalCurrRA8(10);

int tempSamples1 = 0;
int currSamples1 = 0;

int tempSamples2 = 0;
int currSamples2 = 0;

int tempSamples3 = 0;
int currSamples3 = 0;

int tempSamples4 = 0;
int currSamples4 = 0;

int tempSamples5 = 0;
int currSamples5 = 0;

int tempSamples6 = 0;
int currSamples6 = 0;

int tempSamples7 = 0;
int currSamples7 = 0;

int tempSamples8 = 0;
int currSamples8 = 0;

int totalTempAverage1 = 0;
int totalCurrAverage1 = 0;

int totalTempAverage2 = 0;
int totalCurrAverage2 = 0;

int totalTempAverage3 = 0;
int totalCurrAverage3 = 0;

int totalTempAverage4 = 0;
int totalCurrAverage4 = 0;

int totalTempAverage5 = 0;
int totalCurrAverage5 = 0;

int totalTempAverage6 = 0;
int totalCurrAverage6 = 0;

int totalTempAverage7 = 0;
int totalCurrAverage7 = 0;

int totalTempAverage8 = 0;
int totalCurrAverage8 = 0;

boolean servo1Running;
boolean servo2Running;
boolean servo3Running;
boolean servo4Running;
boolean servo5Running;
boolean servo6Running;
boolean servo7Running;
boolean servo8Running;

Chrono timerServo1;
Chrono timerServo2;
Chrono timerServo3;
Chrono timerServo4;
Chrono timerServo5;
Chrono timerServo6;
Chrono timerServo7;
Chrono timerServo8;

const char HEADER = 'H';     //A single character header to indicate the start of a message

void setup() {

 servo1.attach(0);           // attaches the servo to PWM pin 0
 servo2.attach(1);  
 servo3.attach(2);
 servo4.attach(3);
 servo5.attach(4);
 servo6.attach(5);  
 servo7.attach(6);
 servo8.attach(7);

 pinMode(22, INPUT);         //set digital pins to input (Hall switch)
 pinMode(23, INPUT);
 pinMode(24, INPUT);
 pinMode(25, INPUT);
 pinMode(26, INPUT);
 pinMode(27, INPUT); 
 pinMode(28, INPUT);
 pinMode(29, INPUT);   
  
 tempRA1.clear();           // explicitly start clean
 tempRA2.clear();
 tempRA3.clear();
 tempRA4.clear();
 tempRA5.clear();
 tempRA6.clear();
 tempRA7.clear();
 tempRA8.clear();
 
 currRA1.clear();
 currRA2.clear();
 currRA3.clear();
 currRA4.clear();
 currRA5.clear();
 currRA6.clear();
 currRA7.clear();
 currRA8.clear();

 totalTempRA1.clear();
 totalTempRA2.clear();
 totalTempRA3.clear();
 totalTempRA4.clear();
 totalTempRA5.clear();
 totalTempRA6.clear();
 totalTempRA7.clear();
 totalTempRA8.clear();
 
 totalCurrRA1.clear();
 totalCurrRA2.clear();
 totalCurrRA3.clear();
 totalCurrRA4.clear();
 totalCurrRA5.clear();
 totalCurrRA6.clear();
 totalCurrRA7.clear();
 totalCurrRA8.clear();

 Serial.begin(9600);                         //serial communication baud 9600 (PC)
}

void loop() {


 for (pos = 0; pos <= 180; pos += 2) {      // goes from 0 degrees to 180 degrees in steps of 1 degree
  
    servo1.write(pos);                      // tell servo to go to position in variable 'pos'
    servo2.write(pos);
    servo3.write(pos);
    servo4.write(pos);
    servo5.write(pos);                                  
    servo6.write(pos); 
    servo7.write(pos);
    servo8.write(pos);
 
    delay(15);                             // waits 15ms for the servo to reach the position
  }
  for (pos = 180; pos >= 0; pos -= 2) {    // goes from 180 degrees to 0 degrees

    servo1.write(pos);                     // tell servo to go to position in variable 'pos'
    servo2.write(pos);
    servo3.write(pos);
    servo4.write(pos);
    servo5.write(pos);
    servo6.write(pos);
    servo7.write(pos);
    servo8.write(pos);
 
    delay(15);                             // waits 15ms for the servo to reach the position
  }

  int sensHall1 = digitalRead(22);
  int sensHall2 = digitalRead(24);
  int sensHall3 = digitalRead(26);
  int sensHall4 = digitalRead(28);
  int sensHall5 = digitalRead(30);
  int sensHall6 = digitalRead(32);
  int sensHall7 = digitalRead(34);
  int sensHall8 = digitalRead(36);

  int sensTemp1 = analogRead(A0);
  int sensTemp2 = analogRead(A1);
  int sensTemp3 = analogRead(A2);
  int sensTemp4 = analogRead(A3);
  int sensTemp5 = analogRead(A4);
  int sensTemp6 = analogRead(A5);
  int sensTemp7 = analogRead(A6);
  int sensTemp8 = analogRead(A7);
  float temp1 = (sensTemp1*0.004882814-0.5)*100.0;            //temperature in Centrigrades
  float temp2 = (sensTemp2*0.004882814-0.5)*100.0;   
  float temp3 = (sensTemp3*0.004882814-0.5)*100.0;   
  float temp4 = (sensTemp4*0.004882814-0.5)*100.0;   
  float temp5 = (sensTemp5*0.004882814-0.5)*100.0;   
  float temp6 = (sensTemp6*0.004882814-0.5)*100.0;   
  float temp7 = (sensTemp7*0.004882814-0.5)*100.0;  
  float temp8 = (sensTemp8*0.004882814-0.5)*100.0;  

  int sensCurr1 = analogRead(A8);                             //read analog pins for current (voltage drop over shunt resistor)
  int sensCurr2 = analogRead(A9); 
  int sensCurr3 = analogRead(A10);
  int sensCurr4 = analogRead(A11);
  int sensCurr5 = analogRead(A12);
  int sensCurr6 = analogRead(A13);
  int sensCurr7 = analogRead(A14);
  int sensCurr8 = analogRead(A15);
  float curr1 = (5.0-sensCurr1*(5.0/1023.0))/0.1;             //current in amperes
  float curr2 = (5.0-sensCurr2*(5.0/1023.0))/0.1;
  float curr3 = (5.0-sensCurr3*(5.0/1023.0))/0.1;
  float curr4 = (5.0-sensCurr4*(5.0/1023.0))/0.1;
  float curr5 = (5.0-sensCurr5*(5.0/1023.0))/0.1;
  float curr6 = (5.0-sensCurr6*(5.0/1023.0))/0.1;
  float curr7 = (5.0-sensCurr7*(5.0/1023.0))/0.1;
  float curr8 = (5.0-sensCurr8*(5.0/1023.0))/0.1;

  Serial.println();
  Serial.print(temp1); Serial.print(" - ");
  Serial.print(temp2); Serial.print(" - ");
  Serial.print(temp3); Serial.print(" - ");
  Serial.print(temp4); Serial.print(" - "); 
  Serial.print(temp5); Serial.print(" - ");
  Serial.print(temp6); Serial.print(" - ");
  Serial.print(temp7); Serial.print(" - ");
  Serial.print(temp8);

  Serial.println();
  Serial.print(curr1); Serial.print(" A - ");
  Serial.print(curr2); Serial.print(" A - ");
  Serial.print(curr3); Serial.print(" A - ");
  Serial.print(curr4); Serial.print(" A - ");
  Serial.print(curr5); Serial.print(" A - ");
  Serial.print(curr6); Serial.print(" A - ");
  Serial.print(curr7); Serial.print(" A - ");
  Serial.print(curr8); Serial.println();

  Serial.print(sensHall1); Serial.print(" ");
  Serial.print(sensHall2); Serial.print(" ");
  Serial.print(sensHall3); Serial.print(" ");
  Serial.print(sensHall4); Serial.print(" ");
  Serial.print(sensHall5); Serial.print(" ");
  Serial.print(sensHall6); Serial.print(" ");
  Serial.print(sensHall7); Serial.print(" ");
  Serial.println(sensHall8);
  
/*
  // if sensHall = 1 start timer, else reset timer. if timer>5sec => servoRunning = false
  if(sensHall1 == 0) timerServo1.restart();
  else {
    timerServo1.restart();
    timerServo1.stop();
  }
  if (timerServo1.elapsed()>5) servo1Running = false;
  else servo1Running = true;
*/

if(sensHall1 == 0) servo1Running = false;             //condition servo still working (still needs to be improved)
  else servo1Running = true;
if(sensHall2 == 0) servo2Running = false;
  else servo2Running = true;
if(sensHall3 == 0) servo3Running = false;
  else servo3Running = true;
if(sensHall4 == 0) servo4Running = false;
  else servo4Running = true;
if(sensHall5 == 0) servo5Running = false;
  else servo5Running = true;
if(sensHall6 == 0) servo6Running = false;
  else servo6Running = true;
if(sensHall7 == 0) servo7Running = false;
  else servo7Running = true;
if(sensHall8 == 0) servo8Running = false;
  else servo8Running = true;


// ---------------SERVO 1------------------
if(servo1Running == true){            //as long as servo is working, add measurements to running average, else stop running average and give total average
  
  tempRA1.addValue(temp1);
  tempSamples1++;

  currRA1.addValue(curr1);
  currSamples1++;

  Serial.print("Running Temp Average 1: ");
  Serial.print(tempRA1.getAverage(), 3);Serial.print("  |  ");
  Serial.print("Running Curr Average 1: ");
  Serial.println(currRA1.getAverage(), 3);
  
  if (tempSamples1 == 600)
  {
    //after 600 samples (take measurement every second => 600 samples = 10min) -> write average to array and reset running average (measuring interval needs to be faster)
    totalTempRA1.addValue(tempRA1.getAverage());
    tempSamples1 = 0;
    tempRA1.clear();
  }

  if (currSamples1 == 600)
  {
    totalCurrRA1.addValue(currRA1.getAverage());
    currSamples1 = 0;
    currRA1.clear();
  }
}
else {
  float totalTempAverage1 = totalTempRA1.getAverage();
  float totalCurrAverage1 = totalCurrRA1.getAverage();
  
  Serial.print("Total Temp Average 1: "); Serial.print(totalTempAverage1);Serial.print("  |  ");
  Serial.print("Total Curr Average 1: "); Serial.println(totalCurrAverage1);
}

// ---------------SERVO 2------------------
if(servo2Running == true){            //as long as servo is working, add measurements to running average, else stop running average and give total average
  
  tempRA2.addValue(temp2);
  tempSamples2++;

  currRA2.addValue(curr2);
  currSamples2++;
  
  Serial.print("Running Temp Average 2: ");
  Serial.print(tempRA2.getAverage(), 3);Serial.print("  |  ");
  Serial.print("Running Curr Average 2: ");
  Serial.println(currRA2.getAverage(), 3);

  if (tempSamples2 == 600)
  {
    //after 600 samples (take measurement every second => 600 samples = 10min) -> write average to array and reset running average (measuring interval needs to be faster)
    totalTempRA2.addValue(tempRA2.getAverage());
    tempSamples2 = 0;
    tempRA2.clear();
  }
  
  if (currSamples2 == 600)
  {
    totalCurrRA2.addValue(currRA2.getAverage());
    currSamples2 = 0;
    currRA2.clear();
  }
}
else {
  float totalTempAverage2 = totalTempRA2.getAverage();
  float totalCurrAverage2 = totalCurrRA2.getAverage();

  Serial.print("Total Temp Average 2: "); Serial.print(totalTempAverage2);Serial.print("  |  ");
  Serial.print("Total Curr Average 2: "); Serial.println(totalCurrAverage2);
}

// ---------------SERVO 3------------------
if(servo3Running == true){            //as long as servo is working, add measurements to running average, else stop running average and give total average
  
  tempRA3.addValue(temp3);
  tempSamples3++;

  currRA3.addValue(curr3);
  currSamples3++;
  
  Serial.print("Running Temp Average 3: ");
  Serial.print(tempRA3.getAverage(), 3);Serial.print("  |  ");
  Serial.print("Running Curr Average 3: ");
  Serial.println(currRA3.getAverage(), 3);

  if (tempSamples3 == 600)
  {
    //after 600 samples (take measurement every second => 600 samples = 10min) -> write average to array and reset running average (measuring interval needs to be faster)
    totalTempRA3.addValue(tempRA3.getAverage());
    tempSamples3 = 0;
    tempRA3.clear();
  }

  if (currSamples3 == 600)
  {
    totalCurrRA3.addValue(currRA2.getAverage());
    currSamples3 = 0;
    currRA3.clear();
  }
}
else {
  float totalTempAverage3 = totalTempRA3.getAverage();
  float totalCurrAverage3 = totalCurrRA3.getAverage();
  
  Serial.print("Total Temp Average 3: "); Serial.print(totalTempAverage3);Serial.print("  |  ");
  Serial.print("Total Curr Average 3: "); Serial.println(totalCurrAverage3);
}

// ---------------SERVO 4------------------
if(servo4Running == true){            //as long as servo is working, add measurements to running average, else stop running average and give total average
  
  tempRA4.addValue(temp4);
  tempSamples4++;

  currRA4.addValue(curr4);
  currSamples4++;
  
  Serial.print("Running Temp Average 4: ");
  Serial.print(tempRA4.getAverage(), 3);Serial.print("  |  ");
  Serial.print("Running Curr Average 4: ");
  Serial.println(currRA4.getAverage(), 3);

  if (tempSamples4 == 600)
  {
    //after 600 samples (take measurement every second => 600 samples = 10min) -> write average to array and reset running average (measuring interval needs to be faster)
    totalTempRA4.addValue(tempRA4.getAverage());
    tempSamples4 = 0;
    tempRA4.clear();
  }

  if (currSamples4 == 600)
  {
    totalCurrRA4.addValue(currRA4.getAverage());
    currSamples4 = 0;
    currRA4.clear();
  }
}
else {
  float totalTempAverage4 = totalTempRA4.getAverage();
  float totalCurrAverage4 = totalCurrRA4.getAverage();

 Serial.print("Total Temp Average 4: "); Serial.print(totalTempAverage4);Serial.print("  |  ");
 Serial.print("Total Curr Average 4: "); Serial.println(totalCurrAverage4);
}

// ---------------SERVO 5------------------
if(servo5Running == true){            //as long as servo is working, add measurements to running average, else stop running average and give total average
  
  tempRA5.addValue(temp5);
  tempSamples5++;

  currRA5.addValue(curr5);
  currSamples5++;
  
  Serial.print("Running Temp Average 5: ");
  Serial.print(tempRA5.getAverage(), 3);Serial.print("  |  ");
  Serial.print("Running Curr Average 5: ");
  Serial.println(currRA5.getAverage(), 3);

  if (tempSamples5 == 600)
  {
    //after 600 samples (take measurement every second => 600 samples = 10min) -> write average to array and reset running average (measuring interval needs to be faster)
    totalTempRA5.addValue(tempRA5.getAverage());
    tempSamples5 = 0;
    tempRA5.clear();
  }

  if (currSamples5 == 600)
  {
    totalCurrRA5.addValue(currRA5.getAverage());
    currSamples5 = 0;
    currRA5.clear();
  }
}
else {
  float totalTempAverage5 = totalTempRA5.getAverage();
  float totalCurrAverage5 = totalCurrRA5.getAverage();

  Serial.print("Total Temp Average 5: "); Serial.print(totalTempAverage5);Serial.print("  |  ");
  Serial.print("Total Curr Average 5: "); Serial.println(totalCurrAverage5);
}

// ---------------SERVO 6------------------
if(servo6Running == true){            //as long as servo is working, add measurements to running average, else stop running average and give total average
  
  tempRA6.addValue(temp6);
  tempSamples6++;

  currRA6.addValue(curr6);
  currSamples6++;
  
  Serial.print("Running Temp Average 6: ");
  Serial.print(tempRA6.getAverage(), 3);Serial.print("  |  ");
  Serial.print("Running Curr Average 6: ");
  Serial.println(currRA6.getAverage(), 3);

  if (tempSamples6 == 600)
  {
    //after 600 samples (take measurement every second => 600 samples = 10min) -> write average to array and reset running average (measuring interval needs to be faster)
    totalTempRA6.addValue(tempRA6.getAverage());
    tempSamples6 = 0;
    tempRA6.clear();
  }

  if (currSamples6 == 600)
  {
    totalCurrRA6.addValue(currRA6.getAverage());
    currSamples6 = 0;
    currRA6.clear();
  }
}
else {
  float totalTempAverage6 = totalTempRA6.getAverage();
  float totalCurrAverage6 = totalCurrRA6.getAverage();

  Serial.print("Total Temp Average 6: "); Serial.print(totalTempAverage6);Serial.print("  |  ");
  Serial.print("Total Curr Average 6: "); Serial.println(totalCurrAverage6);
}

// ---------------SERVO 7------------------
if(servo7Running == true){            //as long as servo is working, add measurements to running average, else stop running average and give total average
  
  tempRA7.addValue(temp7);
  tempSamples7++;

  currRA7.addValue(curr7);
  currSamples7++;
  
  Serial.print("Running Temp Average 7: ");
  Serial.print(tempRA7.getAverage(), 3);Serial.print("  |  ");
  Serial.print("Running Curr Average 7: ");
  Serial.println(currRA7.getAverage(), 3);

  if (tempSamples7 == 600)
  {
    //after 600 samples (take measurement every second => 600 samples = 10min) -> write average to array and reset running average (measuring interval needs to be faster)
    totalTempRA7.addValue(tempRA7.getAverage());
    tempSamples7 = 0;
    tempRA7.clear();
  }
  
  if (currSamples7 == 600)
  {
    totalCurrRA7.addValue(currRA7.getAverage());
    currSamples7 = 0;
    currRA7.clear();
  }
}
else {
  float totalTempAverage7 = totalTempRA7.getAverage();
  float totalCurrAverage7 = totalCurrRA7.getAverage();

  Serial.print("Total Temp Average 7: "); Serial.print(totalTempAverage7);Serial.print("  |  ");
  Serial.print("Total Curr Average 7: "); Serial.println(totalCurrAverage7);
}

// ---------------SERVO 8------------------
if(servo8Running == true){            //as long as servo is working, add measurements to running average, else stop running average and give total average
  
  tempRA8.addValue(temp8);
  tempSamples8++;

  currRA8.addValue(curr8);
  currSamples8++;
  
  Serial.print("Running Temp Average 8: ");
  Serial.print(tempRA8.getAverage(), 3);Serial.print("  |  ");
  Serial.print("Running Curr Average 8: ");
  Serial.println(currRA8.getAverage(), 3);

  if (tempSamples8 == 600)
  {
    //after 600 samples (take measurement every second => 600 samples = 10min) -> write average to array and reset running average (measuring interval needs to be faster)
    totalTempRA8.addValue(tempRA8.getAverage());
    tempSamples8 = 0;
    tempRA8.clear();
  }

  if (currSamples8 == 600)
  {
    totalCurrRA8.addValue(currRA8.getAverage());
    currSamples8 = 0;
    currRA8.clear();
  }
}
else {
  float totalTempAverage8 = totalTempRA8.getAverage();
  float totalCurrAverage8 = totalTempRA8.getAverage();

  Serial.print("Total Temp Average 8: "); Serial.print(totalTempAverage8);Serial.print("  |  ");
  Serial.print("Total Curr Average 8: "); Serial.println(totalCurrAverage8);
}
//for 10 min measure value every second => average of 10min -> save average in array => average of that array = average lifecycle

}
