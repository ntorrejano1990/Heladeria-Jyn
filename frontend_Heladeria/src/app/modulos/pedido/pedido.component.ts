import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { PedidoService } from 'src/app/servicios/pedido.service';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-pedido',
  templateUrl: './pedido.component.html',
  styleUrls: ['./pedido.component.scss']
})
export class PedidoComponent {
  ventas: any;
  modal = false;
  productos: any;
  total=0;

  constructor(private router: Router, private spedido: PedidoService){}

  ngOnInit(): void{
    this.consulta();
  }

  consulta(){
    this.spedido.consultar().subscribe((resultado:any) => {
      this.ventas = resultado;
    })
  }

  consultap(id:number){
    this.spedido.consultarp(id).subscribe((resultado:any) => {
      this.total = resultado["total"];
      this.productos = resultado["productos"];
      
    })
  }

  insertar(){
    this.router.navigate(['pedidoins']);
  }
    mostrar_modal(dato:any, id:number){
      switch(dato){
        case 0:
        this.modal = false;
          break;
        case 1:
          this.modal = true;
          this.consultap(id);
          break;
      }
      }


    eliminar(id:number){

        Swal.fire({
          title: "¿Esta seguro de eliminar este pedido?",
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
            this.spedido.eliminar(id).subscribe((datos:any) => {
              if(datos['resultado']=='OK'){
                Swal.fire({
                  title: "¡Producto Eliminado!",
                  text: "El producto ha sido Eliminado.",
                  icon: "success"
                });
                this.consulta();
              }
            })
            /////////////////////////////
            
          }
        });
      }
    }