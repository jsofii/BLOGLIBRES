
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


}
