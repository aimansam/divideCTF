from flask import Flask, render_template
import os

# Create an instance of the Flask class
app = Flask(__name__, static_url_path='/04-bluebox/static')
port = os.getenv("PORT", 5000)

# Define a route for the homepage
@app.route("/")
def index():
    return render_template("index.html")

if __name__ == "__main__":
    app.run(host="0.0.0.0", port=port)
