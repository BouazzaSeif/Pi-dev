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
import {DropdownModule} from 'primeng/dropdown';
@NgModule({
  declarations: [
    FooterComponent,
    HeaderComponent,
    NotFoundComponent,
    ConfirmRegisterComponent,
  ],
  imports: [
    CommonModule,
    TooltipModule,
    FormsModule,
    ReactiveFormsModule,
    RouterModule,
    InputSwitchModule,
    AvatarModule,
    DropdownModule,
    
  ],
  exports: [
    FooterComponent,
    HeaderComponent,
    NotFoundComponent,
    TooltipModule,
    FormsModule,
    InputSwitchModule,
    ReactiveFormsModule,
    DropdownModule,
  ],
  providers: [],
})
export class SharedModule {}
