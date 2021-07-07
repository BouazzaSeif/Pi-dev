import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppComponent } from './app.component';
import { HttpClientModule, HTTP_INTERCEPTORS } from '@angular/common/http';
import { SharedModule } from './shared';
import { RouterModule, Routes } from '@angular/router';
import { LoginComponent } from './shared/components/login/login.component';
import { SignupComponent } from './shared/components/signup/signup.component';
import { AuthGuard } from './shared/services/authGuard';
import { ReactiveFormsModule } from '@angular/forms';
import { JwtInterceptor } from './shared/services/jwtinterceptor';
import { ConfirmRegisterComponent } from './shared/components/confirm-register/confirm-register.component';
import { NotFoundComponent } from './shared/components/not-found/not-found.component';

const appRoutes: Routes = [
  /*  { path: '', component: AppComponent, canActivate: [AuthGuard] }, */
  {
    path: '',
    loadChildren: () =>
      import('./user-space/userspace.module').then((m) => m.UserspaceModule),
    canActivate: [AuthGuard],
  },
  /* {
    path: 'entreprise',
    loadChildren: () =>
      import('./entreprise-space/entreprise.module').then(
        (m) => m.EntrepriseModule
      ),
    canActivate: [AuthGuard],
  } */ {
    path: 'login',
    component: LoginComponent,
  },
  {
    path: 'confirm',
    component: ConfirmRegisterComponent,
  },
  {
    path: 'register',
    component: SignupComponent,
  },
  { path: '**', component: NotFoundComponent },
];

@NgModule({
  imports: [
    HttpClientModule,
    BrowserModule,
    RouterModule.forRoot(
      appRoutes /* , { relativeLinkResolution: 'legacy' } */
    ),
    SharedModule,
    ReactiveFormsModule,
   
    
  ],
  declarations: [AppComponent, SignupComponent, LoginComponent],
  providers: [
    AuthGuard,
    { provide: HTTP_INTERCEPTORS, useClass: JwtInterceptor, multi: true },
  ],
  bootstrap: [AppComponent],
})
export class AppModule {}
