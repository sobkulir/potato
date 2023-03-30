#!/usr/bin/env python
import os
import requests
import pandas as pd
import psycopg2
import logging
from sqlalchemy import create_engine
from dotenv import load_dotenv

load_dotenv()

# Define database credentials as environment variables
DB_NAME = os.getenv('DB_NAME')
DB_USER = os.getenv('DB_USER')
DB_PASSWORD = os.getenv('DB_PASSWORD')
DB_HOST = os.getenv('DB_HOST')
DB_PORT = os.getenv('DB_PORT')

def download_matrix():
    URL = "https://docs.google.com/spreadsheets/d/1x5raJiu4W0gMoLufHN62OXhyJn2IBeIu/edit?usp=share_link&ouid=110487550874067370729&rtpof=true&sd=true"
    # download the data behind the URL
    response = requests.get(URL)
    # Open the response into a new file
    open("matrix.xlsx", "wb").write(response.content)

def create_database():
    # Create database connection
    try:
        connection = psycopg2.connect(
            dbname=DB_NAME,
            user=DB_USER,
            password=DB_PASSWORD,
            host=DB_HOST,
            port=DB_PORT
        )
    except psycopg2.Error as e:
        raise Exception(f"Could not connect to database: {e}")

    connection.autocommit = True
    cursor = connection.cursor()

    # Check if table already exists
    cursor.execute("SELECT EXISTS (SELECT FROM pg_tables WHERE tablename = 'mitre');")
    table_exists = cursor.fetchone()[0]

    # If table exists, drop it
    if table_exists:
        print("Table already exists. Dropping table 'mitre'...")
        cursor.execute("DROP TABLE mitre;")
        print("Table mitre dropped successfully.")

    # Create new table and insert data
    df = pd.read_excel(r'./matrix.xlsx')
    df = df[['ID', 'name', 'description', 'url', 'tactics', 'platforms']]
    logging.warning('postgresql://' + DB_USER + ':' + DB_PASSWORD + '@' + DB_HOST + ':' + DB_PORT + '/' + DB_NAME)
    engine = create_engine(f'postgresql://{DB_USER}:{DB_PASSWORD}@{DB_HOST}:{DB_PORT}/{DB_NAME}')
    df.to_sql('mitre', engine, if_exists='replace')

    cursor.close()
    connection.close()
    os.remove('matrix.xlsx')

if __name__ == '__main__':
    try:
        print('Downloading MITRE data.')
        download_matrix()
        print('Pushing to DB.')
        create_database()
        print('Done.')
    except Exception as e:
        print(f"An error occurred: {e}")
