import { Component, Input, OnInit } from '@angular/core';
import { TerrainService } from 'src/app/shared/services/terrain.service';
import { map } from 'rxjs/operators';
import { Observable } from 'rxjs';

@Component({
  selector: 'app-notifications',
  templateUrl: './notifications.component.html',
  styleUrls: ['./notifications.component.scss']
})
export class NotificationsComponent implements OnInit {
  
  @Input()competitions: any;

  constructor(private terrainService: TerrainService) { }

  ngOnInit(): void {
    
   console.log(this.competitions);

    
  }
  
}
