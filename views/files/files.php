<?php

use dosamigos\fileupload\FileUploadUI;

// with UI
?>
<?= FileUploadUI::widget([
    'model' => $model,
    'attribute' => 'newFile',
    'url' => ['files/image-upload'],
    'gallery' => false,
    'fieldOptions' => [
        'accept' => 'image/*'
    ],
    'clientOptions' => [
        'maxFileSize' => 2000000
    ],
    'clientEvents' => [
        'fileuploaddone' => 'function(e, data) {
                                console.log(e);
                                console.log(data);
                            }',
        'fileuploadfail' => 'function(e, data) {
                                console.log(e);
                                console.log(data);
                            }',
    ],
]); ?>
