<?php

declare(strict_types=1);

namespace Vampyrian\PostIt;

use Vampyrian\PostIt\Enums\Order;
use Vampyrian\PostIt\Exceptions\PostItException;
use Vampyrian\PostIt\ValueObjects\PostItAddress;
use Vampyrian\PostIt\ValueObjects\PostItResponse;

class PostIt
{
    private string $baseUrl;

    /**
     * @var array{string, string}
     */
    private array $queryParams = [];

    /**
     * @var array{string, string}
     */
    private array $order = [];

    private function __construct(private string $apiKey)
    {
        $this->baseUrl = 'https://api.postit.lt/v2/?key=' . $apiKey;
    }

    public static function key(string $apiKey): self
    {
        return new self($apiKey);
    }

    public function wherePostCode(string $postCode): self
    {
        $this->queryParams['post_code'] = $postCode;
        return $this;
    }

    public function wherePost(string $post): self
    {
        $this->queryParams['post'] = $post;
        return $this;
    }

    public function whereMunicipality(string $municipality): self
    {
        $this->queryParams['municipality'] = $municipality;
        return $this;
    }

    public function whereCity(string $city): self
    {
        $this->queryParams['city'] = $city;
        return $this;
    }

    public function whereAddress(string $address): self
    {
        $this->queryParams['address'] = $address;
        return $this;
    }

    public function whereStreet(string $street): self
    {
        $this->queryParams['street'] = $street;
        return $this;
    }

    public function whereNumber(string $number): self
    {
        $this->queryParams['number'] = $number;
        return $this;
    }

    public function limit(int $limit): self
    {
        $this->queryParams['limit'] = $limit;
        return $this;
    }

    public function page(int $page): self
    {
        $this->queryParams['page'] = $page;
        return $this;
    }

    public function wideNumberOn(): self
    {
        $this->queryParams['wide_number'] = 1;
        return $this;
    }

    public function wideNumberOff(): self
    {
        $this->queryParams['wide_number'] = 0;
        return $this;
    }

    public function groupByMunicipality(): self
    {
        $this->queryParams['group'] = 'municipality';
        return $this;
    }

    public function groupByMunicipalityCity(): self
    {
        $this->queryParams['group'] = 'municipality_city';
        return $this;
    }

    public function groupByCity(): self
    {
        $this->queryParams['group'] = 'city';
        return $this;
    }

    public function groupByStreet(): self
    {
        $this->queryParams['group'] = 'street';
        return $this;
    }

    public function orderByPostCode(): self
    {
        $this->order['post_code'] = Order::ASC;
        return $this;
    }

    public function orderByPostCodeDesc(): self
    {
        $this->order['post_code'] = Order::DESC;
        return $this;
    }

    public function orderByCity(): self
    {
        $this->order['city'] = Order::ASC;
        return $this;
    }

    public function orderByCityDesc(): self
    {
        $this->order['city'] = Order::DESC;
        return $this;
    }

    public function orderByAddress(): self
    {
        $this->order['address'] = Order::ASC;
        return $this;
    }

    public function orderByAddressDesc(): self
    {
        $this->order['address'] = Order::DESC;
        return $this;
    }

    public function orderByStreet(): self
    {
        $this->order['street'] = Order::ASC;
        return $this;
    }

    public function orderByStreetDesc(): self
    {
        $this->order['street'] = Order::DESC;
        return $this;
    }

    public function orderByNumber(): self
    {
        $this->order['number'] = Order::ASC;
        return $this;
    }

    public function orderByNumberDesc(): self
    {
        $this->order['number'] = Order::DESC;
        return $this;
    }

    public function orderByMunicipality(): self
    {
        $this->order['municipality'] = Order::ASC;
        return $this;
    }

    public function orderByMunicipalityDesc(): self
    {
        $this->order['municipality'] = Order::DESC;
        return $this;
    }

    public function orderByMunicipalitySize(): self
    {
        $this->order['municipality_size'] = Order::ASC;
        return $this;
    }

    public function orderByMunicipalitySizeDesc(): self
    {
        $this->order['municipality_size'] = Order::DESC;
        return $this;
    }

    public function orderByPost(): self
    {
        $this->order['post'] = Order::ASC;
        return $this;
    }

    public function orderByPostDesc(): self
    {
        $this->order['post'] = Order::DESC;
        return $this;
    }

    /**
     * @throws PostItException
     */
    public function get(): PostItResponse
    {
        $url = $this->getUrl();
        $response = file_get_contents($url);
        $json = json_decode($response);

        if ($json->success === false) {
            throw new PostItException(message: $json->message, code: $json->message_code);
        }

        return new PostItResponse(
            totalAddresses: $json->total,
            totalPages: $json->page->total,
            currentPage: $json->page->current,
            addresses: array_map(fn (object $std) => PostItAddress::fromResponseObject($std), $json->data),
        );
    }

    public function getUrl(): string
    {
        $url = $this->baseUrl;
        $url = $url . '&' . http_build_query($this->queryParams);
        foreach ($this->order as $key => $order) {
            $url = $url . '&' . 'order=' . $key . '-' . $order->value;
        }
        return $url;
    }

    /**
     * @param array<string, string> $queryParams
     * @throws PostItException
     */
    private function makeRequest(array $queryParams): PostItResponse
    {
        $url = $this->baseUrl . http_build_query($queryParams);
        $response = file_get_contents($url);
        $json = json_decode($response);

        if ($json->success === false) {
            throw new PostItException(message: $json->message, code: $json->message_code);
        }

        return new PostItResponse(
            totalAddresses: $json->total,
            totalPages: $json->page->total,
            currentPage: $json->page->current,
            addresses: array_map(fn (object $std) => PostItAddress::fromResponseObject($std), $json->data),
        );
    }
}
