import { Component } from '@angular/core';
import { UsuarioService } from 'src/app/servicios/usuarios.service';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-usuario',
  templateUrl: './usuarios.component.html',
  styleUrls: ['./usuarios.component.scss']
})
export class UsuariosComponent {
  usuario: any;
  id_usuario: any; // variable global para que funcione el editar
  obj_usuario = {//Permite insertar a producto
    ident: "",
    nombre: "",
    direccion: "",
    celular: 0,
    email: "",
    rol: "",
    clave: ""
  }
  validar_identidad=true;
  validar_nombre=true;
  validar_direccion=true;
  validar_celular=true;
  validar_email=true;
  validar_rol=true;
  validar_clave=true;
  mform=false;
  botones_form = false;

  constructor(private susuario:UsuarioService){}

  ngOnInit(): void{//invocar la consulta
    this.consulta();
  }

  consulta(){
    this.susuario.consultar().subscribe((resultado:any) => {
      this.usuario = resultado;
    })
  }

  mostrar_form(dato: any){
    switch(dato){
      case "ver":
        this.mform = true;
      break;
      case "no ver":  
        this.mform = false;
        this.botones_form = false;
      break;
    }
  }

  limpiar(){
    this.obj_usuario = {
      ident: "",
      nombre: "",
      direccion: "",
      celular: 0,
      email: "",
      rol: "",
      clave: ""
    }
  }

  validar(funcion: any){ // funcion: any; para guardar el editar
    if(this.obj_usuario.ident == ""){
      this.validar_identidad=false;
    }else{
      this.validar_identidad=true;
    }

    if(this.obj_usuario.nombre == ""){
      this.validar_nombre=false;
    }else{
      this.validar_nombre=true;
    }

    if(this.obj_usuario.direccion == ""){
      this.validar_direccion=false;
    }else{
      this.validar_direccion=true;
    }

    if(this.obj_usuario.celular == 0){
      this.validar_celular=false;
    }else{
      this.validar_celular=true;
    }

    if(this.obj_usuario.email == ""){
      this.validar_email=false;
    }else{
      this.validar_email=true;
    }

    if(this.obj_usuario.rol == ""){
      this.validar_rol=false;
    }else{
      this.validar_rol=true;
    }

    if(this.obj_usuario.clave == ""){
      this.validar_clave=false;
    }else{
      this.validar_clave=true;
    }

    if(this.validar_identidad==true && this.validar_nombre==true && this.validar_direccion==true && this.
      validar_celular==true && this.validar_email==true && this.validar_rol==true && this.validar_clave==true
       && funcion== 'guardar'){
      this.guardar();//funcion para guardar
    }

    if(this.validar_identidad==true && this.validar_nombre==true && this.validar_direccion==true && this.
      validar_celular==true && this.validar_email==true && this.validar_rol==true && this.validar_clave==true
      && funcion== 'editar'){
      this.editar();//funcion para editar
    }
  }

  guardar(){
    this.susuario.insertar(this.obj_usuario).subscribe((datos:any) => {
      if(datos['resultado']=='OK'){
        this.consulta();
      }
    });
    this.limpiar();
    this.mostrar_form('no ver');
    
  }
  
  eliminar(id:number){

    Swal.fire({
      title: "¿Esta seguro de eliminar el Usuario?",
      text: "¡El proceso no podra ser revertido!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "¡Si, Eliminar!",
      cancelButtonText: "Cancelar"
    }).then((result) => {
      if (result.isConfirmed) {
        /////////////////////////////
        this.susuario.eliminar(id).subscribe((datos:any) => {
          if(datos['resultado']=='OK'){
            this.consulta();
          }
        })
        /////////////////////////////


        Swal.fire({
          title: "¡Usuario Eliminado!",
          text: "El Usuario ha sido Eliminado.",
          icon: "success"
        });
      }
    });
  }

  cargar_datos(items: any, id: number){ //cargar datos para usar el editar

    this.obj_usuario = { 
      ident: items.ident,
      nombre: items.nombre,
      direccion: items.direccion,
      celular: items.celular,
      email: items.email,
      rol: items.rol,
      clave: items.clave
    }
    this.id_usuario = id;

    this.botones_form = true;
    this.mostrar_form('ver');
  }

  editar(){
    this.susuario.editar(this.id_usuario, this.obj_usuario).subscribe((datos:any) => {
      if(datos['resultado']=="ok") {
        this.consulta();
        this.botones_form = true;
        this.mostrar_form('ver');
      }
    })
  }

}