void setup() {
  Serial.begin(9600); //serial communication at baud 9600 (PC)
}

void loop() {
  int sensTemp1 = analogRead(A0);
  float temp1 = (sensTemp1*0.004882814-0.5)*100.0;
  Serial.println(temp1);
  delay(5000);
}
