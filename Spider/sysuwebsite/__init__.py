import requests
from bs4 import BeautifulSoup


class Website(object):
    def __init__(self, name, url):
        self.name = name
        self.url = url


class StaticWebsite(Website):
    def __init__(self, name, url):
        Website.__init__(self, name, url)

    def read(self):
        """
        一般静态网站的抓取方法，使用全局抓取。
        :param url:
        :return:
        """
        try:
            response = requests.get(self.url)
            if response.ok:
                return response.text.encode()
            else:
                return None
        except BaseException:
            return None


class ElearningWebsite(Website):
    def __init__(self, name, url, content_id):
        Website.__init__(self, name, url)
        self.content_id = content_id

    def read(self):
        """
        Elearning 的抓取方法，通过 302 获得 cookies 即可访问。
        :param content_id: Lab_doc: `_248969_1` / Lab_sub`_249029_1`
                           Hw: `_249159_1`
        :return:
        """
        session = requests.Session()
        cookies_site = session.get(
            'http://elearning.sysu.edu.cn/webapps/blackboard/content/listContent.jsp?course_id=_12034_1&content_id=%s' % self.content_id).text
        bs_obj = BeautifulSoup(cookies_site, 'html.parser')
        redir_site = session.get(bs_obj.body.a['href']).text
        bs_obj = BeautifulSoup(redir_site, 'html.parser')
        bs_obj = BeautifulSoup(session.get(bs_obj.body.a['href']).text, 'html.parser')
        ret = bs_obj.body.find_all(id='content_listContainer')
        return str(ret).encode()


class XiaoxiWebsite(Website):
    def __init__(self, name, url):
        Website.__init__(self, name, url)

    def read(self):
        """
        小溪网抓取方法，解决 CSRF 后登陆，抓取文件列表。
        :return:
        """
        session = requests.Session()
        login_site = session.get('http://172.18.187.11/netdisk/Logon.aspx').text
        bs_obj = BeautifulSoup(login_site, 'html.parser')
        form = bs_obj.body.form
        input1 = form.select('#__VIEWSTATE')[0]
        value1 = input1['value']
        input2 = form.select('#__EVENTVALIDATION')[0]
        value2 = input2['value']
        session.post('http://172.18.187.11/netdisk/Logon.aspx', {
            '__VIEWSTATE': value1,
            '__EVENTVALIDATION': value2,
            'txtVMName': '14web',
            'txtUserName': 'anonymous',
            'txtPassword': '123456',
            'btnLogon': '登录'
        })
        r = session.get(
            'http://172.18.187.11/netdisk/ShowFolderContent.aspx?vm=14web&foldername=%5c&rootindex=1&rootname=%e5%ae%9e%e9%aa%8c%e5%b8%83%e7%bd%ae')
        bs_obj = BeautifulSoup(r.text, 'html.parser')
        return str(bs_obj.body.table).encode()


class EdinWebsite(Website):
    def __init__(self, name, url):
        Website.__init__(self, name, url)

    def read(self):
        s = requests.Session()
        login_site = s.get('http://edin.sysu.edu.cn/wiki/doku.php?id=mad2016').text
        bs = BeautifulSoup(login_site, 'html.parser')
        a = bs.body.find_all(id='dokuwiki__content')[0]
        return str(a).encode()
