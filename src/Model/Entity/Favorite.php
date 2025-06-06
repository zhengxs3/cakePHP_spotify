<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Favorite Entity
 *
 * @property int $id
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 * @property int $user_id
 * @property int $artist_id
 * @property int $album_id
 * @property string $type
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Artist $artist
 * @property \App\Model\Entity\Album $album
 */
class Favorite extends Entity
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
        'created' => true,
        'modified' => true,
        'user_id' => true,
        'artist_id' => true,
        'album_id' => true,
        'type' => true,
        'user' => true,
        'artist' => true,
        'album' => true,
    ];
}
