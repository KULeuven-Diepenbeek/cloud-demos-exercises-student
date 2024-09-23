from flask import Flask

app = Flask(__name__)

@app.route('/')
def hello_world():
    return 'Hello, World!'

# Run with command: $ python3 app.py
if __name__ == '__main__':
    # for running in docker you need to add the host='0.0.0.0' parameter
    app.run(debug=True,host='0.0.0.0')