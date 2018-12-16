
import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

import { HttpHeaders } from '@angular/common/http';

import { Observable } from 'rxjs/Observable';



//import { models} from '../Models/usuarios';

@Injectable()
export class GestionService {


  constructor(private http: HttpClient) {
    this.host='https://localhost:5001/api';
  }
  host:any;
  CargarRespuestas(preguntaid:number){
      return this.http.get(this.host+'/Respuesta/ListaRespuestas/'+preguntaid);
  }
  ObtenerPregunta(preguntaid:number){
    return this.http.get(this.host+'/Respuesta/Pregunta/'+preguntaid)
  }
  GuardarRespuesta(contenido:any, preguntaid:any){
    var respuesta={
      Contenido:contenido,
      Preguntaid:preguntaid
    }
    return this.http.post(this.host +'/Respuesta/IngresarRespuesta', respuesta);
  }
  CambiarEstado(preguntaid:any){
    var x={
      Preguntaid:preguntaid
    }
    return this.http.post(this.host+'/Respuesta/CambiarEstado', x);
  }

}
