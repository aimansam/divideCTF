import sqlite3
import re
from flask import Flask, render_template, request, redirect, session, g
import os

app = Flask(__name__)
port = os.getenv('PORT', 8080)  # Use PORT env variable if set, otherwise default to 8080
BASE_PATH = os.getenv('BASE_PATH', '').rstrip('/')
app.secret_key = os.urandom(16)  # Needed for session management
DATABASE = 'cybercorp1.db'

@app.context_processor
def inject_base_path():
    return {'base_path': BASE_PATH}

# --- Database Helper Functions ---
def get_db_connection():
    conn = sqlite3.connect(DATABASE)
    conn.row_factory = sqlite3.Row
    return conn

def is_sql_injection(user_input):
    # Regex pattern targeting common SQLi signatures
    # Matches comments, keywords, and structural markers
    sqli_pattern = re.compile(
        r"(\b(INSERT|UPDATE|DELETE|DROP)\b)",
        re.IGNORECASE
    )
    
    if sqli_pattern.search(user_input):
        return True
    return False


@app.route('/')
def index():
    return render_template('index.html')

# --- The Vulnerable Routes ---

@app.route('/login', methods=['GET', 'POST'])
def login():
    if request.method == 'POST':
        username = request.form['username']
        password = request.form['password']

        if is_sql_injection(username) or is_sql_injection(password):
            return render_template('login.html', error="Bad keywords detected.")

        

        # [!!!] VULNERABILITY HERE [!!!]
        # Directly formatting the string allows SQL Injection.
        # A payload like: admin' -- 
        # changes the query to: SELECT * FROM users WHERE username = 'admin' --' AND password = '...'
        query = f"SELECT * FROM users WHERE username = '{username}' AND password = '{password}'"
        
        try:
            conn = get_db_connection()
            user = conn.execute(query).fetchone() # Executing the dangerous query
            
            if user:
                session['logged_in'] = True
                session['username'] = user[1]
                return redirect(f'{BASE_PATH}/admin')
            else:
                error = 'Invalid username or password'
                return render_template('login.html', error=error)
        except Exception as e:
            # We print the error to help them debug (optional: hide this for Hard mode)
            error = f"Database Error: {e}"
            print(f"Error executing query: {query}")

    return render_template('login.html')

@app.route('/admin')
def admin():
    if not session.get('logged_in'):
        return redirect(f'{BASE_PATH}/')
        
    get_username_param = request.args.get('username', '').strip()
    get_role_param = request.args.get('role', '').strip()
    get_status_param = request.args.get('status', '').strip()
    get_filter_param = f"{get_username_param}{get_role_param}{get_status_param}"
    # Fetch the data to show the admin
    
    get_page_param = request.args.get('page', 1, type=int)
    per_page = 10
    offset = (get_page_param - 1) * per_page
    
    conn = get_db_connection()
    
    if get_filter_param:
        users_query = f"SELECT * FROM users WHERE username LIKE '%{get_filter_param}%' LIMIT {per_page} OFFSET {offset}"
        
    else:
        users_query = f"SELECT * FROM users LIMIT {per_page} OFFSET {offset}"
    events_query = f"SELECT * FROM events ORDER BY created_at DESC LIMIT {per_page} OFFSET {offset}"    
    events = conn.execute(events_query).fetchall()
    # Preload users for search functionality
    users = conn.execute(users_query).fetchall()
    all_users_query = "SELECT COUNT(*) FROM users"
    all_users = conn.execute(all_users_query).fetchone()[0]
    
    failed_logins_query = "SELECT COUNT(*) FROM events WHERE event_type = 'login_failed' AND created_at > datetime('now', '-24 hours')"
    failed_logins_24h = conn.execute(failed_logins_query).fetchone()[0]
    active_users_query = "SELECT COUNT(*) FROM users WHERE status = 'active'"
    active_users = conn.execute(active_users_query).fetchone()[0]
    total_event_query = "SELECT COUNT(*) FROM events"
    total_event = conn.execute(total_event_query).fetchone()[0]
    conn.close()
    
    stats = {"all_users": all_users, "failed_logins_24h": failed_logins_24h, "active_users": active_users, "total_event": total_event}
    
    if is_sql_injection(get_username_param) or is_sql_injection(get_role_param) or is_sql_injection(get_status_param):
        return render_template('admin.html', error="Bad keywords detected.",user=session['username'], events=events, users=users, stats=stats,page=get_page_param)
    
    return render_template('admin.html', user=session['username'], events=events, users=users, stats=stats,page=get_page_param)

@app.route('/logout')
def logout():
    session.pop('logged_in', None)
    session.pop('username', None)
    return redirect(f'{BASE_PATH}/')

if __name__ == '__main__':
    app.run(debug=True, host='0.0.0.0', port=port)
