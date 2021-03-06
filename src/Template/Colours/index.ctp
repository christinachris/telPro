<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Project[]|\Cake\Collection\CollectionInterface $projects
 */

// my_connection is defined in your database config
use Cake\Datasource\ConnectionManager;
use Cake\I18n\I18n;
use Cake\I18n\Time;

$conn = ConnectionManager::get('default');
?>

<div class="kt-header__bottom">
    <div class="kt-container">

        <!-- begin: Header Menu -->
        <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
            <div id="kt_header_menu" class="kt-header-menu">

                <ul class="kt-menu__nav ">
                    <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"><a href=" <?php echo $this->Url->build(["controller" => "dashboard", "action" => "index"]); ?>" class="kt-menu__link ">
                            <span class="kt-menu__link-text">Dashboard </span></a></li>
                    <li class="kt-menu__item  kt-menu__item--active " aria-haspopup="true"><a
                            href=" <?php echo $this->Url->build(["controller" => "projects", "action" => "index"]); ?>"
                            class="kt-menu__link "><span class="kt-menu__link-text">Projects </span></a></li>
                    <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel" aria-haspopup="true"><a
                            href="<?php echo $this->Url->build(['controller' => 'Talents', 'action' => 'index']) ?>"
                            class="kt-menu__link "><span class="kt-menu__link-text">Talent</span></a></li>
                    <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel" aria-haspopup="true"><a
                            href="<?php echo $this->Url->build(['controller' => 'Clients', 'action' => 'index']) ?>"
                            class="kt-menu__link "><span class="kt-menu__link-text">Client</span></a></li>
                </ul>

            </div>

        </div>
        <!-- end: Header Menu -->
    </div>
