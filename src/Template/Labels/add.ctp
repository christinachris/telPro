<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Label $label
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Labels'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="labels form large-9 medium-8 columns content">
    <?= $this->Form->create($label) ?>
    <fieldset>
        <legend><?= __('Add Label') ?></legend>
        <?php
            echo $this->Form->control('label_name');
            echo $this->Form->control('label_colour');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
