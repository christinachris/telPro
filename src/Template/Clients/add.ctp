<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Task[]|\Cake\Collection\CollectionInterface $tasks
 */

use Cake\Datasource\ConnectionManager;
use Cake\I18n\I18n;
use Cake\I18n\Time;

//I18n::Locale('es-au');
// my_connection is defined in your database config
$conn = ConnectionManager::get('default');
?>


<div class="kt-header__bottom">
    <div class="kt-container">

        <!-- begin: Header Menu -->
        <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
            <div id="kt_header_menu" class="kt-header-menu">

                <ul class="kt-menu__nav ">
                    <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"><a
                            href=" <?php echo $this->Url->build(["controller" => "dashboard", "action" => "index"]); ?>"
                            class="kt-menu__link ">
                            <span class="kt-menu__link-text">Dashboard </span></a></li>
                    <li class="kt-menu__item   " aria-haspopup="true"><a
                            href=" <?php echo $this->Url->build(["controller" => "projects", "action" => "index"]); ?>"
                            class="kt-menu__link "><span class="kt-menu__link-text">Projects </span></a></li>
                    <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel" aria-haspopup="true"><a
                            href="<?php echo $this->Url->build(['controller' => 'Talents', 'action' => 'index']) ?>"
                            class="kt-menu__link "><span class="kt-menu__link-text">Talent</span></a></li>
                    <li class="kt-menu__item kt-menu__item--active kt-menu__item--submenu kt-menu__item--rel"
                        aria-haspopup="true"><a
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

            <div class="kt-subheader   kt-grid__item" id="kt_subheader">
                <div class="kt-subheader__main">
                    <?= $this->Flash->render() ?>
                    <a href="<?php echo $this->Url->build(["controller" => "dashboard", "action" => "index"]); ?>"
                    <h3 class="kt-subheader__title">
                        Dashboard </h3>
                    </a>
                    <span class="kt-subheader__separator kt-hidden"></span>
                    <div class="kt-subheader__breadcrumbs">
                        <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        <a href="<?php echo $this->Url->build(['controller' => 'Clients', 'action' => 'index']) ?>"
                           class="kt-subheader__breadcrumbs-link">
                            Clients List
                        </a>
                        <span class="kt-subheader__breadcrumbs-separator"></span>

                        <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Add New Client</span>
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


                <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

                    <!--begin::Portlet-->
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon kt-hidden">
											<i class="la la-gear"></i>
										</span>
                                <h3 class="kt-portlet__head-title">
                                    Add New Client
                                </h3>
                            </div>
                        </div>
                        <?= $this->Form->create($client) ?>
                        <fieldset>


                            <form class="kt-form kt-form--label-right">
                                <div class="kt-portlet__body" style="margin-left:55px">
                                    <div class="form-group row">
                                        <div class="col-lg-4">
                                            <?php echo $this->Form->control('first_name', ['type' => 'text', 'pattern' => '[A-Za-Z]{5}', 'class' => 'form-control', 'placeholder' => 'Enter first name']); ?>
                                        </div>
                                        <div class="col-lg-4">
                                            <?php echo $this->Form->control('last_name', ['class' => 'form-control', 'placeholder' => 'Enter last name']); ?>

                                        </div>
                                        <div class="col-lg-4">
                                            <?php echo $this->Form->control('preferred_name', ['class' => 'form-control', 'placeholder' => 'Enter preferred name']); ?>

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <?php echo $this->Form->control('company_name', ['class' => 'form-control', 'id' => 'exampleSelect1', 'placeholder' => 'Enter company name']); ?>
                                            <div class="kt-input-icon">
                                                <span
                                                    class="kt-input-icon__icon kt-input-icon__icon--right"><span></span></span>
                                            </div>

                                        </div>
                                        <div class="col-lg-6">
                                            <?php echo $this->Form->control('address_url', ['type' => 'url', 'class' => 'form-control', 'id' => 'exampleSelect1', 'placeholder' => 'Enter url address']); ?>
                                            <div class="kt-input-icon">
                                                <div class="kt-input-icon">
                                                    <span
                                                        class="kt-input-icon__icon kt-input-icon__icon--right"><span></span></span>
                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <?php echo $this->Form->control('credential', ['class' => 'form-control', 'id' => 'exampleTextarea', 'rows' => '3']); ?>
                                        </div>
                                        <div class="col-lg-3">
                                            <div>
                                                <?php echo $this->Form->control('lifecycle_stage',
                                                    ['options' => array('' => '', 'Offer Sended' => 'Offer Sended', 'Awaiting Payment' => 'Awaiting Payment', 'Potential Lead' => 'Potential Lead', 'Contacted' => 'Contacted'),
                                                        'class' => 'form-control', 'id' => 'exampleSelect1']); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div>
                                                <?php
                                                echo $this->Form->control('contact_owner_id', ['options' => $talents, 'empty' => true, 'class' => 'form-control']); ?>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-4">
                                            <!--  <?php echo $this->Form->control('flag', ['type' => 'checkbox', 'id' => 'flag', 'value' => 'true']); ?>-->

                                        </div>
                                    </div>


                                    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
                                    <div class="form-group row">

                                        <div>
                                            <label>Contact Phone Numbers:</label>
                                            <table id="dynamic_field">
                                                <tr>
                                                    <td><?php echo $this->Form->control('Phones.' . '0' . '.title', ['placeholder' => 'Enter title', 'class' => 'form-control']) ?></td>
                                                    <td><?php echo $this->Form->control('Phones.' . '0' . '.phone_no', ['type' => 'text', 'pattern' => "[0-9]{5-20}", 'class' => 'form-control', 'style' => 'margin-left:20%;', 'label' => ['style' => 'margin-left:20%;']]) ?></td>
                                                    <td>
                                                        <br><?php echo $this->Form->control('Phones.' . '0' . '.is_primary', ['label' => '<span style="padding:0 5px 0 5px;">Primary</span>', 'escape' => false, 'type' => 'checkbox', 'style' => 'margin-left:50px;margin-top:15px;']) ?>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div>
                                        <button style="margin-left:-5px;" type="button" name="add" id="add"
                                                class="btn-sm btn-brand btn-pill">Add More
                                        </button>

                                    </div>
                                    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>

                                    <div class="form-group row">
                                        <div>

                                            <label>Contact Email Addresses:</label>

                                            <table id="dynamic_field2">
                                                <tr>
                                                    <td><?php echo $this->Form->control('Emails.' . '0' . '.title', ['placeholder' => 'Enter title', 'class' => 'form-control']) ?></td>
                                                    <td><?php echo $this->Form->control('Emails.' . '0' . '.email_address', ['type' => 'email', 'class' => 'form-control', 'style' => 'margin-left:20%;', 'label' => ['style' => 'margin-left:20%;']]) ?></td>
                                                    <td>
                                                        <br><?php echo $this->Form->control('Emails.' . '0' . '.is_primary', ['label' => '<span style="padding:0 5px 0 5px;">Primary</span>', 'escape' => false, 'type' => 'checkbox', 'style' => 'margin-left:50px;margin-top:15px;']) ?>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" name="add" id="add2" class="btn-sm btn-brand btn-pill">Add
                                            More
                                        </button>
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
                                        array('controller' => 'Clients',
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


            <?= $this->Html->script('assets/app/custom/general/crud/forms/widgets/form-repeater.js') ?>
            <?= $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js') ?>


            <script>
                $(document).ready(function () {
                    var i = 1;
                    $('#add').click(function () {
                        i++;
                        $('#dynamic_field').append('<tr id="row' + i + '">' +
                            '<td><br><input type="text" placeholder="Enter title" name="Phones[' + (i - 1) + '][title]" class="form-control name_list" /></td>' +
                            '<td><br><input style="margin-left:20%;" type="tel" name="Phones[' + (i - 1) + '][phone_no]" class="form-control name_list" /></td>' +
                            '<td><br><input style="margin-left:50px; margin-top:15px;" type="checkbox" name="Phones[' + (i - 1) + '][is_primary]" ><span style="padding:0 5px 0 5px;">Primary</span></td>' +
                            '<td><br><button style="margin-left:50%;" type="button" name="remove" id="' + i + '" class=" btn_remove btn btn-danger btn-elevate btn-pill btn-sm">Delete</button></td></tr>');
                    });
                    $(document).on('click', '.btn_remove', function () {
                        var button_id = $(this).attr("id");
                        $('#row' + button_id + '').remove();
                    });
                });
            </script>

            <script>
                $(document).ready(function () {
                    var i = 1;
                    $('#add2').click(function () {
                        i++;
                        $('#dynamic_field2').append('<tr id="roww' + i + '">' +
                            '<td><br><input type="text" placeholder="Enter title" name="Emails[' + (i - 1) + '][title]" class="form-control name_list" /></td>' +
                            '<td><br><input style="margin-left:20%;" type="text" name="Emails[' + (i - 1) + '][email_address]" class="form-control name_list" /></td>' +
                            '<td><br><input style="margin-left:50px; margin-top:15px;" type="checkbox" name="Emails[' + (i - 1) + '][is_primary]" ><span style="padding:0 5px 0 5px;">Primary</span></td>' +
                            '<td><br><button style="margin-left:50%;" type="button" name="remove" id="' + i + '" class=" btnremove btn btn-danger btn-elevate btn-pill btn-sm">Delete</button></td></tr>');
                    });
                    $(document).on('click', '.btnremove', function () {
                        var button_id = $(this).attr("id");
                        $('#roww' + button_id + '').remove();
                    });
                });
            </script>

            <script>
                $(document).ready(function () {
                    $('.check').click(function () {
                        $('.check').not(this).prop('checked', false);
                    });
                });
            </script>

