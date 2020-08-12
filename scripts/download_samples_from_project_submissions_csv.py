
from mysql.connector import MySQLConnection, Error
import sys
import dbConfig as config
import pandas as pd
import json 

path = sys.argv[1] + '/storage/app/public/merged_sample/'
name_file = sys.argv[2]
id = sys.argv[3]
query = "SELECT content FROM project_submissions WHERE project_xlsform_id = " + str(id)

try:
	#create connnection with the database
	con = MySQLConnection(**config.dbConfig)
	cursor = con.cursor()
	cursor.execute(query)

	#get the content column from project_submissions table
	content = list(cursor.fetchall())
	# 
	df = pd.DataFrame()

	for element in content:
		element = str(element)
		element = element.replace("('", "")
		element = element.replace("',)", "")
		json_element = json.loads(element)
		df_from_json = pd.json_normalize(json_element)
		df = pd.concat([df, df_from_json])
		
	df.to_csv(path + name_file, index=False)

	con.commit()

	
except Error as e:

	print('Error:', e)

finally:

	print('Done!')
	cursor.close()
	con.close()





