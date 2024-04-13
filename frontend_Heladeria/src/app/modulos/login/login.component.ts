import { Component } from '@angular/core';
import { Route, Router } from '@angular/router';
import { ReCaptchaV3Service } from 'ng-recaptcha';
import { LoginService } from 'src/app/servicios/login.service';
import { RecaptchaService } from 'src/app/servicios/recaptcha.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent {

  email: any;
  clave: any;
  error = false;

  captcha: any;

  isRobot = false;

  usuario: any;
  user = {
    ident: "",
    nombre: "",
    direccion: "",
    celular: "",
    email: "",
    rol: "",
    clave: ""
  }

  constructor(private slogin: LoginService, private router: Router, private captchaService: RecaptchaService,  private recaptchaV3Service: ReCaptchaV3Service){

  }

  ngOnInit(): void {
    sessionStorage.setItem("id", "");
    sessionStorage.setItem("email", "");
    sessionStorage.setItem("nombre", "");
    sessionStorage.setItem("rol", "");
  }

  verificarCaptcha(){
    this.recaptchaV3Service.execute('') //solicitud de token a servicios de google
        .subscribe((token) => {
        this.captchaService.getToken(token) // enviar token a la API
            .subscribe((res:any)=>{
              this.captcha = res; 
              console.log("TIEMPO 1");
              if(this.captcha['respuesta'] != 'OK'){
                  this.isRobot = true 
                }else{
                  this.isRobot = false 
              };
              console.log(this.isRobot);
        })
      });
  }

  consulta(tecla: any){
    if(tecla == 13 || tecla == ""){
      
      this.slogin.consultar(this.email,this.clave).subscribe((resultado:any)=>{
        this.usuario = resultado;
        if(this.usuario[0].validar=="valida" ){
          this.error = false; 
        }else{
          this.error = true;  
      };

        this.recaptchaV3Service.execute('').subscribe((token) => { //solicitud de token a servicios de google
            this.captchaService.getToken(token).subscribe((res:any)=>{ // enviar token a la API
              this.captcha = res; 
              console.log("TIEMPO 1");
              if(this.captcha['respuesta'] != 'OK'){
                  this.isRobot = true 
                }else{
                  this.isRobot = false 
              };
              console.log("TIEMPO 2");
              if(!this.error && !this.isRobot){

                sessionStorage.setItem("id", this.usuario[0]['id_usuario']);
                sessionStorage.setItem("email", this.usuario[0]['email']);
                sessionStorage.setItem("nombre", this.usuario[0]['nombre']);
                sessionStorage.setItem("rol", this.usuario[0]['rol']);
                this.router.navigate(['dashboard']);
              }
              console.log(this.isRobot);
          })
        })
      })
    }
  }
}
