<form id="fileupload" action="<?php echo isset($action) ? $action : '/'; ?>" method="POST" enctype="multipart/form-data">
    <!-- Redirect browsers with JavaScript disabled to the origin page -->
    <noscript>
        <?php echo __('Ative seu JavaScript...'); ?>
    </noscript>
    <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
    <div class="row">
        <div class="span7">
            <!-- The fileinput-button span is used to style the file input field as button -->
            <div class="file-field input-field">
                <input class="file-path validate" type="text"/>
                <div class="btn">
                    <span>File</span>
                    <input type="file" data-url="" name="files[]">
                </div>
            </div>
<!--
            <button type="submit" class="btn btn-mini btn-primary start">
                <i class="icon-upload icon-white"></i>
                <span><?php echo __('Start') ?></span>
            </button>
            <button type="reset" class="btn btn-mini btn-warning cancel">
                <i class="icon-ban-circle icon-white"></i>
                <span><?php echo __('Cancel') ?></span>
            </button>
            <button type="button" class="btn btn-mini btn-danger delete">
                <i class="icon-trash icon-white"></i>
                <span><?php echo __('Remove') ?></span>
            </button>
            <label class="checkbox">
                <input type="checkbox" class="toggle"> Selecionar Arquivos
            </label>
-->
        </div>
        <!-- The global progress information -->
        <div class="fileupload-progress fade">
            <!-- The global progress bar -->
            <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                <div class="determinate" style="width:0%;"></div>
            </div>
            <!-- The extended global progress information -->
            <div class="progress-extended"></div>
        </div>
    </div>
    <!-- The loading indicator is shown during file processing -->
    <div class="fileupload-loading"></div>
    <br>
    <!-- The table listing the files available for upload/download -->
    <table role="presentation" class="table table-striped responsive-table">
        <tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery"></tbody>
    </table>
</form>