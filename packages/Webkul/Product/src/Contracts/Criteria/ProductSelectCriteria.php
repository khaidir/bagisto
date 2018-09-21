<?php

namespace Webkul\Product\Contracts\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;
use Webkul\Product\Models\ProductAttributeValue;
use Webkul\Attribute\Repositories\AttributeRepository;
use Webkul\Product\Product\AbstractProduct;
/**
 * Class MyCriteria.
 *
 * @package namespace App\Criteria;
 */
class ProductSelectCriteria implements CriteriaInterface
{

    /**
     * @param  integer $searchval
     * @return void
     */

    /**
     * Apply criteria in query repository
     *
     * @param string              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model->leftJoin('product_categories', 'products.id', '=', 'product_categories.product_id')->where('products.sku','like','%'.'kd'.'%');
        dd('pallavi');
        $model = $this->attribute_values()->where('attribute_id', '2')->first();
        dd($model);
        return $model;
    }

    public function productList($model, RepositoryInterface $repository){
        $model = $model->select('products.*');

        $attribute = $this->attribute->findOneByField('code', 'name');

        if(!$attribute)
            $model;

        $productValueAlias = 'pav_' . $attribute->code;

        $model = $model->leftJoin('product_attribute_values as ' . $productValueAlias, function($qb) use($attribute, $productValueAlias) {

            $qb = $this->applyChannelLocaleFilter($attribute, $qb, $productValueAlias);

            $qb->on('products.id', $productValueAlias . '.product_id')
                    ->where($productValueAlias . '.attribute_id', $attribute->id);
        });

        $model = $model->addSelect($productValueAlias . '.' . ProductAttributeValue::$attributeTypeFields[$attribute->type] . ' as ' . $code);

        return $model;
    }
}
