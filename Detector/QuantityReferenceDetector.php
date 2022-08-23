<?php
/**
 * CoreShop.
 *
 * This source file is subject to the GNU General Public License version 3 (GPLv3)
 * For the full copyright and license information, please view the LICENSE.md and gpl-3.0.txt
 * files that are distributed with this source code.
 *
 * @copyright  Copyright (c) CoreShop GmbH (https://www.coreshop.org)
 * @license    https://www.coreshop.org/license     GPLv3 and CCL
 */

declare(strict_types=1);

namespace CoreShop\Component\ProductQuantityPriceRules\Detector;

use CoreShop\Component\ProductQuantityPriceRules\Fetcher\QuantityPriceFetcher;
use CoreShop\Component\ProductQuantityPriceRules\Fetcher\QuantityRuleFetcher;
use CoreShop\Component\ProductQuantityPriceRules\Model\ProductQuantityPriceRuleInterface;
use CoreShop\Component\ProductQuantityPriceRules\Model\QuantityRangeInterface;
use CoreShop\Component\ProductQuantityPriceRules\Model\QuantityRangePriceAwareInterface;

class QuantityReferenceDetector implements QuantityReferenceDetectorInterface
{
    public function __construct(private QuantityRuleFetcher $quantityRuleFetcher, private QuantityPriceFetcher $quantityPriceFetcher)
    {
    }

    public function detectRule(QuantityRangePriceAwareInterface $subject, array $context): ProductQuantityPriceRuleInterface
    {
        return $this->quantityRuleFetcher->fetch($subject, $context);
    }

    public function detectQuantityPrice(QuantityRangePriceAwareInterface $subject, float $quantity, int $originalPrice, array $context): int
    {
        $priceRule = $this->detectRule($subject, $context);

        return $this->quantityPriceFetcher->fetchQuantityPrice($priceRule, $subject, $quantity, $originalPrice, $context);
    }

    public function detectRangePrice(QuantityRangePriceAwareInterface $subject, QuantityRangeInterface $range, int $originalPrice, array $context): int
    {
        return $this->quantityPriceFetcher->fetchRangePrice($range, $subject, $originalPrice, $context);
    }
}
