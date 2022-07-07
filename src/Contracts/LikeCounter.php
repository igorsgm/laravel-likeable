<?php

/*
 * This file is part of Laravel Likeable.
 *
 * (c) Anton Komarev <anton@komarev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Igorsgm\Likeable\Contracts;

/**
 * Interface LikeCounter.
 *
 * @property int type_id
 * @property int count
 * @package Igorsgm\Likeable\Contracts
 */
interface LikeCounter
{
    /**
     * Likeable model relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function likeable();
}
