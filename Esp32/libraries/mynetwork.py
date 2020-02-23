SERVERIP='192.168.#.#'
IISD='COMHEM'
PASSWORD=''


def doConnection():
    import network
    sta_if = network.WLAN(network.STA_IF)
    if not sta_if.isconnected():
        sta_if.active(True)
        sta_if.connect(IISD, PASSWORD)
        while not sta_if.isconnected():
            pass

def getMacAdd():
    import network
    import ubinascii
    mac = ubinascii.hexlify(network.WLAN().config('mac'),':').decode()
    print('mac id')
    print(mac)
    return mac
