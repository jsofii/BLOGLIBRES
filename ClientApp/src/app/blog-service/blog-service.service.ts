
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
  GuardarPregunta(temaid:any, pregunta1:any, estado:any){
    var pregunta={
      Temaid:temaid,
      Pregunta1:pregunta1,
      Estado:estado
    }
    return this.http.post(this.host+'/Blog/AddPregunta/', pregunta);
  }
  
  CargarPreguntaF(temaid:any){
    return this.http.get(this.host+'/Blog/ListaPF/'+temaid);
  }
  CargarPreguntaT(temaid:any){
    return this.http.get(this.host+'/Blog/ListaPT/'+temaid);
  }
 


}
