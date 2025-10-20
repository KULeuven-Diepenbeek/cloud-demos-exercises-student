from flask import Flask, request, jsonify
from flask_cors import CORS
import pymysql
import os
from flasgger import Swagger

app = Flask(__name__)
CORS(app)
swagger = Swagger(app)


def get_db_connection():
    """
    Maak een verbinding met de MySQL-database.

    De connectieparameters worden opgehaald via omgevingsvariabelen:
    - DB_HOST (default: 'db')
    - DB_USER (default: 'root')
    - DB_PASSWORD (default: 'root')
    - DB_NAME (default: 'restapi')
    """
    return pymysql.connect(
        host=os.getenv('DB_HOST', 'db'),
        user=os.getenv('DB_USER', 'root'),
        password=os.getenv('DB_PASSWORD', 'root'),
        database=os.getenv('DB_NAME', 'restapi'),
        charset='utf8mb4',
        cursorclass=pymysql.cursors.DictCursor
    )


@app.route('/api/users', methods=['GET'])
def get_users():
    """
    Haal alle gebruikers op.

    ---
    parameters:
      - name: pwd
        in: query
        type: string
        required: true
        description: Eenvoudig wachtwoord om toegang te krijgen (demodoeleinden)
    responses:
      200:
        description: Lijst van gebruikers
        schema:
          type: array
          items:
            type: object
            properties:
              id:
                type: integer
              name:
                type: string
              email:
                type: string
      401:
        description: Ongeldig wachtwoord
    """
    pwd = request.args.get("pwd")
    if pwd != "mypassword":
        return jsonify({"error": "Invalid password"}), 401

    db = get_db_connection()
    try:
        cursor = db.cursor()
        cursor.execute("SELECT * FROM users")
        users = cursor.fetchall()
        return jsonify(users), 200
    except Exception as e:
        return jsonify({"error": str(e)}), 500
    finally:
        db.close()


@app.route('/api/users/<int:user_id>', methods=['GET'])
def get_user(user_id):
    """
    Haal een specifieke gebruiker op via ID.

    ---
    parameters:
      - name: user_id
        in: path
        type: integer
        required: true
        description: ID van de gebruiker
    responses:
      200:
        description: Gevonden gebruiker
        schema:
          type: object
          properties:
            id:
              type: integer
            name:
              type: string
            email:
              type: string
      404:
        description: Gebruiker niet gevonden
    """
    db = get_db_connection()
    try:
        cursor = db.cursor()
        cursor.execute("SELECT * FROM users WHERE id = %s", user_id)
        user = cursor.fetchone()
        if user:
            return jsonify(user), 200
        return jsonify({"error": "User not found"}), 404
    except Exception as e:
        return jsonify({"error": str(e)}), 500
    finally:
        db.close()


@app.route('/api/users', methods=['POST'])
def create_user():
    """
    Maak een nieuwe gebruiker aan.

    ---
    parameters:
      - in: body
        name: body
        required: true
        schema:
          type: object
          required:
            - name
            - email
          properties:
            name:
              type: string
              example: "Alice"
            email:
              type: string
              example: "alice@example.com"
    responses:
      201:
        description: Gebruiker succesvol aangemaakt
      400:
        description: Ongeldige invoer
    """
    data = request.get_json()
    name = data.get('name')
    email = data.get('email')
    if not name or not email:
        return jsonify({"error": "Name and email required"}), 400

    db = get_db_connection()
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


@app.route('/api/users/<int:user_id>', methods=['PUT'])
def update_user(user_id):
    """
    Werk een bestaande gebruiker bij.

    ---
    parameters:
      - name: user_id
        in: path
        type: integer
        required: true
        description: ID van de gebruiker
      - in: body
        name: body
        required: true
        schema:
          type: object
          required:
            - name
            - email
          properties:
            name:
              type: string
              example: "Bob"
            email:
              type: string
              example: "bob@example.com"
    responses:
      200:
        description: Gebruiker succesvol bijgewerkt
      404:
        description: Gebruiker niet gevonden
      400:
        description: Ongeldige invoer
    """
    data = request.get_json()
    name = data.get('name')
    email = data.get('email')
    if not name or not email:
        return jsonify({"error": "Name and email required"}), 400

    db = get_db_connection()
    try:
        cursor = db.cursor()
        cursor.execute("SELECT * FROM users WHERE id = %s", (user_id,))
        user = cursor.fetchone()
        if not user:
            return jsonify({"error": "User not found"}), 404
        cursor.execute("UPDATE users SET name = %s, email = %s WHERE id = %s", (name, email, user_id))
        db.commit()
        return jsonify({"message": "User updated successfully"}), 200
    except Exception as e:
        db.rollback()
        return jsonify({"error": str(e)}), 500
    finally:
        db.close()


@app.route('/api/users/<int:user_id>', methods=['DELETE'])
def delete_user(user_id):
    """
    Verwijder een gebruiker via ID.

    ---
    parameters:
      - name: user_id
        in: path
        type: integer
        required: true
        description: ID van de te verwijderen gebruiker
    responses:
      200:
        description: Gebruiker succesvol verwijderd
      404:
        description: Gebruiker niet gevonden
    """
    db = get_db_connection()
    try:
        cursor = db.cursor()
        cursor.execute("DELETE FROM users WHERE id = %s", user_id)
        db.commit()
        if cursor.rowcount == 0:
            return jsonify({"error": "User not found"}), 404
        return jsonify({"message": "User deleted successfully"}), 200
    except Exception as e:
        return jsonify({"error": str(e)}), 500
    finally:
        db.close()


if __name__ == '__main__':
    app.run(host='0.0.0.0', debug=True)