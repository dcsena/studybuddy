from flask import Flask
from flaskext.mysql import MySQL

app = Flask(__name__)
mysql = MySQL()
app.config['MYSQL_DATABaSE_USER'] = 'root'
app.config['MYSQL_DATABSE_PASSWORD'] = 'root'
app.config['MYSQL_DATABASE_DB'] = 'studybuddyDB'
app.config['MYSQL_DATABASE_HOST'] = 'localhost'
mysql.init_app(app)
mysql.init_app(app)

@app.route('/')
def hello_world():
    return 'Hello World!'

if __name__ == '__main__':
    app.run()

@app.route("/Authenticate")
def Authenticate():
    username = request.args.get('UserName')
    password = request.args.get('Password')
    cursor = mysql.connect().cursor()
    cursor.execute("SELECT * from User where Username='" + username + "' and Password='" + password + "'")
    data = cursor.fetchone()
    if data is None:
     return "Username or Password is wrong"
    else:
     return "Logged in successfully"