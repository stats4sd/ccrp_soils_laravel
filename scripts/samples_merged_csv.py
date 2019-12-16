#!/usr/bin/python3
from mysql.connector import MySQLConnection, Error
import sys
import csv
#import requests
import json
from datetime import datetime
import dbConfig as config

path = sys.argv[1] + '/storage/app/public/data/'
query = "select * from samples_merged"
name_file = sys.argv[2]
print(name_file)


try:
	con = MySQLConnection(**config.dbConfig)
	cursor = con.cursor()
	print("query", query)
	cursor.execute(query)

	with open(path + name_file,'w', newline='') as csv_file:
	    column_names = [i[0] for i in cursor.description]
	    writer = csv.writer(csv_file, delimiter=',', quotechar='"', quoting=csv.QUOTE_MINIMAL)
	    writer.writerow(column_names)
	   
	    for row in cursor.fetchall():
	    	writer.writerow(row)
	con.commit()

	
except Error as e:

	print('Error:', e)

finally:

	print('Done!')
	cursor.close()
	con.close()





