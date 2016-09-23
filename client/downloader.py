import os
import sys
import json
import requests
from grab_log import GrabLog
from output_print import OutputPrint
# from you_get.__main__ import main
from you_get.common import main


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
			main()
			result = output.buffer
		except Exception as e:
			error = e
		finally:
			output.flush()
			output.reset()
		if error != '':
			raise error

		self.analysisInfo = result
		data = json.loads(result)
		self.title = data['title']

	def _download(self, fileName, fileDir):
		""" 开始下载视频"""


	def execute(self):

		cmd = 'you-get --url --json %s' % self.url['url']
		info = {'level': GrabLog.level_info, 'url_id': self.urlId, 'message': '开始下载，准备分析视频...', 'extra': cmd}
		# GrabLog(info).write()

		try:
			self._analysis()
		except Exception as e:
			print('视频分析失败: %s' % e)
			info = {'level': GrabLog.level_error, 'url_id': self.urlId, 'message': '视频分析失败', 'extra': e}
			GrabLog(info).write()
			return False

		info = {'level': GrabLog.level_info, 'url_id': self.urlId, 'message': '视频分析完成, 准备下载...', 'extra': self.analysisInfo}
		# GrabLog(info).write()

		fileName = 'grab-video-%d' % self.urlId
		fileDir = 'videos/'
		if os.path.exists(fileDir) is False:
			os.makedirs(fileDir)

		try:
			self._download(fileName, fileDir)
		except Exception as e:
			print('视频下载失败: %s' % e)
			info = {'level': GrabLog.level_error, 'url_id': self.urlId, 'message': '视频下载失败', 'extra': e}
			GrabLog(info).write()
			return False

		# 保存视频
		video = {
			'url_id': self.urlId,
			'title': self.title,
			'url': self.url['url'],
			'file_name': fileName,
		}

		info = {'level': GrabLog.level_info, 'url_id': self.urlId, 'message': '视频下载成功，准备保存...', 'extra': json.dumps(video)}
		GrabLog(info).write()

		result = requests.post('http://grab.githubs.com/api/video/create', data=video)
		response = json.loads(result.text)
		if response['code'] == 0:
			print('保存视频信息失败')
			info = {'level': GrabLog.level_error, 'url_id': self.urlId, 'message': '保存视频信息失败', 'extra': json.dumps(video)}
			GrabLog(info).write()
		else:
			info = {'level': GrabLog.level_info, 'url_id': self.urlId, 'message': '视频保存成功，下载完成', 'extra': json.dumps(video)}
			GrabLog(info).write()

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
