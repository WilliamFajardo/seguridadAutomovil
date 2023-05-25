#include <WiFi.h>
#include <TinyGPSPlus.h>
#include <HTTPClient.h>
//===============================================================================================
const char* ssid     = "FAMILIA FAJARDO";      // SSID
const char* password = "3105192099";      // Password
const char* host = "invernaderom.000webhostapp.com";  // Dirección IP local o remota, del Servidor Web
const int   port = 80;            // Puerto, HTTP es 80 por defecto, cambiar si es necesario.
const int   watchdog = 2000;        // Frecuencia del Watchdog

//Variables used in the code
                 //Just in case you control more than 1 LED
bool toggle_pressed = false;          //Each time we press the push button    
String data_to_send = "";             //Text data to send to the server
unsigned int Actual_Millis, Previous_Millis;
int refresh_time = 200;               //Refresh rate of connection to website (recommended more than 1s)
char* h;
int t;

//Inputs/outputs
int LED = 2;                          //Este pin corresponde al led integrado en la ESP32

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
float latitudTemp = 0; 
float longitudTemp = 0;
float latitud = 0;
float longitud = 0;
const float Vcc = 3.3;
bool gpsDataRead = false;

String dato;
String cade;
String line;

const int analogInPin = 36; // Puerto Vp analógico del ESP32
int gpio18_pin = 18; // El GPIO5 de la tarjeta ESP32, corresponde al pin D5 identificado físicamente en la tarjeta. Este pin será utilizado para una salida de un LED.
int idVeh=2;
int idDis=1;
String LED_id = "1"; 

// The TinyGPSPlus object
TinyGPSPlus gps;
 
void setup() {
  delay(10);                  //Start monitor
  pinMode(LED, OUTPUT);                   //Set pin 2 as OUTPUT
  pinMode(gpio18_pin, OUTPUT);
  pinMode(analogInPin, INPUT);
  Serial.begin(9600);
  Serial2.begin(9600);
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
      http.begin("https://invernaderom.000webhostapp.com/programasSERVIDOR_php/proceso_eventos/esp32_update.php");   //Indicate the destination webpage 
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
            t = 0;
            digitalWrite(LED, HIGH);
            Serial.println("NO SE ENVIAN DATOS DISPOSITIVO INACTIVO"); 
          }
          //If the received data is LED_is_on, we set HIGH the LED pin
          else if(response_body == "LED_is_on"){
            t= 1;
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
  
  //====================================================================================
  if(t == 1) {
   gpsDataRead = false;
    while (Serial2.available() > 0 && !gpsDataRead) {
      if (gps.encode(Serial2.read())) {
        latitud = gps.location.lat();
        longitud = gps.location.lng();
        displayInfo();
        gpsDataRead = true;
      }
    }
    
    latitudTemp = latitud;
    longitudTemp = longitud;

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

  

   //DETERMINAR EL ESTADO DEL VEHICULO (ENCENDIDO O APAGADO)
   if(voltaje<1.53){
     h = "Apagado";
     Serial.println("Vehiculo apagado");
    }else{
      if ((latitudTemp != latitud) && (longitudTemp != longitud)){
        h = "Encendido_en_movimiento";
      }else{
       h = "Encendido_detenido";
      }
     
     Serial.println("Vehiculo encendido");
    }
  
  
   if ( currentMillis - previousMillis > watchdog ) {
     previousMillis = currentMillis;
     WiFiClient client;
  
     if (!client.connect(host, port)) {
       Serial.println("Conexión falló...");
       digitalWrite(gpio18_pin, HIGH);
       return;
      }
     digitalWrite(gpio18_pin, LOW);
    
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
      Serial.println("Dato ENVIADO");
      delay(4000);

    }
  }else{
    Serial.println("DISPOSITIVO INACTIVO: NO SE ENVIAN DATOS...");
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