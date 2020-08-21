
from mysql.connector import MySQLConnection, Error
import sys
import pandas as pd
import json
import re
from pathlib import Path  # Python 3.6+ only
from dotenv import load_dotenv
import os

env_path = Path(sys.argv[1]) / '.env'
load_dotenv(dotenv_path=env_path)
DB_USERNAME = os.getenv("DB_USERNAME")
DB_PASSWORD = os.getenv("DB_PASSWORD")
DB_HOST = os.getenv("DB_HOST")
DB_DATABASE = os.getenv("DB_DATABASE")

dbConfig = {
            'user': DB_USERNAME,
            'password': DB_PASSWORD,
            'host': DB_HOST,
            'db': DB_DATABASE
            }

path = sys.argv[1] + '/storage/app/public/merged_sample/'
name_file = sys.argv[2]
id = sys.argv[3]
query = "SELECT content FROM project_submissions WHERE project_xlsform_id = " + str(id)

try:
	#create connnection with the database
	con = MySQLConnection(**dbConfig)
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
        element = re.sub(r'(?<!\\)\\(?!["\\/bfnrt]|u[0-9a-fA-F]{4})', r'', element)
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





