<style>
  :root{
    --santa-red:#ff3b3b;
    --deep-blue:#1e3a8a;
    --ice-blue:#56b6ff;
    --mint:#c9f7e6;
    --snow:#f6fbff;
    --gold:#ffd166;
  }

  .pricing-wrapper{
    flex:1;
    padding:70px 5% 80px;
    display:flex;
    flex-direction:column;
    align-items:center;
    background:
      radial-gradient(circle at 20px 20px, rgba(86,182,255,.18) 0 10px, transparent 11px),
      radial-gradient(circle at 70px 60px, rgba(86,182,255,.14) 0 12px, transparent 13px),
      linear-gradient(180deg, #f7fcff 0%, #eef8ff 55%, #f7fcff 100%);
    background-size:120px 120px, 140px 140px, auto;
  }

  .pricing-header{
    text-align:center;
    max-width:920px;
  }

  .pricing-title{
    font-family:'Mountains of Christmas', cursive;
    font-size:clamp(2.4rem, 5vw, 3.8rem);
    color:var(--santa-red);
    margin:0;
    text-shadow:0 6px 18px rgba(255,59,59,.18);
    letter-spacing:.5px;
  }

  .pricing-subtitle{
    margin:10px auto 0;
    color:#315a7a;
    font-size:1.05rem;
    line-height:1.5;
    max-width:720px;
  }

  .tiers-flex{
    display:grid;
    grid-template-columns:repeat(3, minmax(260px, 320px));
    gap:26px;
    justify-content:center;
    width:100%;
    margin-top:44px;
    align-items:stretch;
  }

  @media (max-width: 980px){
    .tiers-flex{ grid-template-columns:repeat(2, minmax(260px, 340px)); }
  }
  @media (max-width: 680px){
    .tiers-flex{ grid-template-columns:1fr; max-width:420px; }
  }

  .tier-card{
    position:relative;
    background:rgba(255,255,255,.92);
    border-radius:34px;
    padding:28px 26px 24px;
    box-shadow:0 14px 30px rgba(0,0,0,.07);
    border:3px dashed rgba(49,90,122,.25);
    display:flex;
    flex-direction:column;
    text-align:left;
    overflow:hidden;
    transition:transform .18s ease, box-shadow .18s ease, border-color .18s ease;
    backdrop-filter: blur(6px);
  }

  .tier-card::before{
    content:"";
    position:absolute;
    inset:-2px;
    background:linear-gradient(135deg, rgba(255,209,102,.35), rgba(86,182,255,.25), rgba(255,59,59,.22));
    opacity:.0;
    transition:opacity .18s ease;
    pointer-events:none;
  }

  .tier-card:hover{
    transform:translateY(-6px) scale(1.02);
    box-shadow:0 18px 40px rgba(0,0,0,.10);
    border-color:rgba(49,90,122,.35);
  }
  .tier-card:hover::before{ opacity:1; }

  .tier-top{
    display:flex;
    align-items:center;
    gap:12px;
    margin-bottom:10px;
  }

  .tier-icon{
    width:52px;height:52px;
    border-radius:16px;
    display:grid;
    place-items:center;
    font-size:26px;
    background:linear-gradient(135deg, rgba(86,182,255,.25), rgba(255,209,102,.25));
    box-shadow:0 10px 18px rgba(0,0,0,.06);
    flex:0 0 auto;
  }

  .tier-name{
    margin:0;
    font-family:'Mountains of Christmas', cursive;
    font-size:2rem;
    color:var(--deep-blue);
    line-height:1;
  }

  .cost{
    display:inline-flex;
    align-items:center;
    gap:10px;
    width:fit-content;
    font-size:1.02rem;
    font-weight:800;
    color:#b82222;
    background:linear-gradient(180deg, #ffeaa7 0%, #ffd87a 100%);
    padding:10px 14px;
    border-radius:16px;
    margin:8px 0 14px;
    transform:rotate(-1.5deg);
    box-shadow:0 10px 16px rgba(255,209,102,.28);
  }

  .cost small{
    font-weight:800;
    color:#7a1b1b;
    opacity:.9;
  }

  .tier-card ul{
    list-style:none;
    padding:0;
    margin:12px 0 18px;
    flex-grow:1;
  }

  .tier-card li{
    margin-bottom:12px;
    font-size:1.02rem;
    color:#2b4b62;
    display:flex;
    gap:10px;
    align-items:flex-start;
    line-height:1.35;
  }

  .tier-card li::before{
    content:"❄️";
    transform:translateY(-1px);
  }

  .tier-footer{
    display:flex;
    gap:12px;
    align-items:center;
    justify-content:space-between;
  }

  .badge{
    font-size:.85rem;
    font-weight:800;
    padding:8px 10px;
    border-radius:999px;
    background:rgba(86,182,255,.18);
    color:#1b4d6a;
    border:1px solid rgba(86,182,255,.25);
  }

  /* Highlight (Santa) */
  .tier-star{
    border:4px solid rgba(255,59,59,.9);
    background:linear-gradient(180deg, rgba(255,245,245,.95) 0%, rgba(255,255,255,.92) 100%);
    transform:translateY(-10px);
  }
  .tier-star:hover{ transform:translateY(-16px) scale(1.02); }

  .tier-star .tier-icon{
    background:linear-gradient(135deg, rgba(255,59,59,.25), rgba(255,209,102,.30));
  }

  .tier-star .badge{
    background:rgba(255,59,59,.12);
    border-color:rgba(255,59,59,.22);
    color:#8b1c1c;
  }

  .ribbon{
    position:absolute;
    top:16px;
    right:-42px;
    transform:rotate(35deg);
    background:linear-gradient(180deg, #ff3b3b 0%, #d81f1f 100%);
    color:white;
    font-weight:900;
    font-size:.85rem;
    padding:10px 54px;
    box-shadow:0 12px 24px rgba(255,59,59,.28);
    letter-spacing:.6px;
  }

  /* Buttons (works with your existing .btn too) */
  .tier-card .btn{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    width:100%;
    padding:14px 16px;
    border-radius:999px;
    font-weight:900;
    text-decoration:none;
    border:0;
    transition:transform .12s ease, filter .12s ease;
    box-shadow:0 14px 20px rgba(0,0,0,.10);
  }

  .btn-primary{
    background:linear-gradient(180deg, #ff3b3b 0%, #d81f1f 100%);
    color:#fff;
  }
  .btn-primary:hover{ transform:translateY(-1px); filter:brightness(1.03); }

  .btn-locked{
    background:linear-gradient(180deg, rgba(86,182,255,.85) 0%, rgba(40,140,230,.95) 100%);
    color:#fff;
    opacity:.95;
    cursor:not-allowed;
  }
  .btn-locked:hover{ transform:none; filter:none; }

  .btn-locked::before{
    content:"🔒";
    margin-right:10px;
  }

  /* subtle sparkles */
  .sparkle{
    position:absolute;
    width:10px;height:10px;
    border-radius:50%;
    background:rgba(255,255,255,.8);
    box-shadow:0 0 0 6px rgba(255,255,255,.18);
    opacity:.0;
    animation:sparkle 2.8s ease-in-out infinite;
  }
  .tier-card:hover .sparkle{ opacity:1; }
  .s1{ top:18px; left:18px; animation-delay:.0s; }
  .s2{ top:58px; right:22px; animation-delay:.6s; }
  .s3{ bottom:22px; left:28px; animation-delay:1.2s; }

  @keyframes sparkle{
    0%,100%{ transform:scale(.85); opacity:.15; }
    50%{ transform:scale(1.2); opacity:.55; }
  }
</style>

<div class="pricing-wrapper">
  <div class="pricing-header">
    <h1 class="pricing-title">Join the Party! 🎉</h1>
    <p class="pricing-subtitle">
      Pick a magical path and unlock fun challenges. Share cheers and make your way to Santa’s special surprise!
    </p>
  </div>

  <div class="tiers-flex">
    <!-- Reindeer -->
    <div class="tier-card">
      <span class="sparkle s1"></span><span class="sparkle s2"></span><span class="sparkle s3"></span>

      <div class="tier-top">
        <div class="tier-icon">🦌</div>
        <h3 class="tier-name">Reindeer</h3>
      </div>

      <div class="cost"><small>Cost:</small> Magic Reindeer Food</div>

      <ul>
        <li>Learn to draw a reindeer picture</li>
        <li>Take photos with reindeer antlers</li>
        <li>Give veggies to reindeer</li>
      </ul>

      <div class="tier-footer">
        <span class="badge">Starter quests</span>
      </div>

      <a href="#" class="btn btn-locked" aria-disabled="true">Locked</a>
    </div>

    <!-- Santa (featured) -->
    <div class="tier-card tier-star">
      <div class="ribbon">MOST FUN</div>
      <span class="sparkle s1"></span><span class="sparkle s2"></span><span class="sparkle s3"></span>

      <div class="tier-top">
        <div class="tier-icon">🎅</div>
        <h3 class="tier-name">Santa</h3>
      </div>

      <div class="cost"><small>Cost:</small> Win Santa’s Game</div>

      <ul>
        <li>Meet &amp; greet with Santa</li>
        <li>Learn a new magical skill</li>
        <li>Request your favorite gift</li>
      </ul>

      <div class="tier-footer">
        <span class="badge">Best value</span>
      </div>

      <a href="index.php?page=game.php" class="btn btn-primary">Ho Ho Ho✨</a>
    </div>

    <!-- Elf -->
    <div class="tier-card">
      <span class="sparkle s1"></span><span class="sparkle s2"></span><span class="sparkle s3"></span>

      <div class="tier-top">
        <div class="tier-icon">🧝</div>
        <h3 class="tier-name">Elf</h3>
      </div>

      <div class="cost"><small>Cost:</small> Candy Cane</div>

      <ul>
        <li>Sing loud together with elf</li>
        <li>Play hide and seek</li>
        <li>Bake elf's favourite cookies</li>
      </ul>

      <div class="tier-footer">
        <span class="badge">Cheer squad</span>
      </div>

      <a href="#" class="btn btn-locked" aria-disabled="true">Locked</a>
    </div>
  </div>
</div>
