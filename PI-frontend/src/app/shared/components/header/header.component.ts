import { ChangeDetectionStrategy, Component, OnInit } from '@angular/core';
import {
  GuardsCheckEnd,
  GuardsCheckStart,
  NavigationEnd,
  NavigationStart,
  Router,
  RoutesRecognized,
} from '@angular/router';
import { BehaviorSubject, Subject } from 'rxjs';
import { Observable } from 'rxjs';
import { map, take } from 'rxjs/operators';
import { AccountService } from '../../services/account.service';
import { TerrainService } from '../../services/terrain.service';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  changeDetection: ChangeDetectionStrategy.OnPush,
  styleUrls: ['./header.component.css'],
})
export class HeaderComponent implements OnInit {
  user$: any;
  /* isEntrepriseSpace = false; */
  displayBasic = new BehaviorSubject(false);
  reservations$: Observable<any>;
  constructor(
    private accountService: AccountService,
    private router: Router,
    private terrainService: TerrainService
  ) {}

  ngOnInit(): void {
    /*  this.router.events.subscribe(
      (
        val:
          | NavigationEnd
          | GuardsCheckStart
          | NavigationStart
          | RoutesRecognized
          | GuardsCheckEnd
      ) => {
        if (val && val.url) {
          this.isEntrepriseSpace =
            val.url.includes('entreprise') || val.url.includes('login');
        }
      }
    ); */
    this.user$ = this.accountService.userValue;
    this.reservations$ = this.terrainService.getReservations().pipe(
      map((reservations) => {
        return reservations['hydra:member'];
      })
    );
  }

  logout() {
    this.accountService.logout();
  }

  showBasicDialog() {
    this.displayBasic.next(!this.displayBasic.value);
  }
}
