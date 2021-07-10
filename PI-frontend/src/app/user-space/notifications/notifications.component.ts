import { Component, Input, OnInit } from '@angular/core';
import { TerrainService } from 'src/app/shared/services/terrain.service';
import { map } from 'rxjs/operators';
import { Observable } from 'rxjs';
import { take } from 'rxjs/operators';
import { ThisReceiver } from '@angular/compiler';



@Component({
  selector: 'app-notifications',
  templateUrl: './notifications.component.html',
  styleUrls: ['./notifications.component.scss']
})
export class NotificationsComponent implements OnInit {
  
  @Input()competitions: any;

  constructor(private terrainService: TerrainService) { }

  ngOnInit(): void {
    
    this.competitions?.forEach(element => {
      element.terrain=this.getTerrain(element.terrain);
    });
    console.log(this.competitions);
    }
  getTerrain(data){
    let terrain={};
    let id=data.substr(data.lastIndexOf("/")+1,data.length);
    this.terrainService.getTerrain(id).subscribe(val=>{
      terrain=val;
    });  
    return terrain;
  }
  
}
