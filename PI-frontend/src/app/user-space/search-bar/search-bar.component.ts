import { Component, EventEmitter, OnInit, Output } from '@angular/core';

@Component({
  selector: 'app-search-bar',
  templateUrl: './search-bar.component.html',
  styleUrls: ['./search-bar.component.scss'],
})
export class SearchBarComponent implements OnInit {
  searchText;
  @Output() term = new EventEmitter<any>();
  ngOnInit(): void {}

  onInputChange(): any {
    this.term.emit(this.searchText);
  }
}
