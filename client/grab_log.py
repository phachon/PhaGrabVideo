"""
写入日志
"""
import requests
import json


class GrabLog:

	def __init__(self, info):
		self.info = info

	def write(self):

		values = {
			'level': self.info.get('level', 0),
			'message': self.info.get('message', ''),
			'extra': self.info.get('extra', ''),
			'url_id': self.info.get('url_id', 0),
			'grab_video_id': self.info.get('grab_video_id', 0),
			'upload_video_id': self.info.get('upload_video_id', 0)
		}

		print(values)
		exit()
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

