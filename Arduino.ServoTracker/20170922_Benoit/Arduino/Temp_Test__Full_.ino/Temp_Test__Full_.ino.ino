void setup() {
  
  Serial.begin(9600);     //serial communication at baud 9600 (PC)

}

void loop() {
  
  int sensTemp1 = analogRead(A0);
  int sensTemp2 = analogRead(A1);
  int sensTemp3 = analogRead(A2);
  int sensTemp4 = analogRead(A3);
  int sensTemp5 = analogRead(A4);
  int sensTemp6 = analogRead(A5);
  int sensTemp7 = analogRead(A6);
  int sensTemp8 = analogRead(A7);
  
  float temp1 = (sensTemp1*0.004882814-0.5)*100.0;
  float temp2 = (sensTemp2*0.004882814-0.5)*100.0;
  float temp3 = (sensTemp3*0.004882814-0.5)*100.0;
  float temp4 = (sensTemp4*0.004882814-0.5)*100.0;
  float temp5 = (sensTemp5*0.004882814-0.5)*100.0;
  float temp6 = (sensTemp6*0.004882814-0.5)*100.0;
  float temp7 = (sensTemp7*0.004882814-0.5)*100.0;
  float temp8 = (sensTemp8*0.004882814-0.5)*100.0;

  Serial.println(temp1);
  Serial.println(temp2);
  Serial.println(temp3);
  Serial.println(temp4);
  Serial.println(temp5);
  Serial.println(temp6);
  Serial.println(temp7);
  Serial.println(temp8);

  delay(5000);


}



