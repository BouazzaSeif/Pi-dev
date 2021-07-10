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
import {IvyCarouselModule} from 'angular-responsive-carousel';
import {CarouselModule} from 'primeng/carousel';

// search module

import { Ng2SearchPipeModule } from 'ng2-search-filter';
@NgModule({
  declarations: [
    FooterComponent,
    HeaderComponent,
    NotFoundComponent,
    ConfirmRegisterComponent,
  ],
  imports: [
    CarouselModule,
    IvyCarouselModule,
    CommonModule,
    TooltipModule,
    FormsModule,
    ReactiveFormsModule,
    RouterModule,
    InputSwitchModule,
    AvatarModule,
    Ng2SearchPipeModule,
    DropdownModule,
  ],
  exports: [
    CarouselModule,
    IvyCarouselModule,
    FooterComponent,
    HeaderComponent,
    NotFoundComponent,
    TooltipModule,
    FormsModule,
    InputSwitchModule,
    ReactiveFormsModule,
    DropdownModule,
    Ng2SearchPipeModule,
  ],
  providers: [],
})
export class SharedModule {}
