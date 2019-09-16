<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */

?>

<!-- end:: Header -->
<div class="kt-header__bottom">
    <div class="kt-container">

        <!-- begin: Header Menu -->
        <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
            <div id="kt_header_menu" class="kt-header-menu">
                <ul class="kt-menu__nav ">
                    <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"><a href=" <?php echo $this->Url->build(["controller" => "dashboard", "action" => "index"]); ?>" class="kt-menu__link ">
                            <span class="kt-menu__link-text">Dashboard </span></a></li>
                    <li class="kt-menu__item   " aria-haspopup="true"><a href=" <?php echo $this->Url->build(["controller" => "projects", "action" => "index"]); ?>" class="kt-menu__link "><span class="kt-menu__link-text">Projects </span></a></li>
                    <li class="kt-menu__item kt-menu__item--active kt-menu__item--submenu kt-menu__item--rel" aria-haspopup="true"><a href="<?php echo $this->Url->build(['controller'=>'Talents', 'action'=>'index'])?>" class="kt-menu__link "><span class="kt-menu__link-text">Talent</span></a></li>
                    <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel" aria-haspopup="true"><a href="<?php echo $this->Url->build(['controller'=>'Clients', 'action'=>'index'])?>" class="kt-menu__link "><span class="kt-menu__link-text">Client</span></a></li>
                </ul>
            </div>
        </div>
        <!-- end: Header Menu -->
    </div>
</div>



