<?php

namespace KhidirDotID\OneSignal;

use KhidirDotID\OneSignal\OneSignalClient;

// end point
define("NOTIFICATIONS", "notifications");
define("DEVICES", "players");
define("APPS", "apps");
define("SEGMENTS", "segments");

/**
 * Class OneSignalManager
 */
class OneSignalManager extends OneSignalClient
{
    /**
     * OneSignalManager constructor.
     */
    public function __construct()
    {
        $this->initConfig();
    }

    /**
     * Set up required configuration
     */
    protected function initConfig()
    {
        $this->setUrl(config('onesignal.url'));
        $this->setAppId(config('onesignal.app_id'));
        $this->setApiKey(config('onesignal.api_key'));
        $this->setAuthKey(config('onesignal.auth_key'));
        $this->setMutableContent(config('onesignal.mutable_content'));
    }

    /**
     * Send a Push Notification to user on device
     *
     * @param $fields
     * @param string $message
     *
     * @return array|mixed
     */
    public function sendPush($fields, $message = '')
    {
        $this->setAuthorization($this->getApiKey());

        $content = array(
            "en" => $message,
        );

        $fields['app_id']          = $this->getAppId();
        $fields['mutable_content'] = $this->getMutableContent();

        if (!isset($fields['contents']) || empty($fields['contents'])) {
            $fields['contents'] = $content;
        }

        return $this->post($this->getUrl(NOTIFICATIONS), json_encode($fields));
    }

    /**
     * @param $notificationId
     * @param null $appId
     *
     * @return array|mixed
     */
    public function cancelNotification($notificationId, $appId = null)
    {
        $this->setAuthorization($this->getApiKey());

        if (empty($appId)) { // take a default if does not specified
            $appId = $this->getAppId();
        }

        return $this->delete($this->getUrl(NOTIFICATIONS . '/' . $notificationId . '?app_id=' . $appId));
    }

    /**
     * GET all notifications of any applications.
     *
     * @param int $limit
     * @param int $offset
     *
     * @return array|mixed
     */
    public function getNotifications($limit = 50, $offset = 0)
    {
        $this->setAuthorization($this->getApiKey());

        $url = $this->getUrl(NOTIFICATIONS) . '?app_id=' . $this->getAppId() . '&limit=' . $limit . '&offset=' . $offset;

        return $this->get($url);
    }

    /**
     * GET all outcomes of any applications.
     * Outcomes are only accessible for around 30 days
     *
     * @param array $params
     *
     * @return array|mixed
     */
    public function getOutcomes($params = [])
    {
        $this->setAuthorization($this->getApiKey());

        $url = $this->getUrl(APPS) . '/outcomes' . $this->getAppId();

        if (count($params) > 0) {
            $url = $url . '?' . join('&', $params);
        }

        return $this->get($url);
    }

    /**
     * Get Single notification
     *
     * @param string $notificationId
     *
     * @return object
     */
    public function getNotification($notificationId)
    {
        $this->setAuthorization($this->getApiKey());

        $url = $this->getUrl(NOTIFICATIONS) . '/' . $notificationId . "?app_id=" . $this->getAppId();

        return $this->get($url);
    }

    /**
     * GET all devices of any applications.
     *
     * @param int $limit
     * @param int $offset
     *
     * @return array|mixed
     */
    public function getDevices($limit = 50, $offset = 0)
    {
        $this->setAuthorization($this->getApiKey());

        $url = $this->getUrl(DEVICES) . '?app_id=' . $this->getAppId() . '&limit=' . $limit . '&offset=' . $offset;

        return $this->get($url);
    }

    /**
     * Get Single Device information
     *
     * @param string $playerId
     *
     * @return object
     */
    public function getDevice($playerId)
    {
        $this->setAuthorization($this->getApiKey());

        $url = $this->getUrl(DEVICES) . '/' . $playerId . "?app_id=" . $this->getAppId();

        return $this->get($url);
    }

    /**
     * Add new device on your application
     *
     * @param array $fields
     *
     * @return array|mixed
     */
    public function addDevice($fields)
    {
        $this->setAuthorization($this->getApiKey());

        if (!isset($fields['app_id']) || empty($fields['app_id'])) {
            $fields['app_id'] = $this->getAppId();
        }

        if (!isset($fields['language']) || empty($fields['language'])) {
            $fields['language'] = "en";
        }

        return $this->post($this->getUrl(DEVICES), json_encode($fields));
    }

    /**
     * update existing device on your application
     *
     * @param array $fields
     * @param int $playerId
     *
     * @return array|mixed
     */
    public function updateDevice($fields, $playerId)
    {
        $this->setAuthorization($this->getApiKey());

        if (!isset($fields['app_id']) || empty($fields['app_id'])) {
            $fields['app_id'] = $this->getAppId();
        }

        if (!isset($fields['language']) || empty($fields['language'])) {
            $fields['language'] = "en";
        }

        return $this->put($this->getUrl(DEVICES) . '/' . $playerId, json_encode($fields));
    }

    /**
     * delete existing device on your application
     *
     * @param int $playerId
     *
     * @return array|mixed
     */
    public function deleteDevice($playerId)
    {
        $this->setAuthorization($this->getApiKey());

        $url = $this->getUrl(DEVICES) . '/' . $playerId . '?app_id=' . $this->getAppId();

        return $this->delete($url);
    }

    /**
     * Create Segment
     *
     * @param $fields
     * @param  null  $appId
     *
     * @return array|mixed
     */
    public function createSegment($fields, $appId = null)
    {
        $this->setAuthorization($this->getApiKey());

        if (empty($appId)) { // take a default if does not specified
            $appId = $this->getAppId();
        }

        return $this->post($this->getUrl(APPS . '/' . $appId . '/' . SEGMENTS), json_encode($fields));
    }

    /**
     * @param $segmentId
     * @param  null  $appId
     *
     * @return array|mixed
     */
    public function deleteSegment($segmentId, $appId = null)
    {
        $this->setAuthorization($this->getApiKey());

        if (empty($appId)) { // take a default if does not specified
            $appId = $this->getAppId();
        }

        return $this->delete($this->getUrl(APPS . '/' . $appId . '/' . SEGMENTS . '/' . $segmentId));
    }

    /**
     * GET all apps of your one signal.
     *
     * @return array|mixed
     */
    public function getApps()
    {
        $this->setAuthorization($this->getAuthKey());

        $url = $this->getUrl(APPS);

        return $this->get($url);
    }

    /**
     * GET single app of your one signal.
     *
     * @param null|string $appId
     *
     * @return array|mixed
     */
    public function getApp($appId = null)
    {
        $this->setAuthorization($this->getAuthKey());

        $url = $this->getUrl(APPS . '/' . $appId);

        return $this->get($url);
    }

    /**
     * Add new application on your one signal.
     *
     * @param array $fields
     *
     * @return array|mixed
     */
    public function createApp($fields)
    {
        $this->setAuthorization($this->getAuthKey());

        return $this->post($this->getUrl(APPS), json_encode($fields));
    }

    /**
     * Update existing application on your one signal.
     *
     * @param array $fields
     * @param null|string $appId
     *
     * @return array|mixed
     */
    public function updateApp($fields, $appId = null)
    {
        $this->setAuthorization($this->getAuthKey());

        if (empty($appId)) { // take a default if does not specified
            $appId = $this->getAppId();
        }

        return $this->put($this->getUrl(APPS . '/' . $appId), json_encode($fields));
    }
}
