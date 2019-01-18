<?php
namespace app\controllers;

use app\models\Fingerprint;
use GuzzleHttp\Client;
use Yii;
use yii\rest\ActiveController;

class FingerprintController extends ActiveController
{
    const
        API_URL = 'direct.lptracker.ru/%s',
        LOGIN = 'login',
        LEAD = 'lead',
        FUNNEL_ID = 1101230,
        PROJECT_ID = 60074,
        CONTACT_ID = 10592149,
        STATUS_SUCCESS = 'success'
    ;

    public $modelClass = 'app\models\Fingerprint';

    /** @var Fingerprint */
    private $finger;

    /** @var string */
    private $token;

    public function actionCheck($fingerprint)
    {
        $this->finger = Fingerprint::find()
            ->where(['fingerprint' => $fingerprint])
            ->one();

        if ($this->finger) {
            $result = $this->login();

            return [
                'message' => 'user_found',
                'code' => 200,
                'result' => $result
            ];
        } else {
            return [
                'message' => 'user_no_found',
                'code' => 404
            ];
        }
    }

    private function login()
    {
        $data = $this->getLoginData();

        $client = new Client();

        $result = $client->post(
            sprintf(self::API_URL, self::LOGIN),
            [
                'headers' => [
                    'Content-Type' => 'application/json'
                ],
                'body' => json_encode($data)
            ]
        )
        ->getBody()
        ->getContents();

        $response = json_decode($result, true);

        if ($response['status'] == self::STATUS_SUCCESS) {
            $this->token = $response['result']['token'];
            return $this->createLead();
        } else {
            return $response['errors'];
        }
    }

    private function createLead()
    {
        $data = $this->getLeadData();

        $client = new Client();
        $result = $client->post(
            sprintf(self::API_URL, self::LEAD),
            [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'token' => $this->token
                ],
                'body' => json_encode($data)
            ]
        )
        ->getBody()
        ->getContents();

        $response = json_decode($result, true);

        if ($response['status'] == self::STATUS_SUCCESS) {
            return $response['result'];
        } else {
            return $response['errors'];
        }
    }

    private function getLoginData()
    {
        return [
            'login' => Yii::$app->params['lptrackerLogin'],
            'password' => Yii::$app->params['lptrackerPassword'],
            'service' => 'TestLead',
            'version' => "1.0"
        ];
    }

    private function getLeadData()
    {
        return [
            'contact_id' => self::CONTACT_ID,
            'name' => $this->finger->name,
            'callback' => false,
            'source' => 'Api',
            'funnel' => self::FUNNEL_ID
        ];
    }
}