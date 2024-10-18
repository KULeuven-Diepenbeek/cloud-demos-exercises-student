from flask import Flask, render_template_string, request, jsonify
from flask_cors import CORS
import pymysql
import os

app = Flask(__name__)
CORS(app)

# Database connection
def get_db_connection():
    return pymysql.connect( 
        host=os.getenv('DB_HOST', 'db2'),
        user=os.getenv('DB_USER', 'root'),
        password=os.getenv('DB_PASSWORD', 'root'),
        database=os.getenv('DB_NAME', 'restapi2'),
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


@app.route('/api/users', methods=['GET'])
def get_users():
    
    pwd = request.args.get("pwd")
    if pwd == "mypassword":
        db = get_db_connection()
        try:
            cursor = db.cursor(pymysql.cursors.DictCursor)
            cursor.execute("SELECT * FROM users")
            users = cursor.fetchall()
            return jsonify(users), 200
        except Exception as e:
            return jsonify({"error":str(e)}), 500
        finally:
            db.close()
    else:
        return "Wrong password mate"
@app.route('/api/users/<int:user_id>', methods=['GET'])
def get_user(user_id):
    db = get_db_connection()
    try:
        cursor = db.cursor(pymysql.cursors.DictCursor)
        cursor.execute("SELECT * FROM users WHERE id = %s", user_id)
        user = cursor.fetchone()
        
        if user:
            return jsonify(user), 200
        else:
            return jsonify({"message":"User not found"}), 500
    
    except Exception as e:
        return jsonify({"error":str(e)}), 500
    finally:
        db.close()

@app.route('/api/users/<int:user_id>', methods=['DELETE'])
def delete_user(user_id):
    db = get_db_connection()
    try:
        cursor = db.cursor(pymysql.cursors.DictCursor)
        cursor.execute("DELETE FROM users WHERE id = %s", user_id)
        db.commit()
        if cursor.rowcount == 0:
            return jsonify({"message":"User not found"}), 404
        return jsonify({"message":"User deleted successfully"}), 200
    except Exception as e:
        return jsonify({"error":str(e)}), 500
    finally:
        db.close()

@app.route('/api/users', methods=['POST'])
def create_user():
    db = get_db_connection()
    data = request.get_json()
    name = data.get('name')
    email = data.get('email')

    if not name or not email:
        return jsonify({"error": "Name and email required"}), 400

    try:
        cursor = db.cursor()
        sql = "INSERT INTO users (name, email) VALUES (%s, %s)"
        cursor.execute(sql, (name, email))
        db.commit()
        return jsonify({"message": "User created successfully"}), 201
    except Exception as e:
        db.rollback()
        return jsonify({"error": str(e)}), 500
    finally:
        db.close()

if __name__ == '__main__':
    app.run(host='0.0.0.0', debug=True)
