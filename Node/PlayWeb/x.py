# coding:utf-8
"""
 * @id       PlayWeb-2014-3-28
 * @desc     扫描节点入口  
 * @author   Yaseng  WwW.Yaseng.Me [Yaseng@UAUC.NET]
 * @project  github.com/yaseng/playweb
"""
import   os, time, itertools, sys, Queue, threading, itertools 
from crawler import *
from scanner import *
import  util, g
reload(sys)
sys.setdefaultencoding('utf8')

class WorkManager(object):

    def __init__(self, queue, thread_num=2):
        self.work_queue = queue
        self.threads = []
        self.__init_thread_pool(thread_num)

 
    
    def __init_thread_pool(self, thread_num):
        for i in range(thread_num):
            self.threads.append(Work(self.work_queue))

 
  
    
    def add_job(self, func, *args):
        self.work_queue.put((func, list(args)))

 
    
    def check_queue(self):
        return self.work_queue.qsize()

 
    
    def wait_allcomplete(self):
        for item in self.threads:
            if item.isAlive():
                item.join()

class Work(threading.Thread):
    def __init__(self, work_queue):
        threading.Thread.__init__(self)
        self.work_queue = work_queue
        self.start()

    def run(self):
        while True:
            try:
                item = self.work_queue.get(block=False)
                print  type(item)
                task = task_queue.get()
                module[task['module']].exploit(task['request'])  
                self.work_queue.task_done()
            except Exception, e:
                #print str(e)
                break
 
class Worker(threading.Thread):
    def __init__(self):
      threading.Thread.__init__(self)
    def run(self):
        while 1:
         if task_queue.empty() == True:
         	 break
         task = task_queue.get()
         module[task['module']].exploit(task['request'])   

if __name__ == '__main__':
    
 
    O = {}
    NODE_KEY = "a88b92531ba974f68bc1fd5938fc77"
    NODE_DEBUG = 0
    SERVER = "http://w/uauc/playweb/"
    util.msg("PlayWeb Node 1.0")
    util.msg("Server:%s Key:%s Debug:%d" % (SERVER, NODE_KEY, NODE_DEBUG))
    util.msg("Listening server project...")
    while 1:
        r = util.http_get(SERVER + "/index.php?m=node&a=get_task")
        if r['data'] != " " :
            O = eval(util.decode_str(r['data'], NODE_KEY))
            break
        time.sleep(1)
    O['debug'] = NODE_DEBUG
    util.msg("[Project] Target:%s  Time:%s Module:%s  Thread:%s" % (O['target'], util.date(O['start_time']), O['module'], O['thread']), 1)
    O['target'] = "w"
    O['key'] = NODE_KEY
    #O['depth'] = 5  # notice
    O['server_url'] = SERVER + "?m=node&a="
    O['web-ports'] = util.csv2array(O['web-ports'])
    O['app-ports'] = util.csv2array(O['app-ports'])
    O['file-ext'] = util.csv2array(O['file-ext'])
    O['module'] = util.csv2array(O['module'])
    g.config(O)
    # print g.O
    info = scanner()
    urls = []
    if info['web']:
        target = Url("http://" + O['target'])
        crawler = Crawler(target)
        crawler.parse(GetRequest(target))
        urls.append(crawler)
    
    module = {}
    module_list = ["sqli", "xss"]
    task_queue = Queue.Queue()
    for item, target in  itertools.product(module_list, urls):
        module[item] = __import__(item)
        for request in target.requests:
            task_queue.put({"module":item, "request":request})
            
    g.O['thread'] = g.O['thread'] if g.O['thread'] > task_queue.qsize() else task_queue.qsize()
    
    work_manager = WorkManager(task_queue, int(g.O['thread']))
    work_manager.wait_allcomplete()
    util.msg("All task done!!!",1)
    
    #===========================================================================
    # for t in range(int(g.O['thread'])):
    #     Worker().start()
    # 
    # util.msg("Done", 1)
    #===========================================================================
 
 
 
 
 
 
 
 
 
 
 
 
