import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable, of } from 'rxjs';
import { environment } from '../../../environments/environment';

@Injectable({
  providedIn: 'root',
})
export class CandidateService {
  private basePath = environment.baseApiPath;

  constructor(private http: HttpClient) {}

  onCreatePost(data: any): Observable<any> {
    return this.http.post<any>(this.basePath + '/offres/', data);
  }
  onPostule(data): Observable<any> {
    // Send Http request
    return this.http.post<any>(this.basePath + '/condidatures/', data);
  }
  onsignUp(data: any): Observable<any> {
    // Send Http request
    return this.http.post<any>(this.basePath + '//', data); // endPoint
  }
  getOffreList(): Observable<any> {
    return this.http.get<any>(this.basePath + '/public-offres/');
    /*  return this.http.get<any>(this.basePath + '/posts.json'); */
  }
}
