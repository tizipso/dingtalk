<?php

declare(strict_types=1);

namespace Dingtalk\Messages;

class Image extends Message
{
    protected $type = 'image';

    protected function transform($value): array
    {
        list($mediaId) = $value;

        return ['media_id' => $mediaId];
    }
}