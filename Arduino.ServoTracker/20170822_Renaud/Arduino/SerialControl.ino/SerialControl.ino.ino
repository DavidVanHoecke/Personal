word midPos = 3000;
word pos = midPos;
byte dataLow = lowByte(pos);
byte dataHigh = highByte(pos);

byte writeHead = 150;
byte returnHead = 105;
byte ID = 0;
byte regPosNew = 30;
byte regPos = 12;
byte len = 2;
byte checksum = 0;

byte dataLowRead = 0;
byte dataHighRead = 0;
word posRead = word(dataHighRead, dataLowRead);

void setup() {
  Serial.begin(9600);
  Serial1.begin(200);  
}

void loop() {
  // Move to position
  Serial.println("Servo position ? (in degrees)");
  while (Serial.available() == 0) {
    pos = Serial.parseInt();
    dataLow = lowByte(pos);
    dataHigh = highByte(pos);
    Serial1.write(writeHead);
    ID = 0;
    Serial1.write(ID);
    Serial1.write(regPosNew);
    len = 2;
    Serial1.write(len);
    Serial1.write(dataLow);
    Serial1.write(dataHigh);
    checksum = (writeHead + ID + regPosNew + len + dataLow + dataHigh) % 256;
    Serial1.write(checksum);
  }
  pos = Serial.parseInt();
  dataLow = lowByte(pos);
  dataHigh = highByte(pos);
  Serial1.write(writeHead);
  ID = 0;
  Serial1.write(ID);
  Serial1.write(regPosNew);
  len = 2;
  Serial1.write(len);
  Serial1.write(dataLow);
  Serial1.write(dataHigh);
  checksum = (writeHead + ID + regPosNew + len + dataLow + dataHigh) % 256;
  Serial1.write(checksum);


  // Read current position
  Serial1.write(writeHead);
  ID = 0;
  Serial1.write(ID);
  Serial1.write(regPos);
  len = 0;
  Serial1.write(len);
  checksum = (writeHead + ID + regPos + len) % 256;
  Serial1.write(checksum);
  //disable TXD (digital switch ?)
  Serial1.read(); Serial1.read(); Serial1.read(); Serial1.read();
  dataLowRead = Serial1.read();
  dataHighRead = Serial1.read();
  Serial1.read();
  posRead = word(dataHighRead, dataLowRead);
  Serial.println(posRead, DEC);
}
