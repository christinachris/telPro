<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Speciality $speciality
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Specialities'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Talents'), ['controller' => 'Talents', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Talent'), ['controller' => 'Talents', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="specialities form large-9 medium-8 columns content">
    <?= $this->Form->create($speciality) ?>
    <fieldset>
        <legend><?= __('Add Speciality') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
