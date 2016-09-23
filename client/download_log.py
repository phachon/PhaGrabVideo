"""
写入日志
"""
import json
import requests
import configparser


class DownloadLog:
	""" 下载日志 """

	# 日志级别
	level_info = 0
	level_warning = 1
	level_error = 2
	level_debug = 3

	def __init__(self, info):
		self.info = info

	def write(self):

		config = configparser.ConfigParser()
		config.read('config.ini')
		host = config.get('download', 'host')
		port = config.get('download', 'port')
		token = config.get('download', 'token')
		name = config.get('download', 'name')

		url = ''.join(['http://', host, ':', port, '/api/log/download'])

		values = {
			'token': token,
			'name': name,
			'level': self.info.get('level', 0),
			'message': self.info.get('message', ''),
			'extra': self.info.get('extra', ''),
			'url_id': self.info.get('url_id', 0),
		}

		try:
			result = requests.post(url, data=values)
			response = json.loads(result.text)
			if response['code'] == 0:
				print('request log api failed')
				exit(response['message'])
		except Exception as e:
			print(e)
