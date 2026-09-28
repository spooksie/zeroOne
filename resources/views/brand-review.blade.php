{{--
    ZeroOne.com — private identity review page for the client.
    Self-contained: no Vite build, no external JS. Fonts come from Google Fonts.
    Kept out of search: robots meta below + X-Robots-Tag header on the route.
--}}
@php
    // Static marks used for favicons and app icons. Colours come from CSS
    // custom properties on the wrapper (--i-ink, --i-acc, --i-b1…), so one
    // drawing serves light, dark and brand tiles. $id keeps ids unique.
    $segA = '9,7 16,0 48,0 55,7 48,14 16,14';
    $segB = '57,9 64,16 64,51 57,58 50,51 50,16';
    $segC = '57,62 64,69 64,104 57,111 50,104 50,69';
    $segD = '9,113 16,106 48,106 55,113 48,120 16,120';
    $segE = '7,62 14,69 14,104 7,111 0,104 0,69';
    $segF = '7,9 14,16 14,51 7,58 0,51 0,16';
    $segG = '9,60 16,53 48,53 55,60 48,67 16,67';
    $segAll = [$segA, $segB, $segC, $segD, $segE, $segF, $segG];
    $polys = fn (array $pts, string $style) => collect($pts)->map(fn ($p) => '<polygon points="'.$p.'" style="'.$style.'"></polygon>')->implode('');

    $mark = [
        'coin' => fn (string $id) => '<svg viewBox="0 0 200 200" aria-hidden="true"><circle cx="100" cy="100" r="98" style="fill:var(--i-acc)"></circle><circle cx="100" cy="100" r="93" fill="none" stroke-width="6" stroke-dasharray="2 2.6" style="stroke:var(--i-edge)"></circle><circle cx="100" cy="100" r="86" fill="none" stroke-width="2.5" opacity=".7" style="stroke:var(--i-ink)"></circle><circle cx="100" cy="100" r="60" fill="none" stroke-width="2.5" opacity=".7" style="stroke:var(--i-ink)"></circle><path d="M103 62 H108 V130 Q108 134 113 134.5 L121 135 V139 H79 V135 L87 134.5 Q92 134 92 130 V80 Q87 84 78 85.5 L77 81.5 Q93 75 103 62 Z" style="fill:var(--i-ink)"></path></svg>',
        'segment' => fn (string $id) => '<svg viewBox="-28.5 -35 190 190" aria-hidden="true"><g transform="skewX(-8)">'.$polys($segAll, 'fill:var(--i-b1)').$polys([$segA, $segB, $segC, $segD, $segE, $segF], 'fill:var(--i-acc)').'</g><g transform="translate(86 0) skewX(-8)">'.$polys($segAll, 'fill:var(--i-b1)').$polys([$segB, $segC], 'fill:var(--i-acc)').'</g></svg>',
        'extrude' => fn (string $id) => '<svg viewBox="17.5 33 150 150" aria-hidden="true"><path d="M70 44 L115.03 70 L70 96 L24.97 70 Z M24.97 70 V122 L70 148 V96" fill="none" stroke-width="6" stroke-linejoin="round" stroke-linecap="round" style="stroke:var(--i-ink)"></path><path d="M115.03 70 L160.06 96 L115.03 122 L70 96 Z" style="fill:var(--i-t)"></path><path d="M70 96 L115.03 122 L115.03 174 L70 148 Z" style="fill:var(--i-l)"></path><path d="M115.03 122 L160.06 96 L160.06 148 L115.03 174 Z" style="fill:var(--i-r)"></path></svg>',
        'onoff' => fn (string $id) => '<svg viewBox="176 20 160 160" aria-hidden="true"><circle cx="218" cy="100" r="30" fill="none" stroke-width="13" style="stroke:var(--i-ink)"></circle><circle cx="294" cy="100" r="36.5" style="fill:var(--i-acc)"></circle><path d="M284 88 L297 78 V122" fill="none" stroke-width="10" stroke-linecap="round" stroke-linejoin="round" style="stroke:var(--i-bg)"></path></svg>',
    ];

    $vars = fn (array $c) => collect($c)->except('bg')->map(fn ($v, $k) => "--i-{$k}: {$v}")->push('--i-bg: '.($c['bg'] ?? 'transparent'))->implode('; ');

    $concepts = [
        [
            'id' => 'coin', 'num' => '01', 'name' => 'Coin',
            'idea' => 'Heads or tails — the purest zero-or-one. A struck brass coin that rests on its 1, with 0 on the reverse; every click tosses it to the other side. Classic and collectable, with a serif that feels established.',
            'fonts' => [
                ['role' => 'Primary', 'use' => 'Wordmark, headings', 'family' => 'Instrument Serif', 'css' => "'Instrument Serif', Georgia, serif", 'weight' => 400, 'tracking' => '0'],
                ['role' => 'Secondary', 'use' => 'Body copy, interface', 'family' => 'Instrument Sans', 'css' => "'Instrument Sans', system-ui, sans-serif", 'weight' => 400, 'tracking' => '0'],
            ],
            'palette' => [
                ['Parchment', '#ECE6DA', 'Light background', '#1D1A15'],
                ['Umber', '#1D1A15', 'Primary — text', '#ECE6DA'],
                ['Brass', '#96681B', 'Accent — the coin', '#FFFFFF'],
                ['Taupe', '#5F584C', 'Secondary text', '#FFFFFF'],
                ['Night', '#16140F', 'Dark background', '#F1EADB'],
                ['Gilt', '#C9973F', 'Accent on dark', '#16140F'],
            ],
            'icons' => [
                'light' => ['bg' => '#ECE6DA', 'ink' => '#FBF3E2', 'acc' => '#96681B', 'edge' => '#5E4110'],
                'dark' => ['bg' => '#16140F', 'ink' => '#221C12', 'acc' => '#C9973F', 'edge' => '#7A5A22'],
                'brand' => ['bg' => '#1D1A15', 'ink' => '#1D1A15', 'acc' => '#C9973F', 'edge' => '#7A5A22'],
            ],
        ],
        [
            'id' => 'segment', 'num' => '02', 'name' => 'Segment',
            'idea' => '“01” on a seven-segment display, with the unlit segments left as ghosts. Click and it counts in binary — 01, 10, 11, 00 — and lands back on 01. The blue keeps a thread to today’s logo.',
            'fonts' => [
                ['role' => 'Primary', 'use' => 'Wordmark, headings', 'family' => 'Chakra Petch', 'css' => "'Chakra Petch', system-ui, sans-serif", 'weight' => 600, 'tracking' => '0.02em'],
                ['role' => 'Secondary', 'use' => 'Body copy, interface', 'family' => 'Chivo', 'css' => "'Chivo', system-ui, sans-serif", 'weight' => 400, 'tracking' => '0'],
            ],
            'palette' => [
                ['Void', '#0D0E12', 'Dark background & primary', '#E6E9F0'],
                ['Signal', '#4D8DFF', 'Accent on dark', '#0D0E12'],
                ['Frost', '#EEF0F4', 'Light background', '#0D0E12'],
                ['Cobalt', '#2A63D9', 'Accent on light', '#FFFFFF'],
                ['Ghost', '#1C1F28', 'Unlit segments', '#E6E9F0'],
                ['Steel', '#8A90A0', 'Secondary text on dark', '#0D0E12'],
            ],
            'icons' => [
                'light' => ['bg' => '#EEF0F4', 'acc' => '#2A63D9', 'b1' => '#D9DDE6'],
                'dark' => ['bg' => '#0D0E12', 'acc' => '#4D8DFF', 'b1' => '#1C1F28'],
                'brand' => ['bg' => '#2A63D9', 'acc' => '#FFFFFF', 'b1' => 'rgba(255,255,255,.16)'],
            ],
        ],
        [
            'id' => 'extrude', 'num' => '03', 'name' => 'Extrude',
            'idea' => 'A bit as an object: an empty outlined block (0) beside a solid one (1). The wordmark follows suit — ZERO in outline, ONE in solid. Architectural and product-ready.',
            'fonts' => [
                ['role' => 'Primary', 'use' => 'Wordmark, headings', 'family' => 'Archivo Expanded', 'css' => "'Archivo', system-ui, sans-serif", 'weight' => 800, 'tracking' => '-0.01em', 'stretch' => '125%'],
                ['role' => 'Secondary', 'use' => 'Body copy, interface', 'family' => 'Archivo', 'css' => "'Archivo', system-ui, sans-serif", 'weight' => 400, 'tracking' => '0'],
            ],
            'palette' => [
                ['Chalk', '#EFEFEA', 'Light background', '#17191E'],
                ['Ink', '#17191E', 'Primary — outline & text', '#EFEFEA'],
                ['Vermilion', '#D63D20', 'Accent — the solid block', '#FFFFFF'],
                ['Flame', '#FF5A3A', 'Accent on dark', '#17191E'],
                ['Slate', '#5A5D66', 'Secondary text', '#FFFFFF'],
                ['Coal', '#121317', 'Dark background', '#ECEDEA'],
            ],
            'icons' => [
                'light' => ['bg' => '#EFEFEA', 'ink' => '#17191E', 't' => '#E77A63', 'l' => '#D63D20', 'r' => '#932612'],
                'dark' => ['bg' => '#121317', 'ink' => '#ECEDEA', 't' => '#FF8D74', 'l' => '#FF5A3A', 'r' => '#B23A22'],
                'brand' => ['bg' => '#D63D20', 'ink' => '#FFFFFF', 't' => '#FFFFFF', 'l' => '#F6C3B7', 'r' => '#17191E'],
            ],
        ],
        [
            'id' => 'onoff', 'num' => '04', 'name' => 'On/Off',
            'idea' => 'A custom-drawn wordmark where the two o’s are the two states: one empty, one lit with a 1. Click and the light slides across like a switch, carrying its 1 while the rest of “one” switches off. A quieter grown-up of today’s toggle logo.',
            'fonts' => [
                ['role' => 'Primary', 'use' => 'Headings, interface (wordmark is custom-drawn)', 'family' => 'Manrope', 'css' => "'Manrope', system-ui, sans-serif", 'weight' => 600, 'tracking' => '-0.02em'],
                ['role' => 'Secondary', 'use' => 'Body copy, long-form', 'family' => 'Literata', 'css' => "'Literata', Georgia, serif", 'weight' => 400, 'tracking' => '0'],
            ],
            'palette' => [
                ['Soot', '#131210', 'Dark background & primary', '#F3EEE4'],
                ['Bone', '#F3EEE4', 'Light background', '#131210'],
                ['Lime', '#C8F03C', 'Accent on dark', '#131210'],
                ['Moss', '#5C7A00', 'Accent on light', '#FFFFFF'],
                ['Clay', '#9A948A', 'Secondary text on dark', '#131210'],
                ['Umber', '#2A2824', 'Surface on dark', '#F3EEE4'],
            ],
            'icons' => [
                'light' => ['bg' => '#F3EEE4', 'ink' => '#131210', 'acc' => '#5C7A00'],
                'dark' => ['bg' => '#131210', 'ink' => '#F3EEE4', 'acc' => '#C8F03C'],
                'brand' => ['bg' => '#C8F03C', 'ink' => '#131210', 'acc' => '#131210'],
            ],
        ],
    ];
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex, nofollow, noarchive, nosnippet, noimageindex">
<meta name="googlebot" content="noindex, nofollow, noarchive, nosnippet, noimageindex">
<meta name="bingbot" content="noindex, nofollow, noarchive">
<meta name="referrer" content="no-referrer">
<title>ZeroOne identity review — private</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Archivo:wdth,wght@100,400;125,800&amp;family=Chakra+Petch:wght@500;600&amp;family=Chivo:wght@400;500&amp;family=Geist+Mono:wght@400;500&amp;family=Geist:wght@400;500;600&amp;family=Instrument+Sans:wght@400;500&amp;family=Instrument+Serif:ital@0;1&amp;family=Literata:opsz,wght@7..72,400&amp;family=Manrope:wght@500;600&amp;display=swap">
<script>document.documentElement.classList.add('js')</script>
@verbatim
<style>
:root{--page:#F4F3EF;--text:#151515;--muted:#5E5D58;--line:#E2E0D9;--card:#FFFFFF}
*{box-sizing:border-box}
html{scroll-behavior:smooth;-webkit-text-size-adjust:100%}
body{margin:0;background:var(--page);color:var(--text);font:400 16px/1.55 'Geist',system-ui,sans-serif}
a{color:inherit}
.wrap{max-width:1200px;margin:0 auto;padding:0 16px}
@media (min-width:760px){.wrap{padding:0 32px}}

/* Top bar */
.top{position:sticky;top:0;z-index:10;background:rgba(244,243,239,.88);backdrop-filter:blur(12px);-webkit-backdrop-filter:blur(12px);border-bottom:1px solid var(--line)}
.top .wrap{display:flex;align-items:center;justify-content:space-between;gap:16px;min-height:60px;flex-wrap:wrap;padding-top:8px;padding-bottom:8px}
.brand{display:flex;align-items:baseline;gap:12px;font-weight:600;letter-spacing:-.01em}
.brand small{font-weight:400;font-size:13px;color:var(--muted)}
.nav{display:flex;gap:4px;flex-wrap:wrap}
.nav a{display:inline-flex;align-items:center;gap:6px;min-height:44px;padding:0 12px;border-radius:999px;text-decoration:none;font-size:14px;color:var(--muted)}
.nav a:hover{background:#E9E7E1;color:var(--text)}
.nav a span{font-family:'Geist Mono',monospace;font-size:12px}

/* Intro */
.hero{padding-top:72px;padding-bottom:40px}
.eyebrow{font:500 12px/1 'Geist Mono',monospace;letter-spacing:.12em;text-transform:uppercase;color:var(--muted);margin:0 0 20px}
.hero h1{font-size:clamp(36px,6vw,64px);line-height:1.02;letter-spacing:-.035em;font-weight:600;margin:0;max-width:14ch;text-wrap:balance}
.hero p{max-width:60ch;color:var(--muted);font-size:18px;margin:24px 0 0;text-wrap:pretty}
.how{display:flex;gap:8px;flex-wrap:wrap;margin-top:28px}
.how span{display:inline-flex;align-items:center;gap:8px;padding:8px 14px;border:1px solid var(--line);border-radius:999px;font-size:14px;background:var(--card)}
.how b{font:500 11px/1 'Geist Mono',monospace;letter-spacing:.08em;text-transform:uppercase;color:var(--muted)}

/* Concept sections */
.concept{padding:56px 0;border-top:1px solid var(--line);scroll-margin-top:72px}
.c-head{display:grid;gap:12px 40px;margin-bottom:28px}
@media (min-width:900px){.c-head{grid-template-columns:minmax(0,1fr) minmax(0,1.3fr);align-items:end}}
.c-head h2{margin:0;font-size:clamp(32px,4.4vw,48px);letter-spacing:-.03em;line-height:1;font-weight:600;display:flex;align-items:baseline;gap:16px}
.c-head h2 span{font:500 14px/1 'Geist Mono',monospace;color:var(--muted);letter-spacing:.04em}
.c-head p{margin:0;color:var(--muted);max-width:58ch;text-wrap:pretty}

.stages{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:16px}
@media (max-width:760px){.stages{grid-template-columns:minmax(0,1fr)}}
.stage{--t:1;position:relative;height:clamp(360px,36vw,440px);border-radius:24px;overflow:hidden;display:flex;align-items:center;justify-content:center;background:var(--bg);color:var(--ink)}
.stage .mode{position:absolute;top:18px;left:20px;font:500 11px/1 'Geist Mono',monospace;letter-spacing:.14em;text-transform:uppercase;color:var(--muted)}
.replay{position:absolute;right:14px;bottom:14px;height:44px;padding:0 16px 0 12px;display:flex;align-items:center;gap:8px;border-radius:999px;border:1px solid color-mix(in srgb,var(--ink) 24%,transparent);background:transparent;color:var(--ink);font:500 13px/1 'Geist',system-ui,sans-serif;cursor:pointer;transition:background-color .2s,border-color .2s}
.replay:hover{background:color-mix(in srgb,var(--ink) 7%,transparent);border-color:color-mix(in srgb,var(--ink) 45%,transparent)}
.replay:focus-visible{outline:2px solid var(--ink);outline-offset:3px}

.details{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:16px;margin-top:16px}
@media (max-width:760px){.details{grid-template-columns:minmax(0,1fr)}}
.card{background:var(--card);border:1px solid var(--line);border-radius:24px;padding:24px;min-width:0}
.card h3{margin:0 0 20px;font:500 12px/1 'Geist Mono',monospace;letter-spacing:.12em;text-transform:uppercase;color:var(--muted)}

/* Favicon */
.tabbar{display:flex;align-items:flex-end;height:46px;padding:0 10px;border-radius:12px 12px 0 0;gap:4px}
.tabbar.light{background:#DEE1E6}
.tabbar.dark{background:#1F2023;margin-top:12px}
.tab{display:flex;align-items:center;gap:10px;height:36px;padding:0 12px;border-radius:10px 10px 0 0;font:400 13px/1 system-ui,sans-serif;min-width:0;width:230px;max-width:100%}
.tabbar.light .tab{background:#FFFFFF;color:#1F1F1F}
.tabbar.dark .tab{background:#35363A;color:#E8EAED}
.tab .t{flex:1;overflow:hidden;white-space:nowrap;text-overflow:ellipsis}
.tab .x{opacity:.6;font-size:15px}
.tab .fav{width:16px;height:16px;flex:none;display:block}
.fav svg,.app svg,.sz svg{display:block;width:100%;height:100%}
.sizes{display:flex;gap:12px;margin-top:20px;flex-wrap:wrap}
.sizes .grp{display:flex;align-items:flex-end;gap:14px;padding:14px 16px;border-radius:14px;background:var(--i-bg)}
.sz{display:flex;flex-direction:column;align-items:center;gap:8px;font:400 11px/1 'Geist Mono',monospace}
.sizes .grp.light .sz{color:#5E5D58}
.sizes .grp.dark .sz{color:#A3A3A8}

/* App icons */
.apps{display:flex;gap:20px;flex-wrap:wrap}
.app-item{display:flex;flex-direction:column;align-items:center;gap:10px;font-size:13px;color:var(--muted)}
.app{width:96px;height:96px;border-radius:22.5%;background:var(--i-bg);padding:16px;box-shadow:0 1px 2px rgba(0,0,0,.08),0 8px 24px -8px rgba(0,0,0,.25),inset 0 0 0 1px rgba(0,0,0,.06)}
.app.sm{width:60px;height:60px;padding:10px}
.apps-row{display:flex;align-items:flex-end;gap:14px;margin-top:22px;padding-top:20px;border-top:1px solid var(--line);flex-wrap:wrap}

/* Type */
.fonts{display:grid;gap:20px}
.font{display:grid;grid-template-columns:auto minmax(0,1fr);gap:4px 20px;align-items:center}
.font .aa{font-size:64px;line-height:1;grid-row:span 3}
.font .role{font:500 11px/1.4 'Geist Mono',monospace;letter-spacing:.1em;text-transform:uppercase;color:var(--muted)}
.font .fam{font-size:20px;font-weight:600;letter-spacing:-.01em}
.font .use{font-size:13px;color:var(--muted)}
.sample{margin:4px 0 0;padding-top:16px;border-top:1px solid var(--line);display:grid;gap:10px}
.sample .h{font-size:clamp(24px,3vw,30px);line-height:1.1;margin:0}
.sample .b{font-size:16px;line-height:1.6;margin:0;color:#3D3C38}

/* Palette */
.swatches{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:10px}
@media (max-width:480px){.swatches{grid-template-columns:repeat(2,minmax(0,1fr))}}
.sw{border-radius:16px;padding:14px;min-height:112px;display:flex;flex-direction:column;justify-content:space-between;gap:10px;box-shadow:inset 0 0 0 1px rgba(0,0,0,.07)}
.sw b{font-size:15px;font-weight:600}
.sw span{display:block;font:400 12px/1.35 'Geist Mono',monospace}

/* Closing + footer */
.closing{padding:64px 0;border-top:1px solid var(--line)}
.closing h2{font-size:clamp(28px,4vw,40px);letter-spacing:-.03em;line-height:1.05;margin:0;font-weight:600}
.closing p{color:var(--muted);max-width:60ch;margin:16px 0 0}
.foot{border-top:1px solid var(--line);padding:28px 0 40px}
.foot .wrap{display:flex;align-items:center;justify-content:space-between;gap:12px 24px;flex-wrap:wrap;font-size:13px;color:var(--muted)}
.foot .credits{display:flex;align-items:center;gap:8px 24px;flex-wrap:wrap}
.credit{display:inline-flex;align-items:center;gap:10px;text-decoration:none;color:#151515;min-height:44px}
.credit svg{height:20px;width:auto;display:block}
.credit.coh svg{height:22px}
.credit:hover svg{opacity:.8}

/* ---------- Logos: shared ---------- */
.logo{appearance:none;background:none;border:0;margin:0;padding:24px 32px;font:inherit;color:inherit;cursor:pointer;-webkit-tap-highlight-color:transparent;border-radius:24px}
.logo:focus-visible{outline:2px solid var(--acc);outline-offset:6px}
.logo svg{display:block;overflow:visible}
.logo svg g{transform-box:fill-box;transform-origin:center}
.ltr{display:inline-block}
.js .logo:not(.play),.js .logo:not(.play) *{animation-play-state:paused!important}

/* ---------- 01 Coin ---------- */
.c-coin .light{--bg:#ECE6DA;--ink:#1D1A15;--acc:#96681B;--face:#FBF3E2;--edge:#5E4110;--muted:#5F584C}
.c-coin .dark{--bg:#16140F;--ink:#F1EADB;--acc:#C9973F;--face:#221C12;--edge:#7A5A22;--muted:#A69E8E}
.cn-logo{display:flex;flex-direction:column;align-items:center;gap:10px;--cs:clamp(150px,17vw,190px)}
.cn-scene{display:block;position:relative;width:var(--cs);height:calc(var(--cs) + 26px);perspective:1000px}
.cn-3d{display:block;position:relative;width:var(--cs);height:var(--cs);transform-style:preserve-3d}
.cn-face,.cn-edge{position:absolute;left:0;top:0;width:var(--cs);height:var(--cs);border-radius:50%}
.cn-face svg{width:100%;height:100%}
.cn-face{backface-visibility:hidden;-webkit-backface-visibility:hidden}
.cn-front{transform:translateZ(6px)}
.cn-back{transform:rotateY(180deg) translateZ(6px)}
.cn-edge{background:var(--edge)}
.cn-body{fill:var(--acc)}
.cn-mill{fill:none;stroke:var(--edge);stroke-width:6px;stroke-dasharray:2 2.6}
.cn-rim{fill:none;stroke:var(--face);stroke-width:1.5px;opacity:.7}
.cn-txt{fill:var(--face);font:400 14px 'Instrument Serif',Georgia,serif}
.cn-num{fill:var(--face);font:400 112px 'Instrument Serif',Georgia,serif}
.cn-shadow{position:absolute;left:18%;top:calc(var(--cs) + 10px);width:64%;height:12px;border-radius:50%;background:color-mix(in srgb,#000 22%,transparent);filter:blur(5px)}
.cn-in{animation:cn-toss 1.3s cubic-bezier(.2,.75,.25,1) .15s backwards}
@keyframes cn-toss{from{transform:translateY(-150px) rotateY(-720deg) scale(.7);opacity:0}}
.cn-shadow{animation:cn-shade-in 1.3s cubic-bezier(.2,.75,.25,1) .15s backwards}
@keyframes cn-shade-in{from{transform:scale(.4);opacity:0}}
.cn-idle{animation:cn-wobble 4.4s ease-in-out 1.5s infinite}
@keyframes cn-wobble{0%,100%{transform:rotateY(0deg)}25%{transform:rotateY(12deg)}75%{transform:rotateY(-12deg)}}
.cn-hov{transition:transform .6s cubic-bezier(.3,1.4,.5,1)}
.logo:hover .cn-hov{transform:rotateX(14deg) rotateY(-28deg) scale(1.04)}
.ca .cn-click{animation:cn-hop-a 1.2s linear}
.cb .cn-click{animation:cn-hop-b 1.2s linear}
@keyframes cn-hop-a{0%{transform:translateY(0);animation-timing-function:cubic-bezier(.2,.6,.35,1)}42%{transform:translateY(-80px);animation-timing-function:cubic-bezier(.65,0,.8,.4)}80%{transform:translateY(0);animation-timing-function:ease-out}90%{transform:translateY(-10px);animation-timing-function:ease-in}100%{transform:translateY(0)}}
@keyframes cn-hop-b{0%{transform:translateY(0);animation-timing-function:cubic-bezier(.2,.6,.35,1)}42%{transform:translateY(-80px);animation-timing-function:cubic-bezier(.65,0,.8,.4)}80%{transform:translateY(0);animation-timing-function:ease-out}90%{transform:translateY(-10px);animation-timing-function:ease-in}100%{transform:translateY(0)}}
.ca .cn-spin{animation:cn-spin-a .96s cubic-bezier(.3,.2,.4,1) forwards}
.cb .cn-spin{animation:cn-spin-b .96s cubic-bezier(.3,.2,.4,1) forwards}
@keyframes cn-spin-a{from{transform:rotateY(0deg)}to{transform:rotateY(900deg)}}
@keyframes cn-spin-b{from{transform:rotateY(900deg)}to{transform:rotateY(1800deg)}}
.ca .cn-shadow{animation:cn-shade-a 1.2s linear}
.cb .cn-shadow{animation:cn-shade-b 1.2s linear}
@keyframes cn-shade-a{0%,80%,100%{transform:none;opacity:1}42%{transform:scale(.55);opacity:.45}90%{transform:scale(.9)}}
@keyframes cn-shade-b{0%,80%,100%{transform:none;opacity:1}42%{transform:scale(.55);opacity:.45}90%{transform:scale(.9)}}
.cn-word{display:flex;font:400 clamp(44px,5vw,56px)/1 'Instrument Serif',Georgia,serif;letter-spacing:.005em;color:var(--ink)}
.cn-word .it{font-style:italic;transition:color .4s ease}
.logo:hover .cn-word .it{color:var(--acc)}
.cn-word .ltr{animation:cn-letter .7s cubic-bezier(.2,.8,.2,1) calc(1.05s + var(--i)*.06s) backwards}
@keyframes cn-letter{from{opacity:0;transform:translateY(14px)}}
.ca .cn-word .ltr{animation:cn-wave-a .6s ease-out calc(.85s + var(--i)*.05s) backwards}
.cb .cn-word .ltr{animation:cn-wave-b .6s ease-out calc(.85s + var(--i)*.05s) backwards}
@keyframes cn-wave-a{0%,100%{transform:none}40%{transform:translateY(-8px)}}
@keyframes cn-wave-b{0%,100%{transform:none}40%{transform:translateY(-8px)}}

/* ---------- 02 Segment ---------- */
.c-segment .light{--bg:#EEF0F4;--ink:#0D0E12;--acc:#2A63D9;--ghost:#DCE0E8;--ghost-h:#CDD2DC;--glow:0;--muted:#5A6070}
.c-segment .dark{--bg:#0D0E12;--ink:#E6E9F0;--acc:#4D8DFF;--ghost:#1C1F28;--ghost-h:#272B37;--glow:1;--muted:#8A90A0}
.sg-logo{display:flex;flex-direction:column;align-items:center;gap:30px}
.sg-svg{width:clamp(200px,24vw,260px);height:auto}
.logo svg .sg-dig{transform-box:view-box;transform-origin:0 0}
.sg-ghost{fill:var(--ghost);transition:fill .4s ease}
.logo:hover .sg-ghost{fill:var(--ghost-h)}
.sg-ghosts{animation:sg-fade .5s ease-out .05s backwards}
@keyframes sg-fade{from{opacity:0}}
.sg-seg,.sg-seg-r{fill:var(--acc)}
.dark .sg-lit{filter:drop-shadow(0 0 5px color-mix(in srgb,var(--acc) 50%,transparent));transition:filter .4s ease}
.dark .logo:hover .sg-lit{filter:drop-shadow(0 0 12px color-mix(in srgb,var(--acc) 80%,transparent))}
.sg-seg{animation:sg-on .5s linear calc(.35s + var(--i)*.09s) backwards}
@keyframes sg-on{0%{opacity:0}30%{opacity:1}42%{opacity:.15}58%{opacity:1}70%{opacity:.5}100%{opacity:1}}
.sg-idle{animation:sg-breathe 3.6s ease-in-out 1.9s infinite}
@keyframes sg-breathe{0%,100%{opacity:1}50%{opacity:.76}}
.sg-R{opacity:0}
.ca .sg-L{animation:sg-l-a 1.8s linear}
.cb .sg-L{animation:sg-l-b 1.8s linear}
.ca .sg-R{animation:sg-r-a 1.8s linear}
.cb .sg-R{animation:sg-r-b 1.8s linear}
@keyframes sg-l-a{0%,19.9%{opacity:1}20%,59.9%{opacity:0}60%,100%{opacity:1}}
@keyframes sg-l-b{0%,19.9%{opacity:1}20%,59.9%{opacity:0}60%,100%{opacity:1}}
@keyframes sg-r-a{0%,19.9%{opacity:0}20%,39.9%{opacity:1}40%,59.9%{opacity:0}60%,79.9%{opacity:1}80%,100%{opacity:0}}
@keyframes sg-r-b{0%,19.9%{opacity:0}20%,39.9%{opacity:1}40%,59.9%{opacity:0}60%,79.9%{opacity:1}80%,100%{opacity:0}}
.ca .sg-press{animation:sg-press-a 1.8s ease-out}
.cb .sg-press{animation:sg-press-b 1.8s ease-out}
@keyframes sg-press-a{0%,20%,40%,60%,80%,100%{transform:none}10%,30%,50%,70%,90%{transform:scale(.985)}}
@keyframes sg-press-b{0%,20%,40%,60%,80%,100%{transform:none}10%,30%,50%,70%,90%{transform:scale(.985)}}
.sg-word{display:flex;font:600 clamp(24px,3vw,30px)/1 'Chakra Petch',system-ui,sans-serif;letter-spacing:.34em;padding-left:.34em;color:var(--ink);transition:letter-spacing .5s ease,padding-left .5s ease}
.logo:hover .sg-word{letter-spacing:.42em;padding-left:.42em}
.sg-word .ltr{animation:sg-on .5s linear calc(1.2s + var(--i)*.06s) backwards}
.ca .sg-word .ltr{animation:sg-wave-a .5s ease-out calc(var(--i)*.24s) backwards}
.cb .sg-word .ltr{animation:sg-wave-b .5s ease-out calc(var(--i)*.24s) backwards}
@keyframes sg-wave-a{0%,100%{transform:none;color:var(--ink)}35%{transform:translateY(-6px);color:var(--acc)}}
@keyframes sg-wave-b{0%,100%{transform:none;color:var(--ink)}35%{transform:translateY(-6px);color:var(--acc)}}

/* ---------- 03 Extrude ---------- */
.c-extrude .light{--bg:#EFEFEA;--ink:#17191E;--acc:#D63D20;--muted:#5A5D66}
.c-extrude .dark{--bg:#121317;--ink:#ECEDEA;--acc:#FF5A3A;--muted:#9A9DA6}
.ex-logo{display:flex;align-items:center;gap:clamp(16px,2.4vw,28px)}
@media (max-width:560px){.ex-logo{flex-direction:column}}
.ex-svg{width:clamp(110px,13vw,150px);height:auto}
.ex-wire{fill:none;stroke:var(--ink);stroke-width:4px;stroke-linejoin:round;stroke-linecap:round;stroke-dasharray:8 7;animation:ex-march 1.4s linear infinite;transition:stroke-dasharray .4s ease}
@keyframes ex-march{to{stroke-dashoffset:-30}}
.logo:hover .ex-wire{stroke-dasharray:15 0}
.ex-wi{animation:ex-wire-in .7s cubic-bezier(.2,.8,.2,1) .15s backwards}
@keyframes ex-wire-in{from{opacity:0;transform:scale(.86)}}
.ca .ex-wire{animation:ex-march 1.4s linear infinite,ex-ping-a .9s ease-out .3s}
.cb .ex-wire{animation:ex-march 1.4s linear infinite,ex-ping-b .9s ease-out .3s}
@keyframes ex-ping-a{0%,100%{stroke:var(--ink)}25%,60%{stroke:var(--acc)}}
@keyframes ex-ping-b{0%,100%{stroke:var(--ink)}25%,60%{stroke:var(--acc)}}
.ex-top{fill:color-mix(in oklab,var(--acc),#fff 26%)}
.ex-left{fill:var(--acc)}
.ex-right{fill:color-mix(in oklab,var(--acc),#000 32%)}
.logo svg .ex-c{transform-origin:50% 100%}
.ex-in{animation:ex-drop 1s linear .65s backwards}
@keyframes ex-drop{0%{transform:translateY(-130px);opacity:0;animation-timing-function:cubic-bezier(.5,0,1,.6)}45%{transform:none;opacity:1;animation-timing-function:cubic-bezier(0,.4,.5,1)}65%{transform:translateY(-16px);animation-timing-function:cubic-bezier(.5,0,1,.6)}82%{transform:none;animation-timing-function:cubic-bezier(0,.4,.5,1)}90%{transform:translateY(-4px);animation-timing-function:cubic-bezier(.5,0,1,.6)}100%{transform:none}}
.ex-idle{animation:ex-glow 3.6s ease-in-out 2s infinite}
@keyframes ex-glow{0%,100%{opacity:1}50%{opacity:.9}}
.ex-h{transition:transform .45s cubic-bezier(.3,1.6,.5,1)}
.logo:hover .ex-h{transform:translateY(-12px)}
.ca .ex-c{animation:ex-hop-a 1s linear}
.cb .ex-c{animation:ex-hop-b 1s linear}
@keyframes ex-hop-a{0%{transform:translateY(0) scale(1,1);animation-timing-function:cubic-bezier(.2,.6,.35,1)}40%{transform:translateY(-70px) scale(1,1);animation-timing-function:cubic-bezier(.65,0,.8,.4)}72%{transform:translateY(0) scale(1.07,.9);animation-timing-function:ease-out}86%{transform:translateY(0) scale(.97,1.04)}100%{transform:translateY(0) scale(1,1)}}
@keyframes ex-hop-b{0%{transform:translateY(0) scale(1,1);animation-timing-function:cubic-bezier(.2,.6,.35,1)}40%{transform:translateY(-70px) scale(1,1);animation-timing-function:cubic-bezier(.65,0,.8,.4)}72%{transform:translateY(0) scale(1.07,.9);animation-timing-function:ease-out}86%{transform:translateY(0) scale(.97,1.04)}100%{transform:translateY(0) scale(1,1)}}
.ex-word{display:flex;font:800 clamp(30px,3.8vw,44px)/1 'Archivo',system-ui,sans-serif;font-stretch:125%;letter-spacing:-.01em;color:var(--ink)}
.ex-word .z{color:transparent;-webkit-text-stroke:1.5px var(--ink);transition:color .4s ease calc(var(--i)*.04s)}
.logo:hover .ex-word .z{color:var(--ink)}
.ex-word .ltr{animation:ex-letter .7s cubic-bezier(.2,.8,.2,1) calc(1.2s + var(--i)*.06s) backwards}
@keyframes ex-letter{from{opacity:0;transform:translateY(16px)}}
.ca .ex-word .ltr{animation:ex-wave-a .6s ease-out calc(.55s + var(--i)*.05s) backwards}
.cb .ex-word .ltr{animation:ex-wave-b .6s ease-out calc(.55s + var(--i)*.05s) backwards}
@keyframes ex-wave-a{0%,100%{transform:none}40%{transform:translateY(-8px)}}
@keyframes ex-wave-b{0%,100%{transform:none}40%{transform:translateY(-8px)}}

/* ---------- 04 On/Off ---------- */
.c-onoff .light{--bg:#F3EEE4;--ink:#131210;--acc:#5C7A00;--muted:#5E594F}
.c-onoff .dark{--bg:#131210;--ink:#F3EEE4;--acc:#C8F03C;--muted:#9A948A}
.oo-logo{width:100%;display:flex;justify-content:center}
.oo-svg{width:min(88%,440px);height:auto}
.oo-s{fill:none;stroke:var(--ink);stroke-width:11px;stroke-linecap:round;stroke-linejoin:round;stroke-dasharray:1 1.2;animation:oo-draw .7s cubic-bezier(.6,0,.3,1) calc(.15s + var(--i)*.1s) backwards;transition:stroke .35s ease}
@keyframes oo-draw{from{stroke-dashoffset:1.1}}
.logo:not(.ca):hover .oo-o1{stroke:var(--acc)}
.oo-disc{fill:var(--acc)}
.oo-one{fill:none;stroke:var(--bg);stroke-width:9px;stroke-linecap:round;stroke-linejoin:round}
/* Switching off: the 1 rides along to the first o while the letters of "one" drop away; switching back brings them in again */
.ca .oo-out{animation:oo-letters-off .45s cubic-bezier(.5,0,.75,0) calc(.12s + var(--k)*.08s) forwards}
.cb .oo-out{animation:oo-letters-on .55s cubic-bezier(.2,.8,.3,1) calc(.3s + var(--k)*.08s) backwards}
@keyframes oo-letters-off{to{opacity:0;transform:translateY(14px)}}
@keyframes oo-letters-on{from{opacity:0;transform:translateY(14px)}}
.oo-i{animation:oo-pop .6s cubic-bezier(.3,1.7,.5,1) 1.15s backwards}
@keyframes oo-pop{from{transform:scale(0)}}
.oo-idle{animation:oo-breathe 3s ease-in-out 2s infinite}
@keyframes oo-breathe{0%,100%{transform:none}50%{transform:scale(1.05)}}
.oo-h{transition:transform .45s cubic-bezier(.3,1.6,.5,1)}
.logo:hover .oo-h{transform:scale(1.1)}
.ca .oo-c{animation:oo-slide-a .7s cubic-bezier(.55,0,.25,1) forwards}
.cb .oo-c{animation:oo-slide-b .7s cubic-bezier(.55,0,.25,1) forwards}
@keyframes oo-slide-a{0%{transform:translateX(0) scale(1,1)}45%{transform:translateX(-44px) scale(1.3,.84)}100%{transform:translateX(-76px) scale(1,1)}}
@keyframes oo-slide-b{0%{transform:translateX(-76px) scale(1,1)}45%{transform:translateX(-32px) scale(1.3,.84)}100%{transform:translateX(0) scale(1,1)}}

@media (prefers-reduced-motion:reduce){
  html{scroll-behavior:auto}
  .logo,.logo *{animation-duration:1ms!important;animation-delay:0s!important;animation-iteration-count:1!important;transition-duration:1ms!important}
}
</style>
@endverbatim
</head>
<body>

<header class="top">
    <div class="wrap">
        <div class="brand">ZeroOne.com <small>Identity review · private preview</small></div>
        <nav class="nav" aria-label="Directions">
            @foreach ($concepts as $c)
                <a href="#{{ $c['id'] }}"><span>{{ $c['num'] }}</span>{{ $c['name'] }}</a>
            @endforeach
        </nav>
    </div>
</header>

<main>
    <section class="hero wrap">
        <p class="eyebrow">ZeroOne.com · Brand identity</p>
        <h1>Four directions for the ZeroOne identity.</h1>
        <p>Each direction is built on one idea — the moment a zero becomes a one. Each is shown as it would live on the site, animated, in light and dark mode, alongside its favicon, app icon, type pairing and colour palette.</p>
        <div class="how">
            <span><b>Hover</b> Point at a logo</span>
            <span><b>Click</b> Tap a logo</span>
            <span><b>Replay</b> Watch the intro again</span>
        </div>
    </section>

    @foreach ($concepts as $c)
        <section class="concept c-{{ $c['id'] }}" id="{{ $c['id'] }}" aria-labelledby="{{ $c['id'] }}-title">
            <div class="wrap">
                <div class="c-head">
                    <h2 id="{{ $c['id'] }}-title"><span>{{ $c['num'] }}</span>{{ $c['name'] }}</h2>
                    <p>{{ $c['idea'] }}</p>
                </div>

                <div class="stages">
                    @foreach (['light', 'dark'] as $m)
                        <div class="stage {{ $m }}">
                            <span class="mode">{{ ucfirst($m) }} mode</span>

                            @switch($c['id'])
                                @case('coin')
                                    <button type="button" class="logo cn-logo" aria-label="Flip the Coin logo, {{ $m }} mode">
                                        <span class="cn-scene">
                                            <span class="cn-shadow"></span>
                                            <span class="cn-3d cn-click" style="display: block"><span class="cn-3d cn-spin" style="display: block"><span class="cn-3d cn-hov" style="display: block"><span class="cn-3d cn-in" style="display: block"><span class="cn-3d cn-idle" style="display: block"><span class="cn-3d cn-coin" style="display: block">
                                                @foreach ([-4.5, -3, -1.5, 0, 1.5, 3, 4.5] as $z)
                                                    <span class="cn-edge" style="transform: translateZ({{ $z }}px)"></span>
                                                @endforeach
                                                @foreach (['front' => ['1', 'ONE · ZERO · ONE · ZERO · ONE · ZERO ·'], 'back' => ['0', 'ZERO · ONE · ZERO · ONE · ZERO · ONE ·']] as $side => [$num, $ring])
                                                    <span class="cn-face cn-{{ $side }}">
                                                        <svg viewBox="0 0 220 220" aria-hidden="true">
                                                            <circle class="cn-body" cx="110" cy="110" r="110"></circle>
                                                            <circle class="cn-mill" cx="110" cy="110" r="105"></circle>
                                                            <circle class="cn-rim" cx="110" cy="110" r="97"></circle>
                                                            <circle class="cn-rim" cx="110" cy="110" r="66"></circle>
                                                            <path id="cn-arc-{{ $side }}-{{ $m }}" d="M110 110 m-80 0 a80 80 0 1 1 160 0 a80 80 0 1 1 -160 0" fill="none"></path>
                                                            <text class="cn-txt"><textPath href="#cn-arc-{{ $side }}-{{ $m }}" textLength="496" lengthAdjust="spacing">{{ $ring }}</textPath></text>
                                                            <text class="cn-num" x="110" y="112" text-anchor="middle" dominant-baseline="central">{{ $num }}</text>
                                                        </svg>
                                                    </span>
                                                @endforeach
                                            </span></span></span></span></span></span>
                                        </span>
                                        <span class="cn-word">@foreach (str_split('ZeroOne') as $i => $l)<span class="ltr{{ $i > 3 ? ' it' : '' }}" style="--i: {{ $i }}">{{ $l }}</span>@endforeach</span>
                                    </button>
                                    @break

                                @case('segment')
                                    <button type="button" class="logo sg-logo" aria-label="Play the Segment logo animation, {{ $m }} mode">
                                        <svg class="sg-svg" width="260" height="196" viewBox="-26 -10 186 140" aria-hidden="true">
                                            <g class="sg-press">
                                                <g class="sg-ghosts">
                                                    @foreach (['skewX(-8)', 'translate(86 0) skewX(-8)'] as $tf)
                                                        <g class="sg-dig" transform="{{ $tf }}">
                                                            @foreach ($segAll as $p)<polygon class="sg-ghost" points="{{ $p }}"></polygon>@endforeach
                                                        </g>
                                                    @endforeach
                                                </g>
                                                <g class="sg-lit"><g class="sg-idle">
                                                    <g class="sg-dig" transform="skewX(-8)">
                                                        <g class="sg-L">
                                                            @foreach ([[0, $segA], [3, $segD], [4, $segE], [5, $segF]] as [$i, $p])<polygon class="sg-seg" style="--i: {{ $i }}" points="{{ $p }}"></polygon>@endforeach
                                                        </g>
                                                        <polygon class="sg-seg" style="--i: 1" points="{{ $segB }}"></polygon>
                                                        <polygon class="sg-seg" style="--i: 2" points="{{ $segC }}"></polygon>
                                                    </g>
                                                    <g class="sg-dig" transform="translate(86 0) skewX(-8)">
                                                        <polygon class="sg-seg" style="--i: 6" points="{{ $segB }}"></polygon>
                                                        <polygon class="sg-seg" style="--i: 7" points="{{ $segC }}"></polygon>
                                                        <g class="sg-R">
                                                            @foreach ([$segA, $segD, $segE, $segF] as $p)<polygon class="sg-seg-r" points="{{ $p }}"></polygon>@endforeach
                                                        </g>
                                                    </g>
                                                </g></g>
                                            </g>
                                        </svg>
                                        <span class="sg-word">@foreach (str_split('ZEROONE') as $i => $l)<span class="ltr" style="--i: {{ $i }}">{{ $l }}</span>@endforeach</span>
                                    </button>
                                    @break

                                @case('extrude')
                                    <button type="button" class="logo ex-logo" aria-label="Play the Extrude logo animation, {{ $m }} mode">
                                        <svg class="ex-svg" width="150" height="143" viewBox="12 32 162 154" aria-hidden="true">
                                            <g class="ex-wi">
                                                <path class="ex-wire" d="M70 44 L115.03 70 L70 96 L24.97 70 Z M24.97 70 V122 L70 148 V96"></path>
                                            </g>
                                            <g class="ex-c"><g class="ex-h"><g class="ex-in"><g class="ex-idle">
                                                <path class="ex-top" d="M115.03 70 L160.06 96 L115.03 122 L70 96 Z"></path>
                                                <path class="ex-left" d="M70 96 L115.03 122 L115.03 174 L70 148 Z"></path>
                                                <path class="ex-right" d="M115.03 122 L160.06 96 L160.06 148 L115.03 174 Z"></path>
                                            </g></g></g></g>
                                        </svg>
                                        <span class="ex-word">@foreach (str_split('ZEROONE') as $i => $l)<span class="ltr{{ $i < 4 ? ' z' : '' }}" style="--i: {{ $i }}">{{ $l }}</span>@endforeach</span>
                                    </button>
                                    @break

                                @case('onoff')
                                    <button type="button" class="logo oo-logo" aria-label="Play the On/Off logo animation, {{ $m }} mode">
                                        <svg class="oo-svg" width="440" height="84" viewBox="-16 50 522 100" aria-hidden="true">
                                            <path class="oo-s" style="--i: 0" pathLength="1" d="M0 70 H44 L0 130 H44"></path>
                                            <path class="oo-s" style="--i: 1" pathLength="1" d="M64 100 H124 A30 30 0 1 0 115.2 121.2"></path>
                                            <path class="oo-s" style="--i: 2" pathLength="1" d="M144 130 V70 M144 100 A30 30 0 0 1 174 70"></path>
                                            <path class="oo-s oo-o1" style="--i: 3" pathLength="1" d="M188 100 A30 30 0 1 1 248 100 A30 30 0 1 1 188 100"></path>
                                            <path class="oo-s oo-o2 oo-out" style="--i: 4; --k: 0" pathLength="1" d="M264 100 A30 30 0 1 1 324 100 A30 30 0 1 1 264 100"></path>
                                            <path class="oo-s oo-out" style="--i: 5; --k: 1" pathLength="1" d="M344 130 V70 M344 100 A30 30 0 0 1 404 100 V130"></path>
                                            <path class="oo-s oo-out" style="--i: 6; --k: 2" pathLength="1" d="M424 100 H484 A30 30 0 1 0 475.2 121.2"></path>
                                            <g class="oo-c"><g class="oo-h"><g class="oo-i"><g class="oo-idle">
                                                <circle class="oo-disc" cx="294" cy="100" r="35.5"></circle>
                                                <path class="oo-one" d="M284 88 L297 78 V122"></path>
                                            </g></g></g></g>
                                        </svg>
                                    </button>
                                    @break
                            @endswitch

                            <button type="button" class="replay">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 12a9 9 0 1 0 3-6.7"></path><path d="M3 4v5h5"></path></svg>
                                <span>Replay intro</span>
                            </button>
                        </div>
                    @endforeach
                </div>

                <div class="details">
                    <div class="card">
                        <h3>Favicon</h3>
                        <div class="tabbar light">
                            <div class="tab"><span class="fav" style="{{ $vars($c['icons']['light']) }}">{!! $mark[$c['id']]($c['id'].'-tl') !!}</span><span class="t">ZeroOne.com</span><span class="x" aria-hidden="true">×</span></div>
                        </div>
                        <div class="tabbar dark">
                            <div class="tab"><span class="fav" style="{{ $vars($c['icons']['dark']) }}">{!! $mark[$c['id']]($c['id'].'-td') !!}</span><span class="t">ZeroOne.com</span><span class="x" aria-hidden="true">×</span></div>
                        </div>
                        <div class="sizes">
                            @foreach (['light', 'dark'] as $m)
                                <div class="grp {{ $m }}" style="{{ $vars($c['icons'][$m]) }}">
                                    @foreach ([16, 32, 48] as $s)
                                        <div class="sz"><span style="width: {{ $s }}px; height: {{ $s }}px; display: block">{!! $mark[$c['id']]($c['id'].'-s'.$m.$s) !!}</span>{{ $s }}px</div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="card">
                        <h3>App icon</h3>
                        <div class="apps">
                            @foreach (['light' => 'Light', 'dark' => 'Dark', 'brand' => 'Brand'] as $k => $label)
                                <div class="app-item">
                                    <div class="app" style="{{ $vars($c['icons'][$k]) }}">{!! $mark[$c['id']]($c['id'].'-a'.$k) !!}</div>
                                    {{ $label }}
                                </div>
                            @endforeach
                        </div>
                        <div class="apps-row" aria-label="Smaller sizes">
                            @foreach (['light', 'dark', 'brand'] as $k)
                                <div class="app sm" style="{{ $vars($c['icons'][$k]) }}">{!! $mark[$c['id']]($c['id'].'-m'.$k) !!}</div>
                            @endforeach
                        </div>
                    </div>

                    <div class="card">
                        <h3>Typography</h3>
                        <div class="fonts">
                            @foreach ($c['fonts'] as $f)
                                <div class="font">
                                    <span class="aa" style="font-family: {{ $f['css'] }}; font-weight: {{ $f['weight'] }}; letter-spacing: {{ $f['tracking'] }}; font-stretch: {{ $f['stretch'] ?? '100%' }}" aria-hidden="true">Aa</span>
                                    <span class="role">{{ $f['role'] }}</span>
                                    <span class="fam">{{ $f['family'] }}</span>
                                    <span class="use">{{ $f['use'] }}</span>
                                </div>
                            @endforeach
                            <div class="sample">
                                <p class="h" style="font-family: {{ $c['fonts'][0]['css'] }}; font-weight: {{ $c['fonts'][0]['weight'] }}; letter-spacing: {{ $c['fonts'][0]['tracking'] }}; font-stretch: {{ $c['fonts'][0]['stretch'] ?? '100%' }}">This is an elite-level .com domain.</p>
                                <p class="b" style="font-family: {{ $c['fonts'][1]['css'] }}">ZeroOne.com is owned by Coherence.com and may be in development.</p>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <h3>Colour palette</h3>
                        <div class="swatches">
                            @foreach ($c['palette'] as [$name, $hex, $role, $on])
                                <div class="sw" style="background: {{ $hex }}; color: {{ $on }}">
                                    <b>{{ $name }}</b>
                                    <div><span>{{ $hex }}</span><span>{{ $role }}</span></div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endforeach

    <section class="closing">
        <div class="wrap">
            <h2>Choosing a direction</h2>
            <p>Let us know the number of the direction you prefer. Elements can be combined — one direction’s mark with another’s motion, type or colour — before the identity is finalised.</p>
        </div>
    </section>
</main>

<footer class="foot">
    <div class="wrap">
        <span>Private preview for ZeroOne.com — please don’t share this link. ©{{ date('Y') }} Booth.com Ltd. All Rights Reserved.</span>
        <div class="credits">
            <a class="credit coh" href="https://coherence.com" target="_blank" rel="noopener" title="Coherence — ethical, human-centred AI across sound, education and consciousness">
                <span>Part of</span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="3.00 3.00 289.08 58.00" role="img" aria-label="Coherence">
  <title>Coherence</title>
  <defs>
    <clipPath id="coherence-mark-clip">
      <rect x="3" y="3" width="58" height="58" rx="15"/>
    </clipPath>
  </defs>
  <g id="mark">
    <rect x="3.5" y="3.5" width="57" height="57" rx="14.5" fill="none" stroke="#00BDF1" stroke-opacity="0.65" stroke-width="2.5"/>
    <g clip-path="url(#coherence-mark-clip)">
      <path d="M-48 19 q8 -12 16 0 q8 12 16 0 q8 -12 16 0 q8 12 16 0 q8 -12 16 0 q8 12 16 0 q8 -12 16 0 q8 12 16 0" fill="none" stroke="currentColor" stroke-opacity="0.85" stroke-width="2.4" stroke-linecap="round"/>
      <path d="M-48 32 q8 -12 16 0 q8 12 16 0 q8 -12 16 0 q8 12 16 0 q8 -12 16 0 q8 12 16 0 q8 -12 16 0 q8 12 16 0" fill="none" stroke="#00BDF1" stroke-opacity="1" stroke-width="2.4" stroke-linecap="round"/>
      <path d="M-48 45 q8 -12 16 0 q8 12 16 0 q8 -12 16 0 q8 12 16 0 q8 -12 16 0 q8 12 16 0 q8 -12 16 0 q8 12 16 0" fill="none" stroke="currentColor" stroke-opacity="0.85" stroke-width="2.4" stroke-linecap="round"/>
    </g>
  </g>
  <g id="wordmark" fill="currentColor">
    <path d="M88.12800000000001 46.86682352941176Q84.00752941176471 46.86682352941176 81.07764705882353 45.42776470588235Q78.14776470588235 43.98870588235294 76.30494117647059 41.65929411764706Q74.46211764705883 39.329882352941176 73.5924705882353 36.607058823529414Q72.72282352941177 33.884235294117644 72.72282352941177 31.33741176470588V30.426352941176468Q72.72282352941177 27.631058823529408 73.61317647058824 24.887529411764703Q74.50352941176472 22.143999999999995 76.35670588235294 19.90776470588235Q78.20988235294118 17.671529411764702 81.088 16.325647058823527Q83.96611764705882 14.97976470588235 87.90023529411765 14.97976470588235Q92.0 14.97976470588235 95.05411764705883 16.460235294117645Q98.10823529411766 17.940705882352937 99.93035294117648 20.60141176470588Q101.7524705882353 23.26211764705882 102.1044705882353 26.823529411764703H96.18258823529412Q95.87200000000001 24.752941176470586 94.73317647058825 23.334588235294113Q93.59435294117648 21.916235294117644 91.84470588235294 21.181176470588234Q90.09505882352941 20.44611764705882 87.90023529411765 20.44611764705882Q85.664 20.44611764705882 83.93505882352942 21.222588235294115Q82.20611764705883 21.99905882352941 81.04658823529412 23.40705882352941Q79.88705882352942 24.81505882352941 79.28658823529412 26.72Q78.68611764705882 28.624941176470585 78.68611764705882 30.923294117647053Q78.68611764705882 33.1595294117647 79.28658823529412 35.064470588235295Q79.88705882352942 36.96941176470588 81.088 38.398117647058825Q82.28894117647059 39.82682352941176 84.04894117647059 40.61364705882353Q85.8089411764706 41.400470588235294 88.12800000000001 41.400470588235294Q91.52376470588236 41.400470588235294 93.85317647058824 39.72329411764706Q96.18258823529412 38.04611764705882 96.67952941176472 35.02305882352941H102.60141176470589Q102.208 38.27388235294117 100.41694117647059 40.96564705882353Q98.62588235294118 43.657411764705884 95.53035294117647 45.26211764705882Q92.43482352941177 46.86682352941176 88.12800000000001 46.86682352941176Z"/>
    <path d="M116.47435294117648 46.86682352941176Q113.51341176470589 46.86682352941176 111.23576470588236 45.91435294117647Q108.95811764705883 44.961882352941174 107.3844705882353 43.336470588235294Q105.81082352941178 41.71105882352941 105.00329411764707 39.640470588235296Q104.19576470588237 37.56988235294118 104.19576470588237 35.31294117647059V34.443294117647056Q104.19576470588237 32.14494117647058 105.03435294117648 30.043294117647054Q105.8729411764706 27.941647058823527 107.46729411764707 26.316235294117647Q109.06164705882354 24.690823529411762 111.33929411764707 23.748705882352937Q113.6169411764706 22.806588235294114 116.47435294117648 22.806588235294114Q119.3524705882353 22.806588235294114 121.61976470588237 23.748705882352937Q123.88705882352943 24.690823529411762 125.4814117647059 26.316235294117647Q127.07576470588236 27.941647058823527 127.91435294117647 30.043294117647054Q128.75294117647059 32.14494117647058 128.75294117647059 34.443294117647056V35.31294117647059Q128.75294117647059 37.56988235294118 127.94541176470588 39.640470588235296Q127.13788235294119 41.71105882352941 125.56423529411765 43.336470588235294Q123.99058823529413 44.961882352941174 121.7129411764706 45.91435294117647Q119.43529411764706 46.86682352941176 116.47435294117648 46.86682352941176ZM116.47435294117648 41.93882352941176Q118.58635294117649 41.93882352941176 120.03576470588237 41.017411764705884Q121.48517647058824 40.096 122.2409411764706 38.49129411764706Q122.99670588235296 36.88658823529411 122.99670588235296 34.87811764705882Q122.99670588235296 32.807529411764705 122.22023529411766 31.202823529411763Q121.44376470588236 29.59811764705882 119.98400000000001 28.66635294117647Q118.52423529411766 27.734588235294115 116.47435294117648 27.734588235294115Q114.44517647058825 27.734588235294115 112.97505882352942 28.66635294117647Q111.5049411764706 29.59811764705882 110.7284705882353 31.202823529411763Q109.95200000000001 32.807529411764705 109.95200000000001 34.87811764705882Q109.95200000000001 36.88658823529411 110.70776470588237 38.49129411764706Q111.46352941176471 40.096 112.92329411764706 41.017411764705884Q114.38305882352942 41.93882352941176 116.47435294117648 41.93882352941176Z"/>
    <path d="M132.35576470588236 46.08V15.849411764705877H138.11200000000002V33.49082352941176H137.11811764705885Q137.11811764705885 30.11576470588235 137.9774117647059 27.744941176470583Q138.83670588235296 25.37411764705882 140.56564705882354 24.13176470588235Q142.29458823529413 22.88941176470588 144.92423529411766 22.88941176470588H145.17270588235294Q149.024 22.88941176470588 151.02211764705885 25.55011764705882Q153.02023529411767 28.210823529411762 153.02023529411767 33.263058823529406V46.08H147.264V32.70399999999999Q147.264 30.571294117647057 146.032 29.318588235294115Q144.8 28.065882352941173 142.81223529411767 28.065882352941173Q140.70023529411768 28.065882352941173 139.40611764705886 29.453176470588232Q138.11200000000002 30.84047058823529 138.11200000000002 33.09741176470588V46.08Z"/>
    <path d="M167.80423529411766 46.86682352941176Q164.9054117647059 46.86682352941176 162.73129411764705 45.87294117647059Q160.55717647058825 44.87905882352941 159.1284705882353 43.21223529411765Q157.69976470588236 41.54541176470588 156.97505882352942 39.474823529411765Q156.2503529411765 37.40423529411764 156.2503529411765 35.23011764705882V34.443294117647056Q156.2503529411765 32.20705882352941 156.97505882352942 30.12611764705882Q157.69976470588236 28.04517647058823 159.11811764705885 26.39905882352941Q160.53647058823532 24.752941176470586 162.6588235294118 23.77976470588235Q164.78117647058824 22.806588235294114 167.55576470588235 22.806588235294114Q171.20000000000002 22.806588235294114 173.65364705882354 24.411294117647056Q176.1072941176471 26.016 177.36 28.593882352941172Q178.61270588235294 31.17176470588235 178.61270588235294 34.15341176470588V36.24470588235294H158.69364705882353V32.724705882352936H174.98917647058823L173.22917647058824 34.443294117647056Q173.22917647058824 32.28988235294118 172.59764705882355 30.75764705882353Q171.96611764705884 29.22541176470588 170.71341176470588 28.39717647058823Q169.46070588235295 27.568941176470585 167.55576470588235 27.568941176470585Q165.63011764705882 27.568941176470585 164.3049411764706 28.448941176470584Q162.97976470588236 29.328941176470586 162.30682352941176 30.95435294117647Q161.63388235294119 32.579764705882354 161.63388235294119 34.85741176470588Q161.63388235294119 36.990117647058824 162.28611764705883 38.625882352941176Q162.93835294117648 40.26164705882353 164.3049411764706 41.18305882352941Q165.6715294117647 42.104470588235294 167.80423529411766 42.104470588235294Q169.89552941176473 42.104470588235294 171.22070588235295 41.255529411764705Q172.5458823529412 40.406588235294116 172.91858823529412 39.18494117647059H178.21929411764708Q177.74305882352942 41.483294117647056 176.32470588235296 43.22258823529411Q174.9063529411765 44.961882352941174 172.74258823529414 45.91435294117647Q170.57882352941178 46.86682352941176 167.80423529411766 46.86682352941176Z"/>
    <path d="M181.9670588235294 46.08V23.59341176470588H186.52235294117648V33.118117647058824H186.39811764705883Q186.39811764705883 28.293647058823527 188.46870588235294 25.798588235294115Q190.53929411764707 23.303529411764703 194.55623529411764 23.303529411764703H195.3844705882353V28.314352941176466H193.81082352941178Q190.89129411764708 28.314352941176466 189.30729411764707 29.877647058823527Q187.72329411764707 31.440941176470588 187.72329411764707 34.38117647058823V46.08Z"/>
    <path d="M207.8494117647059 46.86682352941176Q204.95058823529413 46.86682352941176 202.77647058823533 45.87294117647059Q200.6023529411765 44.87905882352941 199.17364705882355 43.21223529411765Q197.7449411764706 41.54541176470588 197.02023529411767 39.474823529411765Q196.29552941176473 37.40423529411764 196.29552941176473 35.23011764705882V34.443294117647056Q196.29552941176473 32.20705882352941 197.02023529411767 30.12611764705882Q197.7449411764706 28.04517647058823 199.16329411764707 26.39905882352941Q200.58164705882356 24.752941176470586 202.704 23.77976470588235Q204.82635294117648 22.806588235294114 207.6009411764706 22.806588235294114Q211.24517647058826 22.806588235294114 213.69882352941178 24.411294117647056Q216.1524705882353 26.016 217.40517647058826 28.593882352941172Q218.65788235294121 31.17176470588235 218.65788235294121 34.15341176470588V36.24470588235294H198.73882352941177V32.724705882352936H215.0343529411765L213.2743529411765 34.443294117647056Q213.2743529411765 32.28988235294118 212.64282352941177 30.75764705882353Q212.01129411764708 29.22541176470588 210.75858823529416 28.39717647058823Q209.5058823529412 27.568941176470585 207.6009411764706 27.568941176470585Q205.67529411764707 27.568941176470585 204.35011764705882 28.448941176470584Q203.0249411764706 29.328941176470586 202.35200000000003 30.95435294117647Q201.67905882352943 32.579764705882354 201.67905882352943 34.85741176470588Q201.67905882352943 36.990117647058824 202.33129411764708 38.625882352941176Q202.98352941176472 40.26164705882353 204.35011764705882 41.18305882352941Q205.71670588235295 42.104470588235294 207.8494117647059 42.104470588235294Q209.94070588235297 42.104470588235294 211.26588235294122 41.255529411764705Q212.59105882352944 40.406588235294116 212.96376470588237 39.18494117647059H218.26447058823533Q217.78823529411767 41.483294117647056 216.3698823529412 43.22258823529411Q214.95152941176474 44.961882352941174 212.78776470588238 45.91435294117647Q210.62400000000002 46.86682352941176 207.8494117647059 46.86682352941176Z"/>
    <path d="M222.01223529411766 46.08V23.59341176470588H226.56752941176472V33.24235294117647H226.1534117647059Q226.1534117647059 29.825882352941175 227.05411764705883 27.527529411764704Q227.95482352941178 25.229176470588232 229.76658823529414 24.059294117647056Q231.5783529411765 22.88941176470588 234.24941176470588 22.88941176470588H234.4978823529412Q238.5355294117647 22.88941176470588 240.60611764705885 25.488Q242.67670588235296 28.086588235294116 242.67670588235296 33.22164705882353V46.08H236.9204705882353V32.70399999999999Q236.9204705882353 30.63341176470588 235.7298823529412 29.34964705882353Q234.53929411764707 28.065882352941173 232.46870588235296 28.065882352941173Q230.35670588235297 28.065882352941173 229.06258823529413 29.380705882352938Q227.76847058823532 30.695529411764703 227.76847058823532 32.869647058823524V46.08Z"/>
    <path d="M257.35717647058823 46.86682352941176Q254.43764705882353 46.86682352941176 252.29458823529413 45.883294117647054Q250.15152941176473 44.899764705882355 248.73317647058826 43.23294117647059Q247.31482352941177 41.566117647058825 246.6108235294118 39.49552941176471Q245.90682352941178 37.42494117647058 245.90682352941178 35.2715294117647V34.48470588235294Q245.90682352941178 32.22776470588235 246.63152941176472 30.13647058823529Q247.35623529411765 28.04517647058823 248.79529411764707 26.39905882352941Q250.23435294117647 24.752941176470586 252.36705882352942 23.77976470588235Q254.49976470588237 22.806588235294114 257.3157647058824 22.806588235294114Q260.2767058823529 22.806588235294114 262.5854117647059 23.94541176470588Q264.8941176470588 25.084235294117644 266.28141176470587 27.11341176470588Q267.6687058823529 29.142588235294113 267.83435294117646 31.83435294117647H262.24376470588237Q262.036705882353 30.11576470588235 260.784 28.945882352941172Q259.53129411764706 27.775999999999996 257.3157647058824 27.775999999999996Q255.41082352941177 27.775999999999996 254.15811764705882 28.68705882352941Q252.9054117647059 29.59811764705882 252.28423529411765 31.19247058823529Q251.6630588235294 32.78682352941176 251.6630588235294 34.87811764705882Q251.6630588235294 36.86588235294117 252.25317647058824 38.470588235294116Q252.84329411764708 40.075294117647054 254.10635294117648 40.98635294117646Q255.3694117647059 41.89741176470588 257.35717647058823 41.89741176470588Q258.86870588235297 41.89741176470588 259.9454117647059 41.35905882352941Q261.02211764705885 40.82070588235294 261.664 39.87858823529412Q262.3058823529412 38.936470588235295 262.45082352941176 37.71482352941176H268.0414117647059Q267.89647058823533 40.468705882352936 266.46776470588236 42.51858823529412Q265.03905882352944 44.56847058823529 262.6889411764706 45.71764705882353Q260.3388235294118 46.86682352941176 257.35717647058823 46.86682352941176Z"/>
    <path d="M281.2724705882353 46.86682352941176Q278.37364705882356 46.86682352941176 276.19952941176473 45.87294117647059Q274.0254117647059 44.87905882352941 272.5967058823529 43.21223529411765Q271.168 41.54541176470588 270.44329411764704 39.474823529411765Q269.71858823529413 37.40423529411764 269.71858823529413 35.23011764705882V34.443294117647056Q269.71858823529413 32.20705882352941 270.44329411764704 30.12611764705882Q271.168 28.04517647058823 272.5863529411765 26.39905882352941Q274.00470588235294 24.752941176470586 276.1270588235294 23.77976470588235Q278.2494117647059 22.806588235294114 281.024 22.806588235294114Q284.66823529411766 22.806588235294114 287.12188235294116 24.411294117647056Q289.5755294117647 26.016 290.8282352941177 28.593882352941172Q292.0809411764706 31.17176470588235 292.0809411764706 34.15341176470588V36.24470588235294H272.1618823529412V32.724705882352936H288.4574117647059L286.6974117647059 34.443294117647056Q286.6974117647059 32.28988235294118 286.06588235294123 30.75764705882353Q285.4343529411765 29.22541176470588 284.1816470588235 28.39717647058823Q282.9289411764706 27.568941176470585 281.024 27.568941176470585Q279.0983529411765 27.568941176470585 277.7731764705883 28.448941176470584Q276.44800000000004 29.328941176470586 275.77505882352943 30.95435294117647Q275.10211764705883 32.579764705882354 275.10211764705883 34.85741176470588Q275.10211764705883 36.990117647058824 275.7543529411765 38.625882352941176Q276.4065882352941 40.26164705882353 277.7731764705883 41.18305882352941Q279.1397647058824 42.104470588235294 281.2724705882353 42.104470588235294Q283.3637647058824 42.104470588235294 284.6889411764706 41.255529411764705Q286.0141176470588 40.406588235294116 286.3868235294118 39.18494117647059H291.68752941176473Q291.21129411764707 41.483294117647056 289.7929411764706 43.22258823529411Q288.37458823529414 44.961882352941174 286.21082352941175 45.91435294117647Q284.0470588235294 46.86682352941176 281.2724705882353 46.86682352941176Z"/>
  </g>
</svg>
            </a>
            <a class="credit" href="https://qquantum.ai/creative-design/brand-identity-logos" target="_blank" rel="noopener" title="Brand identity and logo design by QQuantum.ai">
                <span>Brand identity by</span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="-40 -780 5620 1010" role="img" aria-label="QQuantum.ai" fill="none"><title>QQuantum.ai</title><g><path transform="translate(301 0)" d="M338 14Q206 14 128 -58Q50 -131 50 -266V-434Q50 -569 128 -642Q206 -714 338 -714Q470 -714 548 -642Q626 -569 626 -434V-266Q626 -131 548 -58Q470 14 338 14ZM338 -104Q412 -104 453 -147Q494 -190 494 -262V-438Q494 -510 453 -553Q412 -596 338 -596Q265 -596 224 -553Q182 -510 182 -438V-262Q182 -190 224 -147Q265 -104 338 -104ZM384 180Q335 180 304 150Q274 119 274 68V0H402V48Q402 78 430 78H489V180Z" fill="currentColor"/></g><g><path transform="translate(942 0)" d="M259 8Q201 8 158 -18Q114 -45 90 -92Q66 -139 66 -200V-496H192V-210Q192 -154 220 -126Q247 -98 298 -98Q356 -98 388 -136Q420 -175 420 -244V-496H546V0H422V-65H404Q392 -40 359 -16Q326 8 259 8Z" fill="currentColor"/></g><g><path transform="translate(1523 0)" d="M224 14Q171 14 129 -4Q87 -23 62 -58Q38 -94 38 -145Q38 -196 62 -230Q87 -265 130 -282Q174 -300 230 -300H366V-328Q366 -363 344 -386Q322 -408 274 -408Q227 -408 204 -386Q181 -365 174 -331L58 -370Q70 -408 96 -440Q123 -471 168 -490Q212 -510 276 -510Q374 -510 431 -461Q488 -412 488 -319V-134Q488 -104 516 -104H556V0H472Q435 0 411 -18Q387 -36 387 -66V-67H368Q364 -55 350 -36Q336 -16 306 -1Q276 14 224 14ZM246 -88Q299 -88 332 -118Q366 -147 366 -196V-206H239Q204 -206 184 -191Q164 -176 164 -149Q164 -122 185 -105Q206 -88 246 -88Z" fill="currentColor"/></g><g><path transform="translate(2066 0)" d="M70 0V-496H194V-431H212Q224 -457 257 -480Q290 -504 357 -504Q415 -504 458 -478Q502 -451 526 -404Q550 -358 550 -296V0H424V-286Q424 -342 396 -370Q369 -398 318 -398Q260 -398 228 -360Q196 -321 196 -252V0Z" fill="currentColor"/></g><g><path transform="translate(2647 0)" d="M260 0Q211 0 180 -30Q150 -61 150 -112V-392H26V-496H150V-650H276V-496H412V-392H276V-134Q276 -104 304 -104H400V0Z" fill="currentColor"/></g><g><path transform="translate(3068 0)" d="M259 8Q201 8 158 -18Q114 -45 90 -92Q66 -139 66 -200V-496H192V-210Q192 -154 220 -126Q247 -98 298 -98Q356 -98 388 -136Q420 -175 420 -244V-496H546V0H422V-65H404Q392 -40 359 -16Q326 8 259 8Z" fill="currentColor"/></g><g><path transform="translate(3649 0)" d="M70 0V-496H194V-442H212Q225 -467 255 -486Q285 -504 334 -504Q387 -504 419 -484Q451 -463 468 -430H486Q503 -462 534 -483Q565 -504 622 -504Q668 -504 706 -484Q743 -465 766 -426Q788 -386 788 -326V0H662V-317Q662 -358 641 -378Q620 -399 582 -399Q539 -399 516 -372Q492 -344 492 -293V0H366V-317Q366 -358 345 -378Q324 -399 286 -399Q243 -399 220 -372Q196 -344 196 -293V0Z" fill="currentColor"/></g><g><path transform="translate(4468 0)" d="M150 14Q109 14 82 -13Q54 -39 54 -81Q54 -123 82 -150Q109 -176 150 -176Q190 -176 217 -149Q244 -123 244 -81Q244 -39 217 -12Q190 14 150 14Z" fill="#5eb3d6"/></g><g><path transform="translate(4731 0)" d="M224 14Q171 14 129 -4Q87 -23 62 -58Q38 -94 38 -145Q38 -196 62 -230Q87 -265 130 -282Q174 -300 230 -300H366V-328Q366 -363 344 -386Q322 -408 274 -408Q227 -408 204 -386Q181 -365 174 -331L58 -370Q70 -408 96 -440Q123 -471 168 -490Q212 -510 276 -510Q374 -510 431 -461Q488 -412 488 -319V-134Q488 -104 516 -104H556V0H472Q435 0 411 -18Q387 -36 387 -66V-67H368Q364 -55 350 -36Q336 -16 306 -1Q276 14 224 14ZM246 -88Q299 -88 332 -118Q366 -147 366 -196V-206H239Q204 -206 184 -191Q164 -176 164 -149Q164 -122 185 -105Q206 -88 246 -88Z" fill="#5eb3d6"/></g><g><path transform="translate(5274 0)" d="M70 0V-496H196V0ZM133 -554Q99 -554 76 -576Q52 -598 52 -634Q52 -670 76 -692Q99 -714 133 -714Q168 -714 191 -692Q214 -670 214 -634Q214 -598 191 -576Q168 -554 133 -554Z" fill="#5eb3d6"/></g><g><path transform="translate(0 0)" d="M338 14Q206 14 128 -58Q50 -131 50 -266V-434Q50 -569 128 -642Q206 -714 338 -714Q470 -714 548 -642Q626 -569 626 -434V-266Q626 -131 548 -58Q470 14 338 14ZM338 -104Q412 -104 453 -147Q494 -190 494 -262V-438Q494 -510 453 -553Q412 -596 338 -596Q265 -596 224 -553Q182 -510 182 -438V-262Q182 -190 224 -147Q265 -104 338 -104ZM384 180Q335 180 304 150Q274 119 274 68V0H402V48Q402 78 430 78H489V180Z" fill="none" stroke="#c9a75c" stroke-width="55" stroke-linejoin="round"/></g></svg>
            </a>
        </div>
    </div>
</footer>

@verbatim
<script>
(function () {
  function bindLogo(logo) {
    var n = 0;
    logo.addEventListener('click', function () {
      n++;
      logo.classList.remove('ca', 'cb');
      logo.classList.add(n % 2 ? 'ca' : 'cb');
    });
  }

  // Intros wait until the logo is on screen, so lower sections aren't finished before they're seen.
  var io = 'IntersectionObserver' in window ? new IntersectionObserver(function (entries) {
    entries.forEach(function (e) {
      if (e.isIntersecting) { e.target.classList.add('play'); io.unobserve(e.target); }
    });
  }, { threshold: 0.35 }) : null;

  function watch(logo) { io ? io.observe(logo) : logo.classList.add('play'); }

  document.querySelectorAll('.logo').forEach(function (logo) { bindLogo(logo); watch(logo); });

  // Replay: swapping in a fresh clone restarts every CSS animation from zero.
  document.querySelectorAll('.replay').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var old = btn.closest('.stage').querySelector('.logo');
      var fresh = old.cloneNode(true);
      fresh.classList.remove('ca', 'cb');
      fresh.classList.add('play');
      old.replaceWith(fresh);
      bindLogo(fresh);
    });
  });
})();
</script>
@endverbatim
</body>
</html>
