<?php

declare(strict_types=1);

namespace Marketplace\Cart\Core\Application\Actions;

use Marketplace\Cart\Core\Application\Exception\CantPayCartException;
use Marketplace\Cart\Core\Application\Service\CartService;
use Marketplace\Cart\Infrastructure\Interfaces\OrderManagerInterface;
use Marketplace\Cart\Infrastructure\Interfaces\OrderRepositoryInterface;

class PayCartAction
{
    public function __construct(
        private OrderRepositoryInterface $orderRepository,
        private OrderManagerInterface $orderManager,
        private CartService $cartService
    ) {}

    /**
     * @throws CantPayCartException
     */
    public function run(int $userId, int $paymentMethodId): void
    {
        if ($this->orderRepository->isLastOrderIsNotPayed($userId)) {
            throw new CantPayCartException('Last order is not payed');
        }

        $order = $this->orderManager->createOrder($userId, $paymentMethodId);

        $this->orderManager->generateUrl($order);

        $this->cartService->deleteOldCartAndCreateNew($userId);
    }
}
