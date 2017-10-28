void setup() {
  
 Serial.begin(9600);       //serial communication at baud 9600 (PC)
  pinMode(22, INPUT);       //set digital pins to input (Hall switch)
  pinMode(23, INPUT);
  pinMode(24, INPUT);
  pinMode(25, INPUT);
  pinMode(26, INPUT);
  pinMode(27, INPUT); 
  pinMode(28, INPUT);
  pinMode(29, INPUT);   

}

void loop() {

  int sensHall1 = digitalRead(22);
  int sensHall2 = digitalRead(24);
  int sensHall3 = digitalRead(26);
  int sensHall4 = digitalRead(28);
  int sensHall5 = digitalRead(30);
  int sensHall6 = digitalRead(32);
  int sensHall7 = digitalRead(34);
  int sensHall8 = digitalRead(36);

  Serial.println(sensHall1);
  Serial.println(sensHall2);
  Serial.println(sensHall3);
  Serial.println(sensHall4);
  Serial.println(sensHall5);
  Serial.println(sensHall6);
  Serial.println(sensHall7);
  Serial.println(sensHall8);

  delay(2000);
}
