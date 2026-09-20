<style>
  :root{
    --santa-red:#ff3b3b;
    --deep-blue:#1e3a8a;
    --ice-blue:#56b6ff;
    --snow:#f6fbff;
    --mint:#c9f7e6;
    --gold:#ffd166;
  }

  .services-wrapper{
    flex:1;
    padding:70px 10% 80px;
    border-radius:50px 50px 0 0;
    background:
      radial-gradient(circle at 22px 22px, rgba(86,182,255,.18) 0 10px, transparent 11px),
      radial-gradient(circle at 80px 70px, rgba(86,182,255,.13) 0 12px, transparent 13px),
      linear-gradient(180deg, #fff7f7 0%, #fff0f2 35%, #f7fcff 100%);
    background-size:120px 120px, 150px 150px, auto;
  }

  .services-head{
    text-align:center;
    max-width:900px;
    margin:0 auto 46px;
  }

  .services-title{
    font-family:'Mountains of Christmas', cursive;
    font-size:clamp(2.3rem, 5vw, 3.8rem);
    color:var(--santa-red);
    margin:0;
    letter-spacing:.5px;
    text-shadow:0 10px 25px rgba(255,59,59,.18);
  }

  .services-subtitle{
    margin:12px auto 0;
    color:#2e5b7b;
    font-size:1.1rem;
    line-height:1.6;
  }

  .service-container{
    display:grid;
    grid-template-columns:repeat(3, minmax(260px, 360px));
    gap:28px;
    justify-content:center;
    align-items:stretch;
  }

  @media (max-width: 980px){
    .service-container{ grid-template-columns:repeat(2, minmax(260px, 380px)); }
  }
  @media (max-width: 680px){
    .services-wrapper{ padding:60px 6% 70px; }
    .service-container{ grid-template-columns:1fr; max-width:420px; margin:0 auto; }
  }

  .magic-box{
    position:relative;
    background:rgba(255,255,255,.92);
    border-radius:34px;
    padding:34px 28px 28px;
    text-align:left;
    border:3px dashed rgba(46,91,123,.26);
    box-shadow:0 14px 30px rgba(0,0,0,.07);
    overflow:hidden;
    transition:transform .18s ease, box-shadow .18s ease, border-color .18s ease;
    backdrop-filter: blur(6px);
  }

  .magic-box::before{
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

  .magic-box:hover{
    transform:translateY(-8px);
    box-shadow:0 18px 42px rgba(0,0,0,.10);
    border-color:rgba(255,59,59,.55);
  }
  .magic-box:hover::before{ opacity:1; }

  .magic-top{
    display:flex;
    align-items:center;
    gap:14px;
    margin-bottom:14px;
  }

  .magic-icon{
    width:64px;height:64px;
    border-radius:22px;
    display:grid;
    place-items:center;
    font-size:30px;
    background:linear-gradient(135deg, rgba(86,182,255,.22), rgba(255,209,102,.22));
    box-shadow:0 12px 20px rgba(0,0,0,.07);
    flex:0 0 auto;
    position:relative;
  }

  /* tiny sparkle dots */
  .magic-icon::after{
    content:"";
    position:absolute;
    width:10px;height:10px;
    border-radius:50%;
    top:-6px; right:-6px;
    background:rgba(255,255,255,.85);
    box-shadow:
      -10px 14px 0 rgba(255,255,255,.55),
      14px 10px 0 rgba(255,255,255,.35);
    opacity:.9;
  }

  .magic-box h3{
    font-family:'Mountains of Christmas', cursive;
    font-size:2.1rem;
    margin:0;
    color:var(--deep-blue);
    line-height:1;
  }

  .magic-box p{
    color:#2b4b62;
    font-size:1.05rem;
    line-height:1.6;
    margin:10px 0 0;
  }

  .magic-footer{
    display:flex;
    align-items:center;
    justify-content:space-between;
    margin-top:18px;
    gap:12px;
  }

  .chip{
    display:inline-flex;
    align-items:center;
    gap:8px;
    font-size:.85rem;
    font-weight:900;
    padding:9px 12px;
    border-radius:999px;
    border:1px solid rgba(86,182,255,.25);
    background:rgba(86,182,255,.14);
    color:#1b4d6a;
    white-space:nowrap;
  }

  .learn{
    text-decoration:none;
    font-weight:900;
    color:var(--santa-red);
    background:rgba(255,59,59,.10);
    border:1px solid rgba(255,59,59,.18);
    padding:9px 12px;
    border-radius:999px;
    transition:transform .12s ease, filter .12s ease;
    white-space:nowrap;
  }

  .learn:hover{
    transform:translateY(-1px);
    filter:brightness(1.02);
  }

  /* Optional: make the middle card feel “featured” like your screenshot */
  .magic-featured{
    border:4px solid rgba(86,182,255,.65);
    background:linear-gradient(180deg, rgba(255,255,255,.95) 0%, rgba(246,251,255,.92) 100%);
  }
  .magic-featured:hover{ border-color:rgba(255,59,59,.75); }

</style>

<div class="services-wrapper">
  <div class="services-head">
    <h1 class="services-title">How We Spread Joy 💖</h1>
    <p class="services-subtitle">
      From the North Pole to your living room — powered by teamwork, twinkles, and a sprinkle of magic dust!
    </p>
  </div>

  <div class="service-container">
    <div class="magic-box">
      <div class="magic-top">
        <div class="magic-icon">📜</div>
        <div>
          <h3>Naughty or Nice?</h3>
        </div>
      </div>

      <p>
        Our magical scroll updates in real-time. Share your toys, help a friend, and watch your cheer level rise — Santa’s watching! ✨
      </p>

      <div class="magic-footer">
        <span class="chip">Live status</span>
        <a class="learn" href="#">See the List →</a>
      </div>
    </div>

    <div class="magic-box magic-featured">
      <div class="magic-top">
        <div class="magic-icon">🚀</div>
        <div>
          <h3>Rocket Sleigh</h3>
        </div>
      </div>

      <p>
        Dasher and Dancer got an upgrade! Presents zoom across the skies faster than a shooting star — with zero chimney traffic. 🌟
      </p>

      <div class="magic-footer">
        <span class="chip">Fast delivery</span>
        <a class="learn" href="#">Track Magic →</a>
      </div>
    </div>

    <div class="magic-box">
      <div class="magic-top">
        <div class="magic-icon">🧸</div>
        <div>
          <h3>Toy Workshop</h3>
        </div>
      </div>

      <p>
        Handmade with love by singing elves. No batteries required — just imagination, giggles, and a tiny bit of glitter. 🎁
      </p>

      <div class="magic-footer">
        <span class="chip">Handmade</span>
        <a class="learn" href="#">Visit Workshop →</a>
      </div>
    </div>
  </div>
</div>
