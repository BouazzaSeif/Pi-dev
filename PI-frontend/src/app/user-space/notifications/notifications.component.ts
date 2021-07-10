import { Component, Input } from '@angular/core';

@Component({
  selector: 'app-notifications',
  templateUrl: './notifications.component.html',
  styleUrls: ['./notifications.component.scss'],
})
export class NotificationsComponent {
  @Input() competitions: any;

  getTerrainId(data) {
    return data.substr(data.lastIndexOf('/') + 1, data.length);
  }
}
