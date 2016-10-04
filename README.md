# OhMyCat

帮我关注老师主页的一只喵。

## 起因

像我这种不爱上 QQ 群的人，很容易忘记关注新消息从而忽略了通知。例如去年就试过错过了数据结构的期中考试。

所以我养了这样一只喵，帮我盯着老师的主页。

## 使用方法

Python 3 with requests

这个版本将 redis 作为 kv 数据库，储存网页信息，使用本机地址，默认端口。

`notification_list.json` 这个是需要通知的微信号，使用 [Server 酱](http://sc.ftqq.com)给微信推送。如果你没有 [Server 酱](http://sc.ftqq.com)的帐号，请先注册一个。

`website_list.json` 是需要订阅的网站，注意 `name` 必须是唯一的，`rule` 为抓取 HTML 后进行匹配的正则表达式，一般静态网页使用 `.*` 即可，动态网页请自行寻找可以匹配的内容。

如果想看到 info 的日志请取消 `logging.basicConfig(level=logging.DEBUG)` 的注释。

