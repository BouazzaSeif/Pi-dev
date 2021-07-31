import { HttpClient, HttpHeaders } from '@angular/common/http';
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
  getCompetitionById(competitionId): Observable<any[]> {
    return this.http.get<any>(
      `${environment.baseApiPath}/api/competitions/${competitionId}`
    );
  }

  getTerrainByID(pitchId: any): Observable<any> {
    return this.http.get<any>(
      `${environment.baseApiPath}/api/terrains/${pitchId}`
    );
  }
  getReservations(): Observable<any[]> {
    return this.http.get<any>(`${environment.baseApiPath}/api/reservations`);
  }

  BookaPitch(reservation) {
    return this.http.post<any>(
      `${environment.baseApiPath}/api/reservations`,
      reservation
    );
  }
  pay(amount) {
    const headers = new HttpHeaders();

    headers.append('Content-Type', 'application/json');
    headers.append('Accept', 'application/json');

    headers.append('Access-Control-Allow-Origin', '*');
    headers.append('Access-Control-Allow-Credentials', 'true');

    headers.append('GET', 'POST');
    return this.http.get<any>(
      `${environment.baseApiPath}/api/create-checkout-session/` + amount
      /*  {
        headers,
      } */
    );
  }
  getReservationById(resId: any): Observable<any[]> {
    return this.http.get<any>(
      `${environment.baseApiPath}/api/reservations/${resId}`
    );
  }
  deleteReservation(resId: any): Observable<any[]> {
    return this.http.delete<any>(
      `${environment.baseApiPath}/api/reservations/${resId}`
    );
  }
}
