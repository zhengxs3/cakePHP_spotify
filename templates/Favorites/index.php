<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Favorite> $favorites
 */
?>
<div class="favorites index content">
    <h3><?= __('Favorites') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('artist_id') ?></th>
                    <th><?= $this->Paginator->sort('album_id') ?></th>
                    <th><?= $this->Paginator->sort('type') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($favorites as $favorite): ?>
                <tr>
                    <td><?= $favorite->hasValue('artist') ? $this->Html->link($favorite->artist->name, ['controller' => 'Artists', 'action' => 'view', $favorite->artist->id]) : '' ?></td>
                    <td>
                        <?php if ($favorite->type === 'album' && $favorite->hasValue('album') && $favorite->album->url): ?>
                            <iframe 
                                src="<?= h($favorite->album->url) ?>" 
                                width="270" height="80" 
                                frameborder="0" allowtransparency="true" 
                                allow="encrypted-media">
                            </iframe>
                        <?php elseif ($favorite->hasValue('album')): ?>
                            <?= h($favorite->album->name) ?>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?= $this->Form->create(null, ['url' => ['controller' => 'Albums', 'action' => 'toggleFavorite', $favorite->album_id]]) ?>
                        <?= $this->Form->hidden('type', ['value' => $favorite->type]) ?>
                        <?= $this->Form->button('❤️', [
                            'style' => 'background:none;border:none;font-size:20px',
                            'title' => 'Retirer des favoris'
                        ]) ?>
                        <?= $this->Form->end() ?>
                    </td>
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