/*
 * SendBinaryFields
 * Sends digital and analog pin values as binary data
 */

const char HEADER = 'H'; //A single character header to indicate the start of a message

void setup() {
 Serial.begin(9600);

  pinMode(22, INPUT);              //set digital pins to input (Hall switch)
  pinMode(24, INPUT);
  pinMode(26, INPUT);
  pinMode(28, INPUT);
  pinMode(30, INPUT);
  pinMode(32, INPUT); 
  pinMode(34, INPUT);
  pinMode(36, INPUT);             
  digitalWrite(22, HIGH);  //Turn on pull-ups
  digitalWrite(24, HIGH);
  digitalWrite(26, HIGH);
  digitalWrite(28, HIGH);
  digitalWrite(30, HIGH);
  digitalWrite(32, HIGH);
  digitalWrite(34, HIGH);
  digitalWrite(36, HIGH);
 
}

void loop() {
  Serial.write(HEADER);   //Send the header
  //Put the bit values of the pins into an integer
  int values = 0;
  int bit = 0;


    bitWrite(values, bit, digitalRead(22));     //Set the bit to 0 or 1 depending on value of given pin
    bit = bit + 1;                              //Increment to the next bit
    bitWrite(values, bit, digitalRead(24));    
    bit = bit + 1;   
    bitWrite(values, bit, digitalRead(26));    
    bit = bit + 1;   
    bitWrite(values, bit, digitalRead(28));    
    bit = bit + 1;   
    bitWrite(values, bit, digitalRead(30));    
    bit = bit + 1;   
    bitWrite(values, bit, digitalRead(32));    
    bit = bit + 1;   
    bitWrite(values, bit, digitalRead(34));    
    bit = bit + 1;            
    bitWrite(values, bit, digitalRead(36));    
    bit = bit + 1;   
   
  
  sendBinary(values);     //Send the integer

  for(int i=0; i<=7; i++){
    values = analogRead(i);
    sendBinary(values);  //Send the integer
  }

   for(int i=8; i<=15; i++){
    values = analogRead(i);
    sendBinary(values);  //Send the integer
  }
  delay(1000);           //Send every second
  
}

//function to send the given integer value to the serial port
void sendBinary(int value){
  //Send the two bytes that comprise an integer
  Serial.write(lowByte(value));   //Send the low byte
  Serial.write(highByte(value));  //Send the hight byte
}
