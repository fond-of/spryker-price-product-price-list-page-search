<?php

namespace FondOfSpryker\Zed\PriceProductPriceListPageSearch\Communication\Plugin\Search;

use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\PageMapTransfer;
use Generated\Shared\Transfer\PriceProductPriceListPageSearchTransfer;
use Spryker\Shared\Kernel\Store;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Search\Business\Model\Elasticsearch\DataMapper\PageMapBuilderInterface;
use Spryker\Zed\Search\Dependency\Plugin\NamedPageMapInterface;

/**
 * @method \FondOfSpryker\Zed\PriceProductPriceListPageSearch\PriceProductPriceListPageSearchConfig getConfig()
 * @method \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\PriceProductPriceListPageSearchFacadeInterface getFacade()
 * @method \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Communication\PriceProductPriceListPageSearchCommunicationFactory getFactory()
 */
abstract class AbstractPriceProductPriceListPageMapPlugin extends AbstractPlugin implements NamedPageMapInterface
{
    protected const KEY_ID_PRICE_LIST = 'id_price_list';
    protected const KEY_SKU = 'sku';
    protected const KEY_PRICE_LIST_NAME = 'price_list_name';
    protected const KEY_PRICES = 'prices';

    /**
     * {@inheritdoc}
     *
     * @param \Spryker\Zed\Search\Business\Model\Elasticsearch\DataMapper\PageMapBuilderInterface $pageMapBuilder
     * @param array $data
     * @param \Generated\Shared\Transfer\LocaleTransfer $locale
     *
     * @return \Generated\Shared\Transfer\PageMapTransfer
     * @api
     *
     */
    public function buildPageMap(
        PageMapBuilderInterface $pageMapBuilder,
        array $data,
        LocaleTransfer $locale
    ): PageMapTransfer {
        $store = Store::getInstance()->getStoreName();

        if (array_key_exists(PriceProductPriceListPageSearchTransfer::STORE_NAME, $data)) {
            $store = $data[PriceProductPriceListPageSearchTransfer::STORE_NAME];
        }

        $pageMapTransfer = (new PageMapTransfer())
            ->setStore($store)
            ->setLocale($locale->getLocaleName())
            ->setType($this->getTypeProductPriceList())
            ->setIsActive(true)
            ->setPriceList($data[PriceProductPriceListPageSearchTransfer::ID_PRICE_LIST]);

        $pageMapBuilder
            ->addSearchResultData(
                $pageMapTransfer,
                static::KEY_ID_PRICE_LIST,
                $data[PriceProductPriceListPageSearchTransfer::ID_PRICE_LIST]
            )->addSearchResultData(
                $pageMapTransfer,
                $this->getKeyIdProduct(),
                $data[PriceProductPriceListPageSearchTransfer::ID_PRODUCT]
            )->addSearchResultData(
                $pageMapTransfer,
                static::KEY_PRICE_LIST_NAME,
                $data[PriceProductPriceListPageSearchTransfer::PRICE_LIST_NAME]
            )->addSearchResultData(
                $pageMapTransfer,
                static::KEY_SKU,
                $data[PriceProductPriceListPageSearchTransfer::SKU]
            )->addSearchResultData(
                $pageMapTransfer,
                static::KEY_PRICES,
                $data[PriceProductPriceListPageSearchTransfer::PRICES]
            )->addFullTextBoosted($pageMapTransfer, $data[PriceProductPriceListPageSearchTransfer::PRICE_LIST_NAME])
            ->addFullTextBoosted($pageMapTransfer, $data[PriceProductPriceListPageSearchTransfer::SKU]);

        $pageMapTransfer = $this->expandPageMap($pageMapTransfer, $pageMapBuilder, $data, $locale);

        return $pageMapTransfer;
    }

    /**
     * @return string
     */
    abstract public function getName(): string;

    /**
     * @return string
     */
    abstract protected function getKeyIdProduct(): string;

    /**
     * @return string
     */
    abstract protected function getTypeProductPriceList(): string;

    /**
     * @param \Generated\Shared\Transfer\PageMapTransfer $pageMapTransfer
     * @param \Spryker\Zed\Search\Business\Model\Elasticsearch\DataMapper\PageMapBuilderInterface $pageMapBuilder
     * @param array $data
     * @param \Generated\Shared\Transfer\LocaleTransfer $locale
     *
     * @return \Generated\Shared\Transfer\PageMapTransfer
     */
    abstract protected function expandPageMap(
        PageMapTransfer $pageMapTransfer,
        PageMapBuilderInterface $pageMapBuilder,
        array $data,
        LocaleTransfer $locale
    ): PageMapTransfer;
}
