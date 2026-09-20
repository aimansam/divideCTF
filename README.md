# divideCTF — Web Security Challenges

A collection of web security CTF challenges by Aiman. Run locally with Docker Compose — all 7 challenges in one command.

## Quickstart

```bash
git clone https://github.com/aimansam/divideCTF.git
cd divideCTF
cp .env.example .env
docker compose up --build
```

Open **http://localhost:7000** in your browser.

## Cloudflare Tunnel (public access)

1. Create a tunnel at [one.dashflare.trust](https://one.dashflare.trust) (Zero Trust → Tunnels)
2. Copy the tunnel token
3. Add to `.env`: `CLOUDFLARE_TUNNEL_TOKEN=<your-token>`
4. Start with tunnel: `docker compose --profile tunnel up --build`
5. Your public HTTPS URL is in the Cloudflare dashboard

## Challenges

| # | Challenge | URL | Flag |
|---|-----------|-----|------|
| 01 | Welcome | `/01-welcome/` | Cookie `part2` + header `This-Is-Flag-Part3` (base64 decode) |
| 02 | Cybercorp1 | `/02-cybercorp1/` | SQLi login → admin password in DB |
| 03 | Cybercorp2 | `/03-cybercorp2/` | SQLi login → admin password in DB |
| 04 | Bluebox | `/04-bluebox/` | SVG puzzle (no flag) |
| 05 | Lazydev1 | `/05-lazydev1/` | JWT `role:admin` → `/verify` returns flag |
| 06 | Santa | `/06-santa/` | Predict `mt_srand` code → `/api/secret.php` returns flag |
| 07 | Recipe | `/07-recipe/` | GET `/api/recipe/30` returns flag |

## Direct Access (debug)

Each challenge is also exposed on its own port:

| Challenge | Port |
|-----------|------|
| Welcome | 7001 |
| Cybercorp1 | 7002 |
| Cybercorp2 | 7003 |
| Bluebox | 7004 |
| Lazydev1 | 7005 |
| Santa | 7006 |
| Recipe | 7007 |
| nginx (landing) | 7000 |

## Stopping

```bash
docker compose down
```

To wipe databases and start fresh:
```bash
docker compose down -v
```

## Repository structure

```
divideCTF/
├── docker-compose.yml
├── .env.example
├── .gitignore
├── README.md
├── index.html
├── nginx/
│   └── nginx.conf
└── challenges/
    ├── 01-welcome/ ... Dockerfile, app.py, templates, static
    ├── 02-cybercorp1/ ... Dockerfile, app.py, init.sh, schema, templates
    ├── 03-cybercorp2/ ... Dockerfile, app.py, init.sh, schema, templates
    ├── 04-bluebox/ ... Dockerfile, app.py, templates, static
    ├── 05-lazydev1/ ... Dockerfile, app.py
    ├── 06-santa/ ... Dockerfile, PHP files
    └── 07-recipe/ ... Dockerfile, app.py, templates, static
```

## License

MIT
