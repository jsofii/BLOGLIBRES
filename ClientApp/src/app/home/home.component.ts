import { Component } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import{HomeService} from '../home-service/home-service.service';
import{BlogServiceService} from '../blog-service/blog-service.service';
import { error } from 'util';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls:['./home.component.css'],
})
export class HomeComponent {
  listaTemas:any;
  idusuario:number;
  contenidoPregunta:any;
  constructor(private rutaActiva: ActivatedRoute, private homeService: HomeService, private blogService:BlogServiceService){
    this.CargarPreguntas();
    this.idusuario=this.rutaActiva.snapshot.params.idusuario;
  }
  
  CargarPreguntas(){
    this.blogService.CargarPreguntas().subscribe(
      data=>{
        this.listaTemas=data;
      }
    )
  }
  GuardarTema(){
    this.blogService.GuardarPregunta(this.contenidoPregunta,true, this.idusuario).subscribe(
      data=>{
        
      },
      error=>{
        alert("Error al guardar tema");
      }
    )
  }
}
