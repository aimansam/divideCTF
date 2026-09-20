PRAGMA foreign_keys = ON;

-- Drop in safe order
DROP TABLE IF EXISTS events;
DROP TABLE IF EXISTS assets;
DROP TABLE IF EXISTS users;

-- USERS
-- IMPORTANT: keep column order: id, username, password (your app uses user[1])
CREATE TABLE users (
  id         INTEGER PRIMARY KEY AUTOINCREMENT,
  username   TEXT NOT NULL UNIQUE,
  password   TEXT NOT NULL,

  -- Extra fields for admin.html compatibility
  role       TEXT NOT NULL DEFAULT 'employee',   -- admin / employee
  status     TEXT NOT NULL DEFAULT 'active',     -- active / locked / disabled
  email      TEXT,
  last_login TEXT                               -- store ISO string e.g. 2026-02-04 10:30:00
);

-- ASSETS
-- IMPORTANT: keep first columns: id, item_name, confidential_data (your app selects * and shows assets)
CREATE TABLE assets (
  id                INTEGER PRIMARY KEY AUTOINCREMENT,
  item_name          TEXT NOT NULL,
  confidential_data  TEXT NOT NULL,

  -- Optional fields (won’t break your current /admin)
  classification     TEXT DEFAULT 'internal',    -- internal / confidential / secret
  owner_username     TEXT,
  created_at         TEXT DEFAULT (datetime('now')),

  FOREIGN KEY (owner_username) REFERENCES users(username) ON UPDATE CASCADE
);

-- EVENTS (for admin.html “Recent Activity” section)
CREATE TABLE events (
  id         INTEGER PRIMARY KEY AUTOINCREMENT,
  created_at TEXT NOT NULL DEFAULT (datetime('now')),
  username   TEXT,
  event_type TEXT NOT NULL,            -- login, view_asset, edit_user, etc.
  ip         TEXT,
  result     TEXT NOT NULL DEFAULT 'ok' -- ok / fail / warn
);

-- Helpful indexes
CREATE INDEX idx_users_username ON users(username);
CREATE INDEX idx_users_role     ON users(role);
CREATE INDEX idx_users_status   ON users(status);

CREATE INDEX idx_assets_item    ON assets(item_name);
CREATE INDEX idx_assets_owner   ON assets(owner_username);

CREATE INDEX idx_events_time    ON events(created_at);
CREATE INDEX idx_events_user    ON events(username);
CREATE INDEX idx_events_type    ON events(event_type);

-- =========================
-- SEED DATA (100 RECORDS)
-- 25 users + 35 assets + 40 events = 100
-- =========================

