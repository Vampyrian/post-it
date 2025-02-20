<?php

declare(strict_types=1);

namespace App\Domains\Integrations\PostIt\Dto;

class PostItResponseDTO
{
    /**
     * @param int $totalAddresses
     * @param int $totalPages
     * @param int $currentPage
     * @param PostItAddressDTO[] $addresses
     */
    public function __construct(
        public int $totalAddresses,
        public int $totalPages,
        public int $currentPage,
        public array $addresses,
    ) {
    }
}
