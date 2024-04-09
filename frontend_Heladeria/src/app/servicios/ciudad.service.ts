import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class CiudadService {

  url = 'http://localhost/Heladeria%20JyJ/Backend/controladores/ciudad.php';//ruta del controlador

  constructor(private http:HttpClient) { }

  consultar(){
    return this.http.get(`${this.url}?control=consulta`);
  }

}
