<?php

/*
 * This file is part of Laravel Likeable.
 *
 * (c) Anton Komarev <anton@komarev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Igorsgm\Likeable\Tests\Unit\Models;

use Igorsgm\Likeable\Models\LikeCounter;
use Igorsgm\Likeable\Tests\TestCase;

/**
 * Class LikeCounterTest.
 *
 * @package Igorsgm\Likeable\Tests\Unit\Models
 */
class LikeCounterTest extends TestCase
{
    /** @test */
    public function it_can_fill_count()
    {
        $counter = new LikeCounter([
            'count' => 4,
        ]);

        $this->assertEquals(4, $counter->count);
    }

    /** @test */
    public function it_can_fill_type_id()
    {
        $counter = new LikeCounter([
            'type_id' => 2,
        ]);

        $this->assertEquals(2, $counter->type_id);
    }

    /** @test */
    public function it_casts_count_to_interger()
    {
        $like = new LikeCounter([
            'count' => '4',
        ]);

        $this->assertTrue(is_int($like->count));
    }
}
