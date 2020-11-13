<?php

namespace FondOfSpryker\Zed\PriceProductPriceListPageSearch\Communication\Plugin\Search;

use FondOfSpryker\Shared\PriceProductPriceListPageSearch\PriceProductPriceListPageSearchConstants;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\PageMapTransfer;
use Spryker\Zed\Search\Business\Model\Elasticsearch\DataMapper\PageMapBuilderInterface;

class PriceProductAbstractPriceListPageMapPlugin extends AbstractPriceProductPriceListPageMapPlugin
{
    protected const KEY_ID_PRODUCT_ABSTRACT = 'id_product_abstract';
    protected const TYPE_PRICE_PRODUCT_ABSTRACT_PRICE_LIST = 'price_product_abstract_price_list';

    /**
     * {@inheritdoc}
     *
     * @return string
     * @api
     *
     */
    public function getName(): string
    {
        return PriceProductPriceListPageSearchConstants::PRICE_PRODUCT_ABSTRACT_PRICE_LIST_RESOURCE_NAME;
    }

    /**
     * @return string
     */
    protected function getKeyIdProduct(): string
    {
        return static::KEY_ID_PRODUCT_ABSTRACT;
    }

    /**
     * @return string
     */
    protected function getTypeProductPriceList(): string
    {
        return static::TYPE_PRICE_PRODUCT_ABSTRACT_PRICE_LIST;
    }

    /**
     * @param \Generated\Shared\Transfer\PageMapTransfer $pageMapTransfer
     * @param \Spryker\Zed\Search\Business\Model\Elasticsearch\DataMapper\PageMapBuilderInterface $pageMapBuilder
     * @param array $data
     * @param \Generated\Shared\Transfer\LocaleTransfer $locale
     *
     * @return \Generated\Shared\Transfer\PageMapTransfer
     */
    protected function expandPageMap(
        PageMapTransfer $pageMapTransfer,
        PageMapBuilderInterface $pageMapBuilder,
        array $data,
        LocaleTransfer $locale
    ): PageMapTransfer {
        $priceProductAbstractPriceListPageMapExpanderPlugins = $this->getFactory()
            ->getPriceProductAbstractPriceListPageMapExpanderPlugins();

        foreach ($priceProductAbstractPriceListPageMapExpanderPlugins as $priceProductAbstractPriceListPageMapExpanderPlugin) {
            $pageMapTransfer = $priceProductAbstractPriceListPageMapExpanderPlugin
                ->expand($pageMapTransfer, $pageMapBuilder, $data, $locale);
        }

        return $pageMapTransfer;
    }
}
