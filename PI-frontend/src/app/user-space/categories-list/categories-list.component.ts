import { Component, OnInit, ViewChild } from '@angular/core';
import { SelectItem} from 'primeng/api';
import { TerrainService } from 'src/app/shared/services/terrain.service';


@Component({
  selector: 'app-categories-list',
  templateUrl: './categories-list.component.html',
  styleUrls: ['./categories-list.component.scss']
})
export class CategoriesListComponent implements OnInit {
  
    cities =[];
    selectedCity1:any;
    regions =[];
    constructor(private terrainService: TerrainService ) {
    }
        


  ngOnInit(): void {
    debugger;
    this.terrainService.getRegions().subscribe(region=>{
    console.log(region['hydra:member']
    );
    this.regions=region['hydra:member'];
    
    })
  }

}
