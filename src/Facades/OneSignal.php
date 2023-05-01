<?php

namespace KhidirDotID\OneSignal\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array|mixed sendPush(array $fields, string $message = '')
 * @method static array|mixed cancelNotification(string $notificationId, string $appId = null)
 * @method static array|mixed getNotifications(int $limit = 50, int $offset = 0)
 * @method static array|mixed getOutcomes(array $params = [])
 * @method static array|mixed getNotification(string $notificationId)
 * @method static array|mixed getDevices(int $limit = 50, int $offset = 0)
 * @method static array|mixed getDevice(string $playerId)
 * @method static array|mixed addDevice(array $fields)
 * @method static array|mixed updateDevice(array $fields, string $playerId)
 * @method static array|mixed deleteDevice(string $playerId)
 * @method static array|mixed createSegment(array $fields, string $appId = null)
 * @method static array|mixed deleteSegment(string $segmentId, string $appId = null)
 * @method static array|mixed getApps()
 * @method static array|mixed getApp(string $appId = null)
 * @method static array|mixed createApp(array $fields)
 * @method static array|mixed updateApp(array $fields, string $appId = null)
 * @method static void setUrl(string $url)
 * @method static void setAppId(string $appId)
 * @method static void setAuthorization(string $key)
 * @method static void setAuthKey(string $authKey)
 * @method static void setMutableContent(bool $mutableContent)
 */
class OneSignal extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'onesignal';
    }
}
