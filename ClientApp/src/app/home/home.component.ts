import { Component } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import{HomeService} from '../home-service/home-service.service';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls:['./home.component.css'],
})
export class HomeComponent {
  listaTemas:any;
  constructor(private rutaActiva: ActivatedRoute, private homeService: HomeService){
    this.cargarTemas();
  }
  cargarTemas(){
    this.homeService.CargarTema().subscribe(
      data=>{
        
        this.listaTemas=data;
      }
    )
  }
}
