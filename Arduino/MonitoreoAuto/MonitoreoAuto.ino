#include <WiFi.h>
#include <TinyGPSPlus.h>
#include <HTTPClient.h>


const char* ssid     = "PuntoAcces";      // SSID
const char* password = "123456789";      // Password
const char* host = "https://invernaderom.000webhostapp.com/";  // Dirección IP local o remota, del Servidor Web
const int   port = 80;            // Puerto, HTTP es 80 por defecto, cambiar si es necesario.
const int   watchdog = 2000;        // Frecuencia del Watchdog

//Variables used in the code
String LED_id = "1";                  //Just in case you control more than 1 LED
bool toggle_pressed = false;          //Each time we press the push button    
String data_to_send = "";             //Text data to send to the server
unsigned int Actual_Millis, Previous_Millis;
int refresh_time = 200;               //Refresh rate of connection to website (recommended more than 1s)


//Inputs/outputs
int button1 = 13;                     //Connect push button on this pin
int LED = 2;                          //Connect LED on this pin (add 150ohm resistor)


//Button press interruption
void IRAM_ATTR isr() {
  toggle_pressed = true; 
}

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
int idDis=2;

// The TinyGPSPlus object
TinyGPSPlus gps;
 
void setup() {
  
  delay(10);                  //Start monitor
  pinMode(LED, OUTPUT);                   //Set pin 2 as OUTPUT
  pinMode(button1, INPUT_PULLDOWN);       //Set pin 13 as INPUT with pulldown
  attachInterrupt(button1, isr, RISING);  //Create interruption on pin 13
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
//===============================================================================

  Actual_Millis = millis();               //Save time for refresh loop
  Previous_Millis = Actual_Millis; 
}

void loop() {
  //We make the refresh loop using millis() so we don't have to sue delay();
  Actual_Millis = millis();
  unsigned long currentMillis = millis();
  
   if(Actual_Millis - Previous_Millis > refresh_time){
    Previous_Millis = Actual_Millis;  
    if(WiFi.status()== WL_CONNECTED){                   //Check WiFi connection status  
      HTTPClient http;                                  //Create new client
      if(toggle_pressed){                               //If button was pressed we send text: "toggle_LED"
        data_to_send = "toggle_LED=" + LED_id;  
        toggle_pressed = false;                         //Also equal this variable back to false 
      }
      else{
        data_to_send = "check_LED_status=" + LED_id;    //If button wasn't pressed we send text: "check_LED_status"
      }
      
      //Begin new connection to website       
      http.begin("https://invernaderom.000webhostapp.com/programasSERVIDOR_php/interfaces/esp32_update.php");   //Indicate the destination webpage 
      http.addHeader("Content-Type", "application/x-www-form-urlencoded");         //Prepare the header
      
      int response_code = http.POST(data_to_send);                                //Send the POST. This will giveg us a response code
      
      //If the code is higher than 0, it means we received a response
      if(response_code > 0){
        Serial.println("HTTP code " + String(response_code));                     //Print return code
  
        if(response_code == 200){                                                 //If code is 200, we received a good response and we can read the echo data
          String response_body = http.getString();                                //Save the data comming from the website
          Serial.print("Server reply: ");                                         //Print data to the monitor for debug
          Serial.println(response_body);

          //If the received data is LED_is_off, we set LOW the LED pin
          if(response_body == "LED_is_off"){
            digitalWrite(LED, HIGH);
          }
          //If the received data is LED_is_on, we set HIGH the LED pin
          else if(response_body == "LED_is_on"){
            digitalWrite(LED, HIGH);
            delay(500);
            digitalWrite(LED, LOW);
          }  
        }//End of response_code = 200
      }//END of response_code > 0
      
      else{
       Serial.print("Error sending POST, code: ");
       Serial.println(response_code);
      }
      http.end();                                                                 //End the connection
    }//END of WIFI connected
    else{
      Serial.println("WIFI connection error");
    }
  }

  //CONSULTA DE ESTADO DE DISPOSITIVO 
  String url = "/programasSERVIDOR_php/proceso_eventos/estadoDis.php?idDis=";
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
    
    String url = "/programasSERVIDOR_php/proceso_eventos/programa1.php?estado_vehiculo=";
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