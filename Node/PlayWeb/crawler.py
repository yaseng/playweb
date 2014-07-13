"""
 * @id       PlayWeb-2014-3-28
 * @desc     爬虫
 * @author   Yaseng  WwW.Yaseng.Me [Yaseng@UAUC.NET]
 * @project  github.com/yaseng/playweb
"""
import   urllib, urllib2, urlparse, re, os, time
from HTMLParser import HTMLParser, HTMLParseError
from http import Url, GetRequest, PostRequest
import  g

class Crawler(HTMLParser):
    def __init__(self, root):
        HTMLParser.__init__(self)
        self.scheme = root.scheme
        self.domain = root.netloc
        self.root = root
        self.requests = []
        self.parsed = []
        self.form = None
        self.current = None
        
    def parse(self, request):
        if g.O['file-ext'] != None:
            (root, ext) = os.path.splitext(request.url.path)
            if ext[1:] not in  g.O['file-ext'] and ext != '':
                self.parsed.append(request)
                return
 
        if g.O['depth'] != None:
            if len(request.url.path.split('/')) + 1 > g.O['depth']:
                
                self.parsed.append(request)
                return
        try:  
            response = request.fetch()
            response = re.sub("href\s*=\s*([^\"'\s>]+)" , r'href="\1"', response)
            response = re.sub("src\s*=\s*([^\"'\s>]+)" , r'src="\1"', response)
            response = re.sub("action\s*=\s*([^\"'\s>]+)" , r'action="\1"', response)
            response = re.sub("method\s*=\s*([^\"'\s>]+)" , r'method="\1"', response)
            response = re.sub("name\s*=\s*([^\"'\s>]+)" , r'name="\1"', response)
            response = re.sub("value\s*=\s*([^\"'\s>]+)" , r'value="\1"', response)
            self.current = request.url
            self.feed(response)
            self.close()
            
        except Exception as e:
        	  #print e
        	  pass
        	  
        finally:
            self.parsed.append(request)
            if request.redirect != None:
                url = Url(request.redirect, default_netloc=self.domain, default_path=self.root.path)
                self.parsed.append(GetRequest(url))            
 
        for req in self.requests:
            if req not in self.parsed:
                self.parse(req)
     
        
        
 
     
    def __get_attr(self, name, attrs, default=''):
        for a in attrs:
            aname = a[0].lower()
            if aname == name:
                return a[1]
        return default

    def __auto_input_form(self,name):
    	  datas = {"user*":"admin", "pass*":"admin", "email.*":"heisenberg@gmail.com","tel*":"139785452465"}
    	  for key in datas:
    	  	if re.search(key, name):
    	  		return datas[key]
    	  	
    	  	

        
    def __sameDomain(self, domain):
        return re.match(".*\.?%s" % re.escape(self.domain), domain) or re.match(".*\.?%s" % re.escape(domain), self.domain)
     
    def handle_starttag(self, tag, attrs):
        tag = tag.lower()
        if tag == 'a':
            href = self.__get_attr('href', attrs)
            url = Url(href, default_netloc=self.domain, default_path=self.current.path)
            if self.__sameDomain(url.netloc) and url.scheme == self.scheme:
                req = GetRequest(url)
                if req not in self.requests:
                    self.requests.append(req)
        elif tag == 'frame' or tag == 'iframe':
            src = self.__get_attr('src', attrs)
            url = Url(src, default_netloc=self.domain, default_path=self.current.path)
            if self.__sameDomain(url.netloc) and url.scheme == self.scheme:
                req = GetRequest(url)
                if req not in self.requests:
                    self.requests.append(req)
        elif tag == 'form':
            self.form          = {}
            self.form['data'] = {}
            self.form['action'] = self.__get_attr('action', attrs, self.current.path)
            self.form['method'] = self.__get_attr('method', attrs, 'get').lower()
        elif self.form != None:
            if tag == 'input':
                name = self.__get_attr('name', attrs)
                value = self.__get_attr('value', attrs)
                if value == "" :
                	value=self.__auto_input_form(name)
                self.form['data'][name] = value
            elif tag == 'select':
            	#name = self.__get_attr('name', attrs)   auto  select!!!
            	#print  self.__get_attr('value', attrs)
                self.form['data'][self.__get_attr('name', attrs)] = ''
                
    def handle_endtag(self, tag):
        tag = tag.lower()
        if tag == 'form' and self.form != None:
            if self.form['method'] == 'get':
                link = self.form['action'] + "?" + urlencode(self.form['data'])
                url = Url(link, default_netloc=self.domain)
                if self.__sameDomain(url.netloc) and url.scheme == self.scheme:
                    req = GetRequest(url)
                    if req not in self.requests:
                        self.requests.append(req)
            elif self.form['method'] == 'post':
                link = self.form['action']
                url = Url(link, default_netloc=self.domain, default_path=self.current.path)
                if self.__sameDomain(url.netloc) and url.scheme == self.scheme:
                    req = PostRequest(url)
                    for name, value in self.form['data'].items():
                        req.addField(name, value)
                    if req not in self.requests:
                        self.requests.append(req)
                
            self.form = None 