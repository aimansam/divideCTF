<style>
  :root{
    --santa-red:#ff3b3b;
    --deep-blue:#1e3a8a;
    --ice-blue:#56b6ff;
    --snow:#f6fbff;
    --mint:#c9f7e6;
    --gold:#ffd166;
  }

  .home-wrapper{
    flex:1;
    padding:72px 10% 86px;
    text-align:center;
    background:
      radial-gradient(circle at 20px 20px, rgba(86,182,255,.18) 0 10px, transparent 11px),
      radial-gradient(circle at 80px 70px, rgba(86,182,255,.13) 0 12px, transparent 13px),
      linear-gradient(180deg, #f7fcff 0%, #eef8ff 52%, #f7fcff 100%);
    background-size:120px 120px, 150px 150px, auto;
  }

  .home-hero{
    max-width:980px;
    margin:0 auto;
    position:relative;
  }

  .home-title{
    font-family:'Mountains of Christmas', cursive;
    font-size:clamp(2.4rem, 5vw, 4rem);
    color:var(--santa-red);
    margin:0;
    letter-spacing:.5px;
    text-shadow:0 10px 25px rgba(255,59,59,.18);
  }

  .home-subtitle{
    margin:14px auto 0;
    font-size:1.15rem;
    color:#2e5b7b;
    line-height:1.65;
    max-width:720px;
  }

  .hero-badges{
    margin-top:18px;
    display:flex;
    gap:10px;
    justify-content:center;
    flex-wrap:wrap;
  }

  .pill{
    display:inline-flex;
    align-items:center;
    gap:8px;
    padding:10px 14px;
    border-radius:999px;
    font-weight:900;
    font-size:.92rem;
    color:#1b4d6a;
    background:rgba(86,182,255,.14);
    border:1px solid rgba(86,182,255,.22);
    box-shadow:0 10px 18px rgba(0,0,0,.05);
  }
  .pill.red{
    color:#7a1b1b;
    background:rgba(255,59,59,.10);
    border-color:rgba(255,59,59,.18);
  }

  .magic-grid{
    margin-top:54px;
    display:grid;
    grid-template-columns:repeat(3, minmax(240px, 320px));
    gap:26px;
    justify-content:center;
    align-items:stretch;
  }

  @media (max-width: 980px){
    .magic-grid{ grid-template-columns:repeat(2, minmax(240px, 360px)); }
  }
  @media (max-width: 680px){
    .home-wrapper{ padding:60px 6% 70px; }
    .magic-grid{ grid-template-columns:1fr; max-width:420px; margin-left:auto; margin-right:auto; }
  }

  .fun-card{
    position:relative;
    background:rgba(255,255,255,.92);
    padding:26px 22px 22px;
    border-radius:34px;
    border:3px dashed rgba(46,91,123,.26);
    box-shadow:0 14px 30px rgba(0,0,0,.07);
    text-align:left;
    overflow:hidden;
    backdrop-filter: blur(6px);
    transition:transform .18s ease, box-shadow .18s ease, border-color .18s ease;
  }

  .fun-card::before{
    content:"";
    position:absolute;
    inset:-2px;
    background:linear-gradient(135deg,
      rgba(255,209,102,.35),
      rgba(86,182,255,.22),
      rgba(255,59,59,.20)
    );
    opacity:0;
    transition:opacity .18s ease;
    pointer-events:none;
  }

  .fun-card:hover{
    transform:translateY(-10px);
    border-color:rgba(255,59,59,.55);
    box-shadow:0 18px 42px rgba(0,0,0,.10);
  }
  .fun-card:hover::before{ opacity:1; }

  .card-top{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:14px;
    margin-bottom:18px;
  }

  .icon-bubble{
    width:62px;height:62px;
    border-radius:22px;
    display:grid;
    place-items:center;
    font-size:30px;
    background:linear-gradient(135deg, rgba(86,182,255,.22), rgba(255,209,102,.22));
    box-shadow:0 12px 20px rgba(0,0,0,.07);
    position:relative;
    flex:0 0 auto;
  }

  /* mini sparkle */
  .icon-bubble::after{
    content:"";
    position:absolute;
    width:10px;height:10px;
    border-radius:50%;
    top:-6px; right:-6px;
    background:rgba(255,255,255,.85);
    box-shadow:-12px 14px 0 rgba(255,255,255,.55), 14px 10px 0 rgba(255,255,255,.35);
    opacity:.9;
  }

  .stat{
    display:flex;
    flex-direction:column;
    gap:6px;
  }

  .stat h2{
    margin:0;
    font-family:'Mountains of Christmas', cursive;
    font-size:2.25rem;
    color:var(--santa-red);
    line-height:1;
  }

  .stat p{
    margin:0;
    font-size:1.02rem;
    color:#2b4b62;
    line-height:1.5;
  }

  .meter{
    height:12px;
    border-radius:999px;
    background:rgba(86,182,255,.12);
    border:1px solid rgba(86,182,255,.18);
    overflow:hidden;
    margin-top:14px;
  }

  .meter > span{
    display:block;
    height:100%;
    width:60%;
    border-radius:999px;
    background:linear-gradient(90deg, rgba(86,182,255,.95), rgba(255,209,102,.95));
  }

  /* Different meter widths per card */
  .m-1 span{ width:85%; }
  .m-2 span{ width:70%; }
  .m-3 span{ width:92%; }

  /* Featured middle card (optional, matches screenshot focus vibe) */
  .featured{
    border:4px solid rgba(86,182,255,.60);
    background:linear-gradient(180deg, rgba(255,255,255,.95) 0%, rgba(246,251,255,.92) 100%);
  }
  .featured:hover{ border-color:rgba(255,59,59,.75); }
</style>

<div class="home-wrapper">
  <div class="home-hero">
    <h1 class="home-title">Welcome to Santa’s House! 🎄</h1>
    <p class="home-subtitle">
      The elves are busy, the reindeer are training, and the cocoa is hot — peek at today’s North Pole stats!
    </p>

    <div class="hero-badges">
      <span class="pill">✨ Live updates</span>
      <span class="pill red">🎁 Gift-ready</span>
      <span class="pill">❄️ Snowy vibes</span>
    </div>
  </div>

  <div class="magic-grid">
    <div class="fun-card">
      <div class="card-top">
        <div class="icon-bubble">🎁</div>
        <span class="pill" style="margin:0;">+ Cheer</span>
      </div>

      <div class="stat">
        <h2>2.1 Billion</h2>
        <p>Gifts Delivered</p>
      </div>

      <div class="meter m-1"><span></span></div>
    </div>

    <div class="fun-card featured">
      <div class="card-top">
        <div class="icon-bubble">🦌</div>
        <span class="pill red" style="margin:0;">Top team</span>
      </div>

      <div class="stat">
        <h2>9 Dashers</h2>
        <p>Reindeer Ready</p>
      </div>

      <div class="meter m-2"><span></span></div>
    </div>

    <div class="fun-card">
      <div class="card-top">
        <div class="icon-bubble">🛷</div>
        <span class="pill" style="margin:0;">Zoom!</span>
      </div>

      <div class="stat">
        <h2>Super Fast</h2>
        <p>Sleigh Speed</p>
      </div>

      <div class="meter m-3"><span></span></div>
    </div>
  </div>
</div>
