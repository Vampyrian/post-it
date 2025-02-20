<?php

namespace Unit;

use PHPUnit\Framework\TestCase;
use Vampyrian\PostIt\PostIt;

class UrlConstructorTest extends TestCase
{
    public function testSearchParams(): void
    {
        $debugUrl = PostIt::key('key')
            ->whereCity('my_city')
            ->wherePost('my_post')
            ->whereMunicipality('my_municipality')
            ->whereCity('my_city')
            ->whereAddress('my_address')
            ->whereStreet('my_street')
            ->whereNumber('my_number')
            ->limit(20)
            ->page(3)
            ->getUrl();

        $this->assertEquals('https://api.postit.lt/v2/?key=key&city=my_city&post=my_post&municipality=my_municipality&address=my_address&street=my_street&number=my_number&limit=20&page=3', $debugUrl);
    }

    public function testGroup(): void
    {
        $debugUrl = PostIt::key('key')
            ->groupByCity()
            ->getUrl();

        $this->assertEquals('https://api.postit.lt/v2/?key=key&group=city', $debugUrl);

        $debugUrl = PostIt::key('key')
            ->groupByMunicipality()
            ->getUrl();

        $this->assertEquals('https://api.postit.lt/v2/?key=key&group=municipality', $debugUrl);


        $debugUrl = PostIt::key('key')
            ->groupByMunicipalityCity()
            ->getUrl();

        $this->assertEquals('https://api.postit.lt/v2/?key=key&group=municipality_city', $debugUrl);

        $debugUrl = PostIt::key('key')
            ->groupByStreet()
            ->getUrl();

        $this->assertEquals('https://api.postit.lt/v2/?key=key&group=street', $debugUrl);
    }

    public function testOrder(): void
    {
        $debugUrl = PostIt::key('key')
            ->orderByPostCode()
            ->orderByCity()
            ->orderByAddress()
            ->orderByStreet()
            ->orderByNumber()
            ->orderByMunicipalitySize()
            ->orderByMunicipality()
            ->orderByPost()
            ->getUrl();

        $this->assertEquals('https://api.postit.lt/v2/?key=key&&order=post_code-asc&order=city-asc&order=address-asc&order=street-asc&order=number-asc&order=municipality_size-asc&order=municipality-asc&order=post-asc', $debugUrl);

        $debugUrl = PostIt::key('key')
            ->orderByPostCodeDesc()
            ->orderByCityDesc()
            ->orderByAddressDesc()
            ->orderByStreetDesc()
            ->orderByNumberDesc()
            ->orderByMunicipalitySizeDesc()
            ->orderByMunicipalityDesc()
            ->orderByPostDesc()
            ->getUrl();

        $this->assertEquals('https://api.postit.lt/v2/?key=key&&order=post_code-desc&order=city-desc&order=address-desc&order=street-desc&order=number-desc&order=municipality_size-desc&order=municipality-desc&order=post-desc', $debugUrl);

    }
}
