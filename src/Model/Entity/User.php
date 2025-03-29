<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Authentication\PasswordHasher\DefaultPasswordHasher;

/**
 * User Entity
 *
 * @property int $id
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 * @property string $username
 * @property string $password
 * @property string $role
 *
 * @property \App\Model\Entity\Favorite[] $favorites
 * @property \App\Model\Entity\Request[] $requests
 */
class User extends Entity
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
        'username' => true,
        'password' => true,
        'role' => true,
        'favorites' => true,
        'requests' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var list<string>
     */
    protected array $_hidden = [
        'password',
    ];

    //hash le password automatiquement
    public function _setPassword(string $p) : ?string{
        if(strlen($p) > 0){
            return (new DefaultPasswordHasher())->hash($p);
        }
        return null;
    }
}
