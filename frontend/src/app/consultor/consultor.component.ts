import { Component, OnInit } from '@angular/core';
import { ConsultorService } from './consultor.service';
import { log } from 'util';

@Component({
  selector: 'app-consultor',
  templateUrl: './consultor.component.html',
  styleUrls: ['./consultor.component.scss']
})
export class ConsultorComponent implements OnInit {

  consultants:any;
  toGet:any = [];
  data:any;
  since:any = [];
  until:any = [];

  constructor(private service : ConsultorService) { }

  ngOnInit() {
    this.loadConsultants();
  }

  loadConsultants(){
    this.service.consultants().subscribe((res) => {
      this.setConsultants(res);
    });
  }

  setConsultants(response){
    this.consultants = response.data;
    console.log(this.consultants)
  }
  
  toggle(consultor){
    if (consultor.selected != true) {
      consultor.selected = true;
      this.toGet.push(consultor.co_usuario);
    } else {
      let index = this.toGet.indexOf(consultor.co_usuario);
      this.toGet.splice(index, 1);
      consultor.selected = false;
    }
  }

  setSinceUntil(option,field,parameter){
    this[option][field] = parameter;

    console.log(this[option]);
  }

  getData(){
    this.service.data(1,2,3).subscribe((res) => {
      this.setData(res);
    });
    // if (this.toGet == [] || this.since['month'] == undefined || 
    // this.since['year'] == undefined || this.until['month'] == undefined
    // || this.until['year'] == undefined){
    //   alert('Todos los campos son obligatorios');
    // }
    // let untilLastDay = this.getLastDay(this.until['year'],this.until['month']);
    
    // let since = `01-${this.since['month']}-${this.since['year']}`;
    // let until = `${untilLastDay}-${this.until['month']}-${this.until['year']}`;
  
    // this.service.data(this.toGet.join(','),since,until).subscribe((res) => {
    //   this.setData(res);
    // })
    // this.service
  }

  setData(res){
    this.data = res.data;
    console.log(this.data[0].data);
  }

  getLastDay(year,month){
    let d = new Date(year,month,0);
    let n = d.getDate();
    return n;
  }
}
