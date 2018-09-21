<?php

    namespace Webkul\Product\Contracts\Criteria;

    use Prettus\Repository\Contracts\CriteriaInterface;
    use Prettus\Repository\Contracts\RepositoryInterface;
    use Webkul\Product\Models\ProductAttributeValue;
    use Webkul\Attribute\Repositories\AttributeRepository;
    use Webkul\Product\Product\AbstractProduct;

    /**
    * Class FilterByNameCriteria.
    *
    * @package namespace App\Criteria;
    */
    class FilterByNameCriteria extends AbstractProduct implements CriteriaInterface
    {
        /**
        * @var AttributeRepository
        */
        protected $attribute;

        /**
    * @var array|string
    */
        protected $attributeToSelect;

        /**
        * @param Webkul\Attribute\Repositories\AttributeRepository $attribute
        * @return void
        */
        public function __construct(AttributeRepository $attribute)
        {
            $this->attribute = $attribute;
        }

        /**
        * Set attributes in attributeToSelect variable
        *
        * @param array|string $attributes
        *
        * @return mixed
        */
        public function addFilterByNameCriteria($attributes)
        {
            $this->attributeToSelect = $attributes;

            return $this;
        }

        /**
        * Apply criteria in query repository
        *
        * @param string $model
        * @param RepositoryInterface $repository
        *
        * @return mixed
        */
        public function apply($model, RepositoryInterface $repository)
        {

            $model = $model->select('products.*');

            $attribute = $this->attribute->findOneByField('code', 'name');

            $code = $attribute->code;

            if(!$attribute)
                $model;

            $productValueAlias = 'pav_' . $attribute->code;

            $model = $model->leftJoin('product_attribute_values as ' . $productValueAlias, function($qb) use($attribute, $productValueAlias, $code) {

                $qb = $this->applyChannelLocaleFilter($attribute, $qb, $productValueAlias);
                $qb->on('products.id', $productValueAlias . '.product_id');
            })
                ->where($productValueAlias . '.attribute_id', $attribute->id)
                ->where($productValueAlias . '.' . ProductAttributeValue::$attributeTypeFields[$attribute->type], 'like', '%'.$this->attributeToSelect[0].'%');

            //dd($productValueAlias . '.' . ProductAttributeValue::$attributeTypeFields[$attribute->type] . ' as ' .$code);
            $model = $model->addSelect($productValueAlias . '.' . ProductAttributeValue::$attributeTypeFields[$attribute->type] . ' as ' .$code );

            return $model;
        }
}