#include <WiFi.h>
#include <TinyGPSPlus.h>


const char* ssid     = "PuntoAcces";      // SSID
const char* password = "123456789";      // Password
const char* host = "192.168.94.32";  // Dirección IP local o remota, del Servidor Web
const int   port = 80;            // Puerto, HTTP es 80 por defecto, cambiar si es necesario.
const int   watchdog = 2000;        // Frecuencia del Watchdog

//Variables sensor
float mVperAmp = 0.100; // Sensibilidad del sensor ACS712 de 20A
float ACSoffset = 1.65; // Offset del sensor ACS712 (valor en  a corriente 0)
float voltaje = 0; // Valor de voltaje leído en el puerto Vp
unsigned long previousMillis = millis(); 
float Amps = 0; // Valor de corriente calculado en amperios
float latitud = 0;
float longitud = 0;
const float Vcc = 3.3;
bool gpsDataRead = false;

String dato;
String cade;
String line;

const int analogInPin = 36; // Puerto Vp analógico del ESP32
int gpio5_pin = 5; // El GPIO5 de la tarjeta ESP32, corresponde al pin D5 identificado físicamente en la tarjeta. Este pin será utilizado para una salida de un LED.
int gpio18_pin = 18; // El GPIO5 de la tarjeta ESP32, corresponde al pin D5 identificado físicamente en la tarjeta. Este pin será utilizado para una salida de un LED.
int idVeh=1;
int idDis=1;

// The TinyGPSPlus object
TinyGPSPlus gps;
 
void setup() {

  pinMode(gpio5_pin, OUTPUT);
  pinMode(gpio18_pin, OUTPUT);
  pinMode(analogInPin, INPUT);
  Serial.begin(9600);
  Serial2.begin(9600);
  //delay(3000);
  Serial.print("Conectando a...");
  Serial.println(ssid);
  
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

 
  Serial.println("");
  Serial.println("WiFi conectado");  
  Serial.println("Dirección IP: ");
  Serial.println(WiFi.localIP());
}

void loop() {
 
  unsigned long currentMillis = millis();

  //CONSULTA DE ESTADO DE DISPOSITIVO 
  String url = "/programas_php/proceso_eventos/estadoDis.php?idDis=";
  url += idDis;


  gpsDataRead = false;
  while (Serial2.available() > 0 && !gpsDataRead) {
    if (gps.encode(Serial2.read())) {
        latitud = gps.location.lat();
        longitud = gps.location.lng();
        displayInfo();
        gpsDataRead = true;
    }
  }
  
  if (millis() > 5000 && gps.charsProcessed() < 10) {
    Serial.println(F("No GPS detected: check wiring."));
    while (true);
  }

  //Obtenemos las corriente promedio de 500 muestras
  
  float lectura = analogRead(analogInPin);
  float voltaje = (lectura * Vcc) / 4095.0; // Convertir la lectura del ADC a voltios
  Serial.print("Voltaje: ");
  Serial.print(voltaje,3);
  Serial.println(" V");
  //delay(500); // Esperar 0.5 segundoS antes de volver a leer el sensor

  char* h;
  int t;

  //DETERMINAR EL ESTADO DEL VEHICULO (ENCENDIDO O APAGADO)
  if(voltaje<1.51){
    h = "Apagado";
    Serial.println("Vehiculo apagado");
  }else{
    h = "Encendido";
    Serial.println("Vehiculo encendido");
  }


  digitalWrite(gpio5_pin, LOW);
  
  
  if ( currentMillis - previousMillis > watchdog ) {
    previousMillis = currentMillis;
    WiFiClient client;
  
    if (!client.connect(host, port)) {
      Serial.println("Conexión falló...");
      digitalWrite(gpio18_pin, HIGH);
      //digitalWrite(gpio5_pin, HIGH);
      //t = 0;
      //Serial.print("Dispositivo inactivo = ");
      return;
    }
    digitalWrite(gpio18_pin, LOW);
    //digitalWrite(gpio5_pin, LOW);
    //t = 1;
    //Serial.print("Dispositivo activo = ");
    
    String url = "/programas_php/proceso_eventos/programa1.php?estado_vehiculo=";
    url += h;
    url += "&estado_dispositivo=";
    url += t;
    url += "&idVeh=";
    url += idVeh;
    url += "&latitud=";
    url += latitud;
    url += "&longitud=";
    url += longitud;
    url += "&idDis=";
    url += idDis;
    
    // Envío de la solicitud al Servidor
    client.print(String("POST ") + url + " HTTP/1.1\r\n" +
               "Host: " + host + "\r\n" + 
               "Connection: close\r\n\r\n");
    unsigned long timeout = millis();
    while (client.available() == 0) {
      if (millis() - timeout > 5000) {
        Serial.println(">>> Superado tiempo de espera!");
        client.stop();
        return;
      }
    }
  
    // Lee respuesta del servidor
    while(client.available()){
      line = client.readStringUntil('\r');
      Serial.print(line);
    }
     digitalWrite(gpio5_pin, HIGH);
     Serial.println("Dato ENVIADO");
     delay(4000);

  }
}

void displayInfo() {
  Serial.print(F("Location: "));
  if (gps.location.isValid()) {
    Serial.print("Latitud: ");
    Serial.print(latitud, 6);
    Serial.print(F(","));
    Serial.print("Longitud: ");
    Serial.print(longitud, 6);
    Serial.println();
    delay(2000);
  }
  else {
    Serial.println(F("INVALID"));
  }
}

void updateSerial() {
  delay(500);
  
  while (Serial.available()) {
    Serial2.write(Serial.read()); // Forward what Serial received to Software Serial Port
  }
  
  while (Serial2.available()) {
    Serial.write(Serial2.read()); // Forward what Software Serial received to Serial Port
  }
}