<?php
    $page = isset($_GET['page']) ? $_GET['page'] : '';
    $hide_layout = (basename($page) === 'game.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Santa's Workshop | Spreading Joy</title>
    <style>
        /* Importing fun, magical fonts */
        @import url('https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;600&family=Mountains+of+Christmas:wght@400;700&display=swap');
        
        :root {
            --santa-red: #ff3333;
            --snow: #ffffff;
            --ice-blue: #74b9ff;
            --deep-blue: #0984e3; /* For text contrast */
            --soft-pink: #ffeaa7; /* Replaced yellow with a soft cream/pink */
        }

        body {
            font-family: 'Fredoka', sans-serif; /* Round, friendly font */
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            /* Fun snowy background pattern */
            background-color: #f0faff; 
            background-image: radial-gradient(#dff9fb 20%, transparent 20%), radial-gradient(#dff9fb 20%, transparent 20%);
            background-position: 0 0, 50px 50px;
            background-size: 100px 100px;
            color: var(--deep-blue);
        }

        /* Bouncy, joyful navigation */
        nav {
            background: var(--snow);
            padding: 1rem 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 5px 20px rgba(116, 185, 255, 0.3);
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
        }

        .logo-link {
            display: flex;
            align-items: center;
            text-decoration: none;
            gap: 10px;
        }

        .logo-link:hover img {
            animation: bounce 0.6s infinite alternate; /* Fun bounce effect */
        }

        .logo-text {
            font-family: 'Mountains of Christmas', cursive;
            font-weight: 700;
            font-size: 2rem;
            color: var(--santa-red);
            margin: 0;
            text-shadow: 2px 2px 0px #ffeaa7;
        }

        .nav-links a {
            color: var(--deep-blue);
            text-decoration: none;
            margin-left: 20px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: 0.3s;
            padding: 8px 15px;
            border-radius: 20px;
        }

        .nav-links a:hover {
            background: var(--ice-blue);
            color: white;
            transform: rotate(-3deg); /* Playful tilt */
        }

        /* The Gap Killer */
        .main-content { flex: 1; display: flex; flex-direction: column; }

        footer {
            background: white;
            text-align: center;
            padding: 2rem;
            color: var(--deep-blue);
            font-size: 1rem;
            border-top: 5px solid var(--ice-blue);
            margin-top: auto;
        }

        /* Fun Buttons */
        .btn {
            background: var(--santa-red);
            color: white;
            padding: 15px 35px;
            text-decoration: none;
            border-radius: 50px; /* Pill shape */
            font-family: 'Fredoka', sans-serif;
            font-weight: 600;
            font-size: 1.2rem;
            display: inline-block;
            box-shadow: 0 5px 0px #c0392b; /* 3D effect */
            transition: 0.2s;
            border: none;
        }

        .btn:hover {
            transform: translateY(3px);
            box-shadow: 0 2px 0px #c0392b; /* Press down effect */
        }

        @keyframes bounce {
            from { transform: translateY(0); }
            to { transform: translateY(-8px); }
        }
    </style>
</head>
<body>

<?php if (!$hide_layout): ?>
<nav>
    <a href="index.php" class="logo-link">
        <img src="https://images.unsplash.com/photo-1640083652354-5b2664e5dfae?auto=format&amp;fit=crop&amp;w=160&amp;h=160&amp;q=85" width="50" height="50" alt="Santa Hat" loading="eager" referrerpolicy="no-referrer" onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1638112110884-8aff837033e5?auto=format&amp;fit=crop&amp;w=160&amp;h=160&amp;q=85';">
        <h1 class="logo-text">Santa HQ</h1>
    </a>
    <div class="nav-links">
        <a href="index.php?page=home.php">🏠 Santa's Home</a>
        <a href="index.php?page=services.php">🎁 Services</a>
        <a href="index.php?page=pricing.php">📜 Party</a>
    </div>
</nav>
<?php endif; ?>

<div class="main-content">
    <?php
        if ($page !== '') {
            include($page);
        } else {
            // Default Fun Hero Section
            echo '
            <div style="flex:1; display:flex; flex-direction:column; justify-content:center; align-items:center; text-align:center; padding: 50px; background: linear-gradient(rgba(255,255,255,0.78), rgba(255,255,255,0.78)), url(\'https://images.unsplash.com/photo-1612979168796-bcae1575b8c5?auto=format&amp;fit=crop&amp;w=1920&amp;q=85\'); background-size:cover; background-position:center; border-radius: 30px; margin: 20px;">
                <h1 style="font-family:\'Mountains of Christmas\'; font-size:4.5rem; color:var(--santa-red); margin:0; line-height: 1.2; text-shadow: 3px 3px 0px white;">Sparkle, Joy & <br>Magic Everywhere! ✨</h1>
                
                <p style="font-size:1.4rem; color:var(--deep-blue); max-width:600px; margin: 20px auto;">
                    Welcome to the happiest place on the internet! Santa and his elves are working hard to deliver smiles to <b>you</b>.
                </p>
                
                <div style="margin-top:30px;">
                    <a href="index.php?page=services.php" class="btn">🎁 Send a Gift</a>
                    <a href="index.php?page=game.php" class="btn" style="background:var(--ice-blue); box-shadow: 0 5px 0px #0984e3; margin-left: 15px;">🎮 Play Games</a>
                </div>
            </div>';
        }
    ?>
</div>

<footer>
    Made with 🍪 cookies and 🥛 milk at the North Pole.<br>
    <small>© 2026 Santa HQ | Spreading Smiles Daily</small>
</footer>

</body>
</html>
