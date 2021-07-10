import { Component, OnInit } from '@angular/core';
import { Observable } from 'rxjs';
import { map } from 'rxjs/operators';
import { TerrainService } from 'src/app/shared/services/terrain.service';

@Component({
  selector: 'app-pitches-list',
  templateUrl: './pitches-list.component.html',
  styleUrls: ['./pitches-list.component.scss'],
})
export class PitchesListComponent implements OnInit {
  terrains$: Observable<any[]>;
  competitions$: Observable<any[]>;
  myTerrain : any;
  searchTerm;

  constructor(private terrainService: TerrainService) {}

  ngOnInit(): void {
    this.terrains$ = this.terrainService
      .getTerrains()
      .pipe(map((val) => val['hydra:member']));

      this.competitions$ =
    this.terrainService.getCompetitions().
    pipe(map((val) => val['hydra:member']
        ));
      
  }
  
  changeSearchTerm(term) {
    this.searchTerm = term;
  }
}
