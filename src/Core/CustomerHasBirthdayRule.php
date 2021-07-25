<?php declare(strict_types=1);

namespace BirthdayRule\Core;

use Shopware\Core\Checkout\CheckoutRuleScope;
use Shopware\Core\Framework\Rule\Rule;
use Shopware\Core\Framework\Rule\RuleScope;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class CustomerHasBirthdayRule extends Rule
{
    /**
     * @var bool
     */
    protected $hasBirthday;

    public function __construct(bool $hasBirthday = true)
    {
        parent::__construct();
        $this->hasBirthday = $hasBirthday;
    }

    public function match(RuleScope $scope): bool
    {
        if (!$scope instanceof CheckoutRuleScope) {
            return false;
        }

        if (!$customer = $scope->getSalesChannelContext()->getCustomer()) {
            return false;
        }
        if (!$birthday = $customer->getBirthday()) {
            return false;
        }

        $today = (new \DateTimeImmutable())->format('m-d');
        $birthday = $birthday->format('m-d');

        return ($birthday === $today) === $this->hasBirthday;
    }

    public function getConstraints(): array
    {
        return [
            'hasBirthday' => [new NotBlank(), new Type('bool')],
        ];
    }

    public function getName(): string
    {
        return 'customerHasBirthday';
    }
}
