<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>আপনার Business — Learn. Build. Grow. (Concept Preview)</title>
<meta name="robots" content="noindex, nofollow">
<meta name="csrf-token" content="{{ csrf_token() }}">
<script>
(function(){
  try {
    var saved = localStorage.getItem('home2-theme');
    if (saved === 'light' || saved === 'dark') {
      document.documentElement.setAttribute('data-theme', saved);
    }
  } catch (e) {}
})();
</script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700;800&family=Hind+Siliguri:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
:root{
  --bg:#05060d;
  --bg-rgb:5,6,13;
  --bg-soft:#0b0d1c;
  --bg-soft-rgb:11,13,28;
  --surface:#11132469;
  --card:var(--ov-0d);
  --card-border:var(--ov-1a);
  --text:#f5f5f8;
  --muted:#9aa0b4;
  --violet:#7c5cff;
  --fuchsia:#ec4899;
  --cyan:#22d3ee;
  --amber:#f7b733;
  --grad: linear-gradient(120deg,var(--violet),var(--fuchsia) 55%,var(--amber));
  --grad-cool: linear-gradient(120deg,var(--cyan),var(--violet));
  --radius: 20px;
  --ease: cubic-bezier(.16,.84,.44,1);

  /* subtle overlay tones: white-on-dark by default, flipped to black-on-light in [data-theme="light"] */
  --ov-03:rgba(255,255,255,.012); --ov-05:rgba(255,255,255,.02); --ov-08:rgba(255,255,255,.031); --ov-0d:rgba(255,255,255,.051); --ov-0f:rgba(255,255,255,.059);
  --ov-14:rgba(255,255,255,.078); --ov-1a:rgba(255,255,255,.102); --ov-1c:rgba(255,255,255,.11); --ov-1f:rgba(255,255,255,.122); --ov-22:rgba(255,255,255,.133);
  --ov-2a:rgba(255,255,255,.165); --ov-33:rgba(255,255,255,.2); --ov-40:rgba(255,255,255,.251); --ov-55:rgba(255,255,255,.333);
}
:root[data-theme="light"]{
  --bg:#f6f6fb;
  --bg-rgb:246,246,251;
  --bg-soft:#ffffff;
  --bg-soft-rgb:255,255,255;
  --text:#13141f;
  --muted:#5b5f72;

  --ov-03:rgba(0,0,0,.02); --ov-05:rgba(0,0,0,.031); --ov-08:rgba(0,0,0,.051); --ov-0d:rgba(0,0,0,.071); --ov-0f:rgba(0,0,0,.078);
  --ov-14:rgba(0,0,0,.102); --ov-1a:rgba(0,0,0,.141); --ov-1c:rgba(0,0,0,.157); --ov-1f:rgba(0,0,0,.173); --ov-22:rgba(0,0,0,.188);
  --ov-2a:rgba(0,0,0,.227); --ov-33:rgba(0,0,0,.27); --ov-40:rgba(0,0,0,.333); --ov-55:rgba(0,0,0,.439);
}
*{margin:0;padding:0;box-sizing:border-box}
html{scroll-behavior:smooth}
body{
  background:var(--bg);
  color:var(--text);
  font-family:'Inter','Hind Siliguri',sans-serif;
  overflow-x:hidden;
  line-height:1.5;
  transition:background .35s ease, color .35s ease;
}
h1,h2,h3,.display{font-family:'Space Grotesk','Hind Siliguri',sans-serif; letter-spacing:-0.02em;}
a{color:inherit;text-decoration:none}
img,svg{display:block;max-width:100%}
.container{width:100%;max-width:1240px;margin:0 auto;padding:0 24px}
section{position:relative;z-index:1;scroll-margin-top:90px;}

/* ===== spotlight (fired when a guide link jumps to a section) ===== */
.spotlight{animation:spotlightPulse 1.6s ease-out;}
@keyframes spotlightPulse{
  0%{box-shadow:inset 0 0 0 0 rgba(124,92,255,0);}
  18%{box-shadow:inset 0 0 90px 14px rgba(124,92,255,.3);}
  100%{box-shadow:inset 0 0 0 0 rgba(124,92,255,0);}
}

/* ===== chooser strip ===== */
.chooser-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:18px;}
.chooser-card{cursor:pointer;text-align:left;}
.chooser-card .icon-wrap{margin-bottom:16px;}
.chooser-card h3{font-size:17px;margin-bottom:6px;}
.chooser-card p{font-size:13.5px;}
@media (max-width:980px){.chooser-grid{grid-template-columns:repeat(2,1fr)}}
@media (max-width:620px){.chooser-grid{grid-template-columns:1fr}}

/* ===== floating quick-nav dock ===== */
.quick-nav{position:fixed;right:22px;top:50%;transform:translateY(-50%);z-index:400;display:flex;flex-direction:column;gap:10px;padding:10px;border-radius:999px;background:rgba(var(--bg-soft-rgb),.7);backdrop-filter:blur(12px);border:1px solid var(--ov-1a);opacity:0;pointer-events:none;transition:opacity .4s;}
.quick-nav.show{opacity:1;pointer-events:auto;}
.qn-item{width:42px;height:42px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:18px;background:var(--ov-0d);transition:transform .2s, background .3s;position:relative;}
.qn-item:hover{background:var(--ov-1f);transform:scale(1.08);}
.qn-item.active{background:var(--grad);}
.qn-item .qn-label{position:absolute;right:52px;top:50%;transform:translateY(-50%);background:rgba(var(--bg-soft-rgb),.94);color:var(--text);border:1px solid var(--ov-22);padding:5px 12px;border-radius:8px;font-size:12.5px;white-space:nowrap;opacity:0;pointer-events:none;transition:opacity .2s;}
.qn-item:hover .qn-label{opacity:1;}
@media (max-width:980px){
  .quick-nav{right:auto;left:50%;top:auto;bottom:18px;transform:translateX(-50%);flex-direction:row;}
  .qn-item .qn-label{display:none;}
}