-- -------------------------
-- USERS (25)
-- Columns: username, password, role, status, email, last_login
-- IMPORTANT: your app.py still works because users table starts with (id, username, password)
-- -------------------------
INSERT INTO users (username, password, role, status, email, last_login) VALUES
('admin',      'divide{P455W0rD_134K3D_1N_P141N73X7}',   'admin',    'active',   'admin@cybercorp.com',        '2026-02-03 09:12:44'),
('svc_backup', '@svc_backup_2026',               'admin',    'active',   'svc_backup@cybercorp.com',   '2026-02-04 02:15:33'),
('secops',     'SecOps!2026',                    'admin',    'active',   'secops@cybercorp.com',       '2026-02-04 08:12:10'),
('it_admin',   'ITadmin#44',                     'admin',    'active',   'it_admin@cybercorp.com',     '2026-02-02 17:01:55'),
('zul',        'zulzul123$',                     'employee', 'locked',   'zul@cybercorp.com',          '2026-01-29 19:02:00'),
('aisha',      'Aisha@12345',                    'employee', 'active',   'aisha@cybercorp.com',        '2026-02-04 08:55:18'),
('syafiq',     'SyaF!q2026',                     'employee', 'active',   'syafiq@cybercorp.com',       '2026-02-04 08:41:02'),
('haziq',      'hzq#pw2026',                     'employee', 'active',   'haziq@cybercorp.com',        '2026-02-03 18:20:10'),
('farah',      'Farah!secure',                   'employee', 'active',   'farah@cybercorp.com',        '2026-02-02 16:03:59'),
('amir',       'Amir-W0rk-01',                   'employee', 'active',   'amir@cybercorp.com',         '2026-02-04 07:37:11'),
('nadia',      'Nadia_pw_2026',                  'employee', 'active',   'nadia@cybercorp.com',        '2026-02-01 10:11:35'),
('intern01',   'internF0rr34l',                  'employee', 'active',   'intern01@cybercorp.com',     '2026-02-03 12:45:09'),
('raja',       'Raja@pw22',                      'employee', 'active',   'raja@cybercorp.com',         '2026-02-01 14:05:22'),
('danial',     'Dnl!2026',                       'employee', 'active',   'danial@cybercorp.com',       '2026-02-03 09:48:10'),
('iman',       'Iman_pw_778',                    'employee', 'active',   'iman@cybercorp.com',         '2026-02-02 10:40:33'),
('sara',       'Sara*pass9',                     'employee', 'active',   'sara@cybercorp.com',         '2026-02-03 15:29:00'),
('khairul',    'Khairul2026',                    'employee', 'active',   'khairul@cybercorp.com',      '2026-02-03 08:05:44'),
('jason',      'JasonPwd!2',                     'employee', 'active',   'jason@cybercorp.com',        '2026-02-02 13:12:09'),
('melissa',    'Melissa#pw',                     'employee', 'active',   'melissa@cybercorp.com',      '2026-02-01 18:41:55'),
('hakim',      'Hakim-101',                      'employee', 'active',   'hakim@cybercorp.com',        '2026-02-03 11:09:12'),
('sofia',      'Sofia@work',                     'employee', 'active',   'sofia@cybercorp.com',        '2026-02-04 08:02:48'),
('ryan',       'ryan12345',                      'employee', 'active',   'ryan@cybercorp.com',         '2026-02-02 09:20:01'),
('naufal',     'Naufal_pw',                      'employee', 'active',   'naufal@cybercorp.com',       '2026-02-03 19:55:29'),
('lina',       'Lina!pw',                        'employee', 'active',   'lina@cybercorp.com',         '2026-02-02 21:10:40'),
('omar',       'Omar_pw_09',                     'employee', 'disabled', 'omar@cybercorp.com',         '2026-01-20 10:01:00');

