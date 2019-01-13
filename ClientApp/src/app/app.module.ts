import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';
import { RouterModule } from '@angular/router';

import { AppComponent } from './app.component';
import { NavMenuComponent } from './nav-menu/nav-menu.component';
import { HomeComponent } from './home/home.component';
import { CounterComponent } from './counter/counter.component';
import { FetchDataComponent } from './fetch-data/fetch-data.component';
import { BlogComponent } from './blog/blog.component';
import { BlogServiceService } from './blog-service/blog-service.service';
import { GestionRespuestaComponent } from './gestion-respuesta/gestion-respuesta.component';
import { GestionService} from './gestion-service/gestion-service.service';
import{HomeService} from './home-service/home-service.service';

//import { servicioPreguntasService } from './servicioPreguntas/servicioPreguntas.service';

@NgModule({
  declarations: [
    AppComponent,
    NavMenuComponent,
    HomeComponent,
    CounterComponent,
    FetchDataComponent,
    BlogComponent,
    GestionRespuestaComponent
  ],
  imports: [
    BrowserModule.withServerTransition({ appId: 'ng-cli-universal' }),
    HttpClientModule,
    FormsModule,
    RouterModule.forRoot([
      {path: 'home/:idusuario/:nombre/:rol', component:HomeComponent},
      { path: 'counter', component: CounterComponent },
      { path: 'fetch-data', component: FetchDataComponent },
      { path: 'home', component: HomeComponent },
      { path: 'blog/:id', component: BlogComponent },
      { path: 'gestion-respuesta/:idPregunta/:idusuario/:nombre/:rol/:estado', component: GestionRespuestaComponent}
    ])
  ],
  providers: [BlogServiceService, GestionService, HomeService],
  bootstrap: [AppComponent]
})
export class AppModule { }
