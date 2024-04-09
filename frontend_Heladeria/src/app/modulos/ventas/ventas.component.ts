import { Component } from '@angular/core';
import { VentasService } from 'src/app/servicios/ventas.service';

@Component({
  selector: 'app-ventas',
  templateUrl: './ventas.component.html',
  styleUrls: ['./ventas.component.scss']
})
export class VentasComponent {
  ventas:any;

  constructor(private sventas:VentasService){}

  ngOnInit(): void{
    this.consulta();
  }

  consulta(){
    this.sventas.consultar().subscribe((resultado:any) =>{
    this.ventas=resultado;
    
    })

  }
}