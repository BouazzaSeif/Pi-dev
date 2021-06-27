import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { environment } from '../../../environments/environment';

@Injectable({
  providedIn: 'root',
})
export class EntrepriseService {
  private basePath = environment.baseApiPath;

  constructor(private http: HttpClient) {}

  getOffreList(): Observable<any> {
    return this.http.get<any>(this.basePath + '/offres/');
  }
  createOffre(value: any): Observable<any> {
    return this.http.post<any>(this.basePath + '/offres/', value);
  }
  modifierOffre(value: any): Observable<any> {
    return this.http.put<any>(this.basePath + `/offres/${value.id}/`, value);
  }

  deleteOffre(id: any): Observable<any> {
    return this.http.delete<any>(this.basePath + `/offres/${id}/`);
  }

  changeEtat(value: any) {
    return this.http.put<any>(this.basePath + `/condidatures/`, value);
  }
}
