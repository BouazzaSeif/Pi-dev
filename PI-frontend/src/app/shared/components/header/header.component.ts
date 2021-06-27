import { Component, OnInit } from '@angular/core';
import {
  GuardsCheckEnd,
  GuardsCheckStart,
  NavigationEnd,
  NavigationStart,
  Router,
  RoutesRecognized,
} from '@angular/router';
import { AccountService } from '../../services/account.service';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.css'],
})
export class HeaderComponent implements OnInit {
  user$: any;
  isEntrepriseSpace = false;
  constructor(private accountService: AccountService, private router: Router) {}

  ngOnInit(): void {
    this.router.events.subscribe(
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
    );
    this.user$ = this.accountService.userValue;
  }

  logout() {
    this.accountService.logout();
  }
}
