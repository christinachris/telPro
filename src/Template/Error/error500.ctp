<?php
use Cake\Core\Configure;
use Cake\Error\Debugger;

$this->layout = 'error';

if (Configure::read('debug')) :
    $this->layout = 'dev_error';

    $this->assign('title', $message);
    $this->assign('templateName', 'error500.ctp');

    $this->start('file');
?>
<?php if (!empty($error->queryString)) : ?>
    <p class="notice">
        <strong>SQL Query: </strong>
        <?= h($error->queryString) ?>
    </p>
<?php endif; ?>
<?php if (!empty($error->params)) : ?>
        <strong>SQL Query Params: </strong>
       <?php Debugger::dump($error->params) ?>
<?php endif; ?>
<?php if ($error instanceof Error) : ?>
        <strong>Error in: </strong>
        <?= sprintf('%s, line %s', str_replace(ROOT, 'ROOT', $error->getFile()), $error->getLine()) ?>
<?php endif; ?>
<?php
    echo $this->element('auto_table_warning');

    if (extension_loaded('xdebug')) :
        xdebug_print_function_stack();
    endif;

    $this->end();
endif;
?>
<!--<h2>--><?//= __d('cake', 'An Internal Error Has Occurred') ?><!--</h2>-->
<!--<p class="error">-->
<!--    <strong>--><?//= __d('cake', 'Error') ?><!--: </strong>-->
<!--   <?//= h($message) ?> -->
<!--</p>-->
<div class="kt-grid kt-grid--ver kt-grid--root kt-page">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid  kt-error-v5" style="background-image: url(<?= $this->Url->image('error-1.jpg') ?>); ">
        <div class="kt-error_container">
		<span class="kt-error_title">
			<h1>Oops!</h1>
		</span>
            <p class="kt-error_subtitle">
                Something went wrong here.
            </p>
            <p class="kt-error_description">
                Error Code: 500 <br>
                Please Contact the Site Administrator.
            </p>
        </div>
    </div>	</div>
