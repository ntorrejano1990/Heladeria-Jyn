import {Inject, Injectable, PLATFORM_ID} from '@angular/core';
import {isPlatformBrowser} from '@angular/common';
import { Observable, throwError} from 'rxjs';
import {HttpClient, HttpHeaders} from '@angular/common/http';
import {catchError, map} from "rxjs/operators";
 
@Injectable({
  providedIn: 'root'
})
export class RecaptchaService {
  constructor(private http: HttpClient) {
  }
  url ='http://localhost/Heladeria%20JyJ/Backend/controladores/captcha.php';
  /*
  Modo de comunicación con el servidor asíncrono
  parametro token: string
  return Observable<any>
   */
  getToken(token: string){
    
      return this.http.post( `${this.url}?control=captcha`,JSON.stringify(token))
  }
}