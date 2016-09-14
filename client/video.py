import json
import requests

video = {
	'url_id': 1,
	'title': 'test',
	'url': 'http://test.com',
	'file_name': 'grab-video-1',
}

result = requests.post('http://grab.githubs.com/api/video/create', data=video)
response = json.loads(result.text)
print(response)