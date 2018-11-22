import { Component, OnInit } from '@angular/core';
import { BlogServiceService } from '../blog-service/blog-service.service';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-blog',
  templateUrl: './blog.component.html',
  styleUrls: ['./blog.component.css']
})
export class BlogComponent implements OnInit {
  idtema:any;
  constructor(private blogservice:BlogServiceService,private rutaActiva: ActivatedRoute) {
    this.idtema=this.rutaActiva.snapshot.params.usuario;
   }

  ngOnInit() {
    this.CargarListaTema();
    this.CargarPreguntaF();
  }
  ListaTemas:any;
  
  CargarListaTema(){
    this.blogservice.CargarTema().subscribe(
      data=>{
        this.ListaTemas=data;
        this.ListaTemas;
      }
    )

  }
  siRespuesta:boolean=false;
  noRespuesta:boolean=false;
  SiRespuesta(){
    this.siRespuesta=true;
    this.noRespuesta=false
  }
  NoRespuesta(){
    this.noRespuesta=true;
    this.siRespuesta=false;
  }
  selectTemaid:any;
  selectNombre:any;
  CargarTema(temid:any, nombre:any){
    this.selectTemaid=temid;
    this.selectNombre=nombre;
  }
  inputPregunta:any;
  GuardarPregunta(){
    this.blogservice.GuardarPregunta(this.selectTemaid, this.inputPregunta, this.siRespuesta).subscribe(
      data=>{
        this.CargarPreguntaF();
      }
    )
  }
  listaPreguntaF:any;
  CargarPreguntaF(){
    this.blogservice.CargarPreguntaF().subscribe(
      data=>{
        this.listaPreguntaF=data;
      }
    )
  }

}