<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-grid--stretch">
    <div class="kt-container kt-body  kt-grid kt-grid--ver" id="kt_body">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

            <div class="kt-subheader   kt-grid__item" id="kt_subheader">
                <div class="kt-subheader__main">
                    <h3 class="kt-subheader__title">
                        Dashboard </h3>
                    <span class="kt-subheader__separator kt-hidden"></span>

                    <div class="kt-subheader__breadcrumbs">
                        <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        <a href="<?php echo $this->Url->build(['controller' => 'Talents', 'action' => 'index']) ?>"
                           class="kt-subheader__breadcrumbs-link">
                            Talents List
                        </a>
                        <span class="kt-subheader__breadcrumbs-separator"></span>

                        <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Edit User</span>
                    </div>
                </div>
                <div class="kt-subheader__toolbar">
                    <div class="kt-subheader__wrapper">
                        <div class="btn kt-subheader__btn-daterange" title="Select dashboard daterange">
                            <span class="kt-subheader__btn-daterange-title" id="kt_dashboard_daterangepicker_title">Today</span>&nbsp;
                            <span class="kt-subheader__btn-daterange-date"
                                  id="kt_dashboard_daterangepicker_date"><?php echo date("M d") ?></span>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
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
                <!-- begin:: Content -->
                <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
                    <!--begin::Portlet-->
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon kt-hidden">
											<i class="la la-gear"></i>
										</span>
                                <h3 class="kt-portlet__head-title">
                                    Edit User
                                </h3>
                            </div>
                        </div>
                        <?= $this->Form->create($user) ?>
                        <fieldset>

                            <form class="kt-form kt-form--label-right">
                                <div class="kt-portlet__body" style="margin-left:55px">
                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <?php echo $this->Form->control('username', ['class' => 'form-control', 'id' => 'exampleSelect1', 'placeholder' => 'Enter username']); ?>
                                            <div class="kt-input-icon">
                                                <div class="kt-input-icon">
                                        <span
                                            class="kt-input-icon__icon kt-input-icon__icon--right"><span></span></span>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-lg-6">
                                            <?php echo $this->Form->control('password', ['class' => 'form-control', 'id' => 'exampleSelect1', 'placeholder' => 'Enter password', 'type' => 'text']); ?>
                                            <div class="kt-input-icon">
                                                <span class="kt-input-icon__icon kt-input-icon__icon--right"><span></span></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
                                    <div class="form-group row">
                                        <div class="col-lg-4">
                                            <?php echo $this->Form->control('role',['class' => 'form-control','options' => array('Superadmin' => 'Superadmin', 'Admin' => 'Admin', 'Project Manager' => 'Project Manager')]); ?>
                                        </div>

                                        <div class="col-lg-4">
                                            <?php echo $this->Form->control('talent_id', ['options' => $talents, 'empty' => true, 'class' => 'form-control']);?>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-outline-brand btn-elevate btn-pill col-lg-4" data-toggle="collapse" data-target="#demo"><i class="flaticon-cogwheel"></i>Permission Setting</button>
                                    <div id="demo" class="collapse">
                                        <br>


                                        <div class="form-group row">
                                            <div class="col-lg-4">
                                                <?php echo $this->Form->control('permission_view_full_client_list', ['type' => 'checkbox', 'label'=>"View All Client"]);?>
                                            </div>
                                            <div class="col-lg-4">
                                                <?php echo $this->Form->control('permission_view_limited_client_list', ['type' => 'checkbox','label'=>"View Assigned Client"]);?>
                                            </div>
                                            <div class="col-lg-4">
                                                <?php echo $this->Form->control('permission_view_full_talent_list', ['type' => 'checkbox', 'label'=>"View All Talent"]);?>
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-4">
                                                <?php echo $this->Form->control('permission_view_limited_talent_list', ['type' => 'checkbox', 'label'=>"View Assigned Talent"]);?>
                                            </div>
                                            <div class="col-lg-4">
                                                <?php echo $this->Form->control('permission_add_client', ['type' => 'checkbox','label'=>"Add Client"]);?>
                                            </div>
                                            <div class="col-lg-4">
                                                <?php echo $this->Form->control('permission_add_talent', ['type' => 'checkbox','label'=>"Add Talent"]);?>
                                            </div>


                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-4">
                                                <?php echo $this->Form->control('permission_delete_client', ['type' => 'checkbox', 'label'=>"Delete Client"]);?>
                                            </div>
                                            <div class="col-lg-4">
                                                <?php echo $this->Form->control('permission_delete_talent', ['type' => 'checkbox', 'label'=>"Delete Talent"]);?>
                                            </div>
                                            <div class="col-lg-4">
                                                <?php echo $this->Form->control('permission_edit_client', ['type' => 'checkbox', 'label'=>"Edit Client"]);?>
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-4">
                                                <?php echo $this->Form->control('permission_edit_talent', ['type' => 'checkbox', 'label'=>"Edit Talent"]);?>
                                            </div>
                                            <div class="col-lg-4">
                                                <?php echo $this->Form->control('permission_archive_talent', ['type' => 'checkbox', 'label'=>"Archive Talent"]);?>
                                            </div>
                                            <div class="col-lg-4">
                                                <?php echo $this->Form->control('permission_unarchive_talent', ['type' => 'checkbox', 'label'=>"Unarchive Talent"]);?>
                                            </div>


                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-4">
                                                <?php echo $this->Form->control('permission_archive_client', ['type' => 'checkbox', 'label'=>"Archive Client"]);?>
                                            </div>
                                            <div class="col-lg-4">
                                                <?php echo $this->Form->control('permission_unarchive_client', ['type' => 'checkbox', 'label'=>"Unarchive Client"]);?>
                                            </div>
                                            <div class="col-lg-4">
                                                <?php echo $this->Form->control('permission_view_archive_client_list', ['type' => 'checkbox', 'label'=>"View Archive Client"]);?>
                                            </div>


                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-4">
                                                <?php echo $this->Form->control('permission_view_archive_talent_list', ['type' => 'checkbox', 'label'=>"View Archive Talent"]);?>
                                            </div>


                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-4">
                                                <?php echo $this->Form->control('permission_view_archive_talent_list', ['type' => 'checkbox', 'label'=>"View Archive Talent"]);?>
                                            </div>


                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-4">
                                                <?php echo $this->Form->control('permission_view_full_project_list', ['type' => 'checkbox', 'label'=>"View All Project"]);?>
                                            </div>
                                            <div class="col-lg-4">
                                                <?php echo $this->Form->control('permission_view_limited_project_list', ['type' => 'checkbox', 'label'=>"View Assigned Project"]);?>
                                            </div>
                                            <div class="col-lg-4">
                                                <?php echo $this->Form->control('permission_view_archive_project_list', ['type' => 'checkbox', 'label'=>"View Archive Project"]);?>
                                            </div>


                                        </div>



                                        <div class="form-group row">
                                            <div class="col-lg-4">
                                                <?php echo $this->Form->control('permission_archive_project', ['type' => 'checkbox', 'label'=>"Archive Project"]);?>
                                            </div>
                                            <div class="col-lg-4">
                                                <?php echo $this->Form->control('permission_unarchive_project', ['type' => 'checkbox', 'label'=>"Unarchive Project"]);?>
                                            </div>
                                            <div class="col-lg-4">
                                                <?php echo $this->Form->control('permission_add_project', ['type' => 'checkbox', 'label'=>"Add Project"]);?>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-lg-4">
                                                <?php echo $this->Form->control('permission_edit_project', ['type' => 'checkbox', 'label'=>"Edit Project"]);?>
                                            </div>
                                            <div class="col-lg-4">
                                                <?php echo $this->Form->control('permission_delete_project', ['type' => 'checkbox', 'label'=>"Delete Project"]);?>
                                            </div>
                                        </div>
                                    </div>


                        </fieldset>
                    </div>

                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <div class="row">
                                <div style="width: 100%;display: flex; align-items: center; justify-content: center;">
                                    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success']) ?>
                                    <?= $this->Form->end() ?>
                                    <?php echo $this->Html->link('Cancel',
                                        array('controller' => 'Talents',
                                            'action' => 'index',
                                            'type' => 'button'),
                                        array('class' => 'btn btn-secondary'))
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Form-->
            </div>
            <div class="kt-footer kt-grid__item" id="kt_footer">
                <div class="kt-container">
                    <div class="kt-footer__wrapper">
                        <div class="kt-footer__copyright">
                            2019&nbsp;©&nbsp;<a>Set My Brand Up</a>
                        </div>

                    </div>
                </div>
            </div>

            <?= $this->Html->script('assets/app/custom/general/crud/forms/widgets/form-repeater.js') ?>
            <?= $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js') ?>



            <!--<?php
            /**
             * @var \App\View\AppView $this
             * @var \App\Model\Entity\User $user
             */
            ?>
            <nav class="large-3 medium-4 columns" id="actions-sidebar">
                <ul class="side-nav">
                    <li class="heading"><?= __('Actions') ?></li>
                    <li><?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $user->id],
                            ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]
                        )
                    ?></li>
                    <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
                    <li><?= $this->Html->link(__('List Images'), ['controller' => 'Images', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link(__('New Image'), ['controller' => 'Images', 'action' => 'add']) ?></li>
                </ul>
            </nav>
            <div class="users form large-9 medium-8 columns content">
                <?= $this->Form->create($user) ?>
                <fieldset>
                    <legend><?= __('Edit User') ?></legend>
                    <?php
                        echo $this->Form->control('username');
                        echo $this->Form->control('password');
                        echo $this->Form->control('role');
                    ?>
                </fieldset>
                <?= $this->Form->button(__('Submit')) ?>
                <?= $this->Form->end() ?>
            </div>
