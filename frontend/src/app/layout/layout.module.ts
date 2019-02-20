import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { TranslateModule } from '@ngx-translate/core';
import { NgbDropdownModule } from '@ng-bootstrap/ng-bootstrap';
import { MatListModule } from '@angular/material';

import { NgbModule,ModalDismissReasons,NgbModal } from '@ng-bootstrap/ng-bootstrap';

import { ChartsModule as Ng2Charts } from 'ng2-charts';

import { LayoutRoutingModule } from './layout-routing.module';
import { LayoutComponent } from './layout.component';
import { SidebarComponent } from './components/sidebar/sidebar.component';
import { HeaderComponent } from './components/header/header.component';
import { ConsultorComponent } from '../consultor/consultor.component';

@NgModule({
    imports: [
        CommonModule,
        LayoutRoutingModule,
        TranslateModule,
        NgbDropdownModule,
        MatListModule,
        Ng2Charts,
        NgbModule.forRoot()
    ],
    declarations: [LayoutComponent, SidebarComponent, HeaderComponent,ConsultorComponent]
})
export class LayoutModule {}
