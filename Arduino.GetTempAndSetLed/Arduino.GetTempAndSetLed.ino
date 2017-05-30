
const int temperaturePin = 7;

const int redLedPin = 3;
const int greenLedPin = 6;
const int blueLedPin = 9;

void setup()
{
  pinMode(redLedPin, OUTPUT);
  pinMode(greenLedPin, OUTPUT);
  pinMode(blueLedPin, OUTPUT);
  
  Serial.begin(9600);

  for (int i=0; i <= 95; i++){
      setLed(i);
      delay(50);
   } 

   delay(1000);
   
   for (int i=95; i >= 0; i--){
      setLed(i);
      delay(50);
   } 

   delay(1000);
 
  analogWrite(blueLedPin, 0);
  analogWrite(redLedPin, 0);
  analogWrite(greenLedPin, 0);
  
  delay(1000);
}


void loop()
{
  float tempInCelcius = getTempInCelcius();
  Serial.print(tempInCelcius);
  Serial.println("C");
  setLed(tempInCelcius);
  /*
  // testing
  setLed(5);
  delay(1000);
  setLed(15);
  delay(1000);
  setLed(25);
  delay(1000);
  setLed(35);
  delay(1000);
  setLed(45);
  delay(1000);
  setLed(55);
  delay(1000);
  setLed(65);
  delay(1000);
  setLed(75);
  delay(1000);
  setLed(85);
  delay(1000);
  */
  delay(1000); // repeat once per second (change as you wish!)
}

void setLed(float tempInCelcius)
{
  float redVal =  mapRed(tempInCelcius);
  float greenVal =  mapGreen(tempInCelcius);
  float blueVal =  mapBlue(tempInCelcius);
/*
  Serial.print("red: ");
  Serial.println(redVal);

  Serial.print("green: ");
  Serial.println(greenVal);
  
  Serial.print("blue: ");
  Serial.println(blueVal);
  */
  analogWrite(redLedPin, redVal);
  analogWrite(greenLedPin, greenVal);
  analogWrite(blueLedPin, blueVal);
}

float getTempInCelcius(){
  float val = analogRead(temperaturePin);
  float tempInC = val* 0.48828125;
  return tempInC;
}

float mapRed(float temp){
  float max = 90;
  float min = 18;

  if(temp < min){
    return 0;
  }

  float result = (temp / 90) * 220;

  if(result > 220){
    result = 220;
  }
  return  result;
}

float mapGreen(float temp){
  float max = 70;
  float middle = 35;
  float min = 1;

  if(temp < min){
    return 0;
  }

  if(temp > max){
    return 0;
  }

  float result = 0;
  if(temp <= middle){
    result = (temp / 35) * 220;
  } else {
    result = 220 - (temp / 70) * 220;
  }
  
  return  result;
}

float mapBlue(float temp){
  float max = 18;
  float min = 1;

  if(temp < min){
    return 220;
  }

  if(temp > max){
    return 0;
  }

  float result = 220 - ((temp / 18) * 220);

  if(result > 220){
    result = 220;
  }
  return  result;
}
