<?php

declare(strict_types=1);

namespace Dingtalk\Messages;

class Text extends Message
{
    protected $type = 'text';

    protected function transform($value): array
    {
        list($content) = $value;

        return ['content' => $content];
    }
}