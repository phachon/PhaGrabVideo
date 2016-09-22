"""
写入日志
"""
import requests
import json


class DownloadLog:
	""" 抓取日志 """

	# 日志级别
	level_info = 0
	level_warning = 1
	level_error = 2
	level_debug = 3

	def __init__(self, info):
		self.info = info

	def write(self):

		values = {
			'level': self.info.get('level', 0),
			'message': self.info.get('message', ''),
			'extra': self.info.get('extra', ''),
			'url_id': self.info.get('url_id', 0),
		}

		try:
			result = requests.post("http://grab.githubs.com/api/log/grab", data=values)
			response = json.loads(result.text)
			if response['code'] == 0:
				exit('request log api failed')
		except Exception as e:
			print(e)

# if __name__ == '__main__':
# 	info = {
# 		# 'level': 'hj',
# 		'message': 'python测试',
# 		'extra': 'adsa',
# 		'url_id': '1',
# 		'grab_video_id': '0',
# 		'upload_video_id': '0',
# 	}
# 	GrabLog(info).write()

