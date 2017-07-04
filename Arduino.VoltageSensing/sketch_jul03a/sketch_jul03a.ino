#include <EmonLib.h>


EnergyMonitor emon1;
double Irms;
double Vrms;
double Pwr;
static char vrms_char[10];
static char irms_char[10];
static char pwr_char[10];

void setup() 
{
  Serial.begin(9600);
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
}
