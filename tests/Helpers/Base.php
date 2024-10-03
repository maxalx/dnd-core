<?php
declare(strict_types=1);
namespace MaxAlx\DnD\Tests\Helpers;

use Faker\Factory as FakerFactory;
use Faker\Generator as Faker;

class Base
{
    protected Faker $faker;

    public function __construct()
    {
        $this->faker = FakerFactory::create();
    }
}