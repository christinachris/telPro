<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="alert alert-error fade show" id="errorMessage" style=" position:absolute;z-index: 10000; margin-bottom: 10px  ; padding:10px; font-size: 15px ; background-color: #ff0080; background: rgb(255,0,128);
    border-color: transparent;" role="alert">
    <div class="alert-icon"><i class="flaticon2-check-mark"></i></div>
    <div class="alert-text" style="color: whitesmoke;font-weight: 500 "><?= '     '. h($message) ?> </div>
    <div class="alert-close" >
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="la la-close" style="color: whitesmoke ;font-weight: 500"></i></span>
        </button>
    </div>
</div>
<script>
    setTimeout(function() {
        $('.alert-success').fadeOut('slow');
    }, 5000);
</script>
