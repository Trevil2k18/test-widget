<?php

use yii\web\View;

$this->registerJsFile(
    $fingerprintUrl,
    ['position' => View::POS_HEAD],
    $jsName);

$script = <<< JS
    Fingerprint2.get(function(components) {
        let murmur = Fingerprint2.x64hash128(components.map(function (pair) { return pair.value }).join(), 31)

        $.ajax({
            url: '/fingerprints/check?fingerprint=' + murmur,
            success: function(data) {
                console.log(data);
            },
            error: function () {
                console.error("ERROR");
            }
        });
        console.log("fingerprint hash", murmur)
    })
JS;

$this->registerJs($script, View::POS_HEAD);

?>