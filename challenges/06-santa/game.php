<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Santa's Workshop | Guess the Code</title>
    <style>
        /* Importing fun, magical fonts */
        @import url('https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;600&family=Mountains+of+Christmas:wght@400;700&display=swap');
        
        /* Base Variables (In case game.php is loaded directly) */
        :root {
            --santa-red: #ff3333;
            --snow: #ffffff;
            --ice-blue: #74b9ff;
            --deep-blue: #0984e3; 
            --soft-pink: #ffeaa7; 
        }

        body {
            font-family: 'Fredoka', sans-serif;
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f0faff; 
            background-image: radial-gradient(#dff9fb 20%, transparent 20%), radial-gradient(#dff9fb 20%, transparent 20%);
            background-position: 0 0, 50px 50px;
            background-size: 100px 100px;
            color: var(--deep-blue);
        }

        /* 1. Fun Wrapper */
        .game-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            min-height: 80vh; 
            animation: slideDown 0.6s ease-out;
        }

        /* 2. The Back Button */
        .back-btn {
            align-self: flex-start;
            margin-bottom: 20px;
            margin-left: 10px;
            text-decoration: none;
            background: var(--ice-blue);
            color: white;
            padding: 12px 25px;
            border-radius: 50px;
            font-family: 'Fredoka', sans-serif;
            font-weight: 600;
            font-size: 1.1rem;
            box-shadow: 0 5px 0 #0984e3; 
            transition: 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .back-btn:hover {
            transform: translateY(3px);
            box-shadow: 0 2px 0 #0984e3;
            background: #63acff;
        }

        /* 3. The Game Card */
        .game-card { 
            background: white; 
            width: 100%;
            max-width: 450px;
            padding: 40px; 
            border-radius: 40px; 
            text-align: center; 
            border: 5px solid var(--santa-red);
            box-shadow: 10px 10px 0px rgba(116, 185, 255, 0.4);
            position: relative;
        }

        /* 4. Polaroid Image Frame */
        .polaroid-frame {
            background: white;
            padding: 10px 10px 40px 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            transform: rotate(-3deg);
            transition: 0.3s;
            margin: 0 auto 20px auto;
            width: 250px;
            border: 1px solid #eee;
        }
        
        .polaroid-frame:hover { transform: rotate(0deg) scale(1.05); }
        .polaroid-frame img { width: 100%; border-radius: 4px; display: block; }

        /* 5. Typography & Inputs */
        .game-title {
            font-family: 'Mountains of Christmas', cursive;
            color: var(--santa-red);
            font-size: 2.8rem;
            margin: 0;
            text-shadow: 2px 2px 0 #ffeaa7;
        }

        .game-desc { color: #888; font-size: 1.1rem; margin-bottom: 25px; font-family: 'Fredoka', sans-serif;}

        .input-group {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-top: 20px;
        }

        .game-input { 
            padding: 15px; 
            border-radius: 50px; 
            border: 3px solid var(--ice-blue); 
            width: 120px; 
            text-align: center; 
            font-size: 1.5rem; 
            font-family: 'Fredoka', sans-serif;
            color: var(--deep-blue);
            outline: none;
        }

        .game-input:focus { border-color: var(--santa-red); }

        .guess-btn { 
            padding: 15px 30px; 
            border-radius: 50px; 
            border: none; 
            font-size: 1.2rem; 
            font-family: 'Fredoka', sans-serif;
            font-weight: bold;
            background: var(--santa-red); 
            color: white; 
            cursor: pointer; 
            transition: 0.2s; 
            box-shadow: 0 5px 0 #c0392b;
        }

        .guess-btn:hover { transform: translateY(3px); box-shadow: 0 2px 0 #c0392b; }
        
        /* 6. Feedback Messages */
        #message { font-size: 1.4rem; font-weight: bold; margin-top: 20px; min-height: 30px; font-family: 'Mountains of Christmas', cursive; }
        #display { font-size: 1.2rem; color: var(--ice-blue); font-family: monospace; margin-top: 10px; }

        .win-text { color: #27ae60 !important; animation: pop 0.5s; }
        .lose-text { color: var(--santa-red) !important; animation: shake 0.4s; }

        @keyframes slideDown { from { transform: translateY(-50px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
        @keyframes shake { 0%, 100% { transform: translateX(0); } 25%, 75% { transform: translateX(-5px); } 50% { transform: translateX(5px); } }
        @keyframes pop { 50% { transform: scale(1.1); } }
    </style>
</head>
<body>

<div class="game-wrapper">
    <a href="index.php?page=home.php" class="back-btn">
        <span>⬅</span> Back to Home
    </a>

    <div class="game-card">
        <div style="font-size: 3rem; position: absolute; top: -30px; right: -20px; transform: rotate(15deg);">🎁</div>
        <div style="font-size: 3rem; position: absolute; bottom: -20px; left: -20px; transform: rotate(-15deg);">❄️</div>

        <div class="polaroid-frame">
            <img id="reaction" src="https://images.unsplash.com/photo-1640083652354-5b2664e5dfae?auto=format&amp;fit=crop&amp;w=900&amp;q=85" alt="Santa hat" referrerpolicy="no-referrer" onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1638112110884-8aff837033e5?auto=format&amp;fit=crop&amp;w=900&amp;q=85';">
        </div>
        
        <h1 class="game-title">Guess the Code!</h1>
        <p class="game-desc">Unlock the magical gift box. <br>Hint: It's a 4-digit number!</p>
        
        <div class="input-group">
            <input type="number" id="userGuess" class="game-input" placeholder="0000">
            <button id="fetchBtn" class="guess-btn">Unlock</button>
        </div>

        <div id="message"></div>
        <div id="display"></div>
    </div>
</div>

<script>
    const btn = document.getElementById('fetchBtn');
    const display = document.getElementById('display');
    const message = document.getElementById('message');
    const reaction = document.getElementById('reaction');
    const funPhrases = ["Scanning Snowflakes... ❄️", "Asking the Elves... 🧝", "Checking the List... 📜", "Warming up Cocoa... ☕"];

    btn.addEventListener('click', function() {
        const userGuess = document.getElementById('userGuess').value;

        if (userGuess === "") {
            message.innerText = "Type a number first! 🖍️";
            message.className = "lose-text";
            return;
        }

        // Start UI feedback loop
        btn.disabled = true;
        message.className = "";
        let phraseIndex = 0;
        const interval = setInterval(() => {
            message.innerText = funPhrases[phraseIndex++ % funPhrases.length];
        }, 400);
        
        // Create the data package for POST
        const formData = new FormData();
        formData.append('guess', userGuess);

        // Perform the POST request to the API
        fetch('api/secret.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            clearInterval(interval);
            btn.disabled = false;
            btn.innerText = "Unlock";

            if (data.success) {
                message.innerText = data.message;
                message.className = "win-text";
                
                // If the server sends a flag, show it! Otherwise just show the code.
                if (data.flag) {
                    display.innerHTML = `Verified: ${data.code}<br><br><div style="background:#27ae60; color:white; padding:10px; border-radius:10px;">🚩 ${data.flag}</div>`;
                } else {
                    display.innerText = "Verified: " + data.code;
                }
                
                reaction.src = "https://images.unsplash.com/photo-1641040264491-04875c91d292?auto=format&fit=crop&w=900&q=85";
            } else {
                message.innerText = data.message;
                message.className = "lose-text";
                display.innerText = data.hint;
                reaction.src = "https://images.unsplash.com/photo-1638112110884-8aff837033e5?auto=format&fit=crop&w=900&q=85";
            }
        })
        .catch(err => {
            clearInterval(interval);
            btn.disabled = false;
            btn.innerText = "Retry";
            message.innerText = "The elves are on break (Error)";
            message.className = "lose-text";
        });
    });
</script>

</body>
</html>
