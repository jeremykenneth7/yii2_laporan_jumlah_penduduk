<div id="modal-form-ajax" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?= isset($modalContent) ? $modalContent : '' ?>
        </div>
    </div>
</div>

<?php
$this->registerJs("
    function modalFormAjax(button, event) {
        event.preventDefault();
        var url = $(button).closest('a').attr('href');

        $.get(url, function(data) {
            $('#modal-form-ajax .modal-content').html(data);
            $('#modal-form-ajax').modal('show');
        });
    }
");
?>