-- -------------------------
-- ASSETS (35)
-- Columns: item_name, confidential_data, classification, owner_username, created_at
-- Note: includes your backup flag asset
-- -------------------------
INSERT INTO assets (item_name, confidential_data, classification, owner_username, created_at) VALUES
('Server Blueprints',            '/var/www/html/secret.pdf',                          'confidential', 'admin',     '2026-01-10 14:22:10'),
('VPN Gateway Config',           'gw=vpn-01; region=ap-southeast-1',                  'secret',       'syafiq',    '2026-01-30 18:42:30'),
('Incident Response Runbook',    'IR: isolate host; rotate keys; notify legal...',    'confidential', 'aisha',     '2026-02-01 11:20:45'),
('Financial Report Q1',          'Q1 Revenue: $50M; EBITDA: $12.4M',                  'internal',     'farah',     '2026-01-25 09:10:00'),
('HR Payroll Export',            'Payroll batch: Feb cycle (restricted)',             'confidential', 'nadia',     '2026-02-03 08:00:00'),
('Cloud IAM Policy',             'Least-privilege policy template v3',                'internal',     'secops',    '2026-02-02 09:50:00'),
('WAF Ruleset',                  'Managed ruleset: OWASP CRS + custom',               'internal',     'secops',    '2026-02-03 10:12:00'),
('Customer PII Sample',          'Redacted sample dataset for QA',                    'confidential', 'melissa',   '2026-01-21 13:42:10'),
('Prod DB Connection Notes',     'Rotate creds monthly; no shared accounts',          'confidential', 'it_admin',  '2026-02-01 09:10:10'),
('Kubernetes Cluster Map',       'Namespaces: core, apps, logging, security',         'internal',     'jason',     '2026-01-28 16:25:00'),
('Security Awareness Slides',    'Phishing simulation guidance',                      'internal',     'sara',      '2026-01-19 10:00:00'),
('Endpoint Baseline',            'CIS hardening checklist',                           'internal',     'hakim',     '2026-02-02 15:11:00'),
('SOC On-call Roster',           'Week 5: aisha, week 6: syafiq',                     'confidential', 'aisha',     '2026-02-01 07:30:00'),
('Audit Evidence Pack',          'ISO27001 evidence index',                           'confidential', 'secops',    '2026-01-17 12:02:00'),
('Vendor Contract - ISP',        'Contract terms (2026 renewal)',                     'internal',     'raja',      '2026-01-12 09:09:00'),
('Data Retention Policy',        'Retention: logs 90d; audit 1y; backups 30d',        'internal',     'secops',    '2026-01-14 08:15:00'),
('Backup Restore Steps',         'Restore procedure for nightly snapshots',           'confidential', 'svc_backup','2026-01-16 03:10:00'),
('S3 Bucket Inventory',          'Buckets: prod-logs, prod-assets, archive',          'internal',     'ryan',      '2026-01-26 14:44:00'),
('Office Wi-Fi Keys',            'SSID: CyberCorp-Staff; Key rotation schedule',      'secret',       'it_admin',  '2026-01-05 09:00:00'),
('PenTest Summary',              'Findings: 7 medium, 2 high; remediation pending',   'confidential', 'secops',    '2026-01-23 17:50:00'),
('Bug Bounty Triage Notes',      'Weekly triage workflow',                            'internal',     'danial',    '2026-02-03 13:05:00'),
('App Secrets Rotation Plan',    'Rotate API keys quarterly; emergency rotation 24h', 'confidential', 'iman',      '2026-02-02 12:00:00'),
('Customer Support SOP',         'Ticket workflow + escalation matrix',               'internal',     'lina',      '2026-01-18 11:11:00'),
('Marketing Campaign Draft',     'Q2 launch messaging',                               'internal',     'sofia',     '2026-01-29 10:10:00'),
('Threat Intel Feed Notes',      'Sources: MISP, vendor feed, OSINT',                 'internal',     'secops',    '2026-02-04 06:30:00'),
('Build Pipeline Diagram',       'CI stages: lint, test, scan, deploy',               'internal',     'jason',     '2026-01-27 09:00:00'),
('Incident 2026-01 Postmortem',  'Root cause + action items',                         'confidential', 'aisha',     '2026-01-31 22:10:00'),
('Admin Access Review',          'Quarterly review list',                             'confidential', 'admin',     '2026-02-01 08:00:00'),
('Database Schema Notes',        'Tables: users, assets, events',                     'internal',     'intern01',  '2026-02-03 12:00:00'),
('Legacy App Credentials',       'Deprecated system creds (do not use)',              'secret',       'it_admin',  '2026-01-08 18:00:00'),
('Server Root Password',         'Highest privileged password for all servers',       'secret',       'admin',     '2026-02-02 20:10:10'),
('Compliance Checklist',         'Monthly checklist for controls',                    'internal',     'raja',      '2026-01-15 09:40:00'),
('Remote Work Policy',           'Device compliance required for VPN',                'internal',     'melissa',   '2026-01-09 16:00:00'),
('Blue Team Playbooks',          'Playbooks: phishing, malware, ddos, insider',       'confidential', 'secops',    '2026-02-03 19:10:00'),
('Asset Register Export',        'CSV export location /exports/assets.csv',           'internal',     'ryan',      '2026-02-01 14:25:00');

