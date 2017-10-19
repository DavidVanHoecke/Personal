#include <Servo.h> //import servo class

Servo servo1; //define 2 servo's

int pos = 0; //in degrees (neutral position)
int freq = 1; //in Hertz
int period = 1000/freq; //in ms

void setup() {
  servo1.attach(2); //attach servo's to (digital) PWM pins
  Serial.begin(9600); //serial communication at baud 9600 (PC)
  Serial.println("Servo frequency (in Hertz, standard 1 Hz) ?");
  delay(5000);
  freq = Serial.parseInt();
  period = 1000/freq; //in ms
  Serial.println("Maximum servo position (in degrees, limited to 45°) ?");
  delay(5000);  
  pos = Serial.parseInt();  
}

void loop() {
  servo1.write(pos+90); //set servo positions to positive deviation
  delay(period/2); //maintain positive position half a period (approximately)
  servo1.write(90-pos); //set servo positions to negative deviation
  delay(period/2); //maintain negative position half a period (approximately)
}
