#include <Servo.h> //import servo class

Servo servo1; //define 2 servo's
// Servo servo2;

int pos = 0; //in degrees (neutral position)
int freq = 1; //in Hertz
int period = 1000; //in ms

unsigned long timeOld = 0; //define timing parameters, in ms
unsigned long timeNew = 0;
unsigned long timeDiff = 0;

// int currTotal1 = 0;
// int currTotal2 = 0;
// int i = 0;

void setup() {
  servo1.attach(2); //attach servo's to (digital) PWM pins
  // servo2.attach(3);
  Serial.begin(9600); //serial communication at baud 9600 (PC)
  pinMode(22, INPUT); //set other digital pins to input (Hall switch)
  // pinMode(23, INPUT);
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
  // servo2.write(pos+90);

  timeNew = millis(); //time since start of program
  timeDiff = timeNew - timeOld; //time between two measurements

  // int sensCurr1 = analogRead(A8); //read analog pins for current (voltage drop over shunt resistor)
  // int sensCurr2 = analogRead(A9);
  // float curr1 = (5.0-sensCurr1*(5.0/1023.0))/0.1; //currents in amperes
  // float curr2 = (5.0-sensCurr2*(5.0/1023.0))/0.1;
  // currTotal1 += curr1;
  // currTotal2 += curr2;
  // i++;
  
  if (timeDiff > 5000) //read sensor data every minute
  {
    int sensHall1 = digitalRead(22); //read digital pins (Hall switch)  //high signal: servo stuck in neutral position (by springs)
    // int sensHall2 = digitalRead(23); 
    // if (sensHall1 == HIGH)
    // {
      // Serial.println("One of the servo's might be broken (stuck in neutral position)... ");
    // }
    
    int sensTemp1 = analogRead(A0); //read analog pins for temperature (sensor: proportional to voltage)
    // int sensTemp2 = analogRead(A1);  
    float temp1 = (sensTemp1*(5.0/1023.0)-0.5)*100.0; //temperatures in Centigrades
    // float temp2 = (sensTemp2*(5.0/1023.0)-0.5)*100.0;

    // float currMean1 = currTotal1/i;
    // float currMean2 = currTotal2/i;
    
    // i = 0;
    // currTotal1 = 0;
    // currTotal2 = 0;
    timeOld = timeNew; //update time after sensor readout
    
    Serial.println("temperature: " + String(temp1));
    Serial.println("position " + String(sensHall1));
    Serial.println("");
  }

  delay(period/2); //maintain positive position half a period (approximately)
  servo1.write(90-pos); //set servo positions to negative deviation
  // servo2.write(90-pos);
  delay(period/2); //maintain negative position half a period (approximately)
}
