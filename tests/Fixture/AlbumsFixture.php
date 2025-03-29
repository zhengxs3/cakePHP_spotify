<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AlbumsFixture
 */
class AlbumsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'created' => '2025-03-29 15:30:50',
                'modified' => '2025-03-29 15:30:50',
                'name' => 'Lorem ipsum dolor sit amet',
                'release_year' => 'Lorem ipsum dolor sit amet',
                'artist_id' => 1,
                'url' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
