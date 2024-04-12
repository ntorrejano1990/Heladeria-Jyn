import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class LoginService {

  url = 'http://localhost/Heladeria%20JyJ/Backend/controladores/login.php';//ruta del controlador

  constructor(private http: HttpClient) { }

  consultar(email: any, clave: any){
    return this.http.get(`${this.url}?email=${email}&clave=${clave}`);
  }

  enviarToken(token: string) {
    return this.http.post(`${this.url}?control=token`, { token });
  }
}
