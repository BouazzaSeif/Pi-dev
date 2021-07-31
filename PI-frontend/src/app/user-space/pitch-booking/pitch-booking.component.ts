import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Observable } from 'rxjs';
import { tap } from 'rxjs/operators';
import { TerrainService } from 'src/app/shared/services/terrain.service';

@Component({
  selector: 'app-pitch-booking',
  templateUrl: './pitch-booking.component.html',
  styleUrls: ['./pitch-booking.component.scss'],
})
export class PitchBookingComponent implements OnInit {
  pitchId: any;
  terrainToBook$: Observable<any>;
  json;
  n;
  url;
  dateToPick: Date;
  constructor(
    private router: ActivatedRoute,
    private terrainService: TerrainService
  ) {}

  ngOnInit(): void {
    this.pitchId = this.router.snapshot.paramMap.get('id');
    this.terrainToBook$ = this.terrainService.getTerrainByID(this.pitchId);
  }
  pay(Prix, terrainID) {
    this.terrainService.pay(Prix).subscribe((data) => {
      this.json = JSON.stringify(data);
      this.n = this.json.length - 3;
      this.url = this.json.substring(8, this.n);
      window.open(this.url);
    });
    setTimeout(() => {
      const user = JSON.parse(localStorage.getItem('user'));
      const reservation = {
        terrain: '/api/terrains/' + terrainID,
        personneId: '/api/personnes/' + '4',
        dateReservation: this.dateToPick.toISOString(),
        time: this.dateToPick.toISOString(),
      };
      console.log(reservation);
      this.terrainService.BookaPitch(reservation).subscribe((data) => {
        console.log(data + 'reservation');
      });
    }, 5000);
  }
}
