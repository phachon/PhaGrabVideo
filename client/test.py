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

	sys.argv = ['/usr/local/python3/bin/you-get', '--url', '--json', 'http://v.youku.com/v_show/id_XMTY2NzA5NjQwNA==.html?spm=0.0.m_231558.5~5~5~5~1~3~5~A.Mm2zY2']
	output = OutputPrint()
	sys.stdout = output
	main()
	result = output.buffer
	output.flush()
	output.reset()
	data = json.loads(result)
	print(data['title'])
	exit()
