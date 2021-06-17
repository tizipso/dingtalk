<?php

declare(strict_types=1);

namespace Dingtalk\Messages;

class File extends Message
{
    protected $type = 'file';

    protected function transform($value): array
    {
        list($mediaId) = $value;

        return ['media_id' => $mediaId];
    }
}