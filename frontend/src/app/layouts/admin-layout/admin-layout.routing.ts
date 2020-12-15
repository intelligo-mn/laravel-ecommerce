import { Routes } from '@angular/router';
import { DashboardComponent } from 'src/app/modules/dashboard/dashboard.component';

export const AdminLayoutRoutes: Routes = [
  {
    path: 'dashboard',
    component: DashboardComponent,
    canActivate: [AuthGuard],
  },
  {
    path: '',
    children: [
      {
        path: '',
        loadChildren: () => import('./../../modules/main.module').then(m => m.MainModule),
      },
    ],
    canActivate: [AuthGuard],
  },
];
