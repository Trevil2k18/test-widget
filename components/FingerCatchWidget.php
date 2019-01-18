<?php

namespace app\components;

use yii\base\Widget;

class FingerCatchWidget extends Widget
{
    const FINGERPRINT_URL = 'https://cdnjs.cloudflare.com/ajax/libs/fingerprintjs2/2.0.6/fingerprint2.js';
    const JS_NAME = 'Fingerprint2';

    public function run()
    {
        return $this->render(
            'catcher',
            [
                'fingerprintUrl' => self::FINGERPRINT_URL,
                'jsName' => self::JS_NAME
            ]
        );
    }
}