import { HttpResponse } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { ActivatedRouteSnapshot, Resolve, Router, Routes } from '@angular/router';
import { EMPTY, Observable, of } from 'rxjs';
import { flatMap } from 'rxjs/operators';
import { AuthGuard } from 'src/app/core/auth/auth.guard';
import { Authority } from 'src/app/shared/constants/authority.constants';
import { IOrder, Order } from 'src/app/shared/model/order.model';
import { ResolvePagingParams } from 'src/app/shared/services/resolve-paging-param.service';
import { OrderFormComponent } from './order-form.component';
import { OrderListComponent } from './order-list.component';
import { OrderPackSelectComponent } from './order-pack-select.component';
import { OrderService } from './order.service';

@Injectable({ providedIn: 'root' })
export class OrderResolve implements Resolve<IOrder> {
  constructor(private service: OrderService, private router: Router) { }

  resolve(route: ActivatedRouteSnapshot): Observable<IOrder> | Observable<never> {
    const id = route.params['id'];
    if (id) {
      return this.service.find(id).pipe(
        flatMap((order: HttpResponse<Order>) => {
          if (order.body) {
            return of(order.body);
          } else {
            this.router.navigate(['404']);
            return EMPTY;
          }
        })
      );
    }
    return of(new Order());
  }
}

export const orderRoute: Routes = [
  {
    path: '',
    component: OrderListComponent,
    resolve: {
      pagingParams: ResolvePagingParams,
    },
    data: {
      authorities: [Authority.ADMIN, Authority.USER],
      defaultSort: 'id,asc',
      pageTitle: 'childfoodApp.order.home.title',
    },
    canActivate: [AuthGuard],
  },
  {
    path: ':id/view',
    component: OrderPackSelectComponent,
    resolve: {
      order: OrderResolve,
    },
    data: {
      authorities: [Authority.ADMIN, Authority.USER],
      pageTitle: 'childfoodApp.order.home.title',
    },
    canActivate: [AuthGuard],
  },
  {
    path: 'create/:id',
    component: OrderFormComponent,
    data: {
      authorities: [Authority.ADMIN, Authority.USER],
      pageTitle: 'childfoodApp.order.home.title',
    },
    canActivate: [AuthGuard],
  },
  {
    path: ':id/edit',
    component: OrderFormComponent,
    resolve: {
      order: OrderResolve,
    },
    data: {
      authorities: [Authority.ADMIN, Authority.USER],
      pageTitle: 'childfoodApp.order.home.title',
    },
    canActivate: [AuthGuard],
  },
];
