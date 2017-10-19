#include <Servo.h> //import servo class

Servo servo1; //define 2 servo's

int pos = 0; //in degrees (neutral position)
int freq = 1; //in Hertz
int period = 1000/freq; //in ms

unsigned long timeOld = 0; //define timing parameters, in ms
unsigned long timeNew = 0;
unsigned long timeDiff = 0;

int currTotal1 = 0;
int i = 0;

void setup() {
  servo1.attach(2); //attach servo's to (digital) PWM pins
  Serial.begin(9600); //serial communication at baud 9600 (PC)
  Serial.println("Servo frequency (in Hertz, standard 1 Hz) ?");
  delay(2000); //time for user to answer
  freq = Serial.parseInt();
  period = 1000/freq; //in ms
  Serial.println("Maximum servo position (in degrees, limited to 45°) ?");
  delay(2000); //time for user to answer  
  pos = Serial.parseInt();  
}

void loop() {
  servo1.write(pos+90); //set servo positions to positive deviation
  
  timeNew = millis(); //time since start of program
  timeDiff = timeNew - timeOld; //time between two measurements

  int sensCurr1 = analogRead(A0); //read analog pins for current (voltage drop over shunt resistor)
  float curr1 = (5.0-sensCurr1*(5.0/1023.0))/0.1; //currents in amperes
  currTotal1 += curr1;
  i++;
  
  if (timeDiff > 2000) //read sensor data every minute
  {
    float meanCurr1 = currTotal1/i;
    i = 0;
    timeOld = timeNew; //update time after sensor readout
    
    Serial.println(curr1);
  }

  delay(period/2); //maintain positive position half a period (approximately)
  servo1.write(90-pos); //set servo positions to negative deviation
  delay(period/2); //maintain negative position half a period (approximately)
}
