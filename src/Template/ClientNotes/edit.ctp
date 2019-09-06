<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ClientNote $clientNote
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $clientNote->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $clientNote->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Client Notes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Clients'), ['controller' => 'Clients', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Client'), ['controller' => 'Clients', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="clientNotes form large-9 medium-8 columns content">
    <?= $this->Form->create($clientNote) ?>
    <fieldset>
        <legend><?= __('Edit Client Note') ?></legend>
        <?php
            echo $this->Form->control('create_date');
            echo $this->Form->control('content');
            echo $this->Form->control('edit_date');
            echo $this->Form->control('id_flag');
            echo $this->Form->control('client_id', ['options' => $clients, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