/* ===== messenger-style chat widget ===== */
.chat-widget{position:fixed;right:24px;bottom:24px;z-index:700;display:flex;flex-direction:column;align-items:flex-end;gap:14px;pointer-events:none;}
.chat-widget .chat-bubble{pointer-events:auto;}
.chat-widget.open .chat-panel{pointer-events:auto;}
.chat-bubble{width:58px;height:58px;border-radius:50%;background:var(--grad);border:none;font-size:24px;cursor:pointer;box-shadow:0 8px 24px rgba(0,0,0,.45);position:relative;flex-shrink:0;transition:transform .25s;}
.chat-bubble:hover{transform:scale(1.06);}
.chat-bubble::after{content:'';position:absolute;inset:0;border-radius:50%;box-shadow:0 0 0 0 rgba(124,92,255,.5);animation:chatPulse 2.6s ease-out infinite;}
@keyframes chatPulse{0%{box-shadow:0 0 0 0 rgba(124,92,255,.5)}100%{box-shadow:0 0 0 18px rgba(124,92,255,0)}}
.chat-widget.open .chat-bubble{transform:scale(.92);}
.chat-panel{width:340px;max-width:calc(100vw - 48px);background:rgba(var(--bg-soft-rgb),.97);color:var(--text);backdrop-filter:blur(16px);border:1px solid var(--ov-22);border-radius:20px;overflow:hidden;transform:translateY(16px) scale(.96);opacity:0;pointer-events:none;transition:transform .3s var(--ease),opacity .3s var(--ease);box-shadow:0 20px 60px rgba(0,0,0,.5);}
.chat-widget.open .chat-panel{transform:translateY(0) scale(1);opacity:1;pointer-events:auto;}
.chat-head{background:var(--grad);color:#05060d;padding:18px 20px;display:flex;justify-content:space-between;align-items:flex-start;gap:10px;}
.chat-head strong{font-size:16px;font-family:'Space Grotesk',sans-serif;}
.chat-head p{font-size:12.5px;margin-top:4px;opacity:.85;}
.chat-close{background:#00000022;border:none;color:#05060d;width:26px;height:26px;border-radius:50%;cursor:pointer;flex-shrink:0;font-size:13px;}
.chat-body{padding:18px 20px 20px;display:flex;flex-direction:column;gap:12px;}
.chat-row label{display:block;font-size:12px;color:var(--muted);margin-bottom:5px;}
.chat-row input,.chat-row textarea{width:100%;padding:10px 12px;border-radius:10px;background:var(--ov-0d);border:1px solid var(--ov-22);color:var(--text);font-family:inherit;font-size:13.5px;resize:vertical;}
.chat-row input:focus,.chat-row textarea:focus{outline:none;border-color:var(--violet);}
.chat-status{font-size:12.5px;color:#ff8fa3;min-height:16px;}
.chat-success{display:none;text-align:center;}
.chat-success.show{display:block;}
.chat-thread{display:flex;flex-direction:column;gap:12px;padding:22px 20px;align-items:flex-start;}
.chat-msg{display:flex;align-items:flex-end;gap:8px;max-width:88%;}
.chat-msg-you{align-self:flex-end;margin-left:auto;}
.chat-msg-you .chat-bubble-text{background:var(--grad);color:#05060d;font-weight:600;border-radius:14px;border-bottom-right-radius:4px;}
.chat-msg-icon{width:26px;height:26px;border-radius:50%;background:var(--ov-14);display:flex;align-items:center;justify-content:center;font-size:13px;flex-shrink:0;}
.chat-bubble-text{background:var(--ov-0d);border:1px solid var(--ov-1a);padding:9px 13px;border-radius:14px;border-bottom-left-radius:4px;font-size:13.5px;line-height:1.45;text-align:left;}
.chat-dots{display:flex;gap:4px;padding:11px 14px;background:var(--ov-0d);border:1px solid var(--ov-1a);border-radius:14px;border-bottom-left-radius:4px;}
.chat-dots span{width:6px;height:6px;border-radius:50%;background:var(--muted);display:block;animation:chatDotBounce 1.2s infinite ease-in-out;}
.chat-dots span:nth-child(2){animation-delay:.15s}
.chat-dots span:nth-child(3){animation-delay:.3s}
@keyframes chatDotBounce{0%,60%,100%{opacity:.35;transform:translateY(0)}30%{opacity:1;transform:translateY(-3px)}}
@media (max-width:480px){.chat-widget{right:16px;bottom:16px;}.chat-panel{width:calc(100vw - 32px);}}

/* ===== background atmosphere ===== */
.bg-fx{position:fixed;inset:0;z-index:0;pointer-events:none;overflow:hidden;background:var(--bg);}
.bg-fx::after{content:'';position:absolute;inset:0;background-image:radial-gradient(circle at 1px 1px, var(--ov-08) 1px, transparent 0);background-size:26px 26px;opacity:.5;}
.blob{position:absolute;border-radius:50%;filter:blur(90px);opacity:.45;will-change:transform;}
.blob1{width:620px;height:620px;background:radial-gradient(circle,var(--violet),transparent 70%);top:-220px;left:-160px;animation:drift1 22s ease-in-out infinite;}
.blob2{width:520px;height:520px;background:radial-gradient(circle,var(--fuchsia),transparent 70%);top:20%;right:-200px;animation:drift2 26s ease-in-out infinite;}
.blob3{width:480px;height:480px;background:radial-gradient(circle,var(--cyan),transparent 70%);bottom:-200px;left:30%;animation:drift3 30s ease-in-out infinite;}
@keyframes drift1{0%,100%{transform:translate(0,0)}50%{transform:translate(80px,60px)}}
@keyframes drift2{0%,100%{transform:translate(0,0)}50%{transform:translate(-70px,80px)}}
@keyframes drift3{0%,100%{transform:translate(0,0)}50%{transform:translate(60px,-70px)}}

/* ===== custom cursor ===== */
.cursor-dot,.cursor-ring{position:fixed;top:0;left:0;border-radius:50%;pointer-events:none;z-index:9999;transform:translate(-50%,-50%);}
.cursor-dot{width:6px;height:6px;background:var(--text);}
.cursor-ring{width:34px;height:34px;border:1px solid rgba(255,255,255,.45);transition:width .25s,height .25s,border-color .25s,background .25s;}
.cursor-ring.hover{width:58px;height:58px;background:rgba(255,255,255,.06);border-color:rgba(255,255,255,.7);}
@media (pointer:coarse){.cursor-dot,.cursor-ring{display:none}}

/* ===== preloader ===== */
#preloader{position:fixed;inset:0;background:#05060d;z-index:10000;display:flex;align-items:center;justify-content:center;flex-direction:column;gap:14px;}
#preloader .pl-logo{font-family:'Space Grotesk',sans-serif;font-size:28px;font-weight:700;letter-spacing:-.02em;opacity:0;}
#preloader .pl-bar{width:160px;height:2px;background:var(--ov-1a);border-radius:2px;overflow:hidden;}
#preloader .pl-bar i{display:block;height:100%;width:0%;background:var(--grad);}

/* ===== navbar ===== */
header{position:fixed;top:0;left:0;right:0;z-index:500;transition:background .35s,backdrop-filter .35s,box-shadow .35s,padding .35s;padding:22px 0;}
header.scrolled{background:rgba(var(--bg-rgb),.72);backdrop-filter:blur(16px);box-shadow:0 1px 0 var(--ov-14);padding:14px 0;}
.nav-row{display:flex;align-items:center;justify-content:space-between;}
.brand{display:flex;align-items:center;gap:10px;font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:19px;}
.brand .mark{width:30px;height:30px;border-radius:9px;background:var(--grad);display:flex;align-items:center;justify-content:center;font-size:14px;color:#05060d;font-weight:800;}
.nav-links{display:flex;align-items:center;gap:34px;}
.nav-links a{font-size:14.5px;color:var(--muted);transition:color .2s;position:relative;}
.nav-links a:hover{color:var(--text)}
.nav-links a::after{content:'';position:absolute;left:0;bottom:-6px;width:0;height:1px;background:var(--grad);transition:width .25s var(--ease);}
.nav-links a:hover::after{width:100%}
.nav-cta{display:flex;align-items:center;gap:14px}
.burger{display:none;width:30px;height:22px;position:relative;cursor:pointer;flex-direction:column;justify-content:space-between;}
.burger span{display:block;height:2px;width:100%;background:var(--text);border-radius:2px;transition:.3s;}

/* ===== buttons ===== */
.btn{display:inline-flex;align-items:center;gap:8px;padding:13px 26px;border-radius:999px;font-size:14.5px;font-weight:600;cursor:pointer;border:1px solid transparent;white-space:nowrap;}
.btn-primary{background:var(--grad);color:#05060d;position:relative;isolation:isolate;}
.btn-primary::before{content:'';position:absolute;inset:-1px;border-radius:999px;background:var(--grad);filter:blur(14px);opacity:.6;z-index:-1;transition:opacity .3s;}
.btn-primary:hover::before{opacity:1}
.btn-ghost{background:var(--ov-0d);border-color:var(--ov-22);color:var(--text);backdrop-filter:blur(8px);}
.btn-ghost:hover{background:var(--ov-1c);border-color:var(--ov-40);}
.btn-sm{padding:10px 20px;font-size:13.5px;}
.theme-toggle{width:38px;height:38px;border-radius:50%;background:var(--ov-0d);border:1px solid var(--ov-22);display:flex;align-items:center;justify-content:center;cursor:pointer;font-size:15px;color:var(--text);flex-shrink:0;transition:background .25s,transform .2s;}
.theme-toggle:hover{background:var(--ov-1a);transform:scale(1.06);}

/* ===== hero ===== */
.hero{min-height:100vh;display:flex;align-items:center;padding:150px 0 90px;position:relative;}
#hero-canvas{position:absolute;inset:0;z-index:0;opacity:.85;}
.hero-inner{position:relative;z-index:2;text-align:center;width:100%;}
.eyebrow{display:inline-flex;align-items:center;gap:8px;padding:8px 16px;border-radius:999px;background:var(--ov-0d);border:1px solid var(--ov-22);font-size:13px;color:var(--muted);margin-bottom:28px;backdrop-filter:blur(8px);}
.eyebrow .dot{width:6px;height:6px;border-radius:50%;background:var(--amber);box-shadow:0 0 10px var(--amber);}
.hero h1{font-size:clamp(40px,6.4vw,78px);font-weight:700;line-height:1.08;margin-bottom:26px;}
.hero h1 .line{display:block;overflow:hidden;}
.hero h1 .line span{display:inline-block;transform:translateY(110%);}
.gradient-text{background:var(--grad);-webkit-background-clip:text;background-clip:text;color:transparent;}
.hero .sub{max-width:620px;margin:0 auto 42px;color:var(--muted);font-size:clamp(15px,1.7vw,18px);font-family:'Inter','Hind Siliguri',sans-serif;}
.hero .cta-row{display:flex;gap:16px;justify-content:center;flex-wrap:wrap;margin-bottom:70px;}
.hero-badges{display:flex;justify-content:center;align-items:center;gap:14px;flex-wrap:wrap;max-width:760px;margin:0 auto;}
.float-chip{padding:10px 16px;border-radius:14px;background:var(--ov-0f);border:1px solid var(--ov-22);backdrop-filter:blur(10px);font-size:13px;display:flex;align-items:center;gap:8px;animation:floaty 5s ease-in-out infinite;white-space:nowrap;}
.chip1{animation-delay:0s}
.chip2{animation-delay:.8s}
.chip3{animation-delay:1.6s}
@keyframes floaty{0%,100%{transform:translateY(0)}50%{transform:translateY(-14px)}}
.scroll-hint{position:absolute;bottom:34px;left:50%;transform:translateX(-50%);display:flex;flex-direction:column;align-items:center;gap:8px;color:var(--muted);font-size:12px;letter-spacing:.08em;text-transform:uppercase;}
.scroll-hint .mouse{width:22px;height:34px;border:1px solid var(--ov-40);border-radius:12px;position:relative;}
.scroll-hint .mouse i{position:absolute;top:6px;left:50%;width:3px;height:6px;background:var(--text);border-radius:2px;transform:translateX(-50%);animation:scrolldown 1.8s infinite;}
@keyframes scrolldown{0%{opacity:1;top:6px}70%{opacity:0;top:18px}100%{opacity:0;top:6px}}

/* ===== marquee ===== */
.marquee-wrap{position:relative;z-index:1;background:var(--bg);padding:36px 0;border-top:1px solid var(--ov-14);border-bottom:1px solid var(--ov-14);overflow:hidden;}
.marquee-label{text-align:center;font-size:12.5px;letter-spacing:.14em;text-transform:uppercase;color:var(--muted);margin-bottom:24px;}
.marquee-track{display:flex;width:max-content;animation:scroll-x 26s linear infinite;}
.marquee-wrap:hover .marquee-track{animation-play-state:paused}
.marquee-track span{display:flex;align-items:center;gap:12px;font-family:'Space Grotesk',sans-serif;font-size:21px;color:var(--ov-55);padding:0 44px;white-space:nowrap;}
.marquee-track span i{width:6px;height:6px;border-radius:50%;background:var(--grad);}
@keyframes scroll-x{from{transform:translateX(0)}to{transform:translateX(-50%)}}

/* ===== section heading ===== */
.section-pad{padding:140px 0;}
.s-head{text-align:center;max-width:680px;margin:0 auto 64px;}
.s-tag{display:inline-block;font-size:12.5px;letter-spacing:.14em;text-transform:uppercase;color:var(--cyan);margin-bottom:16px;font-weight:600;}
.s-head h2{font-size:clamp(28px,4vw,46px);font-weight:700;margin-bottom:16px;}
.s-head p{color:var(--muted);font-size:16px;}

/* ===== stats ===== */
.stats-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:1px;background:var(--ov-14);border:1px solid var(--ov-14);border-radius:var(--radius);overflow:hidden;}
.stat{background:var(--bg-soft);padding:42px 20px;text-align:center;}
.stat .num{font-family:'Space Grotesk',sans-serif;font-size:clamp(32px,4.5vw,52px);font-weight:700;background:var(--grad);-webkit-background-clip:text;background-clip:text;color:transparent;}
.stat .lbl{color:var(--muted);font-size:13.5px;margin-top:8px;}

/* ===== bento services ===== */
.bento{display:grid;grid-template-columns:repeat(4,1fr);gap:20px;}
.bento .card{grid-column:span 2;}
.bento .card.wide{grid-column:span 2;}
.card{
  display:block;
  background:linear-gradient(160deg,var(--ov-0d),var(--ov-03));
  border:1px solid var(--card-border);
  border-radius:var(--radius);
  padding:30px;
  position:relative;
  transition:border-color .3s, transform .1s;
  transform-style:preserve-3d;
  overflow:hidden;
}
.card-meta{display:flex;align-items:center;justify-content:space-between;gap:10px;margin-bottom:14px;}
.badge-pill{font-size:11px;letter-spacing:.04em;text-transform:uppercase;padding:4px 10px;border-radius:999px;background:var(--ov-14);color:var(--muted);}
.card-price{font-family:'Space Grotesk',sans-serif;font-weight:700;color:var(--text);}
.card-price .old{font-family:'Inter',sans-serif;font-weight:400;color:var(--muted);text-decoration:line-through;margin-right:6px;font-size:13px;}
.card-link{display:inline-flex;align-items:center;gap:6px;margin-top:16px;font-size:13.5px;font-weight:600;color:var(--text);}
.course-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media (max-width:980px){.course-grid{grid-template-columns:repeat(2,1fr)}}
@media (max-width:620px){.course-grid{grid-template-columns:1fr}}
.card::before{content:'';position:absolute;inset:0;background:radial-gradient(400px circle at var(--mx,50%) var(--my,50%),var(--ov-14),transparent 60%);opacity:0;transition:opacity .3s;pointer-events:none;}
.card:hover::before{opacity:1}
.card:hover{border-color:var(--ov-33);}
.card .icon-wrap{width:48px;height:48px;border-radius:13px;background:var(--grad);display:flex;align-items:center;justify-content:center;margin-bottom:22px;}
.card .icon-wrap svg{width:24px;height:24px;stroke:#05060d;}
.card h3{font-size:19px;margin-bottom:10px;font-weight:600;}
.card p{color:var(--muted);font-size:14.5px;}
.card.feature-visual{display:flex;flex-direction:column;justify-content:space-between;min-height:260px;}
.mock-window{border-radius:12px;background:#05060d;border:1px solid var(--ov-1a);overflow:hidden;margin-top:20px;}
.mock-bar{display:flex;gap:6px;padding:9px 12px;background:var(--ov-08);}
.mock-bar i{width:8px;height:8px;border-radius:50%;background:var(--ov-33);}
.mock-body{height:90px;background:linear-gradient(135deg,#7c5cff33,#ec489933,#22d3ee22);position:relative;}
.mock-body::after{content:'';position:absolute;inset:14px;border:1px dashed var(--ov-22);border-radius:8px;}

/* ===== timeline (interactive journey map) ===== */
.journey-progress-label{display:inline-block;margin-top:18px;padding:6px 14px;border-radius:999px;background:var(--ov-0d);border:1px solid var(--ov-22);font-size:12.5px;color:var(--cyan);font-weight:600;letter-spacing:.03em;}
.timeline{position:relative;max-width:740px;margin:0 auto;padding-left:40px;}
.timeline-track{position:absolute;left:14px;top:6px;bottom:6px;width:2px;background:var(--ov-14);}
.timeline-progress{position:absolute;left:14px;top:6px;width:2px;height:0%;background:var(--grad);box-shadow:0 0 14px var(--violet);transition:height .1s;}
.t-item{position:relative;padding-bottom:58px;transition:opacity .3s;}
.t-item:last-child{padding-bottom:0}
.t-dot{position:absolute;left:-40px;top:0;width:30px;height:30px;border-radius:50%;background:var(--bg-soft);border:2px solid var(--ov-2a);display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:700;font-family:'Space Grotesk',sans-serif;color:var(--text);cursor:pointer;appearance:none;padding:0;transition:transform .2s, border-color .3s, background .3s, box-shadow .3s;z-index:1;}
.t-dot:hover{transform:scale(1.1);}
.t-item.locked{opacity:.4;}
.t-item.locked .t-dot{cursor:not-allowed;}
.t-item.locked .t-dot:hover{transform:none;}
.t-item.current .t-dot{border-color:var(--fuchsia);background:var(--grad);color:#05060d;animation:dotPulse 1.6s ease-in-out infinite;}
.t-item.completed .t-dot{border-color:var(--cyan);background:var(--bg-soft);color:var(--cyan);}
@keyframes dotPulse{0%,100%{box-shadow:0 0 0 0 rgba(124,92,255,.55)}50%{box-shadow:0 0 0 10px rgba(124,92,255,0)}}
.t-item h3{font-size:19px;margin-bottom:6px;display:flex;align-items:center;gap:10px;flex-wrap:wrap;}
.t-item p{color:var(--muted);font-size:14.5px;}
.t-item.current{cursor:pointer;}
.t-item.current:hover h3{color:var(--cyan);}
.t-hint{display:none;align-items:center;gap:4px;padding:4px 12px;border-radius:999px;background:var(--grad);color:#05060d;font-size:11.5px;font-weight:700;white-space:nowrap;animation:hintNudge 1.3s ease-in-out infinite;}
.t-item.current .t-hint{display:inline-flex;}
@keyframes hintNudge{0%,100%{transform:translateX(0)}50%{transform:translateX(5px)}}
@media (max-width:620px){.t-hint{font-size:10.5px;padding:3px 9px;}}
.t-particle{position:fixed;width:6px;height:6px;border-radius:50%;pointer-events:none;z-index:9998;}
.journey-reward{max-width:740px;margin:40px auto 0;padding:22px 26px;border-radius:var(--radius);background:linear-gradient(135deg,var(--ov-0f),var(--ov-05));border:1px solid var(--ov-22);display:flex;align-items:center;justify-content:space-between;gap:20px;flex-wrap:wrap;opacity:0;transform:translateY(16px) scale(.97);pointer-events:none;transition:opacity .5s var(--ease),transform .5s var(--ease);}
.journey-reward.show{opacity:1;transform:translateY(0) scale(1);pointer-events:auto;}
.journey-reward span{font-size:15px;}
@media (max-width:620px){.journey-reward{flex-direction:column;align-items:flex-start;}}

/* ===== showcase ===== */
.showcase-scroll{display:flex;gap:24px;overflow-x:auto;padding:10px 4px 26px;cursor:grab;}
.showcase-scroll::-webkit-scrollbar{height:6px}
.showcase-scroll::-webkit-scrollbar-thumb{background:var(--ov-22);border-radius:6px}
.showcase-scroll.dragging{cursor:grabbing;user-select:none;scroll-behavior:auto;}
.showcase-scroll.dragging *{pointer-events:none;}

/* ===== scroll progress bar ===== */
.scroll-progress{position:fixed;top:0;left:0;height:3px;width:0%;background:var(--grad);z-index:9500;pointer-events:none;}

/* ===== real-time activity toast ===== */
.activity-toast{position:fixed;left:24px;bottom:24px;z-index:450;max-width:290px;background:rgba(var(--bg-soft-rgb),.95);color:var(--text);backdrop-filter:blur(12px);border:1px solid var(--ov-1a);border-radius:14px;padding:13px 14px;display:flex;align-items:flex-start;gap:10px;opacity:0;transform:translateY(14px);transition:opacity .4s var(--ease),transform .4s var(--ease);pointer-events:none;box-shadow:0 12px 30px rgba(0,0,0,.35);}
.activity-toast.show{opacity:1;transform:translateY(0);pointer-events:auto;}
.activity-toast .icon{font-size:19px;flex-shrink:0;line-height:1;margin-top:1px;}
.activity-toast .text{font-size:12.5px;line-height:1.4;min-width:0;}
.activity-toast .text strong{display:block;color:var(--text);font-weight:600;}
.activity-toast .text span{color:var(--muted);font-size:11px;}
.activity-toast .act-close{margin-left:auto;background:none;border:none;color:var(--muted);cursor:pointer;font-size:13px;flex-shrink:0;padding:2px;}
@media (max-width:980px){.activity-toast{left:16px;bottom:16px;max-width:240px;}}
.show-card{scroll-snap-align:start;min-width:340px;max-width:340px;background:var(--bg-soft);border:1px solid var(--card-border);border-radius:var(--radius);overflow:hidden;flex-shrink:0;}
.show-visual{height:170px;position:relative;}
.show-visual .mock-bar{position:relative;z-index:2;}
.show-tag{position:absolute;top:14px;right:14px;z-index:3;font-size:11px;padding:5px 10px;border-radius:999px;background:#00000066;backdrop-filter:blur(6px);}
.show-card .body{padding:22px 22px 26px;}
.show-card h3{font-size:18px;margin-bottom:8px;}
.show-card p{color:var(--muted);font-size:14px;margin-bottom:16px;}
.show-card .tags{display:flex;gap:8px;flex-wrap:wrap;}
.show-card .tags span{font-size:11.5px;color:var(--muted);border:1px solid var(--ov-22);padding:4px 10px;border-radius:999px;}

/* ===== testimonials ===== */
.testi-wrap{max-width:720px;margin:0 auto;position:relative;min-height:260px;}
.testi{position:absolute;inset:0;opacity:0;transform:translateY(16px);transition:opacity .5s var(--ease),transform .5s var(--ease);pointer-events:none;text-align:center;}
.testi.active{opacity:1;transform:translateY(0);pointer-events:auto;position:relative;}
.testi .quote{font-size:clamp(18px,2.4vw,24px);font-family:'Space Grotesk',sans-serif;line-height:1.45;margin-bottom:28px;}
.testi .who{display:flex;align-items:center;justify-content:center;gap:12px;}
.testi .avatar{width:42px;height:42px;border-radius:50%;background:var(--grad);display:flex;align-items:center;justify-content:center;font-weight:700;color:#05060d;font-family:'Space Grotesk',sans-serif;}
.testi .name{font-weight:600;font-size:14.5px;}
.testi .role{color:var(--muted);font-size:13px;}
.testi-dots{display:flex;justify-content:center;gap:10px;margin-top:36px;}
.testi-dots button{width:8px;height:8px;border-radius:50%;border:none;background:var(--ov-2a);cursor:pointer;transition:.3s;}
.testi-dots button.active{background:var(--grad);width:26px;border-radius:5px;}

/* ===== cta banner ===== */
.cta-banner{margin:0 24px;border-radius:32px;background:linear-gradient(135deg,#1a0f33,#2b0f2a,#0f1d2e);position:relative;overflow:hidden;padding:90px 40px;text-align:center;border:1px solid rgba(255,255,255,.08);--text:#f5f5f8;--muted:#9aa0b4;color:var(--text);}
.cta-banner::before{content:'';position:absolute;width:500px;height:500px;background:radial-gradient(circle,var(--violet),transparent 70%);opacity:.5;top:-200px;left:-100px;filter:blur(10px);}
.cta-banner::after{content:'';position:absolute;width:420px;height:420px;background:radial-gradient(circle,var(--cyan),transparent 70%);opacity:.4;bottom:-200px;right:-80px;}
.cta-banner h2{font-size:clamp(28px,4.6vw,48px);margin-bottom:18px;position:relative;z-index:2;}
.cta-banner p{color:var(--muted);max-width:480px;margin:0 auto 34px;position:relative;z-index:2;}
.cta-banner .cta-row{position:relative;z-index:2;display:flex;gap:16px;justify-content:center;flex-wrap:wrap;}

/* ===== footer ===== */
footer{position:relative;z-index:1;padding:80px 0 30px;border-top:1px solid var(--ov-14);margin-top:60px;background:var(--bg);}
.foot-grid{display:grid;grid-template-columns:1.6fr 1fr 1fr 1fr;gap:40px;margin-bottom:60px;}
.foot-brand p{color:var(--muted);font-size:14px;margin-top:14px;max-width:280px;}
.foot-col h4{font-size:13px;letter-spacing:.08em;text-transform:uppercase;color:var(--muted);margin-bottom:18px;}
.foot-col a{display:block;color:#d8d9e0;font-size:14.5px;margin-bottom:12px;transition:color .2s;}
.foot-col a:hover{color:var(--text)}
.foot-social{display:flex;gap:10px;margin-top:18px;}
.foot-social a{width:36px;height:36px;border-radius:50%;border:1px solid var(--ov-22);display:flex;align-items:center;justify-content:center;}
.foot-social a:hover{background:var(--ov-14)}
.foot-social svg{width:16px;height:16px;stroke:var(--text);}
.foot-bottom{display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;padding-top:28px;border-top:1px solid var(--ov-14);color:var(--muted);font-size:13px;}
.back-top{width:40px;height:40px;border-radius:50%;border:1px solid var(--ov-22);display:flex;align-items:center;justify-content:center;}

/* ===== reveal utility ===== */
.reveal{opacity:0;transform:translateY(34px);}

/* ===== responsive ===== */
@media (max-width:980px){
  .nav-links{display:none}
  .burger{display:flex}
  .bento{grid-template-columns:repeat(2,1fr)}
  .bento .card{grid-column:span 1}
  .bento .card.wide{grid-column:span 2}
  .stats-grid{grid-template-columns:repeat(2,1fr)}
  .foot-grid{grid-template-columns:1fr 1fr}
  .hero-badges{display:none}
}
@media (max-width:620px){
  .bento{grid-template-columns:1fr}
  .bento .card.wide{grid-column:span 1}
  .foot-grid{grid-template-columns:1fr}
  .section-pad{padding:90px 0}
  .cta-banner{padding:60px 24px;margin:0 16px;}
}

/* mobile nav panel */
#mobileNav{position:fixed;top:0;right:0;height:100vh;width:78%;max-width:320px;background:rgba(var(--bg-soft-rgb),.96);color:var(--text);backdrop-filter:blur(16px);z-index:600;transform:translateX(100%);transition:transform .4s var(--ease);padding:100px 32px 40px;display:flex;flex-direction:column;gap:26px;border-left:1px solid var(--ov-14);}
#mobileNav.open{transform:translateX(0)}
#mobileNav a{font-size:18px;font-weight:600;}
#navOverlay{position:fixed;inset:0;background:#00000080;z-index:550;opacity:0;pointer-events:none;transition:opacity .3s;}
#navOverlay.open{opacity:1;pointer-events:auto;}
</style>
</head>
<body>

<div id="preloader">
  <div class="pl-logo display">আপনার <span class="gradient-text">Business</span></div>
  <div class="pl-bar"><i id="plBarFill"></i></div>
</div>

<div class="scroll-progress" id="scrollProgress"></div>

<div class="cursor-dot" id="cursorDot"></div>
<div class="cursor-ring" id="cursorRing"></div>

<!-- ============ FLOATING QUICK-NAV GUIDE ============ -->
<nav class="quick-nav" id="quickNav" aria-label="Quick section guide">
  <a href="#courses" data-target="#courses" class="qn-item"><span class="qn-label">Learn a skill</span>🎓</a>
  <a href="#services" data-target="#services" class="qn-item"><span class="qn-label">Buy software</span>🛠</a>
  <a href="#portfolio" data-target="#portfolio" class="qn-item"><span class="qn-label">What we've built</span>🧩</a>
  <a href="{{ url('/contact') }}" class="qn-item" data-chat-open><span class="qn-label">Talk to us</span>💬</a>
</nav>

@if (count($activities))
<!-- ============ REAL-TIME ACTIVITY TOAST ============ -->
<div class="activity-toast" id="activityToast">
  <span class="icon">🎓</span>
  <div class="text">
    <strong id="activityText"></strong>
    <span id="activityTime"></span>
  </div>
  <button type="button" class="act-close" id="activityClose" aria-label="Dismiss">✕</button>
</div>
@endif

<!-- ============ MESSENGER-STYLE CHAT WIDGET ============ -->
<div class="chat-widget" id="chatWidget">
  <div class="chat-panel" id="chatPanel">
    <div class="chat-head">
      <div>
        <strong>👋 Talk to us</strong>
        <p>Tell us what you need — we'll reply by email.</p>
      </div>
      <button type="button" class="chat-close" id="chatClose" aria-label="Close chat">✕</button>
    </div>
    <form id="chatForm" class="chat-body">
      <div class="chat-row">
        <label for="chatName">Name</label>
        <input type="text" id="chatName" name="name" required placeholder="Your name">
      </div>
      <div class="chat-row">
        <label for="chatContact">Email or phone</label>
        <input type="text" id="chatContact" name="contact" required placeholder="you@email.com or 01XXXXXXXXX">
      </div>
      <div class="chat-row">
        <label for="chatSubject">Subject</label>
        <input type="text" id="chatSubject" name="subject" required placeholder="What's this about?">
      </div>
      <div class="chat-row">
        <label for="chatMessage">Message</label>
        <textarea id="chatMessage" name="message" required rows="4" placeholder="Tell us a bit more..."></textarea>
      </div>
      <button type="submit" class="btn btn-primary" id="chatSubmit" style="width:100%;justify-content:center;">Send message →</button>
      <div class="chat-status" id="chatStatus"></div>
    </form>
    <div class="chat-success" id="chatSuccess">
      <div class="chat-thread" id="chatThread">
        <div class="chat-msg chat-msg-you">
          <div class="chat-bubble-text">Message sent! ✓</div>
        </div>
        @if ($chatConfig['enabled'])
        <div class="chat-msg chat-msg-agent chat-typing" id="chatTyping">
          <div class="chat-msg-icon">🤖</div>
          <div class="chat-dots"><span></span><span></span><span></span></div>
        </div>
        <div class="chat-msg chat-msg-agent" id="chatAgentReply" style="display:none;">
          <div class="chat-msg-icon">🤖</div>
          <div class="chat-bubble-text">{{ $chatConfig['message'] }}</div>
        </div>
        @endif
      </div>
      <button type="button" class="btn btn-ghost btn-sm" id="chatAnother" style="margin:0 20px 20px;">Send another message</button>
    </div>
  </div>
  <button type="button" class="chat-bubble" id="chatBubble" aria-label="Open chat">💬</button>
</div>

<div class="bg-fx">
  <div class="blob blob1"></div>
  <div class="blob blob2"></div>
  <div class="blob blob3"></div>
</div>

<!-- ============ NAVBAR ============ -->
<header id="siteHeader">
  <div class="container nav-row">
    <a href="{{ url('/home2') }}" class="brand">
      <span class="mark">আ</span> আপনার&nbsp;Business
    </a>
    <nav class="nav-links">
      <a href="#services">Services</a>
      <a href="#courses">Courses</a>
      <a href="#portfolio">Portfolio</a>
      <a href="#blog">Blog</a>
      <a href="{{ url('/') }}">Original Site</a>
    </nav>
    <div class="nav-cta">
      <button type="button" class="theme-toggle magnetic" id="themeToggle" aria-label="Toggle light/dark theme">🌙</button>
      <a href="{{ url('/contact') }}" class="btn btn-ghost btn-sm magnetic" data-chat-open>Talk to us</a>
      <a href="{{ route('register') }}" class="btn btn-primary btn-sm magnetic">Get Started</a>
      <div class="burger" id="burger"><span></span><span></span><span></span></div>
    </div>
  </div>
</header>

<div id="navOverlay"></div>
<div id="mobileNav">
  <a href="#services">Services</a>
  <a href="#courses">Courses</a>
  <a href="#portfolio">Portfolio</a>
  <a href="#blog">Blog</a>
  <a href="{{ url('/contact') }}" data-chat-open>Talk to us</a>
  <a href="{{ url('/') }}">Original Site</a>
  <button type="button" class="theme-toggle" id="mobileThemeToggle" aria-label="Toggle light/dark theme" style="align-self:flex-start;">🌙</button>
  <a href="{{ route('register') }}" class="btn btn-primary" style="justify-content:center;margin-top:10px;">Get Started</a>
</div>

<!-- ============ HERO ============ -->
<section class="hero">
  <canvas id="hero-canvas"></canvas>
  <div class="container hero-inner">
    <div class="eyebrow"><span class="dot"></span> Bangladesh's All-in-One Growth Platform</div>
    <h1>
      <span class="line"><span>Learn. Build. Grow.</span></span>
      <span class="line"><span class="gradient-text">All in one place.</span></span>
    </h1>
    <p class="sub">কোর্স থেকে কাস্টম সফটওয়্যার, SaaS থেকে বিজনেস অটোমেশন — <strong>আপনার Business</strong> নিয়ে এসেছে একটিমাত্র ডিজিটাল ইকোসিস্টেম যেখানে আপনার আইডিয়া বাস্তব ব্যবসায় রূপ নেয়।</p>
    <div class="cta-row">
      <a href="{{ route('register') }}" class="btn btn-primary magnetic">Start Your Journey →</a>
      <a href="#services" class="btn btn-ghost magnetic">Explore Services</a>
    </div>
    <div class="hero-badges">
      <div class="float-chip chip1">🎓 {{ $stats['courses'] }} Courses Live</div>
      <div class="float-chip chip2">🛠 {{ $stats['services'] }} Software Products</div>
      <div class="float-chip chip3">✍️ {{ $stats['posts'] }} Guides &amp; Articles</div>
    </div>
  </div>
  <div class="scroll-hint"><span>Scroll</span><div class="mouse"><i></i></div></div>
</section>

<!-- ============ CHOOSER STRIP (guides the visitor) ============ -->
<section class="section-pad" style="padding:60px 0;">
  <div class="container">
    <div class="chooser-grid">
      <a href="#courses" data-target="#courses" class="card reveal chooser-card">
        <div class="icon-wrap"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c0 1 2.7 2 6 2s6-1 6-2v-5"/></svg></div>
        <h3>Learn a skill</h3>
        <p>Browse real courses and start today.</p>
        <span class="card-link">See courses →</span>
      </a>
      <a href="#services" data-target="#services" class="card reveal chooser-card">
        <div class="icon-wrap"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 7l9-4 9 4-9 4-9-4z"/><path d="M3 7v10l9 4 9-4V7"/><path d="M12 11v10"/></svg></div>
        <h3>Buy ready software</h3>
        <p>One-time purchase or subscription — your choice.</p>
        <span class="card-link">See services →</span>
      </a>
      <a href="#portfolio" data-target="#portfolio" class="card reveal chooser-card">
        <div class="icon-wrap"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 7h18M3 7a2 2 0 0 1 2-2h3l2-2h4l2 2h3a2 2 0 0 1 2 2M3 7v11a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V7"/></svg></div>
        <h3>See what we've built</h3>
        <p>Real in-house products our team engineered.</p>
        <span class="card-link">View portfolio →</span>
      </a>
      <a href="{{ url('/contact') }}" class="card reveal chooser-card" data-chat-open>
        <div class="icon-wrap"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg></div>
        <h3>Talk to us</h3>
        <p>Not sure where to start? Tell us what you need.</p>
        <span class="card-link">Open chat →</span>
      </a>
    </div>
  </div>
</section>

<!-- ============ MARQUEE ============ -->
<div class="marquee-wrap">
  <div class="marquee-label">Built on a real, working stack</div>
  <div class="marquee-track" id="marqueeTrack">
    @php $stack = ['Laravel 11', 'Filament 3', 'Livewire 3', 'Tailwind CSS', 'Alpine.js', 'SSLCommerz']; @endphp
    @for ($i = 0; $i < 2; $i++)
      @foreach ($stack as $tech)
        <span><i></i>{{ $tech }}</span>
      @endforeach
    @endfor
  </div>
</div>

<!-- ============ STATS ============ -->
<section class="section-pad">
  <div class="container">
    <div class="stats-grid">
      <div class="stat reveal"><div class="num" data-count="{{ $stats['courses'] }}">0</div><div class="lbl">Courses you can start today</div></div>
      <div class="stat reveal"><div class="num" data-count="{{ $stats['services'] }}">0</div><div class="lbl">Software products ready to deploy</div></div>
      <div class="stat reveal"><div class="num" data-count="{{ $stats['posts'] }}">0</div><div class="lbl">Guides &amp; articles published</div></div>
      <div class="stat reveal"><div class="num" data-count="{{ $stats['enrollments'] }}">0</div><div class="lbl">Learners enrolled so far</div></div>
    </div>
  </div>
</section>

<!-- ============ SERVICES BENTO ============ -->
<section class="section-pad" id="services">
  <div class="container">
    <div class="s-head reveal">
      <span class="s-tag">Software &amp; SaaS Marketplace</span>
      <h2>Ready-made software, built for Bangladeshi businesses.</h2>
      <p>Real products you can buy today — one-time purchase or subscription, delivered through the platform's own checkout.</p>
    </div>
    @php
      $serviceIcons = [
        '<path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/>',
        '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
        '<rect x="5" y="2" width="14" height="20" rx="2"/><path d="M12 18h.01"/>',
        '<circle cx="12" cy="12" r="10"/><path d="M2 12h20"/><path d="M12 2a15 15 0 0 1 0 20 15 15 0 0 1 0-20z"/>',
        '<path d="M12 2a10 10 0 1 0 10 10"/><path d="M12 2v10l6 3"/>',
      ];
    @endphp
    <div class="bento">
      @foreach ($services as $i => $service)
        <a href="{{ route('services.show', $service->slug) }}" class="card reveal {{ $i === 0 ? 'wide feature-visual' : '' }}">
          <div>
            <div class="icon-wrap"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">{!! $serviceIcons[$i % count($serviceIcons)] !!}</svg></div>
            <div class="card-meta">
              <span class="badge-pill">{{ $service->delivery_time }}</span>
              <span class="card-price">৳{{ number_format($service->starting_price) }}+</span>
            </div>
            <h3>{{ $service->title }}</h3>
            <p>{{ $service->short_description }}</p>
          </div>
          @if ($i === 0)
            <div class="mock-window">
              <div class="mock-bar"><i></i><i></i><i></i></div>
              <div class="mock-body"></div>
            </div>
          @else
            <span class="card-link">View plans →</span>
          @endif
        </a>
      @endforeach
    </div>
  </div>
</section>

<!-- ============ COURSES ============ -->
<section class="section-pad" id="courses" style="background:linear-gradient(180deg,transparent,var(--ov-05),transparent);">
  <div class="container">
    <div class="s-head reveal">
      <span class="s-tag">Learning</span>
      <h2>Courses that teach you to actually build the business.</h2>
      <p>Practical, instructor-led courses — watch lectures, track progress, earn a certificate on completion.</p>
    </div>
    <div class="course-grid">
      @foreach ($courses as $course)
        <a href="{{ route('courses.show', $course->slug) }}" class="card reveal">
          <div class="icon-wrap"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c0 1 2.7 2 6 2s6-1 6-2v-5"/></svg></div>
          <div class="card-meta">
            <span class="badge-pill">{{ $course->level }}</span>
            <span class="card-price">
              @if ($course->is_free)
                Free
              @else
                @if ($course->discount_price)<span class="old">৳{{ number_format($course->price) }}</span>@endif
                ৳{{ number_format($course->discount_price ?: $course->price) }}
              @endif
            </span>
          </div>
          <h3>{{ $course->title }}</h3>
          <p>{{ $course->short_description }}</p>
          <span class="card-link">{{ $course->duration_formatted }} · Start course →</span>
        </a>
      @endforeach
    </div>
  </div>
</section>

<!-- ============ HOW IT WORKS TIMELINE (interactive) ============ -->
<section class="section-pad" id="how" style="background:linear-gradient(180deg,transparent,var(--ov-05),transparent);">
  <div class="container">
    <div class="s-head reveal">
      <span class="s-tag">The journey</span>
      <h2>From a napkin idea to a scaled business.</h2>
      <p>Click each step to unlock the next one — see the full path for yourself.</p>
      <div class="journey-progress-label" id="journeyProgressLabel">Step 1 of 5</div>
    </div>
    <div class="timeline" id="journeyTimeline">
      <div class="timeline-track"></div>
      <div class="timeline-progress" id="timelineProgress"></div>

      <div class="t-item"><button type="button" class="t-dot" aria-label="Step 1: Learn">1</button><h3>Learn <span class="t-hint">👆 Click to unlock</span></h3><p>Pick a course that matches where you are — beginner basics to advanced scaling strategy.</p></div>
      <div class="t-item"><button type="button" class="t-dot" aria-label="Step 2: Choose software">2</button><h3>Choose software <span class="t-hint">👆 Click to unlock</span></h3><p>Browse ready-made services and SaaS products built specifically for Bangladeshi businesses.</p></div>
      <div class="t-item"><button type="button" class="t-dot" aria-label="Step 3: Checkout">3</button><h3>Checkout <span class="t-hint">👆 Click to unlock</span></h3><p>Pay securely through SSLCommerz — one-time purchase or a monthly/yearly subscription, your call.</p></div>
      <div class="t-item"><button type="button" class="t-dot" aria-label="Step 4: Track">4</button><h3>Track <span class="t-hint">👆 Click to unlock</span></h3><p>Your dashboard follows enrollments, certificates, orders, and active subscriptions in one view.</p></div>
      <div class="t-item"><button type="button" class="t-dot" aria-label="Step 5: Grow">5</button><h3>Grow <span class="t-hint">👆 Click to finish</span></h3><p>Renew, upgrade, or add new services as your business grows — all under one account.</p></div>
    </div>
    <div class="journey-reward" id="journeyReward">
      <span>🎉 You've mapped out the full journey — ready to take the first step for real?</span>
      <a href="{{ route('register') }}" class="btn btn-primary btn-sm magnetic">Start free →</a>
    </div>
  </div>
</section>

<!-- ============ ENGINEERING PORTFOLIO ============ -->
<section class="section-pad" id="portfolio">
  <div class="container">
    <div class="s-head reveal">
      <span class="s-tag">What we've built</span>
      <h2>Engineering portfolio — our in-house work.</h2>
      <p>Products our own team has engineered end-to-end. Want something like this built for your business? <a href="{{ url('/contact') }}" style="color:var(--text);text-decoration:underline;">Let's talk</a>.</p>
    </div>
    <div class="showcase-scroll">
      @foreach ($projects as $project)
        <div class="show-card reveal">
          <div class="show-visual" style="background:linear-gradient(135deg,{{ $project->color }}55,{{ $project->color }}15);">
            <span class="show-tag">{{ $project->tech_stack[0] ?? 'Build' }}</span>
            <div class="mock-bar"><i></i><i></i><i></i></div>
          </div>
          <div class="body">
            <h3>{{ $project->title }}</h3>
            <p>{{ \Illuminate\Support\Str::limit($project->description, 110) }}</p>
            <div class="tags">
              @foreach ($project->tech_stack as $tech)
                <span>{{ $tech }}</span>
              @endforeach
            </div>
          </div>
        </div>
      @endforeach
    </div>
    <div style="text-align:center;margin-top:28px;">
      <a href="{{ route('portfolio.index') }}" class="btn btn-ghost magnetic">View full portfolio →</a>
    </div>
  </div>
</section>

<!-- ============ BLOG PREVIEW ============ -->
@if ($posts->count())
<section class="section-pad" id="blog" style="background:linear-gradient(180deg,transparent,var(--ov-05),transparent);">
  <div class="container">
    <div class="s-head reveal">
      <span class="s-tag">From the blog</span>
      <h2>Guides &amp; writing from the team.</h2>
      <p>Practical articles on building and running a business in Bangladesh.</p>
    </div>
    <div class="course-grid">
      @foreach ($posts as $post)
        <a href="{{ route('blog.show', $post->slug) }}" class="card reveal">
          <span class="badge-pill">{{ $post->category->name ?? 'Blog' }}</span>
          <h3 style="margin-top:16px;">{{ $post->title }}</h3>
          <p>{{ \Illuminate\Support\Str::limit($post->excerpt, 120) }}</p>
          <span class="card-link">Read article →</span>
        </a>
      @endforeach
    </div>
  </div>
</section>
@endif

<!-- ============ TESTIMONIALS ============ -->
@if ($testimonials->count())
<section class="section-pad" id="stories" style="background:linear-gradient(180deg,transparent,var(--ov-05),transparent);">
  <div class="container">
    <div class="s-head reveal">
      <span class="s-tag">Success stories</span>
      <h2>Don't just take our word for it.</h2>
    </div>
    <div class="testi-wrap">
      @foreach ($testimonials as $t)
        @php
          $initials = collect(explode(' ', $t->name))->map(fn($w) => mb_substr($w, 0, 1))->take(2)->implode('');
          $roleLine = trim(($t->role ?? '') . (($t->role && $t->company) ? ', ' : '') . ($t->company ?? ''));
        @endphp
        <div class="testi {{ $loop->first ? 'active' : '' }}">
          <p class="quote">"{{ $t->quote }}"</p>
          <div class="who">
            <div class="avatar" style="background:{{ $t->avatar_color }};">{{ $initials }}</div>
            <div style="text-align:left">
              <div class="name">{{ $t->name }}</div>
              @if ($roleLine)<div class="role">{{ $roleLine }}</div>@endif
            </div>
          </div>
        </div>
      @endforeach
      <div class="testi-dots" id="testiDots"></div>
    </div>
  </div>
</section>
@endif

<!-- ============ CTA BANNER ============ -->
<section class="section-pad" id="cta">
  <div class="container">
    <div class="cta-banner reveal">
      <h2>Ready to build something great?</h2>
      <p>Whether you're starting from zero or scaling to the next level — let's talk about what আপনার Business can do for you.</p>
      <div class="cta-row">
        <a href="{{ route('register') }}" class="btn btn-primary magnetic">Get Started Free</a>
        <a href="{{ url('/') }}" class="btn btn-ghost magnetic">Visit Live Site</a>
      </div>
    </div>
  </div>
</section>

<!-- ============ FOOTER ============ -->
<footer>
  <div class="container">
    <div class="foot-grid">
      <div class="foot-brand">
        <div class="brand"><span class="mark">আ</span> আপনার&nbsp;Business</div>
        <p>Bangladesh's all-in-one digital business platform. Learn. Build. Grow.</p>
        <div class="foot-social">
          <a href="#" aria-label="Facebook"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg></a>
          <a href="#" aria-label="LinkedIn"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/><path d="M10 9h4v12h-4z"/><path d="M14 13a4 4 0 0 1 8 0v8h-4v-7a1 1 0 0 0-2 0v7h-2z"/></svg></a>
          <a href="#" aria-label="YouTube"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="4"/><path d="M10 9l5 3-5 3z"/></svg></a>
        </div>
      </div>
      <div class="foot-col">
        <h4>Company</h4>
        <a href="{{ url('/about') }}">About</a>
        <a href="{{ url('/contact') }}">Contact</a>
        <a href="{{ url('/faq') }}">FAQ</a>
      </div>
      <div class="foot-col">
        <h4>Explore</h4>
        <a href="{{ route('courses.index') }}">Courses</a>
        <a href="{{ route('services.index') }}">Services</a>
        <a href="{{ route('blog.index') }}">Blog</a>
      </div>
      <div class="foot-col">
        <h4>Legal</h4>
        <a href="{{ url('/privacy-policy') }}">Privacy Policy</a>
        <a href="{{ url('/terms') }}">Terms of Service</a>
      </div>
    </div>
    <div class="foot-bottom">
      <span>© {{ date('Y') }} আপনার Business. All rights reserved. · <em style="color:var(--muted)">Concept preview — /home2</em></span>
      <a href="#top" class="back-top" id="backTop" aria-label="Back to top">↑</a>
    </div>
  </div>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<script>
(function(){
  const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  const isCoarse = window.matchMedia('(pointer: coarse)').matches;

  /* ---------- preloader ---------- */
  const preloader = document.getElementById('preloader');
  const plBar = document.getElementById('plBarFill');
  gsap.to(plBar, {width:'100%', duration:1.1, ease:'power2.inOut'});
  gsap.to('.pl-logo', {opacity:1, duration:.5, delay:.15});
  window.addEventListener('load', () => {
    gsap.to(preloader, {
      opacity:0, duration:.6, delay:.5, ease:'power2.inOut',
      onComplete:() => { preloader.style.display='none'; startHeroText(); }
    });
  });
  // fallback in case load event is delayed
  setTimeout(() => { if(preloader && preloader.style.display !== 'none'){ preloader.style.display='none'; startHeroText(); } }, 3500);

  /* ---------- hero headline entrance ---------- */
  function startHeroText(){
    gsap.to('.hero h1 .line span', {
      y:0, duration:1, ease:'power4.out', stagger:0.12
    });
    gsap.from('.eyebrow, .hero .sub, .hero .cta-row, .float-chip', {
      opacity:0, y:20, duration:.9, ease:'power3.out', stagger:0.08, delay:.15
    });
  }

  /* ---------- custom cursor ---------- */
  if(!isCoarse){
    const dot = document.getElementById('cursorDot');
    const ring = document.getElementById('cursorRing');
    const xTo = gsap.quickTo(dot, "x", {duration:.1, ease:"power3"});
    const yTo = gsap.quickTo(dot, "y", {duration:.1, ease:"power3"});
    const xToR = gsap.quickTo(ring, "x", {duration:.35, ease:"power3"});
    const yToR = gsap.quickTo(ring, "y", {duration:.35, ease:"power3"});
    window.addEventListener('mousemove', e => {
      xTo(e.clientX); yTo(e.clientY); xToR(e.clientX); yToR(e.clientY);
    });
    document.querySelectorAll('a, button, .card, .magnetic').forEach(el => {
      el.addEventListener('mouseenter', () => ring.classList.add('hover'));
      el.addEventListener('mouseleave', () => ring.classList.remove('hover'));
    });
  }

  /* ---------- magnetic buttons ---------- */
  if(!isCoarse){
    document.querySelectorAll('.magnetic').forEach(btn => {
      btn.addEventListener('mousemove', e => {
        const r = btn.getBoundingClientRect();
        const relX = e.clientX - r.left - r.width/2;
        const relY = e.clientY - r.top - r.height/2;
        gsap.to(btn, {x:relX*0.25, y:relY*0.4, duration:.3, ease:'power2.out'});
      });
      btn.addEventListener('mouseleave', () => gsap.to(btn, {x:0, y:0, duration:.4, ease:'elastic.out(1,0.4)'}));
    });
  }

  /* ---------- header on scroll ---------- */
  const header = document.getElementById('siteHeader');
  window.addEventListener('scroll', () => {
    header.classList.toggle('scrolled', window.scrollY > 40);
  }, {passive:true});

  /* ---------- scroll progress bar ---------- */
  const scrollProgress = document.getElementById('scrollProgress');
  function updateScrollProgress() {
    const h = document.documentElement;
    const max = h.scrollHeight - h.clientHeight;
    scrollProgress.style.width = (max > 0 ? (h.scrollTop / max) * 100 : 0) + '%';
  }
  window.addEventListener('scroll', updateScrollProgress, {passive:true});
  window.addEventListener('resize', updateScrollProgress);
  updateScrollProgress();

  /* ---------- drag-to-scroll carousels ---------- */
  document.querySelectorAll('.showcase-scroll').forEach(scroller => {
    let isDown = false, startX = 0, startScroll = 0, moved = false;
    scroller.addEventListener('mousedown', e => {
      isDown = true; moved = false;
      scroller.classList.add('dragging');
      startX = e.pageX;
      startScroll = scroller.scrollLeft;
    });
    ['mouseleave', 'mouseup'].forEach(evt => scroller.addEventListener(evt, () => {
      isDown = false;
      scroller.classList.remove('dragging');
    }));
    scroller.addEventListener('mousemove', e => {
      if (!isDown) return;
      e.preventDefault();
      const dx = e.pageX - startX;
      if (Math.abs(dx) > 4) moved = true;
      scroller.scrollLeft = startScroll - dx;
    });
    // prevent the drag from being interpreted as a click on inner links/cards
    scroller.addEventListener('click', e => { if (moved) { e.preventDefault(); e.stopPropagation(); } }, true);
  });

  /* ---------- real-time activity toast ---------- */
  const activityToast = document.getElementById('activityToast');
  if (activityToast) {
    const activities = @json($activities);
    const activityText = document.getElementById('activityText');
    const activityTime = document.getElementById('activityTime');
    let actIndex = 0, actTimer, actDismissed = false;

    function showActivity() {
      if (actDismissed || !activities.length) return;
      const a = activities[actIndex % activities.length];
      activityText.textContent = a.text;
      activityTime.textContent = a.time;
      activityToast.classList.add('show');
      setTimeout(() => activityToast.classList.remove('show'), 4500);
      actIndex++;
    }

    document.getElementById('activityClose').addEventListener('click', () => {
      actDismissed = true;
      activityToast.classList.remove('show');
      clearInterval(actTimer);
    });

    setTimeout(() => {
      showActivity();
      actTimer = setInterval(showActivity, 7000);
    }, 3000);
  }

  /* ---------- mobile nav ---------- */
  const burger = document.getElementById('burger');
  const mobileNav = document.getElementById('mobileNav');
  const overlay = document.getElementById('navOverlay');
  function closeNav(){ mobileNav.classList.remove('open'); overlay.classList.remove('open'); }
  burger.addEventListener('click', () => { mobileNav.classList.toggle('open'); overlay.classList.toggle('open'); });
  overlay.addEventListener('click', closeNav);
  mobileNav.querySelectorAll('a').forEach(a => a.addEventListener('click', closeNav));

  /* ---------- light/dark theme toggle ---------- */
  const themeToggle = document.getElementById('themeToggle');
  const mobileThemeToggle = document.getElementById('mobileThemeToggle');
  function getTheme() { return document.documentElement.getAttribute('data-theme') || 'dark'; }
  function applyThemeIcon() {
    const icon = getTheme() === 'light' ? '☀️' : '🌙';
    if (themeToggle) themeToggle.textContent = icon;
    if (mobileThemeToggle) mobileThemeToggle.textContent = icon;
  }
  function setTheme(theme) {
    document.documentElement.setAttribute('data-theme', theme);
    try { localStorage.setItem('home2-theme', theme); } catch (e) {}
    applyThemeIcon();
  }
  function toggleTheme() { setTheme(getTheme() === 'light' ? 'dark' : 'light'); }
  if (themeToggle) themeToggle.addEventListener('click', toggleTheme);
  if (mobileThemeToggle) mobileThemeToggle.addEventListener('click', toggleTheme);
  applyThemeIcon();

  /* ---------- back to top ---------- */
  document.getElementById('backTop').addEventListener('click', e => {
    e.preventDefault(); window.scrollTo({top:0, behavior:'smooth'});
  });

  /* ---------- guide: spotlight on jump-to-section links ---------- */
  document.querySelectorAll('[data-target]').forEach(el => {
    el.addEventListener('click', () => {
      const target = document.querySelector(el.dataset.target);
      if (!target) return;
      target.classList.remove('spotlight');
      void target.offsetWidth; // restart animation if clicked again quickly
      target.classList.add('spotlight');
      setTimeout(() => target.classList.remove('spotlight'), 1600);
    });
  });

  /* ---------- guide: floating quick-nav dock ---------- */
  const quickNav = document.getElementById('quickNav');
  if (quickNav) {
    window.addEventListener('scroll', () => {
      quickNav.classList.toggle('show', window.scrollY > window.innerHeight * 0.5);
    }, {passive:true});

    const qnItems = Array.from(quickNav.querySelectorAll('.qn-item[data-target]'));
    const spySections = qnItems
      .map(it => document.querySelector(it.dataset.target))
      .filter(Boolean);
    if (spySections.length && 'IntersectionObserver' in window) {
      const spy = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            const id = '#' + entry.target.id;
            qnItems.forEach(it => it.classList.toggle('active', it.dataset.target === id));
          }
        });
      }, {rootMargin: '-45% 0px -45% 0px'});
      spySections.forEach(s => spy.observe(s));
    }
  }

  /* ---------- messenger-style chat widget ---------- */
  const chatWidget = document.getElementById('chatWidget');
  if (chatWidget) {
    const chatBubble = document.getElementById('chatBubble');
    const chatClose = document.getElementById('chatClose');
    const chatForm = document.getElementById('chatForm');
    const chatStatus = document.getElementById('chatStatus');
    const chatSuccess = document.getElementById('chatSuccess');
    const chatAnother = document.getElementById('chatAnother');
    const chatSubmit = document.getElementById('chatSubmit');
    const chatTyping = document.getElementById('chatTyping');
    const chatAgentReply = document.getElementById('chatAgentReply');
    const chatAutoReplyDelay = {{ (int) ($chatConfig['delay'] ?? 2) }} * 1000;

    const openChat = () => chatWidget.classList.add('open');
    const closeChat = () => chatWidget.classList.remove('open');

    chatBubble.addEventListener('click', () => chatWidget.classList.toggle('open'));
    chatClose.addEventListener('click', closeChat);

    // every "Talk to us" entry point (navbar, chooser card, quick-nav dock, mobile menu)
    // opens this widget instead of navigating away; href stays as a no-JS fallback.
    document.querySelectorAll('[data-chat-open]').forEach(el => {
      el.addEventListener('click', (e) => {
        e.preventDefault();
        openChat();
      });
    });

    chatForm.addEventListener('submit', async (e) => {
      e.preventDefault();
      chatStatus.textContent = '';
      chatSubmit.disabled = true;
      chatSubmit.textContent = 'Sending...';
      try {
        const res = await fetch('{{ route('contact-messages.store') }}', {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
          },
          body: new FormData(chatForm),
        });
        const data = await res.json();
        if (!res.ok) {
          const firstError = data.errors ? Object.values(data.errors)[0][0] : (data.message || 'Something went wrong — please try again.');
          throw new Error(firstError);
        }
        chatForm.style.display = 'none';
        chatSuccess.classList.add('show');
        if (chatTyping && chatAgentReply) {
          chatTyping.style.display = 'flex';
          chatAgentReply.style.display = 'none';
          setTimeout(() => {
            chatTyping.style.display = 'none';
            chatAgentReply.style.display = 'flex';
          }, chatAutoReplyDelay);
        }
      } catch (err) {
        chatStatus.textContent = err.message || 'Something went wrong — please try again.';
      } finally {
        chatSubmit.disabled = false;
        chatSubmit.textContent = 'Send message →';
      }
    });

    chatAnother.addEventListener('click', () => {
      chatForm.reset();
      chatForm.style.display = 'flex';
      chatSuccess.classList.remove('show');
      if (chatTyping && chatAgentReply) {
        chatTyping.style.display = 'none';
        chatAgentReply.style.display = 'none';
      }
    });
  }

  /* ---------- scroll reveals ---------- */
  gsap.registerPlugin(ScrollTrigger);
  document.querySelectorAll('.reveal').forEach(el => {
    gsap.to(el, {
      opacity:1, y:0, duration:.9, ease:'power3.out',
      scrollTrigger:{trigger:el, start:'top 85%'}
    });
  });

  /* ---------- bento tilt ---------- */
  if(!isCoarse){
    document.querySelectorAll('.card').forEach(card => {
      card.addEventListener('mousemove', e => {
        const r = card.getBoundingClientRect();
        const px = (e.clientX - r.left)/r.width, py = (e.clientY - r.top)/r.height;
        card.style.setProperty('--mx', (px*100)+'%');
        card.style.setProperty('--my', (py*100)+'%');
        const rx = (py-0.5) * -8, ry = (px-0.5) * 8;
        card.style.transform = `perspective(700px) rotateX(${rx}deg) rotateY(${ry}deg) translateZ(0)`;
      });
      card.addEventListener('mouseleave', () => { card.style.transform = 'perspective(700px) rotateX(0) rotateY(0)'; });
    });
  }

  /* ---------- stat counters ---------- */
  document.querySelectorAll('.num').forEach(num => {
    const target = parseInt(num.dataset.count, 10);
    const suffix = num.dataset.suffix || '+';
    ScrollTrigger.create({
      trigger:num, start:'top 90%', once:true,
      onEnter:() => {
        gsap.to(num, {
          innerText:target, duration:1.6, ease:'power2.out', snap:{innerText:1},
          onUpdate(){ num.textContent = Math.floor(num.innerText).toLocaleString() + suffix; }
        });
      }
    });
  });

  /* ---------- interactive journey map ---------- */
  const tItems = Array.from(document.querySelectorAll('#journeyTimeline .t-item'));
  if (tItems.length) {
    let unlocked = 1; // 1-indexed: steps < unlocked are completed, === unlocked is current, > unlocked are locked
    const progressLabel = document.getElementById('journeyProgressLabel');
    const reward = document.getElementById('journeyReward');

    function burst(dotEl) {
      if (reduceMotion) return;
      const rect = dotEl.getBoundingClientRect();
      const colors = ['#7c5cff', '#ec4899', '#22d3ee', '#f7b733'];
      for (let i = 0; i < 10; i++) {
        const p = document.createElement('span');
        p.className = 't-particle';
        p.style.background = colors[i % colors.length];
        p.style.left = (rect.left + rect.width / 2) + 'px';
        p.style.top = (rect.top + rect.height / 2) + 'px';
        document.body.appendChild(p);
        const angle = Math.random() * Math.PI * 2;
        const dist = 36 + Math.random() * 36;
        gsap.to(p, {
          x: Math.cos(angle) * dist, y: Math.sin(angle) * dist, opacity: 0,
          duration: 0.7, ease: 'power2.out', onComplete: () => p.remove()
        });
      }
    }

    function renderJourneyState() {
      tItems.forEach((item, idx) => {
        const step = idx + 1;
        const dot = item.querySelector('.t-dot');
        item.classList.remove('locked', 'current', 'completed');
        if (step < unlocked) {
          item.classList.add('completed');
          dot.textContent = '✓';
        } else if (step === unlocked) {
          item.classList.add('current');
          dot.textContent = step;
        } else {
          item.classList.add('locked');
          dot.textContent = step;
        }
      });
      const pct = ((unlocked - 1) / (tItems.length - 1 || 1)) * 100;
      gsap.to('#timelineProgress', { height: pct + '%', duration: 0.6, ease: 'power2.out' });
      progressLabel.textContent = unlocked > tItems.length
        ? 'All steps unlocked 🎉'
        : `Step ${unlocked} of ${tItems.length}`;
      if (unlocked > tItems.length) reward.classList.add('show');
    }

    tItems.forEach((item, idx) => {
      const step = idx + 1;
      const dot = item.querySelector('.t-dot');
      // whole card is clickable when it's the current step, not just the small dot
      item.addEventListener('click', () => {
        if (step !== unlocked) return;
        burst(dot);
        unlocked = step + 1;
        renderJourneyState();
      });
    });

    renderJourneyState();
  }

  /* ---------- testimonials carousel ---------- */
  const testis = document.querySelectorAll('.testi');
  const dotsWrap = document.getElementById('testiDots');
  let tIndex = 0, tTimer;
  testis.forEach((_, i) => {
    const b = document.createElement('button');
    if(i===0) b.classList.add('active');
    b.addEventListener('click', () => showTesti(i, true));
    dotsWrap.appendChild(b);
  });
  function showTesti(i, manual){
    testis.forEach(t => t.classList.remove('active'));
    dotsWrap.querySelectorAll('button').forEach(b => b.classList.remove('active'));
    testis[i].classList.add('active');
    dotsWrap.children[i].classList.add('active');
    tIndex = i;
    if(manual){ clearInterval(tTimer); startTestiTimer(); }
  }
  function startTestiTimer(){
    tTimer = setInterval(() => showTesti((tIndex+1) % testis.length), 5000);
  }
  startTestiTimer();

  /* ---------- three.js hero visual ---------- */
  if(!reduceMotion && window.THREE){
    const canvas = document.getElementById('hero-canvas');
    const renderer = new THREE.WebGLRenderer({canvas, alpha:true, antialias:true});
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(55, window.innerWidth/window.innerHeight, 0.1, 100);
    camera.position.z = 9;

    function sizeCanvas(){
      const w = canvas.parentElement.clientWidth, h = canvas.parentElement.clientHeight;
      renderer.setSize(w, h);
      camera.aspect = w/h; camera.updateProjectionMatrix();
    }
    sizeCanvas();

    const geo = new THREE.IcosahedronGeometry(3.1, 1);
    const mat = new THREE.MeshBasicMaterial({color:0x7c5cff, wireframe:true, transparent:true, opacity:0.55});
    const mesh = new THREE.Mesh(geo, mat);
    scene.add(mesh);

    const geo2 = new THREE.IcosahedronGeometry(2.2, 0);
    const mat2 = new THREE.MeshBasicMaterial({color:0xec4899, wireframe:true, transparent:true, opacity:0.4});
    const mesh2 = new THREE.Mesh(geo2, mat2);
    scene.add(mesh2);

    // starfield particles
    const starCount = 260;
    const starGeo = new THREE.BufferGeometry();
    const positions = new Float32Array(starCount*3);
    for(let i=0;i<starCount;i++){
      positions[i*3] = (Math.random()-0.5)*18;
      positions[i*3+1] = (Math.random()-0.5)*12;
      positions[i*3+2] = (Math.random()-0.5)*10 - 2;
    }
    starGeo.setAttribute('position', new THREE.BufferAttribute(positions, 3));
    const starMat = new THREE.PointsMaterial({color:0x22d3ee, size:0.045, transparent:true, opacity:0.75});
    const stars = new THREE.Points(starGeo, starMat);
    scene.add(stars);

    let mouseX = 0, mouseY = 0;
    window.addEventListener('mousemove', e => {
      mouseX = (e.clientX/window.innerWidth - 0.5);
      mouseY = (e.clientY/window.innerHeight - 0.5);
    });

    let hue = 0, rafId;
    function animate(){
      rafId = requestAnimationFrame(animate);
      mesh.rotation.x += 0.0018; mesh.rotation.y += 0.0026;
      mesh2.rotation.x -= 0.0012; mesh2.rotation.y -= 0.0022;
      stars.rotation.y += 0.0004;
      camera.position.x += (mouseX*1.4 - camera.position.x) * 0.03;
      camera.position.y += (-mouseY*1.2 - camera.position.y) * 0.03;
      camera.lookAt(0,0,0);
      hue = (hue + 0.0015) % 1;
      mat.color.setHSL(0.72 + hue*0.15, 0.75, 0.62);
      mat2.color.setHSL(0.86 + hue*0.1, 0.7, 0.62);
      renderer.render(scene, camera);
    }
    animate();

    window.addEventListener('resize', sizeCanvas);
    document.addEventListener('visibilitychange', () => {
      if(document.hidden) cancelAnimationFrame(rafId); else animate();
    });
  }
})();
</script>
</body>
</html>
