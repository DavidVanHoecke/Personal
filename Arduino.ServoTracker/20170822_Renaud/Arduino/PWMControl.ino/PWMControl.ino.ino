#include <Servo.h> //import servo class

Servo servo1; //define 8 servo's
Servo servo2;
Servo servo3;
Servo servo4;
Servo servo5;
Servo servo6;
Servo servo7;
Servo servo8;

int pos = 0; //in degrees (neutral position)
int freq = 1; //in Hertz
int period = 1000/freq; //in ms

unsigned long timeOld = 0; //define timing parameters, in ms
unsigned long timeNew = 0;
unsigned long timeDiff = 0;

void setup() {
  servo1.attach(2); //attach servo's to (digital) PWM pins
  servo2.attach(3);
  servo3.attach(4);
  servo4.attach(5);
  servo5.attach(6);
  servo6.attach(7);
  servo7.attach(8);
  servo8.attach(9);
  Serial.begin(9600); //serial communication at baud 9600 (PC)
  pinMode(37, INPUT); //set other digital pins to input (Hall switch)
  pinMode(36, INPUT);
  pinMode(35, INPUT);
  pinMode(34, INPUT);
  pinMode(33, INPUT);
  pinMode(32, INPUT);
  pinMode(31, INPUT);
  pinMode(30, INPUT);
  Serial.println("Servo frequency (in Hertz, standard 1 Hz) ?");
  freq = Serial.parseInt();
  period = 1000/freq; //in ms
  Serial.println("Maximum servo position (in degrees, limited to 45°) ?");  
  pos = Serial.parseInt();
  Serial.println("Temperatures 1-8 || Currents 1-8 || Positions 1-8");  
}

void loop() {
  servo1.write(pos+90); //set servo positions to positive deviation
  servo2.write(pos+90);
  servo3.write(pos+90);
  servo4.write(pos+90);
  servo5.write(pos+90);
  servo6.write(pos+90);
  servo7.write(pos+90);
  servo8.write(pos+90);

  timeNew = millis(); //time since start of program
  timeDiff = timeNew - timeOld; //time between two measurements
  if (timeDiff > 60000) //read sensor data every minute
  {
    String dataString = ""; //data string for CSV file
    
    int sensHall1 = digitalRead(37); //read digital pins (Hall switch)  //high signal: servo stuck in neutral position (by springs)
    int sensHall2 = digitalRead(36);
    int sensHall3 = digitalRead(35);
    int sensHall4 = digitalRead(34);
    int sensHall5 = digitalRead(33);
    int sensHall6 = digitalRead(32);
    int sensHall7 = digitalRead(31);
    int sensHall8 = digitalRead(30); 
    if (sensHall1 == HIGH || sensHall2 == HIGH || sensHall3 == HIGH || sensHall4 == HIGH || sensHall5 == HIGH || sensHall6 == HIGH || sensHall7 == HIGH || sensHall8 == HIGH)
    {
      Serial.println("One of the servo's might be broken (stuck in neutral position)... " + timeNew);
    }
    
    int sensTemp1 = analogRead(0); //read analog pins for temperature (sensor: proportional to voltage)
    int sensTemp2 = analogRead(1);
    int sensTemp3 = analogRead(2);
    int sensTemp4 = analogRead(3);
    int sensTemp5 = analogRead(4);
    int sensTemp6 = analogRead(5);
    int sensTemp7 = analogRead(6);
    int sensTemp8 = analogRead(7);  
    float temp1 = (sensTemp1*(5.0/1024.0)-0.5)*100.0; //temperatures in Centigrades
    float temp2 = (sensTemp2*(5.0/1024.0)-0.5)*100.0;
    float temp3 = (sensTemp3*(5.0/1024.0)-0.5)*100.0;
    float temp4 = (sensTemp4*(5.0/1024.0)-0.5)*100.0;
    float temp5 = (sensTemp5*(5.0/1024.0)-0.5)*100.0;
    float temp6 = (sensTemp6*(5.0/1024.0)-0.5)*100.0;
    float temp7 = (sensTemp7*(5.0/1024.0)-0.5)*100.0;
    float temp8 = (sensTemp8*(5.0/1024.0)-0.5)*100.0;

    int sensCurr1 = analogRead(8); //read analog pins for current (voltage drop over shunt resistor)
    int sensCurr2 = analogRead(9);
    int sensCurr3 = analogRead(10);
    int sensCurr4 = analogRead(11);
    int sensCurr5 = analogRead(12);
    int sensCurr6 = analogRead(13);
    int sensCurr7 = analogRead(14);
    int sensCurr8 = analogRead(15);
    float curr1 = (5.0-sensCurr1*(5.0/1024.0))/0.1; //currents in amperes
    float curr2 = (5.0-sensCurr2*(5.0/1024.0))/0.1;
    float curr3 = (5.0-sensCurr3*(5.0/1024.0))/0.1;
    float curr4 = (5.0-sensCurr4*(5.0/1024.0))/0.1;
    float curr5 = (5.0-sensCurr5*(5.0/1024.0))/0.1;
    float curr6 = (5.0-sensCurr6*(5.0/1024.0))/0.1;
    float curr7 = (5.0-sensCurr7*(5.0/1024.0))/0.1;
    float curr8 = (5.0-sensCurr8*(5.0/1024.0))/0.1;

    timeOld = timeNew; //update time after sensor readout

    delay(period/2); //maintain positive position half a period (approximately)
    servo1.write(90-pos); //set servo positions to negative deviation
    servo2.write(90-pos);
    servo3.write(90-pos);
    servo4.write(90-pos);
    servo5.write(90-pos);
    servo6.write(90-pos);
    servo7.write(90-pos);
    servo8.write(90-pos);
    delay(period/2); //maintain negative position half a period (approximately)

    dataString = String(temp1) + "," + String(temp2) + "," + String(temp3) + "," + String(temp4) + "," + String(temp5) + "," + String(temp6) + "," + String(temp7) + "," + String(temp8) + ", ,"
    + String(curr1) + "," + String (curr2) + "," + String(curr3) + "," + String(curr4) + "," + String(curr5) + "," + String(curr6) + "," + String(curr7) + "," + String(curr8) + ", ,"
    + String(sensHall1) + "," + String (sensHall2) + "," + String(sensHall3) + "," + String(sensHall4) + "," + String(sensHall5) + "," + String(sensHall6) + "," + String(sensHall7) + "," + String(sensHall8);
    Serial.println(dataString);
  }
}
