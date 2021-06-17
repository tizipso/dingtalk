<?php

declare(strict_types=1);

namespace Dingtalk\Messages;

class Voice extends Message
{
    protected $type = 'voice';

    protected function transform($value): array
    {
        list($mediaId, $duration) = $value;

        return ['media_id' => $mediaId, 'duration' => $duration];
    }
}