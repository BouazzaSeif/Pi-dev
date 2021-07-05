import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { SharedModule } from '../shared';
import { RouterModule, Routes } from '@angular/router';
import { HomeComponent } from './home/home.component';

import { NotificationsComponent } from './notifications/notifications.component';
import { PitchesListComponent } from './pitches-list/pitches-list.component';
import { TerrainCardComponent } from './terrain-card/terrain-card.component';
import { SearchBarComponent } from './search-bar/search-bar.component';
import { CategoriesListComponent } from './categories-list/categories-list.component';
const UserSpaceRoutes: Routes = [
  {
    path: '',
    redirectTo: 'home',
    pathMatch: 'full',
  },
  {
    path: 'home',
    component: HomeComponent,
  } /* ,
  {
    path: 'myOffres/formulaire',
    component: FormulaireOffreComponent,
  },
  {
    path: 'myOffres/:id',
    component: AllCandidatsComponent,
  },
  {
    path: 'myOffres/:id/profil/:profilId',
    component: ProfilComponent,
  }, */,
];

@NgModule({
  declarations: [HomeComponent, PitchesListComponent, NotificationsComponent, TerrainCardComponent, SearchBarComponent, CategoriesListComponent],
  imports: [CommonModule, SharedModule, RouterModule.forChild(UserSpaceRoutes)],
})
export class UserspaceModule {}
