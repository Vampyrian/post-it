<?php

declare(strict_types=1);

namespace Vampyrian\PostIt\ValueObjects;

class PostItAddress
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

    /**
     * @param object{"post_code": string, "address": string, "street": string, "number": string, "only_number": string, "housing": string, "city": string, "municipality": string, "post": string, "mailbox": string, "company": string} $stdClass
     * @return PostItAddress
     */
    public static function fromResponseObject(object $stdClass): self
    {
        return new self(
            postCode: strlen($stdClass->post_code) > 0 ? $stdClass->post_code : null,
            address: strlen($stdClass->address) > 0 ? $stdClass->address : null,
            street: strlen($stdClass->street) > 0 ? $stdClass->street : null,
            number: strlen($stdClass->number) > 0 ? $stdClass->number : null,
            onlyNumber: strlen($stdClass->only_number) > 0 ? $stdClass->only_number : null,
            housing: strlen($stdClass->housing) > 0 ? $stdClass->housing : null,
            city: strlen($stdClass->city) > 0 ? $stdClass->city : null,
            municipality: strlen($stdClass->city) > 0 ? $stdClass->city : null,
            post: strlen($stdClass->post) > 0 ? $stdClass->post : null,
            mailbox: strlen($stdClass->mailbox) > 0 ? $stdClass->mailbox : null,
            company: strlen($stdClass->company) > 0 ? $stdClass->company : null,
        );
    }
}
