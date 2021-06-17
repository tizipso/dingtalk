<?php

declare(strict_types=1);

namespace Dingtalk;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\HandlerStack;
use Hyperf\Guzzle\CoroutineHandler;

class Robot
{
    /**
     * 机器人 AccessToken
     *
     * @var string
     */
    protected $access_token;

    /**
     * 加签 没有勾选，不用填写
     *
     * @var string
     */
    protected $secret;

    /**
     * @param string      $access_token
     * @param string|null $secret
     */
    public function __construct(string $access_token, string $secret = null)
    {
        $this->access_token = $access_token;
        $this->secret = $secret;
    }

    /**
     * @param string      $access_token
     * @param string|null $secret
     *
     * @return self
     */
    public static function create(string $access_token, string $secret = null): Robot
    {
        return new static($access_token, $secret);
    }

    /**
     * 发送消息
     *
     * @param array $message
     *
     * @return mixed
     * @throws GuzzleException
     */
    public function send(array $message)
    {
        $client = new Client([
            'base_uri' => 'https://oapi.dingtalk.com',
            'handler' => HandlerStack::create(new CoroutineHandler()),
        ]);

        $query = [
            'access_token' => $this->access_token
        ];

        if ($this->secret) {
            $timestamp = time() . '000';
            $query['sign'] = urlencode(base64_encode(hash_hmac('sha256', $timestamp . "\n" . $this->secret, $this->secret, true)));
            $query['timestamp'] = $timestamp;
        }

        $response = $client->post('robot/send', [
            'query' => $query,
            'json' => $message,
            'debug' => true,
        ]);

        $content = $response->getBody()->getContents();

        return json_decode($content, true);
    }
}