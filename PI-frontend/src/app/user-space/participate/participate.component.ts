import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Observable } from 'rxjs';
import { TerrainService } from 'src/app/shared/services/terrain.service';

@Component({
  selector: 'app-participate',
  templateUrl: './participate.component.html',
  styleUrls: ['./participate.component.scss']
})
export class ParticipateComponent implements OnInit {
  pitchId: any;
  competitionId: any;
  pitchtoparticipate$: Observable<any>;
  competition$: Observable<any>;
  constructor(  private router: ActivatedRoute,
    private terrainService: TerrainService) { }

  ngOnInit(): void {
    this.competitionId = this.router.snapshot.paramMap.get('id');
  //  this.pitchtoparticipate$ = this.terrainService.getTerrainByID(this.competitionId);
    this.competition$ = this.terrainService.getCompetitionById(this.competitionId);
  }

}
