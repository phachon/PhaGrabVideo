"""
下载器
@author phachon@163.com
"""
import sys
import json
import you_get
import requests
from grab_log import GrabLog
from output_print import OutputPrint
from you_get.__main__ import main as you_get_main


class Downloader:
	""" 根据 you-get 下载视频 """

	def __init__(self, url):
		self.url = url
		self.urlId = url.get('url_id', 0)

	def _analysis(self):
		""" 分析视频信息 """

		sys.argv = ['/usr/local/python3/bin/you-get', '--url', '--json', self.url['url']]
		output = OutputPrint()
		sys.stdout = output
		error = ''
		try:
			you_get_main()
			sys.argv = []
			result = output.buffer
		except Exception as e:
			error = e
		finally:
			output.flush()
			output.reset()
		if error != '':
			raise error

		data = json.loads(result)
		self.title = data['title']

	def _download(self):
		""" 开始下载视频"""

		sys.argv = ['/usr/local/python3/bin/you-get', self.url['url']]

		try:
			you_get_main()
			sys.argv = []
		except Exception as e:
			raise e

	def execute(self):

		cmd = 'you-get --url --json ' + self.url['url']
		# 写入日志：开始url
		info = {'level': 0, 'url_id': self.urlId, 'message': '开始下载', 'extra': cmd}
		# GrabLog(info).write()

		try:
			self._analysis()
		except Exception as e:
			print('视频分析失败: %s' % e)
			info = {'level': 1, 'url_id': self.urlId, 'message': '视频分析失败', 'extra': e}
			# GrabLog(info).write()

		fileName = 'grab-video-' + range()
		fileDir = 'videos/'

		try:
			self._download()
		except Exception as e:
			print('视频下载失败: %s' % e)
			info = {'level': 1, 'url_id': self.urlId, 'message': '视频下载失败', 'extra': e}
			# GrabLog(info).write()

		info = {'level': 1, 'url_id': self.urlId, 'message': '视频下载成功', 'extra': cmd}
		# GrabLog(info).write()

		#创建视频
		video = {
			'url_id': self.urlId,
			'title': self.title,
			'url' : self.url['url'],
            'file_name' : fileName,
		}
if __name__ == '__main__':
	urlResults = requests.get('http://grab.githubs.com/api/url/getUrls?status=0')

	response = json.loads(urlResults.text)
	if response['code'] == 0:
		print('interface request failed')
	else:
		data = response['data']
		if data is None:
			exit()
		for url in data:
			Downloader(url).execute()
