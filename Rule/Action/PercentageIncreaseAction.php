<?php

declare(strict_types=1);

/*
 * CoreShop
 *
 * This source file is available under two different licenses:
 *  - GNU General Public License version 3 (GPLv3)
 *  - CoreShop Commercial License (CCL)
 * Full copyright and license information is available in
 * LICENSE.md which is distributed with this source code.
 *
 * @copyright  Copyright (c) CoreShop GmbH (https://www.coreshop.org)
 * @license    https://www.coreshop.org/license     GPLv3 and CCL
 *
 */

namespace CoreShop\Component\ProductQuantityPriceRules\Rule\Action;

use CoreShop\Component\ProductQuantityPriceRules\Model\QuantityRangeInterface;
use CoreShop\Component\ProductQuantityPriceRules\Model\QuantityRangePriceAwareInterface;

class PercentageIncreaseAction implements ProductQuantityPriceRuleActionInterface
{
    public function calculate(QuantityRangeInterface $range, QuantityRangePriceAwareInterface $subject, int $realItemPrice, array $context): int
    {
        return $realItemPrice + ((int) round(($range->getPercentage() / 100) * $realItemPrice));
    }
}
