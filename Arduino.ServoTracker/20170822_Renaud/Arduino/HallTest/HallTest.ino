void setup() {
  Serial.begin(9600); //serial communication at baud 9600 (PC)
  pinMode(22, INPUT); //set other digital pins to input (Hall switch)
}

void loop() {
  int sensHall1 = digitalRead(22);     
  Serial.println(sensHall1);
  delay(2000);
}
