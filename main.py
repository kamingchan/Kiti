import json
from time import sleep
import requests
from datetime import datetime
import logging
import re


def send_notification(title, content=''):
    for user in notification_list:
        while True:
            message = {
                'text': title,
                'desp': 'Hi! %s: \n\n%s\n\n%s' % (user['name'], content, datetime.now().strftime("%m-%d %H:%M"))
            }
            try:
                requests.post(user['url'], message)
                break
            except BaseException as e:
                logging.error(e)
                sleep(5)


def run():
    db = dict()
    while True:
        for website in website_list:
            try:
                response = requests.get(website['url']).text
            except BaseException as e:
                logging.error(e)
                pass
            response_re = re.findall(website['rule'], response)
            name = website['name']
            if name not in db:
                db[name] = response_re
                logging.info('Initialize %s done.' % name)
            else:
                if response_re != db[name]:
                    msg = '%s又有新内容啦！[点我直达网站！](%s)' % (name, website['url'])
                    logging.info('%s搞了个大新闻。' % name)
                    send_notification('%s搞了个大新闻' % name, msg)
                    db[name] = response_re
                else:
                    logging.info('%s闷声发大财。' % name)
        sleep(20)


if __name__ == '__main__':
    # logging.basicConfig(level=logging.DEBUG)
    with open('website_list.json', 'r', encoding='utf-8') as ws_list:
        website_list = json.load(ws_list)
    with open('notification_list.json', 'r', encoding='utf-8') as nf_list:
        notification_list = json.load(nf_list)
    run()