</div>
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-grid--stretch">
    <div class="kt-container kt-body  kt-grid kt-grid--ver" id="kt_body">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
            <!-- Header End -->
            <div class="kt-subheader   kt-grid__item" id="kt_subheader">
                <div class="kt-subheader__main">
                    <?= $this->Flash->render() ?>
                    <a href="<?php echo $this->Url->build(["controller" => "dashboard", "action" => "index"]); ?>"
                    <h3 class="kt-subheader__title">
                        Dashboard </h3>
                    </a>
                    <span class="kt-subheader__separator kt-hidden"></span>
                    <div class="kt-subheader__breadcrumbs">
                        <a href="<?php echo $this->Url->build(["controller" => "projects", "action" => "index"]); ?>"
                           class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        <a href="<?php echo $this->Url->build(["controller" => "projects", "action" => "index"]); ?>"
                           class="kt-subheader__breadcrumbs-link">
                            Labels </a>

                        <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
                    </div>
                </div>
                <div class="kt-subheader__toolbar">
                    <div class="kt-subheader__wrapper">
                        <div class="btn kt-subheader__btn-daterange" title="Select dashboard daterange">
                            <span class="kt-subheader__btn-daterange-title" id="kt_dashboard_daterangepicker_title">Today</span>&nbsp;
                            <span class="kt-subheader__btn-daterange-date"
                                  id="kt_dashboard_daterangepicker_date"><?php echo date("M d") ?></span>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 width="24px"
                                 height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--sm">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect id="bound" x="0" y="0" width="24" height="24"/>
                                    <path
                                        d="M4.875,20.75 C4.63541667,20.75 4.39583333,20.6541667 4.20416667,20.4625 L2.2875,18.5458333 C1.90416667,18.1625 1.90416667,17.5875 2.2875,17.2041667 C2.67083333,16.8208333 3.29375,16.8208333 3.62916667,17.2041667 L4.875,18.45 L8.0375,15.2875 C8.42083333,14.9041667 8.99583333,14.9041667 9.37916667,15.2875 C9.7625,15.6708333 9.7625,16.2458333 9.37916667,16.6291667 L5.54583333,20.4625 C5.35416667,20.6541667 5.11458333,20.75 4.875,20.75 Z"
                                        id="check" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                    <path
                                        d="M2,11.8650466 L2,6 C2,4.34314575 3.34314575,3 5,3 L19,3 C20.6568542,3 22,4.34314575 22,6 L22,15 C22,15.0032706 21.9999948,15.0065399 21.9999843,15.009808 L22.0249378,15 L22.0249378,19.5857864 C22.0249378,20.1380712 21.5772226,20.5857864 21.0249378,20.5857864 C20.7597213,20.5857864 20.5053674,20.4804296 20.317831,20.2928932 L18.0249378,18 L12.9835977,18 C12.7263047,14.0909841 9.47412135,11 5.5,11 C4.23590829,11 3.04485894,11.3127315 2,11.8650466 Z M6,7 C5.44771525,7 5,7.44771525 5,8 C5,8.55228475 5.44771525,9 6,9 L15,9 C15.5522847,9 16,8.55228475 16,8 C16,7.44771525 15.5522847,7 15,7 L6,7 Z"
                                        id="Combined-Shape" fill="#000000"/>
                                </g>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-content kt-grid__item kt-grid__item--fluid">
                <div class="col-8">
                    <div class="kt-portlet kt-portlet--height-fluid">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Labels Editing
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <!--begin: Datatable -->
                            <table class="table" id="myTable">
                                <thead>
                                <tr>
                                    <th scope="col"><?= $this->Paginator->sort('colour_id') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('colour_name') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('card_type') ?></th>
                                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($colours as $colour): ?>
                                    <tr>
                                        <td><?= $this->Number->format($colour->colour_id) ?></td>
                                        <td style="background-color: <?php echo $colour->colour_name ?>"><?= h($colour->colour_name) ?></td>
                                        <td><?= h($colour->card_type) ?></td>
                                        <td class="actions">
                                            <a href="#" class="btn btn-lg btn-clean la la-edit" id="clear"
                                               data-toggle="modal"
                                               data-target="#kt_modal_<?php echo $colour->colour_id; ?>">
                                            </a>

                                            <!--begin::Modal : ADD New Task -->
                                            <div class="modal fade" id="kt_modal_<?php echo $colour->colour_id; ?>"
                                                 class="kt_modal_<?php echo $colour->colour_id; ?>" role="dialog"
                                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-md" style="margin-top: 50px" role="document">

                                                    <?= $this->Form->create($colour,['url' => ['controller' => 'Colours', 'action' => 'edit', $colour->colour_id]]) ?>

                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Task Label</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true" class="la la-remove"></span>
                                                            </button>
                                                        </div>
                                                        <form class="kt-form kt-form--fit kt-form--label-right">
                                                            <div class="modal-body">
                                                                <!--Test -- -->
                                                                <div class="form-group row kt-margin-b-20">
                                                                    <?php echo $this->Form->control('colour_name', [
                                                                        'templates' => ['inputContainer' => '{{content}}'],
                                                                        'class' => 'form-control col-lg-6 col-md-6 col-sm-12',
                                                                        'placehoder' => '#000000',
                                                                        'label' => [
                                                                            'class' => 'col-form-label col-lg-5 col-sm-12',
                                                                            'text' => 'Colour Code (Hex) :'
                                                                        ]
                                                                    ]); ?>
                                                                </div>
                                                                <div class="form-group row kt-margin-b-20">
                                                                    <?php echo $this->Form->control('card_type', [
                                                                        'templates' => ['inputContainer' => '{{content}}'],
                                                                        'class' => 'form-control col-lg-6 col-md-6 col-sm-12',
                                                                        'label' => [
                                                                            'class' => 'col-form-label col-lg-5 col-sm-12',
                                                                            'text' => 'Card Type (Label Name) :'
                                                                        ]
                                                                    ]); ?>
                                                                </div>

                                                            </div>

                                                            <div class="modal-footer" style="padding-top: 20px ">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                                    Cancel
                                                                </button>
                                                                <!--Button has not template in Cakephp, need to set a templates before change it -->
                                                                <?php
                                                                $this->Form->setTemplates([
                                                                    'button' => '<button{{attrs}}>{{text}}</button>'])
                                                                ?>

                                                                <?= $this->Form->button('Submit ', [
                                                                    'type' => 'submit',
                                                                    'class' => 'btn btn-brand',
                                                                    'escape' => false
                                                                ]);
                                                                ?>
                                                                <?= $this->Form->end() ?>

                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Modal-->

                                          <!-- $this->Html->link($this->Html->tag('i', '', array('class' => 'btn btn-lg btn-clean  la la-edit', 'style' => 'padding : 8px')) . '', array('controller' => 'colours', 'action' => 'edit', $colour->colour_id), array('escape' => false)) ?>
                                            <!--                            $this->Form->postLink($this->Html->tag('i', '', array('class' => 'btn btn-lg btn-clean  la la-trash', 'style' => 'padding : 5px')).'', array('controller' => 'colours', 'action' => 'delete',  $colour->colour_id), array('escape' => false), ['confirm' => __('Are you sure you want to delete # {0}?', $colour->colour_id)]) -->
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
