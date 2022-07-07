<?php

/*
 * This file is part of Laravel Likeable.
 *
 * (c) Anton Komarev <anton@komarev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Igorsgm\Likeable\Tests\Stubs\Models;

use Igorsgm\Likeable\Contracts\Likeable as LikeableContract;
use Igorsgm\Likeable\Traits\Likeable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EntityWithMorphMap.
 *
 * @package Igorsgm\Likeable\Tests\Stubs\Models
 */
class EntityWithMorphMap extends Model implements LikeableContract
{
    use Likeable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'entities_with_morph_map';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];
}
