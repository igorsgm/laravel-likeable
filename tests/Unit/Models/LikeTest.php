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

use Igorsgm\Likeable\Models\Like;
use Igorsgm\Likeable\Tests\TestCase;

/**
 * Class LikeTest.
 *
 * @package Igorsgm\Likeable\Tests\Unit\Models
 */
class LikeTest extends TestCase
{
    /** @test */
    public function it_can_fill_user_id()
    {
        $like = new Like([
            'user_id' => 4,
        ]);

        $this->assertEquals(4, $like->user_id);
    }

    /** @test */
    public function it_can_fill_type_id()
    {
        $like = new Like([
            'type_id' => 2,
        ]);

        $this->assertEquals(2, $like->type_id);
    }
}
