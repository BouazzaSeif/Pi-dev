import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { ConfirmationService, PrimeNGConfig, Message } from 'primeng/api';
import { Observable } from 'rxjs';
import { tap } from 'rxjs/operators';
import { TerrainService } from 'src/app/shared/services/terrain.service';

@Component({
  selector: 'app-reservation',
  templateUrl: './reservation.component.html',
  styleUrls: ['./reservation.component.scss'],
  providers: [ConfirmationService],
})
export class ReservationComponent implements OnInit {
  resId: any;
  reservation$: Observable<any>;
  terrain: any;
  msgs: Message[] = [];
  constructor(
    private router: ActivatedRoute,
    private terrainService: TerrainService,
    private confirmationService: ConfirmationService,
    private primengConfig: PrimeNGConfig
  ) {}

  ngOnInit(): void {
    this.primengConfig.ripple = true;
    this.resId = this.router.snapshot.paramMap.get('id');
    this.reservation$ = this.terrainService
      .getReservationById(this.resId)
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
      });
    }
  }

  deleteReservation() {
    this.confirmationService.confirm({
      message: 'Are you sure you want to delete this reservation?',
      header: 'Confirmation',
      icon: 'pi pi-exclamation-triangle',
      accept: () => {
        this.msgs = [
          {
            severity: 'success',
            summary: 'Confirmed',
            detail: 'You have accepted',
          },
        ];
        this.terrainService.deleteReservation(this.resId).subscribe();
      },
      reject: () => {} /* 
      key: 'positionDialog', */,
    });
  }
}
