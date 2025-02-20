<?php

declare(strict_types=1);

namespace App\Domains\Integrations\PostIt\Dto;

class PostItAddressDTO
{
    public function __construct(
        public ?string $postCode,
        public ?string $address,
        public ?string $street,
        public ?string $number,
        public ?string $onlyNumber,
        public ?string $housing,
        public ?string $city,
        public ?string $municipality,
        public ?string $post,
        public ?string $mailbox,
        public ?string $company,
    ) {
    }
}
