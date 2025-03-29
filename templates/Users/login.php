<h1> Connexion </h1>

<?= $this->Form->create() ?>
    <?= $this->Form->control('username') ?>
    <?= $this->Form->control('password') ?>
    <?= $this->Form->button('Se connecer') ?>

<?= $this->Form->end() ?>

<p>Vous n'avez pas de compte ? 
   <?= $this->Html->link('Créer un compte', ['controller' => 'Users', 'action' => 'add']) ?>
</p>
