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
  json;
  n;
  url;
  constructor(
    private router: ActivatedRoute,
    private terrainService: TerrainService
  ) {}


 
  ngOnInit(): void {
    this.pitchId = this.router.snapshot.paramMap.get('id');
    this.terrainToBook$ = this.terrainService.getTerrainByID(this.pitchId);
  }
  pay() {
    this.terrainService.pay(100).subscribe((data) =>{
      console.log(data);
      this.json = JSON.stringify(data)
      this.n = this.json.length - 3
      this.url = this.json.substring(8, this.n);
      window.open(this.url)})
}
}
