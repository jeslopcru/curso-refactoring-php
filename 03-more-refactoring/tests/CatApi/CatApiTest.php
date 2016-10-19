<?php

namespace CatApi\Tests;

use CatApi\CatApi;

class CatApiTest extends \PHPUnit_Framework_TestCase
{
    protected function tearDown()
    {
        @unlink(__DIR__ . '/../../cache/random');
    }

    /** @test */
    public function it_fetches_a_random_url_of_a_cat_gif()
    {
        $catApi = new CatApi();

        $url = $catApi->getRandomImage();

        $this->assertTrue(filter_var($url, FILTER_VALIDATE_URL) !== false);
    }

    /** @test */
    public function it_caches_a_random_cat_gif_url_for_3_seconds()
    {
        $catApi = new CatApi();

        $firstUrl = $catApi->getRandomImage();
        sleep(2);
        $secondUrl = $catApi->getRandomImage();
        sleep(2);
        $thirdUrl = $catApi->getRandomImage();

        $this->assertSame($firstUrl, $secondUrl);
        $this->assertNotSame($secondUrl, $thirdUrl);
    }
}
