import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { first } from 'rxjs/operators';
import { AccountService } from 'src/app/shared/services/account.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css', './util.css'],
})
export class LoginComponent implements OnInit {
  loginForms = new FormGroup({
    username: new FormControl('', Validators.required),
    password: new FormControl('', Validators.required),
  });
  error: boolean;
  spinnerOn = false;

  get username() {
    return this.loginForms.get('username');
  }

  get password() {
    return this.loginForms.get('password');
  }
  constructor(
    private route: ActivatedRoute,
    private router: Router,
    private accountService: AccountService
  ) {}

  ngOnInit(): void {}

  login() {
    this.spinnerOn = true;
    this.accountService
      .login(this.username.value, this.password.value)
      .pipe(first())
      .subscribe({
        next: () => {
          this.spinnerOn = false;
          const returnUrl = this.route.snapshot.queryParams.returnUrl || '/';
          this.router.navigateByUrl(returnUrl);
        },
        error: (error) => {
          this.spinnerOn = false;
          this.error = true;
        },
      });
  }
}
