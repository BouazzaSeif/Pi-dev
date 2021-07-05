import { Component, Input, OnInit } from '@angular/core';

@Component({
  selector: 'app-terrain-card',
  templateUrl: './terrain-card.component.html',
  styleUrls: ['./terrain-card.component.scss'],
})
export class TerrainCardComponent implements OnInit {
  @Input() terrain: any;
  constructor() {}

  ngOnInit(): void {}
}
