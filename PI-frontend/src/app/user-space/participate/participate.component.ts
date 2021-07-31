import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Observable } from 'rxjs';
import { tap } from 'rxjs/operators';
import { ConfirmationService, PrimeNGConfig, Message } from 'primeng/api';
import { TerrainService } from 'src/app/shared/services/terrain.service';

@Component({
  selector: 'app-participate',
  templateUrl: './participate.component.html',
  styleUrls: ['./participate.component.scss'],
  providers: [ConfirmationService],
})
export class ParticipateComponent implements OnInit {
  pitchId: any;
  competitionId: any;
  terrain: any;
  pitchtoparticipate$: Observable<any>;
  competition$: Observable<any>;
  dateToPick: Date;
  constructor(
    private router: ActivatedRoute,
    private terrainService: TerrainService
  ) {}

  ngOnInit(): void {
    this.competitionId = this.router.snapshot.paramMap.get('id');
    this.competition$ = this.terrainService
      .getCompetitionById(this.competitionId)
      .pipe(tap((resVal) => this.getTerrain(resVal.terrain)));
  }
  getTerrain(terrain: any): void {
    if (terrain) {
      const terrainId = terrain.substr(
        terrain.lastIndexOf('/') + 1,
        terrain.length
      );
      this.terrainService.getTerrainByID(terrainId).subscribe((terrainVal) => {
        this.terrain = terrainVal;
        console.log(this.terrain);
      });
    }
  }
  participateCompetition(terrainID, competition) {
    setTimeout(() => {
      const user = JSON.parse(localStorage.getItem('user'));
      const competitionToSend = {
        terrain: '/api/terrains/' + terrainID?.toString(),
        personneId: '/api/personnes/' + '4',
        dateReservation: competition.dateComp,
        time: competition.timeCom,
      };

      this.terrainService.BookaPitch(competitionToSend).subscribe((data) => {
        console.log(data + 'competitionToSend');
      });
    }, 5000);
  }
}
