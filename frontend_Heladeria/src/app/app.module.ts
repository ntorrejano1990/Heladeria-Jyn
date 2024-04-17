import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { AppRoutingModule } from './app-routing.module';
import { FormsModule } from '@angular/forms';
import { HttpClientModule} from '@angular/common/http';

import {RECAPTCHA_V3_SITE_KEY, RecaptchaV3Module} from 'ng-recaptcha';

import { AppComponent } from './app.component';
import { NavComponent } from './estructura/nav/nav.component';
import { AsideComponent } from './estructura/aside/aside.component';
import { ContentComponent } from './estructura/content/content.component';
import { FooterComponent } from './estructura/footer/footer.component';
import { PrincipalComponent } from './estructura/principal.component';
import { DashboardComponent } from './modulos/dashboard/dashboard.component';
import { CategoriaComponent } from './modulos/categoria/categoria.component';
import { ProductoComponent } from './modulos/producto/producto.component';
import { ClienteComponent } from './modulos/cliente/cliente.component';
import { PedidoComponent } from './modulos/pedido/pedido.component';
import { UsuariosComponent } from './modulos/usuarios/usuarios.component';
import { ComprasComponent } from './modulos/compras/compras.component';
import { ProveedorComponent } from './modulos/proveedor/proveedor.component';
import { LoginComponent } from './modulos/login/login.component';
import { NoEncontroComponent } from './modulos/no-encontro/no-encontro.component';
import { PedidoinsertarComponent } from './modulos/pedidoinsertar/pedidoinsertar.component';


@NgModule({
  declarations: [
    AppComponent,
    NavComponent,
    AsideComponent,
    ContentComponent,
    FooterComponent,
    PrincipalComponent,
    DashboardComponent,
    CategoriaComponent,
    ProductoComponent,
    ClienteComponent,
    PedidoComponent,
    UsuariosComponent,
    ComprasComponent,
    ProveedorComponent,
    LoginComponent,
    NoEncontroComponent,
    PedidoinsertarComponent
  ],
  imports: [
    RecaptchaV3Module,
    BrowserModule,
    AppRoutingModule,
    FormsModule,
    HttpClientModule
  ],
  providers: [{
    provide: RECAPTCHA_V3_SITE_KEY,
    useValue: '6LcXlL0pAAAAAFUH6d20-Tl1dJYc6POMYqJSN_gI',
  }],
  bootstrap: [AppComponent]
})
export class AppModule { }
