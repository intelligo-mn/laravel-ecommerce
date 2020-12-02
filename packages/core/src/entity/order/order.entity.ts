import { Adjustment, CurrencyCode, OrderAddress, OrderTaxSummary } from '@vendure/common/lib/generated-types';
import { DeepPartial, ID } from '@vendure/common/lib/shared-types';
import { Column, Entity, JoinTable, ManyToMany, ManyToOne, OneToMany } from 'typeorm';

import { Calculated } from '../../common/calculated-decorator';
import { ChannelAware } from '../../common/types/common-types';
import { HasCustomFields } from '../../config/custom-field/custom-field-types';
import { OrderState } from '../../service/helpers/order-state-machine/order-state';
import { VendureEntity } from '../base/base.entity';
import { Channel } from '../channel/channel.entity';
import { CustomOrderFields } from '../custom-entity-fields';
import { Customer } from '../customer/customer.entity';
import { EntityId } from '../entity-id.decorator';
import { OrderItem } from '../order-item/order-item.entity';
import { OrderLine } from '../order-line/order-line.entity';
import { Payment } from '../payment/payment.entity';
import { Promotion } from '../promotion/promotion.entity';
import { ShippingMethod } from '../shipping-method/shipping-method.entity';

/**
 * @description
 * An Order is created whenever a {@link Customer} adds an item to the cart. It contains all the
 * information required to fulfill an order: which {@link ProductVariant}s in what quantities;
 * the shipping address and price; any applicable promotions; payments etc.
 *
 * An Order exists in a well-defined state according to the {@link OrderState} type. A state machine
 * is used to govern the transition from one state to another.
 *
 * @docsCategory entities
 */
@Entity()
export class Order extends VendureEntity implements ChannelAware, HasCustomFields {
    constructor(input?: DeepPartial<Order>) {
        super(input);
    }

    @Column() code: string;

    @Column('varchar') state: OrderState;

    @Column({ default: true })
    active: boolean;

    @Column({ nullable: true })
    orderPlacedAt?: Date;

    @ManyToOne(type => Customer)
    customer?: Customer;

    @OneToMany(type => OrderLine, line => line.order)
    lines: OrderLine[];

    @Column('simple-array')
    couponCodes: string[];

    @ManyToMany(type => Promotion)
    @JoinTable()
    promotions: Promotion[];

    @Column('simple-json') shippingAddress: OrderAddress;

    @Column('simple-json') billingAddress: OrderAddress;

    @OneToMany(type => Payment, payment => payment.order)
    payments: Payment[];

    @Column('varchar')
    currencyCode: CurrencyCode;

    @EntityId({ nullable: true })
    shippingMethodId: ID | null;

    @ManyToOne(type => ShippingMethod)
    shippingMethod: ShippingMethod | null;

    @Column({ default: 0 })
    shipping: number;

    @Column({ default: 0 })
    shippingWithTax: number;

    @Column(type => CustomOrderFields)
    customFields: CustomOrderFields;

    @EntityId({ nullable: true })
    taxZoneId?: ID;

    @ManyToMany(type => Channel)
    @JoinTable()
    channels: Channel[];

    /**
     * @description
     * The subTotal is the total of the OrderLines, before order-level promotions
     * and shipping has been applied.
     */
    @Column() subTotal: number;

    @Column() subTotalWithTax: number;

    @Calculated()
    get discounts(): Adjustment[] {
        const groupedAdjustments = new Map<string, Adjustment>();
        for (const line of this.lines) {
            for (const discount of line.discounts) {
                const adjustment = groupedAdjustments.get(discount.adjustmentSource);
                if (adjustment) {
                    adjustment.amount += discount.amount;
                } else {
                    groupedAdjustments.set(discount.adjustmentSource, { ...discount });
                }
            }
        }
        return [...groupedAdjustments.values()];
    }

    @Calculated()
    get total(): number {
        return this.subTotal + (this.shipping || 0);
    }

    @Calculated()
    get totalWithTax(): number {
        return this.subTotalWithTax + (this.shippingWithTax || 0);
    }

    @Calculated()
    get totalQuantity(): number {
        return (this.lines || []).reduce((total, line) => total + line.quantity, 0);
    }

    @Calculated()
    get taxSummary(): OrderTaxSummary[] {
        const taxRateMap = new Map<number, { base: number; tax: number }>();
        for (const line of this.lines) {
            const row = taxRateMap.get(line.taxRate);
            if (row) {
                row.tax += line.proratedLineTax;
                row.base += line.proratedLinePrice;
            } else {
                taxRateMap.set(line.taxRate, {
                    tax: line.proratedLineTax,
                    base: line.proratedLinePrice,
                });
            }
        }
        return Array.from(taxRateMap.entries()).map(([taxRate, row]) => ({
            taxRate,
            taxBase: row.base,
            taxTotal: row.tax,
        }));
    }

    getOrderItems(): OrderItem[] {
        return this.lines.reduce((items, line) => {
            return [...items, ...line.items];
        }, [] as OrderItem[]);
    }
}
