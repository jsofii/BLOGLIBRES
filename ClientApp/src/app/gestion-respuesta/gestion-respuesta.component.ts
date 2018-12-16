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
  constructor(private rutaActiva: ActivatedRoute, private gestionService: GestionService) { 
    this.idPregunta= this.rutaActiva.snapshot.params.idPregunta;

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

  ngOnInit() {
  }

}
