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
                    <?= $this->Flash->render() ?>
                    <a href="<?php echo $this->Url->build(["controller" => "dashboard", "action" => "index"]); ?>"
                    <h3 class="kt-subheader__title">
                        Dashboard </h3>
                    </a>
                    <span class="kt-subheader__separator kt-hidden"></span>



                    <div class="kt-subheader__breadcrumbs">
                        <i class="flaticon2-shelter"></i>

                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        Archived Talent List

                        <a href="" class="kt-subheader__breadcrumbs-link">
                        </a>
                        <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
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
                    <div class="kt-portlet__body">
                        <!--begin: Selected Rows Group Action Form -->
                        <div class="kt-portlet kt-portlet--mobile">
                            <div class="kt-portlet__head kt-portlet__head--lg">
                                <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="flaticon2-list-1"></i>
										</span>
                                    <h3 class="kt-portlet__head-title">
                                        Talents List
                                        <small>:</small>
                                    </h3>
                                </div>
                                <div class="kt-portlet__head-toolbar">
                                    <div class="kt-portlet__head-wrapper">
                                        &nbsp;
                                        <div class="dropdown dropdown-inline">
                                            <!-- Cakephp format of html input.-->
                                            <?= $this->Html->link('<span class="btn btn-outline-primary"><i class="flaticon-eye"></i> View Talents</span>', ['controller' => 'Talents', 'action' => 'Index', 'type' => 'button'], ['escape' => false]) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-portlet__body">
                                <!--begin: Search Form -->
                                <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
                                    <div class="row align-items-center">
                                        <div class="col-xl-8 order-2 order-xl-1">
                                            <div class="row align-items-center">
                                                <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                                    <div class="kt-input-icon kt-input-icon--left">
                                                        <input type="text" class="form-control" placeholder="Search..."
                                                               id="generalSearch" onkeyup="Search()">
                                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
							<span><i class="la la-search"></i></span>
						</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 order-1 order-xl-2 kt-align-right">
                                            <a href="#" class="btn btn-default kt-hidden">
                                                <i class="la la-cart-plus"></i> New Order
                                            </a>
                                            <div
                                                class="kt-separator kt-separator--border-dashed kt-separator--space-lg d-xl-none"></div>
                                        </div>
                                    </div>
                                    <!--end: Search Form -->
                                </div>
                                <!--begin: Selected Rows Group Action Form -->
                                <div class="kt-form kt-form--label-align-right kt-margin-t-20 collapse"
                                     id="kt_datatable_group_action_form">
                                    <div class="row align-items-center">
                                        <div class="col-xl-12">
                                            <div class="kt-form__group kt-form__group--inline">
                                                <div class="kt-form__label kt-form__label-no-wrap">
                                                    <label class="kt-font-bold kt-font-danger-">Selected
                                                        <span id="kt_datatable_selected_number">0</span> records:</label>
                                                </div>
                                                <div class="kt-form__control">
                                                    <div class="btn-toolbar">
                                                        <div class="dropdown">
                                                            <button type="button" class="btn btn-brand btn-sm dropdown-toggle"
                                                                    data-toggle="dropdown">
                                                                Update status
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="#">Pending</a>
                                                                <a class="dropdown-item" href="#">Delivered</a>
                                                                <a class="dropdown-item" href="#">Canceled</a>
                                                            </div>
                                                        </div>
                                                        &nbsp;&nbsp;&nbsp;
                                                        <button class="btn btn-sm btn-danger" type="button"
                                                                id="kt_datatable_delete_all">Delete All
                                                        </button>
                                                        &nbsp;&nbsp;&nbsp;
                                                        <button class="btn btn-sm btn-success" type="button" data-toggle="modal"
                                                                data-target="#kt_modal_fetch_id">Fetch Selected Records
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end: Selected Rows Group Action Form -->
                            </div>
                            <div class="kt-portlet__body kt-portlet__body--fit">
                                <!--begin: Datatable -->
                                <div
                                    class="kt-datatable kt-datatable--default kt-datatable--brand kt-datatable--scroll kt-datatable--loaded"
                                    id="server_record_selection" style="">
                                    <table class="table" id="myTalentTable">
                                        <thead>
                                        <tr style="left: 0px;">
                                            <th style="width: 10%">
                                                <?= $this->Paginator->sort('first_name', 'Full name') ?></span>
                                            </th>
                                            <th style="width: 8%">
                                                <?= $this->Paginator->sort('position') ?>
                                            </th>
                                            <th style="width: 10%">
                                                <?= $this->Paginator->sort('skill_categories') ?>
                                            </th>
                                            <th style="width: 10%">
                                                <?= $this->Paginator->sort('speciality_id') ?>
                                            </th>
                                            <th style="width: 5%">
                                                <?= $this->Paginator->sort('cost') ?>
                                            </th>
                                            <th style="width: 10%">
                                                <?= $this->Paginator->sort('response_time') ?>
                                            </th>
                                            <th style="width: 10%">
                                                <?= $this->Paginator->sort('quality_of_work') ?>
                                            </th>
                                            <th style="width: 10%">
                                                <?= $this->Paginator->sort('phone_no') ?>
                                            </th>
                                            <th style="width: 15%">
                                                <?= $this->Paginator->sort('email') ?>
                                            </th>
                                            <!--<th data-field="Type" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
                                                        <span ><?= $this->Paginator->sort('occupied') ?></span>
                                                    </th>
                                                    -->
                                            <th style="width: 10%" data-field="Actions" data-autohide-disabled="false">
                                                <span>Actions</span>
                                            </th>
                                        </tr>
                                        <?php foreach ($talents

                                        as $talent): ?>
                                        <tbody class="kt-datatable__body ps ps--active-y">
                                        <tr data-row="0" class="kt-datatable__row" style="left: 0px;">

                                            <td data-field="OrderID" class="kt-datatable__cell">
                                    <span
                                        style="width: 85px;"><?= $this->Html->link(h($talent->first_name) . ' ' . h($talent->last_name), ['action' => 'view', $talent->id]) ?></span>
                                            </td>
                                            <td data-field="ShipDate" class="kt-datatable__cell">
                                                <span style="width: 80px;"><?= h($talent->position) ?></span>
                                            </td>
                                            <td data-field="ShipDate" class="kt-datatable__cell">
                                    <span
                                        style="width: 80px;"><?= $talent->has('skill_category') ? $this->Html->link($talent->skill_category->name, ['controller' => 'SkillCategories', 'action' => 'view', $talent->skill_category->id]) : '' ?></span>
                                            </td>
                                            <td data-field="ShipDate" class="kt-datatable__cell">
                                    <span
                                        style="width: 80px;"><?= $talent->has('speciality') ? $this->Html->link($talent->speciality->name, ['controller' => 'Specialities', 'action' => 'view', $talent->speciality->id]) : '' ?></span>
                                            </td>
                                            <td data-field="ShipDate" class="kt-datatable__cell">
                                                <span style="width: 45px;"><?= h($talent->cost) ?></span>
                                            </td>
                                            <td data-field="ShipDate" class="kt-datatable__cell">
                                                <span style="width: 90px;"><?= h($talent->response_time) ?></span>
                                            </td>
                                            <td data-field="ShipDate" class="kt-datatable__cell">
                                                <span style="width: 70px;"><?= h($talent->quality_of_work) ?></span>
                                            </td>
                                            <td data-field="ShipAddress" class="kt-datatable__cell">
                                                <span style="width: 75px;"><?= h($talent->phone_no) ?></span>
                                            </td>
                                            <td data-field="ShipDate" class="kt-datatable__cell">
                                                <span style="width: 125px;"><?= h($talent->email) ?></span>
                                            </td>
                                            <!--<td data-field="ShipDate" class="kt-datatable__cell">
                                                        <span style="width: 123px;"><?= h($talent->occupied) ?></span>
                                                    </td>
                                                    -->
                                            <td class="kt-datatable__cell--left kt-datatable__cell" data-field="Actions"
                                                data-autohide-disabled="false">
                                                    <span style="overflow: visible; position: relative; width: 100px;">
                                                        <?= $this->Html->link('', ['action' => 'unarchive', $talent->id], ['confirm' => __('Are you sure you want to UNarchive {0}'), 'class' => "flaticon-refresh",'style' => 'padding : 5px ; font-size: 20px', 'data-toggle' => "kt-popover", 'data-content' => "Unarchive Talent", 'data-placement' => 'bottom']) ?>

                                                        <?= $this->Html->link('  ', ['action' => 'delete', $talent->id], ['confirm' => __('Are you sure you want to DELETE {0}'), 'class' => "flaticon2-delete", 'style' => 'padding : 5px ; font-size: 18px', 'data-toggle' => "kt-popover", 'data-content' => "Delete Talent", 'data-placement' => 'bottom'] ) ?>

                                                    </span>
                                            </td>
                                        </tr>
                                        </tbody><?php endforeach; ?>
                                    </table>
                                    <div class="kt-datatable__pager kt-datatable--paging-loaded">
                                        <ul class="kt-datatable__pager-nav">
                                            <li>
                                                <a title="First"
                                                   class="kt-datatable__pager-link kt-datatable__pager-link--first kt-datatable__pager-link--disabled"
                                                   data-page="1" disabled="disabled">
                                                    <i class="flaticon2-fast-back"></i><?= $this->Paginator->first('' . __('first')) ?>
                                                </a>
                                            </li>
                                            <li>
                                                <a title="Previous"
                                                   class="kt-datatable__pager-link kt-datatable__pager-link--prev kt-datatable__pager-link--disabled"
                                                   data-page="1" disabled="disabled"><i class="flaticon2-back"></i>
                                                    <?= $this->Paginator->prev('' . __(' ')) ?></a>
                                            </li>
                                            <li style=""></li>
                                            <li style="display: none;"><input type="text" class="kt-pager-input form-control"
                                                                              title="Page number"><?= $this->Paginator->numbers() ?>
                                            </li>
                                            <li><a title="Next" class="kt-datatable__pager-link kt-datatable__pager-link--next"
                                                   data-page="2">
                                                    <i class="flaticon2-next"></i><?= $this->Paginator->next(__(' ') . ' ') ?></a>
                                            </li>
                                            <li><a title="Last" class="kt-datatable__pager-link kt-datatable__pager-link--last"
                                                   data-page="35"><i
                                                        class="flaticon2-fast-next"></i><?= $this->Paginator->last(__('last') . ' >>') ?>
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="kt-datatable__pager-info">
                                <span
                                    class="kt-datatable__pager-detail"><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end:: Content -->
                        </div>
                    </div>
                </div>
            </div>
            <script>
                function Search() {
                    // Declare variables
                    var input, filter, table, tr, td, i, txtValue, j;
                    input = document.getElementById("generalSearch");
                    filter = input.value.toUpperCase();
                    table = document.getElementById("myTalentTable");
                    tr = table.getElementsByTagName("tr");

                    // Loop through all table rows, and hide those who don't match the search query
                    for (i = 0; i < tr.length; i++) {
                        td = tr[i].getElementsByTagName("td")[0];

                        if (td) {
                            txtValue = td.textContent || td.innerText;
                            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                tr[i].style.display = "";
                            } else {
                                tr[i].style.display = "none";
                            }
                        }
                        for (j = 1; j < 11; j++) {

                            td = tr[i].getElementsByTagName("td")[j];
                            if (td) {
                                txtValue += td.textContent || td.innerText;
                                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                    tr[i].style.display = "";
                                } else {
                                    tr[i].style.display = "none";
                                }
                            }
                        }
                    }

                }
            </script>

