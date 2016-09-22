import requests


if __name__ == '__main__':
	""" downloader install """

	print("Ready install phaGrabVideo uploader....")

	host = input("Please input phaGrabVideo host：")
	port = input("Please input phaGrabVideo port：")

	url = ''.join(['http://', host, ':', port, '/api/api/index'])
	print("Check phaGrabVideo Api ....")

	try:
		result = requests.get(url)
	except Exception as e:
		print('install failed, Domain access failed:')
		print(e)
		print('Please check your host or port is correct')
		exit()
	print('phaGrabVideo Api check success')

	name = input('Please input phaGrabVideo name：')
	token = input('Please input phaGrabVideo token：')

	print("Check phaGrabVideo name and token ....")

	data = {
		'name': name,
		'token': token,
	}

	token_url = ''.join(['http://', host, ':', port, '/api/api/token'])

	try:
		result = requests.get(token_url, params=data)
	except Exception as e:
		print('install failed, Domain access failed:')
		print(e)
		print('Please check your host or port is correct')
		exit()




