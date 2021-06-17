<?php

declare(strict_types=1);

namespace Dingtalk\Calendar;

use GuzzleHttp\Exception\GuzzleException;
use Dingtalk\Kernel\BaseClient;
use Psr\Http\Message\ResponseInterface;

class Client extends BaseClient
{
    /**
     * 创建日程
     *
     * @param array $params
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function create(array $params): ResponseInterface
    {
        return $this->http->client->post('topapi/calendar/v2/event/create', [
            'json' => $params,
        ]);
    }

    /**
     * 修改日程
     *
     * @param string $event_id
     * @param array  $params
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function update(string $event_id, array $params): ResponseInterface
    {
        return $this->http->client->post('topapi/calendar/v2/event/update', [
            'json' => array_merge([
                'event_id' => $event_id,
            ], $params),
        ]);
    }

    /**
     * 修改日程参与者
     *
     * @param string $calendar_id
     * @param string $event_id
     * @param array  $params
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function updateAttendee(string $calendar_id, string $event_id, array $params): ResponseInterface
    {
        return $this->http->client->post('topapi/calendar/v2/attendee/update', [
            'json' => array_merge([
                'calendar_id' => $calendar_id,
                'event_id' => $event_id,
            ], $params),
        ]);
    }

    /**
     * 取消日程
     *
     * @param string $calendar_id
     * @param string $event_id
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function cancel(string $calendar_id, string $event_id): ResponseInterface
    {
        return $this->http->client->post('topapi/calendar/v2/event/cancel', [
            'json' => [
                'calendar_id' => $calendar_id,
                'event_id' => $event_id,
            ],
        ]);
    }
}