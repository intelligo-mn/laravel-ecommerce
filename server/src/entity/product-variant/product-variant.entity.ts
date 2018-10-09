import { DeepPartial, HasCustomFields, ID } from 'shared/shared-types';
import { Column, Entity, JoinTable, ManyToMany, ManyToOne, OneToMany } from 'typeorm';

import { LocaleString, Translatable, Translation } from '../../common/types/locale-types';
import { VendureEntity } from '../base/base.entity';
import { CustomProductVariantFields } from '../custom-entity-fields';
import { FacetValue } from '../facet-value/facet-value.entity';
import { ProductOption } from '../product-option/product-option.entity';
import { Product } from '../product/product.entity';

import { ProductVariantPrice } from './product-variant-price.entity';
import { ProductVariantTranslation } from './product-variant-translation.entity';

@Entity()
export class ProductVariant extends VendureEntity implements Translatable, HasCustomFields {
    constructor(input?: DeepPartial<ProductVariant>) {
        super(input);
    }

    name: LocaleString;

    @Column() sku: string;

    /**
     * A synthetic property which is populated with data from a ProductVariantPrice entity.
     * It is marked as a @Column() so that changes to it will trigger the afterUpdate subscriber.
     */
    @Column({
        name: 'lastPriceValue',
        comment: 'Not used - actual price is stored in product_variant_price table',
    })
    price: number;

    /**
     * A synthetic property which is populated with data from a ProductVariantPrice entity.
     */
    priceBeforeTax: number;

    /**
     * A synthetic property which is populated with data from a ProductVariantPrice entity.
     */
    taxCategory: {
        id: ID;
        name: string;
        taxRate: number;
    };

    @OneToMany(type => ProductVariantPrice, price => price.variant, { eager: true })
    productVariantPrices: ProductVariantPrice[];

    @OneToMany(type => ProductVariantTranslation, translation => translation.base, { eager: true })
    translations: Array<Translation<ProductVariant>>;

    @ManyToOne(type => Product, product => product.variants)
    product: Product;

    @ManyToMany(type => ProductOption)
    @JoinTable()
    options: ProductOption[];

    @ManyToMany(type => FacetValue)
    @JoinTable()
    facetValues: FacetValue[];

    @Column(type => CustomProductVariantFields)
    customFields: CustomProductVariantFields;
}
