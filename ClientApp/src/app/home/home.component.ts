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
  nombre:string;
  rol:string;
  
  constructor(private rutaActiva: ActivatedRoute, private homeService: HomeService, private blogService:BlogServiceService){
    this.CargarPreguntas();
    this.idusuario=this.rutaActiva.snapshot.params.idusuario;
    this.nombre=this.rutaActiva.snapshot.params.nombre;
    this.rol=this.rutaActiva.snapshot.params.rol;
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
        this.CargarPreguntas();
      },
      error=>{
        alert("Error al guardar tema");
      }
    )
  }
  CerrarTema(temid:number){
    this.blogService.CerrarTema(temid).subscribe(
      data=>{
        this.CargarPreguntas();
      },
      error=>{
        alert("no se pudo borrar el tema seleccionado");
      }
    )
  }
  ActivarTema(temaid:number){
    this.blogService.ActivarTema(temaid).subscribe(
      data=>{
        this.CargarPreguntas();
      }
    );
  }

  EliminarTema(temaid:number){
    this.blogService.EliminarTema(temaid).subscribe(
      data=>{
        this.CargarPreguntas();
      }
    );
}
}
