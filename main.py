import json
from time import sleep
import requests
from datetime import datetime
import logging
import re
import redis


class Website:
    def __init__(self, dic):
        self.name = dic['name']
        self.url = dic['url']
        self.re = dic['rule']

    def read(self):
        """

        :rtype: string encoded with UTF-8 or None if fail.
        """
        try:
            response = requests.get(self.url).text
        except BaseException as e:
            logging.error(e)
            return None
        response_re = re.findall(self.re, response)
        return " ".join(response_re).encode()


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
    while True:
        for website in website_list:
            response = website.read()
            if response is None:
                logging.warning('Read from %s fail.' % website.name)
                pass
            last_data = redis_db.get(website.name)
            if last_data is b'':
                redis_db.set(website.name, response)
                logging.info('Initialize %s done.' % website.name)
            else:
                if response != last_data:
                    msg = '%s又有新内容啦！[点我直达网站！](%s)' % (website.name, website.url)
                    logging.info('%s搞了个大新闻。' % website.name)
                    send_notification('%s搞了个大新闻' % website.name, msg)
                    redis_db.set(website.name, response)
                else:
                    logging.info('%s闷声发大财。' % website.name)
        sleep(20)


if __name__ == '__main__':
    # logging.basicConfig(level=logging.DEBUG)
    website_list = list()
    with open('website_list.json', 'r', encoding='utf-8') as ws_list:
        for website_data in json.load(ws_list):
            website_list.append(Website(website_data))
    with open('notification_list.json', 'r', encoding='utf-8') as nf_list:
        notification_list = json.load(nf_list)
    redis_db = redis.StrictRedis()
    run()
