from flask import Flask, render_template, send_from_directory, make_response
import os

app = Flask(__name__, static_url_path='/01-welcome/static')
port = int(os.environ.get("PORT", 8080))

@app.route('/')
def home():
    # Flask looks in the /templates folder automatically
    content = render_template('index.html')
    res = make_response(content)
    res.set_cookie('part2', 'UEFSVCAyOiBEVjNON1VyM19GVQ==')
    return res

@app.route('/secret1')
def secret1():
    return render_template('secret1.html')

@app.route('/secret2')
def secret2():
    content = render_template('secret2.html')
    res = make_response(content)
    res.headers['This-Is-Flag-Part3'] = 'UEFSVCAzOiAxMV8wRl9IMURE'
    return res

@app.route('/secret3')
def secret3():
    return render_template('secret3.html')

@app.route('/robots.txt')
def robots():
    # Serves robots.txt from the root directory
    return send_from_directory(app.root_path, 'robots.txt')

@app.route('/lock')
def lock():
    # Serves robots.txt from the root directory
    return render_template('lock.html')

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=port)
