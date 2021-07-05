import { Component, OnInit } from '@angular/core';
import { TerrainService } from 'src/app/shared/services/terrain.service';

@Component({
  selector: 'app-pitches-list',
  templateUrl: './pitches-list.component.html',
  styleUrls: ['./pitches-list.component.scss'],
})
export class PitchesListComponent implements OnInit {
  terrains = [{}, {}, {}, {}, {}, {}];
  constructor(private terrainService: TerrainService) {}

  ngOnInit(): void {}
}
