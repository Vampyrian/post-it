<?php

declare(strict_types=1);

namespace Vampyrian\PostIt\ValueObjects;

use App\Domains\Integrations\PostIt\Dto\PostItAddressDTO;

class Mapper
{
    /**
     * @param object{"post_code": string, "address": string, "street": string, "number": string, "only_number": string, "housing": string, "city": string, "municipality": string, "post": string, "mailbox": string, "company": string} $stdClass
     * @return PostItAddressDTO
     */
    public static function map(object $stdClass): PostItAddressDTO
    {
        return new PostItAddressDTO(
            postCode: self::getNullOrString($stdClass->post_code),
            address: self::getNullOrString($stdClass->address),
            street: self::getNullOrString($stdClass->street),
            number: self::getNullOrString($stdClass->number),
            onlyNumber: self::getNullOrString($stdClass->only_number),
            housing: self::getNullOrString($stdClass->housing),
            city: self::getNullOrString($stdClass->city),
            municipality: self::getNullOrString($stdClass->municipality),
            post: self::getNullOrString($stdClass->post),
            mailbox: self::getNullOrString($stdClass->mailbox),
            company: self::getNullOrString($stdClass->company)
        );
    }

    private static function getNullOrString(string $input): ?string
    {
        return strlen($input) > 0 ? $input : null;
    }

}
