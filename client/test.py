import sys
from you_get.__main__ import main
import json


class OutputPrint:
	def __init__(self):
		self.buffer = ''
		self.__console__ = sys.stdout

	def write(self, output_stream):
		self.buffer += output_stream.replace('\n', '').replace(' ', '')

	def flush(self):
		self.buffer = ''

	def isatty(self):
		pass

	def reset(self):
		sys.stdout = self.__console__

if __name__ == '__main__':
	kwargs = {
		# 'first': 1,
		'url': 'http://my.tv.sohu.com/pl/9113873/85158891.shtml',
	}
	sys.argv = ['/usr/local/python3/bin/you-get', '--url', '--json', 'http://my.tv.sohu.com/pl/9113873/85158891.shtml']
	#sys.kwargs = ['/usr/local/python3/bin/you-get', '--url', '--json', 'http://my.tv.sohu.com/pl/9113873/85158891.shtml']
	# output = OutputPrint()
	# sys.stdout = output
	main()
	main()
	# sys.argv = []
	# sys.argv = ['/usr/local/python3/bin/you-get', 'http://my.tv.sohu.com/pl/9113873/85158891.shtml']
	# main()
	# result = output.buffer
	# output.flush()
	# output.reset()
	# data = json.loads(result)
	# print(data['title'])
	exit()
