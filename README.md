# Dingtalk for Hyperf

## 介绍
Based on mingyoung/dingtalk developed a DingTalk expansion package adapted to Hyperf. - 基于 mingyoung/dingtalk 开发的适配于 Hyperf 的钉钉扩展包。

封装了钉钉身份验证、通讯录管理、消息通知、审批、群机器人、业务事件回调管理等服务端接口，让开发者可以使用简单的配置，提供简洁的 API 以供方便快速地调用钉钉接口

## 环境要求

- PHP 7.3+
- [Composer](https://getcomposer.org/)

## 安装

```bash
composer require tizipso/dingtalk
```

## 使用

```php
use DingTalk\Application;

$config = [
    'corp_id' => '',
    'agent_id' => '',
    'app_key' => 'dingwu33fo1fjc0fszad',
    'app_secret' => 'RsuMFgEIY3jg5UMidkvwpzEobWjf9Fcu3oLqLyCUIgzULm54WcV7j9fi3fJlUshk',
    'token' => '',
    'aes_key' => '',
];

$app = new Application($config);
```

## License

MIT
