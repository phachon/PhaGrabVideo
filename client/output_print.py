import sys


class OutputPrint:
	""" 将print输出内容保存到变量里 """

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
