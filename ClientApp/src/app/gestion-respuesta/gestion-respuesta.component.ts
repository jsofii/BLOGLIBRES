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
  constructor(private rutaActiva: ActivatedRoute, private gestionService: GestionService) { 
    this.idPregunta= this.rutaActiva.snapshot.params.idPregunta;
    this.tieneRespuesta=this.rutaActiva.snapshot.params.tieneRespuesta;
    this.CargarRespuestas();
    this.CargarPregunta();
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
    this.gestionService.GuardarRespuesta(this.contenido, this.idPregunta).subscribe(
      data=>{
        this.CargarRespuestas();
        this.CambiarEstado();
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
