from flask import Flask, render_template_string
import pymysql

app = Flask(__name__)

# Database connection
def get_db_connection():
    return pymysql.connect(
        # USE SERVICE NAME AS IP/URL ADDRESS
        host="db",
        user="root",
        password="example",
        database="school",
        charset='utf8mb4',
        cursorclass=pymysql.cursors.DictCursor
    )

@app.route('/')
def hello_world():
    db = get_db_connection()
    cursor = db.cursor()
    cursor.execute("SELECT * FROM students")
    students = cursor.fetchall()
    cursor.close()
    db.close()
    
    # Simple HTML template to display students
    html = """
    <h1>Student List</h1>
    <ul>
    {% for student in students %}
        <li>{{ student.FirstName }} - {{ student.StudentID }}</li>
    {% endfor %}
    </ul>
    """
    return render_template_string(html, students=students)

if __name__ == '__main__':
    app.run(host='0.0.0.0', debug=True)
