<?php

/*
 * This file is part of Laravel Likeable.
 *
 * (c) Anton Komarev <anton@komarev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Igorsgm\Likeable\Events;

use Igorsgm\Likeable\Contracts\Likeable as LikeableContract;

/**
 * Class ModelWasLiked.
 *
 * @package Igorsgm\Likeable\Events
 */
class ModelWasLiked
{
    /**
     * The liked model.
     *
     * @var \Igorsgm\Likeable\Contracts\Likeable
     */
    public $model;

    /**
     * User id who liked model.
     *
     * @var int
     */
    public $likerId;

    /**
     * Create a new event instance.
     *
     * @param \Igorsgm\Likeable\Contracts\Likeable $likeable
     * @param int $likerId
     * @return void
     */
    public function __construct(LikeableContract $likeable, $likerId)
    {
        $this->model = $likeable;
        $this->likerId = $likerId;
    }
}
