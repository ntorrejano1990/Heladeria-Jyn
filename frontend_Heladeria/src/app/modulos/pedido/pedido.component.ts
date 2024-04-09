import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { PedidoService } from 'src/app/servicios/pedido.service';

@Component({
  selector: 'app-pedido',
  templateUrl: './pedido.component.html',
  styleUrls: ['./pedido.component.scss']
})
export class PedidoComponent {
  ventas: any;
  modal = false;

  constructor(private router: Router, private spedido: PedidoService){}

  ngOnInit(): void{
    this.consulta();
  }

  consulta(){
    this.spedido.consultar().subscribe((resultado:any) => {
      this.ventas = resultado;
    })
  }

  insertar(){
    this.router.navigate(['pedidoins']);
  }
    mostrar_modal(dato:any){
      switch(dato){
        case 0:
        this.modal = false;
          break;
          case 1:
            this.modal = true;
            break;
      }
      }
}
