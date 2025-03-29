<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Favorite $favorite
 * @var \Cake\Collection\CollectionInterface|string[] $users
 * @var \Cake\Collection\CollectionInterface|string[] $artists
 * @var \Cake\Collection\CollectionInterface|string[] $albums
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Favorites'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="favorites form content">
            <?= $this->Form->create($favorite) ?>
            <fieldset>
                <legend><?= __('Add Favorite') ?></legend>
                <?php
                    echo $this->Form->control('user_id', ['options' => $users]);
                    echo $this->Form->control('artist_id', ['options' => $artists]);
                    echo $this->Form->control('album_id', ['options' => $albums]);
                    echo $this->Form->control('type');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
