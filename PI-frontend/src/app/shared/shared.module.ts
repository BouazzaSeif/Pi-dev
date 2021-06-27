import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FooterComponent } from './components/footer/footer.component';
import { HeaderComponent } from './components/header/header.component';
import { NotFoundComponent } from './components/not-found/not-found.component';
import { CandidateService } from './services/candidate.service';
import { RouterModule } from '@angular/router';
import { AvatarModule } from 'ngx-avatar';
import { EntrepriseService } from './services/entreprise.service';

import { TooltipModule } from 'primeng/tooltip';
import { InputSwitchModule } from 'primeng/inputswitch';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';

@NgModule({
  declarations: [FooterComponent, HeaderComponent, NotFoundComponent],
  imports: [
    CommonModule,
    TooltipModule,
    FormsModule,
    ReactiveFormsModule,
    RouterModule,
    InputSwitchModule,
    AvatarModule,
  ],
  exports: [
    FooterComponent,
    HeaderComponent,
    NotFoundComponent,
    TooltipModule,
    FormsModule,
    InputSwitchModule,
    ReactiveFormsModule,
  ],
  providers: [CandidateService, EntrepriseService],
})
export class SharedModule {}