-- -------------------------
-- EVENTS (40)
-- Columns: created_at, username, event_type, ip, result
-- -------------------------
INSERT INTO events (created_at, username, event_type, ip, result) VALUES
('2026-02-04 08:41:03', 'syafiq',   'login',       '127.0.0.1', 'ok'),
('2026-02-04 08:55:19', 'aisha',    'login',       '127.0.0.1', 'ok'),
('2026-02-04 09:00:12', 'zul',      'login',       '127.0.0.1', 'fail'),
('2026-02-04 07:37:12', 'amir',     'login',       '127.0.0.1', 'ok'),
('2026-02-04 08:02:49', 'sofia',    'login',       '127.0.0.1', 'ok'),
('2026-02-03 09:12:45', 'admin',    'login',       '127.0.0.1', 'ok'),
('2026-02-04 02:15:34', 'svc_backup','login',      '127.0.0.1', 'ok'),
('2026-02-02 17:01:56', 'it_admin', 'login',       '127.0.0.1', 'ok'),
('2026-02-04 08:12:11', 'secops',   'login',       '127.0.0.1', 'ok'),
('2026-02-03 12:45:10', 'intern01',   'login',       '127.0.0.1', 'ok'),

('2026-02-03 18:20:11', 'haziq',    'view_asset',  '127.0.0.1', 'ok'),
('2026-02-03 11:09:13', 'hakim',    'view_asset',  '127.0.0.1', 'ok'),
('2026-02-02 13:12:10', 'jason',    'view_asset',  '127.0.0.1', 'ok'),
('2026-02-03 15:29:01', 'sara',     'view_asset',  '127.0.0.1', 'ok'),
('2026-02-02 16:04:00', 'farah',    'view_asset',  '127.0.0.1', 'ok'),
('2026-02-01 10:11:36', 'nadia',    'view_asset',  '127.0.0.1', 'ok'),
('2026-02-03 09:48:11', 'danial',   'view_asset',  '127.0.0.1', 'ok'),
('2026-02-02 10:40:34', 'iman',     'view_asset',  '127.0.0.1', 'ok'),
('2026-02-01 14:05:23', 'raja',     'view_asset',  '127.0.0.1', 'ok'),
('2026-02-01 18:41:56', 'melissa',  'view_asset',  '127.0.0.1', 'ok'),

('2026-02-03 10:12:05', 'secops',   'view_asset',  '127.0.0.1', 'ok'),
('2026-02-02 09:50:10', 'secops',   'view_asset',  '127.0.0.1', 'ok'),
('2026-02-03 08:05:45', 'khairul',  'view_asset',  '127.0.0.1', 'ok'),
('2026-02-02 21:10:41', 'lina',     'view_asset',  '127.0.0.1', 'ok'),
('2026-02-02 09:20:02', 'ryan',     'view_asset',  '127.0.0.1', 'ok'),
('2026-02-03 19:55:30', 'naufal',   'view_asset',  '127.0.0.1', 'warn'),
('2026-02-03 12:45:12', 'intern01',   'view_asset',  '127.0.0.1', 'warn'),
('2026-02-01 10:01:01', 'omar',     'login',       '127.0.0.1', 'fail'),
('2026-02-01 10:01:40', 'omar',     'login',       '127.0.0.1', 'fail'),
('2026-02-01 10:03:12', 'omar',     'login',       '127.0.0.1', 'fail'),

('2026-01-31 22:10:05', 'aisha',    'event_note',  '127.0.0.1', 'ok'),
('2026-01-30 18:43:02', 'syafiq',   'event_note',  '127.0.0.1', 'ok'),
('2026-01-23 17:51:10', 'secops',   'event_note',  '127.0.0.1', 'ok'),
('2026-01-27 09:00:05', 'jason',    'event_note',  '127.0.0.1', 'ok'),
('2026-01-16 03:10:10', 'svc_backup','event_note', '127.0.0.1', 'ok'),
('2026-02-02 20:10:11', 'admin',    'view_asset',  '127.0.0.1', 'ok'),
('2026-02-03 19:10:01', 'secops',   'view_asset',  '127.0.0.1', 'ok'),
('2026-02-01 08:00:01', 'admin',    'view_asset',  '127.0.0.1', 'ok'),
('2026-02-04 06:30:10', 'secops',   'view_asset',  '127.0.0.1', 'ok'),
('2026-02-02 12:00:01', 'iman',     'event_note',  '127.0.0.1', 'ok');
