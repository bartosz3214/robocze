# bartek-robocze

A PHP learning project. The environment runs in Docker (PHP 8.5 + nginx + MySQL), the
work is split into tickets in [`tickets/`](tickets/), and each ticket is done on its own
git branch.

Read this file top to bottom once before you start.

---

## 1. Requirements

You need only two things installed:

- **Docker** with the Compose plugin — `docker compose version` should print something
- **Node.js 18+** — only to install the git hooks, the project itself does not use it

You do **not** need PHP, nginx or MySQL on your computer. They all run in containers.

---

## 2. Running the project

```bash
# 1. Copy the environment file and set it to your own user
cp .env.example .env
sed -i "s/^APP_UID=.*/APP_UID=$(id -u)/;s/^APP_GID=.*/APP_GID=$(id -g)/" .env

# 2. Install the git hooks (branch name checking)
npm install

# 3. Build and start everything
docker compose up -d --build
```

Open <http://localhost> in your browser.

The first build takes a few minutes — it compiles the PHP extensions. Later starts
take seconds.

### Everyday commands

| What you want | Command |
|---|---|
| Start | `docker compose up -d` |
| Stop | `docker compose down` |
| Stop **and wipe the database** | `docker compose down -v` |
| See what is running | `docker compose ps` |
| Watch PHP errors live | `docker compose logs -f php` |
| Watch nginx logs | `docker compose logs -f nginx` |
| A shell inside the PHP container | `docker compose exec php bash` |
| Run a PHP file from the terminal | `docker compose exec php php yourfile.php` |
| Open the MySQL console | `docker compose exec mysql mysql -uapp -papp app` |
| Import a `.sql` file | `docker compose exec -T mysql mysql -uapp -papp app < schema.sql` |
| Rebuild after changing the Dockerfile | `docker compose up -d --build` |

You do **not** need to restart anything after editing a `.php` file. Your project
folder is mounted into the containers — save the file, refresh the browser.

### Settings

Everything configurable lives in `.env` (copied from `.env.example`). The ones you may
actually want to change:

| Variable | Default | Meaning |
|---|---|---|
| `NGINX_PORT` | `80` | Port on your machine. Change to `8080` if something already uses 80. |
| `NGINX_ROOT` | `/var/www/html` | Document root inside the container. |
| `MYSQL_DATABASE` / `MYSQL_USER` / `MYSQL_PASSWORD` | `app` / `app` / `app` | Database credentials. |
| `MYSQL_PORT` | `3306` | Port for connecting from a GUI client on your machine. |
| `PHP_DISPLAY_ERRORS` | `1` | Keep this on while learning — you want to see errors. |

`.env` is **not** committed to git. `.env.example` is. If you add a new setting, add it
to both.

### Connecting a database GUI

Host `127.0.0.1`, port `3306`, user `app`, password `app`, database `app`.
From **inside** PHP the host is `mysql`, not `localhost` — see ticket 09.

### When something breaks

| Symptom | Likely cause |
|---|---|
| Completely blank page | A PHP fatal error. Run `docker compose logs -f php`. |
| `502 Bad Gateway` | The PHP container is not running. `docker compose ps`. |
| `404 Not Found` | No such file, or you have no `index.php` yet. |
| Port 80 already in use | Set `NGINX_PORT=8080` in `.env`, then `docker compose up -d`. |
| Cannot connect to the database | It is still starting. Wait for `healthy` in `docker compose ps`. |

---

## 3. How to work with git

### The rule

**Every ticket gets its own branch.** You never commit straight to `master`.

Branch names must follow this convention:

```
feature/<ticketnumber>-<description>
```

| | |
|---|---|
| ✅ | `feature/02-hello-world` |
| ✅ | `feature/07-functions` |
| ✅ | `feature/11-oop-inheritance-and-interfaces` |
| ❌ | `hello-world` — no prefix, no ticket number |
| ❌ | `feature/hello` — no ticket number |
| ❌ | `feature/02_Hello` — use lowercase letters and dashes |

The ticket number and description come straight from the ticket file name:
`tickets/02-hello-world.md` → `feature/02-hello-world`.

This is **enforced automatically**. A git hook (husky) checks the branch name on every
commit and rejects it if it does not match, or if you are on `master`. That is not a
suggestion you can forget — it simply will not let you commit.

### The loop, for every single ticket

```bash
# 1. Start from an up-to-date master
git switch master
git pull

# 2. Create the branch for the ticket you are about to do
git switch -c feature/02-hello-world

# 3. ... write the code ...

# 4. See what you changed
git status
git diff

# 5. Stage and commit (as often as you like - small commits are good)
git add index.php
git commit -m "Add hello world page"

# 6. Push it
git push -u origin feature/02-hello-world

# 7. Open a pull request, get it reviewed, then move to the next ticket
```

### Commit messages

One short line, present tense, saying what the change does:

