<?php

declare(strict_types=1);

namespace Dingtalk\Messages;

class Link extends Message
{
    protected $type = 'link';

    public function setPictureUrl($value): Link
    {
        return $this->setAttribute('picUrl', $value);
    }

    public function setTitle($value): Link
    {
        return $this->setAttribute('title', $value);
    }

    public function setText($value): Link
    {
        return $this->setAttribute('text', $value);
    }

    protected function transform($value): array
    {
        list($url) = $value;

        return ['messageUrl' => $url];
    }
}