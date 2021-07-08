import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';

import { environment } from '../../../environments/environment';
@Injectable({
  providedIn: 'root',
})
export class TerrainService {
  private apiBasepath = environment.baseApiPath;
  constructor(private http: HttpClient) {}

  // exemple
  fetchPayement(): Observable<any> {
    return this.http.get<any>(`${environment.baseApiPath}/api/payements`);
  }
  getRegions(): Observable<any> {
    return this.http.get<any>(`${environment.baseApiPath}/api/regions`);
  }
  getTerrains(): Observable<any[]> {
    return this.http.get<any>(`${environment.baseApiPath}/api/terrains`);
  }
  getCompetitions(): Observable<any[]> {
    return this.http.get<any>(`${environment.baseApiPath}/api/competitions`);
  }
}
