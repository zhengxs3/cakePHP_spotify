<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Request Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $type
 * @property string $name
 * @property string|null $release_year
 * @property int|null $artist_id
 * @property string $url
 * @property string|null $status
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Artist $artist
 */
class Request extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'user_id' => true,
        'type' => true,
        'name' => true,
        'release_year' => true,
        'artist_id' => true,
        'url' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'artist' => true,
    ];
}
