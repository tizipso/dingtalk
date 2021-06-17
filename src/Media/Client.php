<?php

declare(strict_types=1);

namespace Dingtalk\Media;

use GuzzleHttp\Exception\GuzzleException;
use Dingtalk\Kernel\BaseClient;
use Psr\Http\Message\ResponseInterface;

class Client extends BaseClient
{
    /**
     * 上传图片
     *
     * @param mixed $media
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function uploadImage($media): ResponseInterface
    {
        return $this->upload('image', $media);
    }

    /**
     * 上传语音
     *
     * @param mixed $media
     *
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function uploadVoice($media): ResponseInterface
    {
        return $this->upload('voice', $media);
    }

    /**
     * 上传普通文件
     *
     * @param mixed $media
     *
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function uploadFile($media): ResponseInterface
    {
        return $this->upload('file', $media);
    }

    /**
     * 上传媒体文件
     *
     * @param string $type
     * @param mixed  $media
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function upload(string $type, $media): ResponseInterface
    {
        return $this->http->client->post('media/upload', [
            'multipart' => [
                'media' => $media,
                'type' => $type,
            ]
        ]);
    }
}