<?php

namespace FondOfSpryker\Client\PriceProductPriceListPageSearch\Config;

use Generated\Shared\Transfer\PaginationConfigTransfer;

interface PaginationConfigBuilderInterface
{
    /**
     * @param \Generated\Shared\Transfer\PaginationConfigTransfer $paginationConfigTransfer
     *
     * @return void
     */
    public function setPaginationConfigTransfer(PaginationConfigTransfer $paginationConfigTransfer): void;

    /**
     * @return \Generated\Shared\Transfer\PaginationConfigTransfer
     */
    public function getPaginationConfigTransfer(): PaginationConfigTransfer;

    /**
     * @param array $requestParameters
     *
     * @return int
     */
    public function getCurrentPage(array $requestParameters): int;

    /**
     * @param array $requestParameters
     *
     * @return int
     */
    public function getCurrentItemsPerPage(array $requestParameters): int;
}
