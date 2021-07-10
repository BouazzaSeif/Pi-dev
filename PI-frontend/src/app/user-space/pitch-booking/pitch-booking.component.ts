import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Observable } from 'rxjs';
import { TerrainService } from 'src/app/shared/services/terrain.service';

@Component({
  selector: 'app-pitch-booking',
  templateUrl: './pitch-booking.component.html',
  styleUrls: ['./pitch-booking.component.scss'],
})
export class PitchBookingComponent implements OnInit {
  pitchId: any;
  terrainToBook$: Observable<any>;
  constructor(
    private router: ActivatedRoute,
    private terrainService: TerrainService
  ) {}

  ngOnInit(): void {
    this.pitchId = this.router.snapshot.paramMap.get('id');
    this.terrainToBook$ = this.terrainService.getTerrainByID(this.pitchId);
  }
}
