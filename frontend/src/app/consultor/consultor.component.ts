import { Component, OnInit } from '@angular/core';
import { ConsultorService } from './consultor.service';
import { log } from 'util';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
// import { routerTransition } from '../../router.animations';

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
  type:any = undefined;

  public barChartOptions: any = {
    scaleShowVerticalLines: false,
    responsive: true
  };

  public barChartLabels: string[];

  public barChartType: string = 'bar';
  public barChartLegend: boolean;

  public barChartData: any;

  public pieChartLabels: string[];

  public pieChartData: number[];

  public pieChartType: string = 'pie';

  constructor(private service : ConsultorService, private modalService: NgbModal) { }

  openModal(modal){
    this.modalService.open(modal);
  }
  
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
  }

  getData(type){
    if (this.toGet == [] || this.since['month'] == undefined || 
    this.since['year'] == undefined || this.until['month'] == undefined
    || this.until['year'] == undefined){
      alert('Todos los campos son obligatorios');
    }
    let untilLastDay = this.getLastDay(this.until['year'],this.until['month']);
    
    let since = `01-${this.since['month']}-${this.since['year']}`;
    let until = `${untilLastDay}-${this.until['month']}-${this.until['year']}`;
  
    this.service.data(this.toGet.join(','),since,until).subscribe((res) => {
      this.setData(res,type);
    })
    this.service
  }

  setData(res,type){
    this.data = res.data;

    if (type == 0){
      this.setBarData();
    }else if (type == 2){
      this.setPieData();
    }

    this.type = type;
  }

  setBarData(){

    var salarioPromedio = 0;
    var temp = [];

    this.data.forEach((element,index) =>{
      element.resume.monthly.forEach((element,index) => {
        salarioPromedio += element.salario;
      })
      
      temp.push({
        data : [element.resume.totals.totalNeto],
        label : element.no_usuario
      })
    });

    temp.unshift({
      data : [salarioPromedio], label : 'Average salaries'
    });

    console.log(temp);

    this.barChartData = temp;

    console.log(this.barChartData);
  }

  setPieData(){

    var labels = [];
    var data = [];

    this.data.forEach((element,index) =>{
      labels.push(element.no_usuario);
      data.push(element.resume.totals.totalNeto);
    });

    
    this.pieChartLabels = labels;
    this.pieChartData = data;
  }

  getLastDay(year,month){
    let d = new Date(year,month,0);
    let n = d.getDate();
    return n;
  }
}
