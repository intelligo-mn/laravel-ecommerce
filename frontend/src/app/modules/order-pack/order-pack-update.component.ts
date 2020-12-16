import { Component, OnInit } from '@angular/core';
import { HttpResponse } from '@angular/common/http';
// eslint-disable-next-line @typescript-eslint/no-unused-vars
import { FormBuilder, Validators } from '@angular/forms';
import { ActivatedRoute } from '@angular/router';
import { Observable } from 'rxjs';
import * as moment from 'moment';
import { DATE_TIME_FORMAT } from 'src/app/shared/constants/input.constants';

import { IOrderPack, OrderPack } from 'src/app/shared/model/order-pack.model';
import { OrderPackService } from './order-pack.service';
import { IProduct } from 'src/app/shared/model/product.model';
import { ProductService } from 'src/app/modules/product/product.service';

@Component({
  selector: 'order-pack-update',
  templateUrl: './order-pack-update.component.html',
})
export class OrderPackUpdateComponent implements OnInit {
  isSaving = false;
  products: IProduct[] = [];

  editForm = this.fb.group({
    id: [],
    name: [null, [Validators.required]],
    startDate: [null, [Validators.required]],
    endDate: [null, [Validators.required]],
    status: [null, [Validators.required]],
    products: [],
  });

  constructor(
    protected orderPackService: OrderPackService,
    protected productService: ProductService,
    protected activatedRoute: ActivatedRoute,
    private fb: FormBuilder
  ) {}

  ngOnInit(): void {
    this.activatedRoute.data.subscribe(({ orderPack }) => {
      if (!orderPack.id) {
        const today = moment().startOf('day');
        orderPack.startDate = today;
        orderPack.endDate = today;
      }

      this.updateForm(orderPack);

      this.productService.query().subscribe((res: HttpResponse<IProduct[]>) => (this.products = res.body || []));
    });
  }

  updateForm(orderPack: IOrderPack): void {
    this.editForm.patchValue({
      id: orderPack.id,
      name: orderPack.name,
      startDate: orderPack.startDate ? orderPack.startDate.format(DATE_TIME_FORMAT) : null,
      endDate: orderPack.endDate ? orderPack.endDate.format(DATE_TIME_FORMAT) : null,
      status: orderPack.status,
      products: orderPack.products,
    });
  }

  previousState(): void {
    window.history.back();
  }

  save(): void {
    this.isSaving = true;
    const orderPack = this.createFromForm();
    if (orderPack.id !== undefined) {
      this.subscribeToSaveResponse(this.orderPackService.update(orderPack));
    } else {
      this.subscribeToSaveResponse(this.orderPackService.create(orderPack));
    }
  }

  private createFromForm(): IOrderPack {
    return {
      ...new OrderPack(),
      id: this.editForm.get(['id'])!.value,
      name: this.editForm.get(['name'])!.value,
      startDate: this.editForm.get(['startDate'])!.value ? moment(this.editForm.get(['startDate'])!.value, DATE_TIME_FORMAT) : undefined,
      endDate: this.editForm.get(['endDate'])!.value ? moment(this.editForm.get(['endDate'])!.value, DATE_TIME_FORMAT) : undefined,
      status: this.editForm.get(['status'])!.value,
      products: this.editForm.get(['products'])!.value,
    };
  }

  protected subscribeToSaveResponse(result: Observable<HttpResponse<IOrderPack>>): void {
    result.subscribe(
      () => this.onSaveSuccess(),
      () => this.onSaveError()
    );
  }

  protected onSaveSuccess(): void {
    this.isSaving = false;
    this.previousState();
  }

  protected onSaveError(): void {
    this.isSaving = false;
  }

  trackById(index: number, item: IProduct): any {
    return item.id;
  }
}
