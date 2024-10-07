from flask import Flask, render_template_string, request, jsonify
from flask_cors import CORS
import pymysql
import os

app = Flask(__name__)
CORS(app)

# Database connection
def get_db_connection():
    return pymysql.connect( 
        host=os.getenv('DB_HOST', 'db'),
        user=os.getenv('DB_USER', 'root'),
        password=os.getenv('DB_PASSWORD', 'root'),
        database=os.getenv('DB_NAME', 'restapi'),
        charset='utf8mb4',
        cursorclass=pymysql.cursors.DictCursor
    )

# DO REST API STUFF
@app.route('/')
def show_databases():
    connection = get_db_connection()
    try:
        with connection.cursor() as cursor:
            cursor.execute("SHOW DATABASES")
            databases = cursor.fetchall()
        return render_template_string("<ul>{% for db in databases %}<li>{{ db['Database'] }}</li>{% endfor %}</ul>", databases=databases)
    finally:
        connection.close()

if __name__ == '__main__':
    app.run(host='0.0.0.0', debug=True)
