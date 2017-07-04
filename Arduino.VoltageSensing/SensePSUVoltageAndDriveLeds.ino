<<<<<<< HEAD:Arduino.VoltageSensing/sketch_jul03a/sketch_jul03a.ino
#include <EmonLib.h>


EnergyMonitor emon1;
double Irms;
double Vrms;
double Pwr;
static char vrms_char[10];
static char irms_char[10];
static char pwr_char[10];
=======

const int redLedPin = 6;
const int yellowLedPin = 9;
const int greenLedPin = 12;

// Reads power supply voltage and returns it as millivolt
long readVcc() {
  long result;
  // Read 1.1V reference against AVcc
  ADMUX = _BV(REFS0) | _BV(MUX3) | _BV(MUX2) | _BV(MUX1);
  delay(2); // Wait for Vref to settle
  ADCSRA |= _BV(ADSC); // Convert
  while (bit_is_set(ADCSRA,ADSC));
  result = ADCL;
  result |= ADCH<<8;
  result = 1126400L / result; // Back-calculate AVcc in mV
  return result;
}
>>>>>>> develop:Arduino.VoltageSensing/SensePSUVoltageAndDriveLeds.ino

void setup() 
{
  Serial.begin(9600);
<<<<<<< HEAD:Arduino.VoltageSensing/sketch_jul03a/sketch_jul03a.ino
  emon1.voltage(1.1, 370.0, 1.72);  // Voltage: input pin, calibration, phase_shift
  emon1.current(0, 10);           // Current: input pin, calibration.
}

static word calculate()
{
  emon1.calcVI(6, 1000); // Calculate all. No.of half wavelengths (crossings), time-out
  Vrms = emon1.Vrms;
  
  Serial.println(Vrms);
}

void loop()
{
  calculate();
=======

  pinMode(greenLedPin, OUTPUT);
  pinMode(yellowLedPin, OUTPUT);
  pinMode(redLedPin, OUTPUT);

  // switch on, one by one
  digitalWrite(greenLedPin, HIGH);
  delay(500);
  digitalWrite(yellowLedPin, HIGH);
  delay(500);
  digitalWrite(redLedPin, HIGH);
  delay(500);

  // turn off leds but leave on red (= power "on")
  digitalWrite(greenLedPin, LOW);
  digitalWrite(yellowLedPin, LOW);
}

void loop() {
  //Serial.println( readVcc(), DEC );
  //delay(1000);

  if(readVcc() > 7400){
    digitalWrite(greenLedPin, HIGH);
    digitalWrite(yellowLedPin, LOW);
  } else {
    digitalWrite(greenLedPin, LOW);
    digitalWrite(yellowLedPin, HIGH);
  }
>>>>>>> develop:Arduino.VoltageSensing/SensePSUVoltageAndDriveLeds.ino
}
