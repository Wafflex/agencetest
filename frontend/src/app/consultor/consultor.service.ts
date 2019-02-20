import { Injectable } from '@angular/core';
import { HttpClient } from  '@angular/common/http';
import { Observable } from "rxjs";

interface Consultor {
  co_usuario : string;
  no_usuario : string;
} 


@Injectable({
  providedIn: 'root'
})
export class ConsultorService {


  configUrl = 'http://localhost:8000/api';

  constructor(private http: HttpClient) { }

  consultants(): Observable<Consultor[]>{
    return this.http.get<Consultor[]>(`${this.configUrl}/consultants`);
  }

  data(users,since,until) {
    return this.http.get(`${this.configUrl}/results?users=${users}&since=${since}&until=${until}`);
    // return this.http.get(`${this.configUrl}/results?users=anapaula.chiodaro,carlos.arruda&since=01-01-2007&until=28-02-2007`);
  }
}
