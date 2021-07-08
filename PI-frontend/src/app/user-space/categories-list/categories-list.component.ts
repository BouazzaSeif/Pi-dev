import { Component, EventEmitter, OnInit, Output } from '@angular/core';
import { Observable } from 'rxjs';
import { map } from 'rxjs/operators';
import { TerrainService } from 'src/app/shared/services/terrain.service';

@Component({
  selector: 'app-categories-list',
  templateUrl: './categories-list.component.html',
  styleUrls: ['./categories-list.component.scss'],
})
export class CategoriesListComponent implements OnInit {
  selectedRegion: any;
  regions$: Observable<any[]>;
  @Output() term = new EventEmitter<any>();
  constructor(private terrainService: TerrainService) {}

  ngOnInit(): void {
    this.regions$ = this.terrainService.getRegions().pipe(
      map((region) => {
        region['hydra:member'].unshift({ Nom: 'All region' });
        return region['hydra:member'];
      })
    );
  }

  selectRegion() {
    if (this.selectedRegion.Nom === 'All region') {
      this.term.emit('');
    } else {
      this.term.emit(this.selectedRegion.Nom);
    }
  }
}
