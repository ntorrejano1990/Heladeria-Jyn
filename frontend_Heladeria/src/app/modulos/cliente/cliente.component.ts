import { Component } from '@angular/core';
import { CiudadService } from 'src/app/servicios/ciudad.service';
import { ClienteService } from 'src/app/servicios/cliente.service';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-cliente',
  templateUrl: './cliente.component.html',
  styleUrls: ['./cliente.component.scss']
})
export class ClienteComponent {
  cliente: any;
  ciudad: any;// variable global para que cargue la lista de ciudad en proveedor:profe
  id_cliente: any; // variable global para que funcione el editar
  obj_cliente = {//Permite insertar
    ident: "",
    nombre: "",
    direccion: "",
    celular: "",
    email: "",
    fo_ciudad: 0
  }
  validar_identidad=true;
  validar_nombre=true;
  validar_direccion=true;
  validar_celular=true;
  validar_email=true;
  validar_fo_ciudad=true;
  mform=false;
  botones_form = false;

  constructor(private scliente:ClienteService, private sciudad:CiudadService){}//llamar servicio ciudad

  ngOnInit(): void{//invocar la consulta
    this.consulta();
    this.con_ciudad();//invocar la consulta para lista ciudad
  }

  consulta(){
    this.scliente.consultar().subscribe((resultado:any) => {
      this.cliente = resultado;
    })
  }

  con_ciudad(){//consulta ciudad para traer lista
    this.sciudad.consultar().subscribe((resultado:any) => {
      this.ciudad = resultado;
      console.log(this.ciudad);//invocar función ciudad profe
      
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
    this.obj_cliente = {
      ident: "",
      nombre: "",
      direccion: "",
      celular: "",
      email: "",
      fo_ciudad: 0
    }
  }

  validar(funcion: any){ // funcion: any; para guardar el editar
    if(this.obj_cliente.ident == ""){
      this.validar_identidad=false;
    }else{
      this.validar_identidad=true;
    }

    if(this.obj_cliente.nombre == ""){
      this.validar_nombre=false;
    }else{
      this.validar_nombre=true;
    }

    if(this.obj_cliente.direccion == ""){
      this.validar_direccion=false;
    }else{
      this.validar_direccion=true;
    }

    if(this.obj_cliente.celular == ""){
      this.validar_celular=false;
    }else{
      this.validar_celular=true;
    }

    if(this.obj_cliente.email == ""){
      this.validar_email=false;
    }else{
      this.validar_email=true;
    }

    if(this.obj_cliente.fo_ciudad == 0){
      this.validar_fo_ciudad=false;
    }else{
      this.validar_fo_ciudad=true;
    }

    if(this.validar_identidad==true && this.validar_nombre==true && this.validar_direccion==true && this.
      validar_celular==true && this.validar_email==true && this.validar_fo_ciudad==true && funcion== 'guardar'){
      this.guardar();//funcion para guardar
    }

    if(this.validar_identidad==true && this.validar_nombre==true && this.validar_direccion==true && this.
      validar_celular==true && this.validar_email==true && this.validar_fo_ciudad==true && funcion== 'editar'){
      this.editar();//funcion para editar
    }
  }

  guardar(){
    this.scliente.insertar(this.obj_cliente).subscribe((datos:any) => {
      if(datos['resultado']=='OK'){
        this.consulta();
      }
    });
    this.limpiar();
    this.mostrar_form('no ver');
    
  }

  eliminar(id:number){

    Swal.fire({
      title: "¿Esta seguro de eliminar el Cliente?",
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
        this.scliente.eliminar(id).subscribe((datos:any) => {
          if(datos['resultado']=='OK'){
            this.consulta();
          }
        })
        /////////////////////////////


        Swal.fire({
          title: "¡Cliente Eliminado!",
          text: "El Cliente ha sido Eliminado.",
          icon: "success"
        });
      }
    });
  }
  
  cargar_datos(items: any, id: number){ //cargar datos para usar el editar

    this.obj_cliente = { 
      ident: items.ident,
      nombre: items.nombre,
      direccion: items.direccion,
      celular: items.celular,
      email: items.email,
      fo_ciudad: items.fo_ciudad 
    }
    this.id_cliente = id;

    this.botones_form = true;
    this.mostrar_form('ver');
  }

  editar(){
    this.scliente.editar(this.id_cliente, this.obj_cliente).subscribe((datos:any) => {
      if(datos['resultado']=="ok") {
        this.consulta();
        this.botones_form = true;
        this.mostrar_form('ver');
      }
    })
  }

}
