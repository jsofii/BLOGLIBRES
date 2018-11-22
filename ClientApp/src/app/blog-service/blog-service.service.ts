
import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

import { HttpHeaders } from '@angular/common/http';

import { Observable } from 'rxjs/Observable';



//import { models} from '../Models/usuarios';

@Injectable()
export class BlogServiceService {


  constructor(private http: HttpClient) {
  
  }

  CargarTema(){
    return this.http.get('https://localhost:5001/api/Blog/ListaTema');
  }
  GuardarPregunta(temaid:any, pregunta1:any, estado:any){
    var pregunta={
      Temaid:temaid,
      Pregunta1:pregunta1,
      Estado:estado
    }
    return this.http.post('https://localhost:5001/api/Blog/AddPregunta/', pregunta);
  }
  CargarPreguntaF(){
    return this.http.get('https://localhost:5001/api/Blog/ListaPF');
  }


}
