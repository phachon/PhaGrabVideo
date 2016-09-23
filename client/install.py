import json
import requests
import configparser


if __name__ == '__main__':
	""" downloader install """

	print("Ready install phaGrabVideo uploader....")

	host = input("Please input phaGrabVideo host：")
	port = input("Please input phaGrabVideo port：")

	url = ''.join(['http://', host, ':', port, '/api/api/index'])
	print("Validate phaGrabVideo Api ....")

	try:
		result = requests.get(url)
		response = json.loads(result.text)
		if response['code'] == 0:
			print('install failed, Domain access failed:')
			exit(response['message'])
	except Exception as e:
		print('install failed, Domain access failed:')
		print(e)
		exit('Please check your host or port is correct')

	print('phaGrabVideo Api validate success')

	name = input('Please input phaGrabVideo name：')
	token = input('Please input phaGrabVideo token：')

	print("Validate phaGrabVideo name and token ....")

	data = {
		'name': name,
		'token': token,
	}

	token_url = ''.join(['http://', host, ':', port, '/api/api/token'])

	try:
		result = requests.post(token_url, data=data)
		response = json.loads(result.text)
		if response['code'] == 0:
			print('install failed, validate token failed:')
			exit(response['message'])
	except Exception as e:
		print('install failed, validate token failed:')
		print(e)
		exit('Please register a account in your phaGrabVideo host')

	print('Validate phaGrabVideo name and token success')

	try:
		conf = configparser.ConfigParser()
		config = open('config.ini', 'w')
		conf.add_section('download')
		conf.set('download', 'host', host)
		conf.set('download', 'port', port)
		conf.set('download', 'name', name)
		conf.set('download', 'token', token)
		conf.write(config)
		config.close()
	except Exception as e:
		print('install failed, write config failed:')
		print(e)
		exit('Please Please try to reinstall')

	print('install success')
