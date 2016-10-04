import json
import os
from time import sleep
import requests
from datetime import datetime
import logging
import re
import redis
import multiprocessing


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
    with open('notification_list.json', 'r', encoding='utf-8') as nf_list:
        notification_list = json.load(nf_list)
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


def spider_task(website):
    response = website.read()
    if response is None:
        logging.warning('Read from %s fail.' % website.name)
        pass
    logging.info('Read from %s succeed.' % website.name)
    redis_db = redis.StrictRedis()
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


def master(queue, sleep_time):
    logging.info('Master start.')
    website_list = list()
    with open('website_list.json', 'r', encoding='utf-8') as ws_list:
        for website_data in json.load(ws_list):
            website_list.append(Website(website_data))
    while True:
        for website in website_list:
            queue.put(website)
            logging.info('Put %s in queue' % website.name)
        sleep(sleep_time)


def slave(queue):
    logging.info('Slave start.')
    pools_size = 2
    pool = multiprocessing.Pool(processes=pools_size)
    while True:
        website = queue.get()
        logging.info('%s get %s' % (os.getpid(), website.name))
        pool.apply_async(func=spider_task, args=(website,))


if __name__ == '__main__':
    logging.basicConfig(level=logging.DEBUG)
    website_queue = multiprocessing.Queue()
    master_p = multiprocessing.Process(target=master, args=(website_queue, 20), name='Master')
    slave_p = multiprocessing.Process(target=slave, args=(website_queue,), name='Slave')
    slave_p.start()
    master_p.start()
    check_time = 120
    while True:
        if not master_p.is_alive():
            logging.error('Master exit unexpected.')
            exit(1)
        if not slave_p.is_alive():
            logging.error('Slave exit unexpected.')
            exit(1)
        sleep(check_time)
