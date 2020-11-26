<?php

namespace FondOfSpryker\Zed\PriceProductPriceListPageSearch\Communication\Console;

use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\PriceProductPriceListPageSearchFacadeInterface getFacade()
 * @method \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Persistence\PriceProductPriceListPageSearchQueryContainerInterface getQueryContainer()
 * @method \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Persistence\PriceProductPriceListPageSearchRepositoryInterface getRepository()
 * @method \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Communication\PriceProductPriceListPageSearchCommunicationFactory getFactory()
 */
class PriceProductPriceListPageSearchPublishConsole extends Console
{
    public const COMMAND_NAME = 'price-product-price-list:publish';
    public const DESCRIPTION = 'Publish resource price_product_[abstract|concrete]_price_list by idPriceList.';
    public const TYPE_OPTION = 'type';
    public const TYPE_OPTION_SHORTCUT = 't';
    public const ID_PRICE_LIST_OPTION = 'id-price-list';
    public const ID_PRICE_LIST_OPTION_SHORTCUT = 'i';

    protected const TYPE_ABSTRACT = 'abstract';
    protected const TYPE_CONCRETE = 'concrete';

    protected const ERROR_MESSAGE = '<error>The option "type" can only be "abstract" or "concrete".</error>';

    /**
     * @return void
     */
    protected function configure(): void
    {
        $this->addOption(static::TYPE_OPTION, static::TYPE_OPTION_SHORTCUT, InputArgument::OPTIONAL);
        $this->addOption(static::ID_PRICE_LIST_OPTION, static::ID_PRICE_LIST_OPTION_SHORTCUT, InputArgument::OPTIONAL);

        $this->setName(static::COMMAND_NAME)
            ->setDescription(static::DESCRIPTION)
            ->addUsage(sprintf('-%s type -%s 1', static::TYPE_OPTION_SHORTCUT, static::ID_PRICE_LIST_OPTION_SHORTCUT));
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $type = $input->getOption(static::TYPE_OPTION);
        $idPriceList = $input->getOption(static::ID_PRICE_LIST_OPTION);

        switch ($type) {
            case static::TYPE_ABSTRACT:
                $this->getFacade()->publishAbstractPriceProductPriceListByIdPriceList($idPriceList);

                break;
            case static::TYPE_CONCRETE:
                $this->getFacade()->publishConcretePriceProductPriceListByIdPriceList($idPriceList);

                break;
            default:
                $output->writeln(static::ERROR_MESSAGE);
        }

        return 0;
    }
}
