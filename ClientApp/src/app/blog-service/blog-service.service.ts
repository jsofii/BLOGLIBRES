
import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

import { HttpHeaders } from '@angular/common/http';

import { Observable } from 'rxjs/Observable';



//import { models} from '../Models/usuarios';

@Injectable()
export class BlogServiceService {

  
  constructor(private http: HttpClient) {
    this.host='https://localhost:5001/api';
  }
  host:any;
  
  CargarTema(){
    return this.http.get(this.host+'/Blog/ListaTema');
  }
  CargarPreguntas(){
    return this.http.get(this.host+'/Blog/TodasPreguntas');
  }
  GuardarPregunta( pregunta1:any, estado:any, usuarioid:number){
    var pregunta={
     
      Pregunta1:pregunta1,
      Estado:estado,
      usuarioid:usuarioid
    }
    return this.http.post(this.host+'/Blog/AddPregunta/', pregunta);
  }
  CerrarTema(preguntaid:number){
    var pregunta={
     
     Preguntaid:preguntaid,
    }
    return this.http.put(this.host + '/Blog/cerrarTema/',pregunta);
  }
  
  ActivarTema(preguntaid:number){
    var pregunta={
     
     Preguntaid:preguntaid,
    }
    return this.http.put(this.host + '/Blog/activarTema/',pregunta);
  }
  CargarPreguntaF(temaid:any){
    return this.http.get(this.host+'/Blog/ListaPF/'+temaid);
  }

  EliminarTema(idpregunta:number){
    return this.http.delete(this.host+'/Blog/EliminarPregunta/'+idpregunta);
  }



}
