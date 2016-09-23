import os
import json
import datetime
import requests
import configparser
from download_log import DownloadLog


class Download(object):
	""" download video """

	def __init__(self):
		self.url_id = 0
		self.data = {}
		self.dir = 'videos'

	def get_urls(self):
		""" get urls """

		conf = configparser.ConfigParser()
		conf.read('config.ini')
		host = conf.get('download', 'host')
		port = conf.get('download', 'port')
		name = conf.get('download', 'name')
		token = conf.get('download', 'token')

		url = ''.join(['http://', host, ':', port, '/api/url/getDefaultUrls'])
		params = {
			'token': token,
			'name': name
		}

		try:
			result = requests.get(url, params=params)
			response = json.loads(result.text)
			if response['code'] == 0:
				raise response['message']

		except Exception as e:
			raise e

		self.data = response['data']
		return True

	def download(self):
		""" start download"""

		if self.data is not None:
			for url in self.data:
				self.url_id = url['url_id']
				url_address = url['url']
				date = datetime.datetime.now()
				time = datetime.datetime.strftime(date, 'Y-m-d-H-i-s')
				filename = ''.join([time, '-', self.url_id])
				
				# 开始下载
				cmd = ''.join(['you-get ', ' -o ', self.dir, ' -O ', filename, url_address])

				log = {'level': DownloadLog.level_info, 'url_id': self.url_id, 'message': '下载视频失败...', 'extra': cmd}
				DownloadLog(log).write()

				try:
					os.system(cmd)
				except Exception as e:
					raise e

				log = {'level': DownloadLog.level_info, 'url_id': self.url_id, 'message': '下载视频成功...', 'extra': cmd}
				DownloadLog(log).write()

		return True

	def execute(self):
		""" execute """

		try:
			self.get_urls()
			self.download()
		except Exception as e:
			log = {'level': DownloadLog.level_error, 'url_id': self.url_id, 'message': '下载视频失败...', 'extra': e}
			DownloadLog(log).write()

if __name__ == '__main__':
	Download().execute()
