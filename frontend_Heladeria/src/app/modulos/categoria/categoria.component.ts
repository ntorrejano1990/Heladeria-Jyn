import { Component } from '@angular/core';
import { CategoriaService } from 'src/app/servicios/categoria.service';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-categoria',
  templateUrl: './categoria.component.html',
  styleUrls: ['./categoria.component.scss']
})
export class CategoriaComponent {

  categoria: any;
  id_categoria: any; // variable global para que funcione el editar
  obj_categoria = {//Permite insertar a producto
    nombre: ""
  }
  validar_nombre=true;
  mform=false;
  botones_form = false;

  constructor(private scategoria:CategoriaService){}

  ngOnInit(): void{//invocar la consulta
    this.consulta();
  }

  consulta(){
    this.scategoria.consultar().subscribe((resultado:any) => {
      this.categoria = resultado;
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
    this.obj_categoria = {
      nombre: ""
    }
  }

  validar(funcion: any){ // funcion: any; para guardar el editar
    if(this.obj_categoria.nombre == ""){
      this.validar_nombre=false;
    }else{
      this.validar_nombre=true;
    }

    if(this.validar_nombre==true && funcion== 'guardar'){
      this.guardar();//funcion para guardar
    }

    if(this.validar_nombre==true && funcion== 'editar'){
      this.editar();//funcion para editar
    }
  }

  guardar(){
    this.scategoria.insertar(this.obj_categoria).subscribe((datos:any) => {
      if(datos['resultado']=='OK'){
        this.consulta();
      }
    });
    this.limpiar();
    this.mostrar_form('no ver');
    
  }
  
  eliminar(id:number){

    Swal.fire({
      title: "¿Esta seguro de eliminar la Categoría?",
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
        this.scategoria.eliminar(id).subscribe((datos:any) => {
          if(datos['resultado']=='OK'){
            this.consulta();
          }
        })
        /////////////////////////////


        Swal.fire({
          title: "¡Categoría Eliminado!",
          text: "La Categoría ha sido Eliminado.",
          icon: "success"
        });
      }
    });
  }

  cargar_datos(items: any, id: number){ //cargar datos para usar el editar

    this.obj_categoria = { 
      nombre: items.nombre
    }
    this.id_categoria = id;

    this.botones_form = true;
    this.mostrar_form('ver');
  }

  editar(){
    this.scategoria.editar(this.id_categoria, this.obj_categoria).subscribe((datos:any) => {
      if(datos['resultado']=="ok") {
        this.consulta();
        this.botones_form = true;
        this.mostrar_form('ver');
      }
    })
  }

}