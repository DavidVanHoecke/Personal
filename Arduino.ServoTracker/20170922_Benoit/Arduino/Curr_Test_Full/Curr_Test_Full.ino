#include<Servo.h>                      //import servo class

Servo servo1;
Servo servo2;
Servo servo3;
Servo servo4;
Servo servo5;
Servo servo6;
Servo servo7;
Servo servo8;

int pos = 0;                          //in degrees (neutral position)
int freq = 1;                         //in kHz
int period = 1000/freq  ;             //in ms

unsigned long timeOld = 0;            //define timing parameters (in ms)
unsigned long timeNew = 0;    
unsigned long timeDiff = 0;

int currTotal1 = 0;
int currTotal2 = 0;
int currTotal3 = 0;
int currTotal4 = 0;
int currTotal5 = 0;
int currTotal6 = 0;
int currTotal7 = 0;
int currTotal8 = 0;

int i=0;

void setup(){

  servo1.attach(2);                       // connect servo's to (digital) PWM pins
  servo2.attach(3);       
  servo3.attach(4);
  servo4.attach(5);
  servo5.attach(6);
  servo6.attach(7);
  servo7.attach(8);
  servo8.attach(9);
    
  serial.begin(9600);                     //serial communication baud 9600 (PC)
  serial.println("Servo frequency standard 1Hz?");    
  delay(2000);                            //time for user to answer
  freq = Serial.parseInt();
  period = 1000/freq;                     //in ms
  Serial.println("Maximum servo position (in degrees, limited to 45°)?");
  delay(2000);                            //time for user to answer         
  pos = Serial.parseInt();                //(pos1 = Serial.parseInt();)

}

void loop(){

  servo1.write(pos+90);             //set servo position to positive deviation
  servo2.write(pos+90);
  servo3.write(pos+90);
  servo4.write(pos+90);
  servo5.write(pos+90);
  servo6.write(pos+90);
  servo7.write(pos+90);
  servo8.write(pos+90);

  timeNew() = millis();                                 //time since start of program
  timeDiff = timeNew - timeOld;                         //time between two measurements


  int sensCurr1 = analogRead(A8);                       //read analog pins for current (voltage drop over shunt resistor)
  int sensCurr2 = analogRead(A9);
  int sensCurr3 = analogRead(A10);
  int sensCurr4 = analogRead(A11);
  int sensCurr5 = analogRead(A12);
  int sensCurr6 = analogRead(A13);
  int sensCurr7 = analogRead(A14);
  int sensCurr8 = analogRead(A15);
  float curr1 = (5.0-sensCurr1*(5.0/1023.0))/0.1;       //current in amperes
  float curr2 = (5.0-sensCurr2*(5.0/1023.0))/0.1;
  float curr3 = (5.0-sensCurr3*(5.0/1023.0))/0.1;
  float curr4 = (5.0-sensCurr4*(5.0/1023.0))/0.1;
  float curr5 = (5.0-sensCurr5*(5.0/1023.0))/0.1;
  float curr6 = (5.0-sensCurr6*(5.0/1023.0))/0.1;
  float curr7 = (5.0-sensCurr7*(5.0/1023.0))/0.1;
  float curr8 = (5.0-sensCurr8*(5.0/1023.0))/0.1;

  currTotal1 += curr1;          
  currTotal2 += curr2;
  currTotal3 += curr3;
  currTotal4 += curr4;
  currTotal5 += curr5;
  currTotal6 += curr6;
  currTotal7 += curr7;
  currTotal8 += curr8;

  i++;

  if(timeDiff >2000){             //read sensor data every minute
    float meancurr1 = currTotal1/i;
    float meancurr2 = currTotal2/i;
    float meancurr3 = currTotal3/i;
    float meancurr4 = currTotal4/i;
    float meancurr5 = currTotal5/i;
    float meancurr6 = currTotal6/i;
    float meancurr7 = currTotal7/i;
    float meancurr8 = currTotal8/i;
    
    i=0;
    timeOld = timeNew;            //update time after sensor readout

    Serial.print(curr1);
    Serial.print(curr2);
    Serial.print(curr3);
    Serial.print(curr4);
    Serial.print(curr5);
    Serial.print(curr6);
    Serial.print(curr7);
    Serial.print(curr8);
  }

delay(period/2);                    //maintain positive position half a period (approximately)
servo1.write(90-pos);               //set servo positions to negative deviation
servo2.write(90-pos);
servo3.write(90-pos);         
servo4.write(90-pos);
servo5.write(90-pos);
servo6.write(90-pos);
servo7.write(90-pos);
servo8.write(90-pos);
delay(period/2);                   //maintain negative position half a period (approximately)
                                 
} 
