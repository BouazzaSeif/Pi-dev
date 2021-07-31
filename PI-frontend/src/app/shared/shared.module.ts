import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FooterComponent } from './components/footer/footer.component';
import { HeaderComponent } from './components/header/header.component';
import { NotFoundComponent } from './components/not-found/not-found.component';
import { RouterModule } from '@angular/router';

import { AvatarModule } from 'ngx-avatar';
import { TooltipModule } from 'primeng/tooltip';
import { InputSwitchModule } from 'primeng/inputswitch';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { ConfirmRegisterComponent } from './components/confirm-register/confirm-register.component';
import { DropdownModule } from 'primeng/dropdown';
import { IvyCarouselModule } from 'angular-responsive-carousel';
import { CarouselModule } from 'primeng/carousel';
import { ProgressSpinnerModule } from 'primeng/progressspinner';
import { CalendarModule } from 'primeng/calendar';
import { ConfirmDialogModule } from 'primeng/confirmdialog';
import { MessagesModule } from 'primeng/messages';
// search module

import { Ng2SearchPipeModule } from 'ng2-search-filter';
import { PiLoaderComponent } from './components/pi-loader/pi-loader.component';
@NgModule({
  declarations: [
    FooterComponent,
    HeaderComponent,
    NotFoundComponent,
    ConfirmRegisterComponent,
    PiLoaderComponent,
  ],
  imports: [
    CarouselModule,
    IvyCarouselModule,
    CommonModule,
    TooltipModule,
    FormsModule,
    ReactiveFormsModule,
    ConfirmDialogModule,
    RouterModule,
    CalendarModule,
    ProgressSpinnerModule,
    InputSwitchModule,
    AvatarModule,
    MessagesModule,
    Ng2SearchPipeModule,
    DropdownModule,
  ],
  exports: [
    CarouselModule,
    IvyCarouselModule,
    FooterComponent,
    HeaderComponent,
    NotFoundComponent,
    CalendarModule,
    TooltipModule,
    FormsModule,
    InputSwitchModule,
    ReactiveFormsModule,
    MessagesModule,
    DropdownModule,
    ProgressSpinnerModule,
    ConfirmDialogModule,
    Ng2SearchPipeModule,
    PiLoaderComponent,
  ],
  providers: [],
})
export class SharedModule {}
