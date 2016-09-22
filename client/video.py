import configparser


# 写入配置文件
config = open('config.ini', 'w')
conf = configparser.ConfigParser()

conf.add_section('download')
conf.set('download', 'host', 'http://grab.githubs.com/')
conf.set('download', 'port', '80')
conf.set('download', 'name', 'panchao')
conf.set('download', 'token', 'lahdkjasdkjasnd')
conf.write(config)
config.close()
