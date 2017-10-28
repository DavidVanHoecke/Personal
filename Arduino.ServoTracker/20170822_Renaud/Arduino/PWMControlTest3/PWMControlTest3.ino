#include <Servo.h> //import servo class

Servo servo1; //define 2 servo's

int pos = 0; //in degrees (neutral position)
int freq = 1; //in Hertz
int period = 1000; //in ms

unsigned long timeOld = 0; //define timing parameters, in ms
unsigned long timeNew = 0;
unsigned long timeDiff = 0;

void setup() {
  servo1.attach(2); //attach servo's to (digital) PWM pins
  Serial.begin(9600); //serial communication at baud 9600 (PC)
  pinMode(22, INPUT); //set other digital pins to input (Hall switch)
  Serial.println("Servo frequency (in Hertz, standard 1 Hz) ?");
  delay(3000); //time for user to answer
  freq = Serial.parseInt();
  period = 1000/freq; //in ms
  Serial.println("Maximum servo position (in degrees, limited to 45°) ?");
  delay(3000); //time for user to answer  
  pos = Serial.parseInt();  
}

void loop() {
  servo1.write(pos+90); //set servo positions to positive deviation

  timeNew = millis(); //time since start of program
  timeDiff = timeNew - timeOld; //time between two measurements

  if (timeDiff > 5000) //read sensor data every minute
  {
    int sensHall1 = digitalRead(22); //read digital pins (Hall switch)  //high signal: servo stuck in neutral position (by springs)
    
    int sensTemp1 = analogRead(A0); //read analog pins for temperature (sensor: proportional to voltage)
    float temp1 = (sensTemp1*(5.0/1023.0)-0.5)*100.0; //temperatures in Centigrades
    
    timeOld = timeNew; //update time after sensor readout
    
    Serial.println("temperature: " + String(temp1));
    Serial.println("position " + String(sensHall1));
    Serial.println("");
  }

  delay(period/2); //maintain positive position half a period (approximately)
  servo1.write(90-pos); //set servo positions to negative deviation
  delay(period/2); //maintain negative position half a period (approximately)
}
