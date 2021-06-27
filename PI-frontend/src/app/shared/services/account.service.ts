import { Injectable } from '@angular/core';
import { Router } from '@angular/router';
import { HttpClient } from '@angular/common/http';
import { BehaviorSubject, Observable } from 'rxjs';
import { map } from 'rxjs/operators';

import { environment } from '../../../environments/environment';

export class User {
  user?: {
    id: string;
    username: string;
    email: string;
  };
  token?: string;
  email?: string;
  plainPassword?: string;
  password?: string;
  username?: string;
}
@Injectable({ providedIn: 'root' })
export class AccountService {
  private userSubject: BehaviorSubject<User>;
  public user: Observable<User>;

  constructor(private router: Router, private http: HttpClient) {
    this.userSubject = new BehaviorSubject<User>(
      JSON.parse(localStorage.getItem('user'))
    );
    this.user = this.userSubject.asObservable();
  }

  public get userValue(): User {
    return this.userSubject.value;
  }

  login(username, password) {
    return this.http
      .post<User>(`${environment.baseApiPath}/api/login`, {
        username,
        password,
      })
      .pipe(
        map((user) => {
          // store user details and jwt token in local storage to keep user logged in between page refreshes
          localStorage.setItem('user', JSON.stringify(user));
          this.userSubject.next(user);
          return user;
        })
      );
  }

  logout() {
    // remove user from local storage and set current user to null
    localStorage.removeItem('user');
    this.userSubject.next(null);
    this.router.navigate(['/login']);
  }

  register(user: User) {
    return this.http
      .post<any>(`${environment.baseApiPath}/api/register`, user)
      .pipe(
        map((returnedUser) => {
          // store user details and jwt token in local storage to keep user logged in between page refreshes
          localStorage.setItem('user', JSON.stringify(returnedUser));
          this.userSubject.next(returnedUser);
          return user;
        })
      );
  }

  getAll() {
    return this.http.get<User[]>(`${environment.baseApiPath}/users`);
  }

  getById(id: string) {
    return this.http.get<User>(`${environment.baseApiPath}/users/${id}`);
  }

  update(id, params) {
    return this.http.put(`${environment.baseApiPath}/users/${id}`, params).pipe(
      map((x) => {
        // update stored user if the logged in user updated their own record
        if (id == this.userValue.user.id) {
          // update local storage
          const user = { ...this.userValue, ...params };
          localStorage.setItem('user', JSON.stringify(user));

          // publish updated user to subscribers
          this.userSubject.next(user);
        }
        return x;
      })
    );
  }

  delete(id: string) {
    return this.http.delete(`${environment.baseApiPath}/users/${id}`).pipe(
      map((x) => {
        // auto logout if the logged in user deleted their own record
        if (id == this.userValue.user.id) {
          this.logout();
        }
        return x;
      })
    );
  }
}
