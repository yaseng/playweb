# coding:utf-8
"""
 * @id       PlayWeb-2014-3-28
 * @desc     工具函数库
 * @author   Yaseng  WwW.Yaseng.Me [Yaseng@UAUC.NET]
 * @project  github.com/yaseng/playweb
"""
import  json, urllib2, urllib, time
from base64 import b64encode, b64decode  
import string  
import g
from urllib import urlencode, quote
 
def msg(text, type=0):
    if type == 2 and  g.O['debug']==1:
        print "[d]"+str(text)
    elif type == 0:
       str_def = "[*]"
    elif type == 1:
       str_def = "[+]"
    elif type == -1:
       str_def = "[-]";
    print str_def + text
    
def  date(d):
	return time.strftime('%Y-%m-%d %H:%M:%S', time.localtime(d))
    
def  http_get(url, headers=None, time=5):
    ret = {}
    try:
        r = urllib2.urlopen(url, timeout=time)
        ret = {"data":r.read(), "code":200, "headers":r.headers}
    except urllib2.HTTPError, e:
        ret = {"data":e.read(), "code":e.code, "headers":e.headers}
    except urllib2.URLError, e:
        return None
    return  ret
"""
@desc http   post
"""

def  http_post(url, data, headers=None, time=5):
    ret = {}
    try:
        opener = urllib2.build_opener()
        # opener.addheaders.append(('Cookie', '
        # dict(r['headers']).get('content-length', 0) 
        r = opener.open(url, data, timeout=time)
        ret = {"data":r.read(), "code":200, "headers":r.headers}
    except urllib2.HTTPError, e:
        ret = {"data":e.read(), "code":e.code, "headers":e.headers}
    except urllib2.URLError, e:
        return None
    return  ret

def csv2array(csv):
    items = csv.split(',')
    res = []
    for i, item in enumerate(items):
        item = item.strip()
        if item != '':
            res.append(item)
    return res

def encode_str(unicodeString, key=None):  
    strorg = unicodeString.encode('utf-8')  
    strlength = len(strorg)  
    baselength = len(key)  
    hh = []  
    for i in range(strlength):  
        hh.append(chr((ord(strorg[i]) + ord(key[i % baselength])) % 256))  
    return b64encode(''.join(hh))  
  
def decode_str(orig, key=None):  
    strorg = b64decode(orig.encode('utf-8'))  
    strlength = len(strorg)  
    keylength = len(key)  
    mystr = ' ' * strlength  
    hh = []  
    for i in range(strlength):  
        hh.append((ord(strorg[i]) - ord(key[i % keylength])) % 256)  
    return ''.join(chr(i) for i in hh).decode('utf-8')  

def url2ip(url):
    return ""  

def  json_encode(dict):
    return  json.dumps(dict)

def  encode_dict(dict, key=None):
    return  encode_str(json.dumps(dict), key)

def  report(dict):
    dict['project_hash'] = g.O['project_hash']
    http_post(g.O['server_url'] + "report", "content=" + quote(encode_dict(dict, g.O['key'])))


