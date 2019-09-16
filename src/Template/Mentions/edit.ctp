<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Mention $mention
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $mention->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $mention->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Mentions'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Talents'), ['controller' => 'Talents', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Talent'), ['controller' => 'Talents', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tasks'), ['controller' => 'Tasks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Task'), ['controller' => 'Tasks', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="mentions form large-9 medium-8 columns content">
    <?= $this->Form->create($mention) ?>
    <fieldset>
        <legend><?= __('Edit Mention') ?></legend>
        <?php
            echo $this->Form->control('talent_id', ['options' => $talents, 'empty' => true]);
            echo $this->Form->control('mention_date', ['empty' => true]);
            echo $this->Form->control('project_id', ['options' => $projects, 'empty' => true]);
            echo $this->Form->control('task_id', ['options' => $tasks, 'empty' => true]);
            echo $this->Form->control('user_id', ['options' => $users, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
