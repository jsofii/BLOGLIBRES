import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Params } from '@angular/router';
import { GestionService} from '../gestion-service/gestion-service.service';


@Component({
  selector: 'app-gestion-respuesta',
  templateUrl: './gestion-respuesta.component.html',
  styleUrls: ['./gestion-respuesta.component.css']
})
export class GestionRespuestaComponent implements OnInit {
  idPregunta:any;
  tieneRespuesta:any;
  contenido:string;
  titulorespuesta:string;
  imagenrespuesta:string="sinImagen";
  imagenrespuesta2:string="sinImagen";
  videorespuesta:string="sinVideo";
  addimagen:string="sinImagen";
  addvideo:string="videoSfz.mp4";
  idusuario:number=0;
  fecha:Date;
  
  constructor(private rutaActiva: ActivatedRoute, private gestionService: GestionService) { 
    this.idPregunta= this.rutaActiva.snapshot.params.idPregunta;
    this.tieneRespuesta=this.rutaActiva.snapshot.params.tieneRespuesta;
    this.idusuario=this.rutaActiva.snapshot.params.idusuario;
    this.CargarRespuestas();
    this.CargarPregunta();
  }
  elegirImagen(event){
    const file = event.target.files[0];
    this.addimagen=file.name;
    console.log(this.addimagen);
  }
  elegirVideo(event){
    const file= event.target.files[0];
    this.addvideo=file.name;

  }
  SeleccionarImagen(imagen:string){
    this.imagenrespuesta=imagen;
  }
 
  //Función que carga las Respuestas de una pregunta
  listaRespuestas:any;
  CargarRespuestas(){
    this.gestionService.CargarRespuestas(this.idPregunta).subscribe(
      data=>{
        this.listaRespuestas=data;
      }
    )
    
  }
  preguntaNombre:any;
  pregunta:any;
  CargarPregunta(){
    this.gestionService.ObtenerPregunta(this.idPregunta).subscribe(
      data=>{
        this.pregunta=data;
        this.preguntaNombre=this.pregunta.pregunta1;
      }
    )
  }
  IngresarRespuesta(){
    this.gestionService.GuardarRespuesta(this.contenido, this.idPregunta, this.titulorespuesta, this.idusuario, this.addimagen,this.addvideo).subscribe(
      data=>{
        this.CargarRespuestas();
       
        this.contenido="";
      }
      
    );
   
  }
  CambiarEstado(){
    this.gestionService.CambiarEstado(this.idPregunta).subscribe(
      data=>{

      }
    )
  }

  DeleteRespuesta(idrespuesta: number) {

    if (confirm("SE ELIMINARA?")) {


      this.gestionService.EliminarRespuesta(idrespuesta).subscribe(
        data => {

          this.CargarRespuestas();

        }
      )
    } else {

    }
  }

  ngOnInit() {
  }

}
