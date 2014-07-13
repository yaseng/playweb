# coding:utf-8
import   os, time,itertools,sys,Queue, threading,imp 
from crawler import *
from http import Url
reload(sys)
sys.setdefaultencoding('utf8')

        
                
class Worker(threading.Thread):
    def __init__(self):
      threading.Thread.__init__(self)
    def run(self):
        while 1:
         if task_queue.empty() == True:
             break
         task=task_queue.get()
         module[task['module']].exploit(task['request'])   
        
if __name__ == '__main__':
    target = Url("http://w")
    o = {"depth":5, "ext":['cgi', 'cfm', 'asp', 'aspx', 'jsp', 'php', 'htm', 'html', 'do'], }
    thread=10
    #module_list=["sqli","xss","lfi","ftp_login","ssh_login"]
    module_list=["sqli","xss"]
    module={}
    ya = Crawler(target, o)
    ya.parse(GetRequest(target))
    task_queue = Queue.Queue()
    for item in module_list:
    	module[item]= __import__(item)
    	for request in ya.requests:
    		task_queue.put({"module":item,"request":request})
    		
    for t in range(3):
    	Worker().start()
 
    


    
    
 
 