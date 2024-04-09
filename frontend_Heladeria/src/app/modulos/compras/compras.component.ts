import { Component } from '@angular/core';
import { ComprasService } from 'src/app/servicios/compras.service';

@Component({
  selector: 'app-compras',
  templateUrl: './compras.component.html',
  styleUrls: ['./compras.component.scss']
})
export class ComprasComponent {
  compras: any;

  constructor(private scompras:ComprasService){}

  ngOnInit(): void{
    this.consulta();
  }

  consulta(){
    this.scompras.consultar().subscribe((resultado:any) => {
      this.compras = resultado;
    })
  }

}
