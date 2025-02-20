<?php

declare(strict_types=1);

namespace Vampyrian\PostIt\ValueObjects;

class PostItResponse
{
    /**
     * @param int $totalAddresses
     * @param int $totalPages
     * @param int $currentPage
     * @param PostItAddress[] $addresses
     */
    public function __construct(
        public int $totalAddresses,
        public int $totalPages,
        public int $currentPage,
        public array $addresses,
    ) {
    }
}
