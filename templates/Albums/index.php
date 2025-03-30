<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Album> $albums
 */

 $favoriteAlbumIds = $favoriteAlbumIds ?? [];
?>
<div class="albums index content">
    <?= $this->Html->link(__('New Album'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Albums') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= __('Favorite') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('artist_id') ?></th>
                    <th><?= $this->Paginator->sort('Album') ?></th>
                    <th><?= $this->Paginator->sort('release_year') ?></th>
                    
                </tr>
            </thead>
            <tbody>
                <?php foreach ($albums as $album): ?>
                <tr>
                    <td>
                        <?= $this->Form->create(null, ['url' => ['action' => 'toggleFavorite', $album->id]]) ?>
                        <?= $this->Form->hidden('type', ['value' => 'album']) ?>
                        <?= $this->Form->button(in_array($album->id, $favoriteAlbumIds) ? '❤️' : '🤍', [
                            'style' => 'background:none;border:none;font-size:20px'
                        ]) ?>
                        <?= $this->Form->end() ?>
                    </td>
                    <td><?= h($album->name) ?></td>
                    <td><?= $album->hasValue('artist') ? $this->Html->link($album->artist->name, ['controller' => 'Artists', 'action' => 'view', $album->artist->id]) : '' ?></td>
                    <td>
                        <iframe src="<?= h($album->url) ?>" width="270" height="80" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>
                    </td>
                    <td><?= h($album->release_year) ?></td>
                    
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>