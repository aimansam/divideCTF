from flask import Flask, render_template, send_from_directory, make_response
import os

app = Flask(__name__, static_url_path='/01-welcome/static')
BASE_PATH = os.getenv('BASE_PATH', '').rstrip('/')

@app.context_processor
def inject_base_path():
    return {'base_path': BASE_PATH}
port = int(os.environ.get("PORT", 8080))

@app.route('/')
def home():
    # Flask looks in the /templates folder automatically
    content = render_template('index.html')
    res = make_response(content)
    res.set_cookie('part2', 'UEFSVCAyOiBEVjNON1VyM19GVQ==')
    return res

@app.route('/secret1', strict_slashes=False)
def secret1():
    return render_template('secret1.html')

@app.route('/secret2', strict_slashes=False)
def secret2():
    content = render_template('secret2.html')
    res = make_response(content)
    res.headers['This-Is-Flag-Part3'] = 'UEFSVCAzOiAxMV8wRl9IMURE'
    return res

@app.route('/secret3', strict_slashes=False)
def secret3():
    return render_template('secret3.html')

@app.route('/robots.txt')
def robots():
    # Serves robots.txt from the root directory
    return send_from_directory(app.root_path, 'robots.txt')

@app.route('/lock', strict_slashes=False)
def lock():
    # Serves robots.txt from the root directory
    return render_template('lock.html')

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=port)