- ✅ `Add product list table`
- ✅ `Validate email in contact form`
- ❌ `fix`, `changes`, `asdf`, `work from today`

### Commands you will use constantly

| What you want | Command |
|---|---|
| Which branch am I on? | `git branch --show-current` |
| What have I changed? | `git status` |
| Show me the changes | `git diff` |
| Create and switch to a branch | `git switch -c feature/03-variables-and-types` |
| Switch to an existing branch | `git switch feature/03-variables-and-types` |
| Rename the branch I am on | `git branch -m feature/03-variables-and-types` |
| Stage one file | `git add index.php` |
| Stage everything | `git add .` |
| Commit | `git commit -m "Your message"` |
| Push the first time | `git push -u origin <branch>` |
| Push after that | `git push` |
| See recent commits | `git log --oneline -10` |
| Throw away changes in one file | `git restore index.php` |

### If the hook rejects your commit

You will see a message telling you exactly what is wrong. Usually you created the
branch with the wrong name — rename it and commit again:

```bash
git branch -m feature/02-hello-world
git commit -m "Add hello world page"
```

If you committed on `master` by accident, nothing is lost — move your work to a branch:

```bash
git switch -c feature/02-hello-world
```

Your staged changes come with you.

> `git commit --no-verify` skips the hook. It exists for emergencies such as
> finishing a merge on `master`. If you are reaching for it during a ticket,
> the branch name is the thing to fix, not the hook.

### Hook setup

The hook is installed by `npm install` (husky runs on the `prepare` script). If commits
stop being checked, run `npm install` again. The check itself is a plain shell script in
`.husky/check-branch-name.sh` — read it, it is short.

---

## 4. The tickets

Do them **in order**. Each one builds on the one before it, and the later tickets
assume you still have the files from the earlier ones.

| # | Ticket | Branch | Time | What you learn |
|---|---|---|---|---|
| 01 | Docker environment | `feature/1-docker-compose` | — | ✅ Done — this is the setup you are running |
| 02 | [Hello World](tickets/02-hello-world.md) | `feature/02-hello-world` | 1h | `echo`, PHP tags, server vs. browser |
| 03 | [Variables and types](tickets/03-variables-and-types.md) | `feature/03-variables-and-types` | 1–2h | Variables, string, int, float, bool, interpolation |
| 04 | [Conditionals](tickets/04-conditionals.md) | `feature/04-conditionals` | 2h | `if` / `elseif` / `else`, `switch`, `===` vs `==` |
| 05 | [Loops](tickets/05-loops.md) | `feature/05-loops` | 2h | `for`, `while`, nesting, `break`, `continue` |
| 06 | [Arrays](tickets/06-arrays.md) | `feature/06-arrays` | 2–3h | Indexed and associative arrays, `foreach` |
| 07 | [Functions](tickets/07-functions.md) | `feature/07-functions` | 2–3h | Parameters, return values, types, scope |
| 08 | [Forms](tickets/08-forms-and-superglobals.md) | `feature/08-forms-and-superglobals` | 3h | `$_POST`, `$_GET`, validation, escaping output |
| 09 | [MySQL and PDO](tickets/09-mysql-with-pdo.md) | `feature/09-mysql-with-pdo` | 3–4h | Connecting, `SELECT`, `INSERT`, prepared statements |
| 10 | [OOP part 1](tickets/10-oop-classes-and-objects.md) | `feature/10-oop-classes-and-objects` | 4h | **Classes, objects, constructors, encapsulation** |
| 11 | [OOP part 2](tickets/11-oop-inheritance-and-interfaces.md) | `feature/11-oop-inheritance-and-interfaces` | 5h | **Inheritance, abstract classes, interfaces, polymorphism, repository** |

Tickets 10 and 11 are the OOP exercises, and they are the point the rest is building
towards. Tickets 02–09 deliberately use loose arrays and plain functions so that
ticket 10 has something concrete to improve on — the product list you build in
ticket 06 comes back as a class in ticket 10 and as a class hierarchy in ticket 11.

### What "done" means

A ticket is finished when every box in its **Acceptance criteria** is ticked, the code
is committed on the correctly named branch, and the branch is pushed.

---

## 5. Project structure

```
.
├── compose.yaml                     # The three services: nginx, php, mysql
├── .env.example                     # Every setting, copy to .env
├── docker/
│   ├── php/
│   │   ├── Dockerfile               # PHP 8.5-FPM + extensions + Composer
│   │   └── php.ini                  # memory limit, upload size, error display
│   └── nginx/templates/
│       └── default.conf.template    # nginx vhost, filled in from .env
├── .husky/
│   ├── pre-commit                   # Runs on every commit
│   └── check-branch-name.sh         # The branch name rule
├── tickets/                         # Your work, one file per ticket
└── README.md                        # This file
```

Your own PHP files go in the project root (and `src/` from ticket 10 onwards).
