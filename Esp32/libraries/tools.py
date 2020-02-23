
def mapvalue(x,in_min,in_max,out_min,out_max):
    return round((x-in_min)*(out_max-out_min)/(in_max-in_min)+out_min,2)
def getId():
    from libraries.mynetwork import getMacAdd,SERVERIP
    import urequests
    node_id=0
    mac=getMacAdd()
    url='http://'+SERVERIP+':5000/getid/'+mac
    '''
    try:
        value = urequests.get(url)
        node_id=int(value.text)
    except OSError:
        print("error in connection")
    '''   
    return 5
