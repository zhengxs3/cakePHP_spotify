<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Artist> $artists
 */
?>
<div class="artists index content">
    <?= $this->Html->link(__('New Artist'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Artists') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('albums') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($artists as $artist): ?>
                <tr>
                    <td><?= $this->Number->format($artist->id) ?></td>
                    <td><?= $this->Html->link($artist->name, ['controller' => 'Artists', 'action' => 'view', $artist->id])?></td>
                    <td><iframe src="<?= h($artist->url) ?>" width="270" height="80" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe></td>
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