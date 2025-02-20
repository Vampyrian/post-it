<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Vampyrian\PostIt\PostIt;

class ExampleTest extends TestCase
{
    public function testExample(): void
    {
        $new  = new PostIt();
        $this->assertTrue(true);
    }
}
