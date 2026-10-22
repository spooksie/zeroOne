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
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="3.00 3.00 275.00 58.00" role="img" aria-label="Coherence">
  <title>Coherence</title>
  <g id="mark">
    <g fill="none" stroke-width="2.8" stroke-linejoin="round">
        <path d="M52.56 49.26L52.07 50.39L51.35 51.35L50.39 52.07L49.26 52.56L48.01 52.86L46.72 53.03L45.48 53.16L44.34 53.37L43.31 53.72L42.38 54.27L41.53 55.01L40.7 55.89L39.83 56.84L38.89 57.73L37.87 58.46L36.75 58.92L35.56 59.08L34.36 58.92L33.16 58.5L32 57.92L30.9 57.29L29.84 56.72L28.8 56.32L27.75 56.13L26.65 56.15L25.48 56.34L24.24 56.6L22.97 56.82L21.69 56.89L20.47 56.72L19.37 56.26L18.42 55.53L17.63 54.56L16.99 53.44L16.45 52.27L15.93 51.15L15.37 50.15L14.69 49.31L13.85 48.63L12.85 48.07L11.73 47.55L10.56 47.01L9.44 46.37L8.47 45.58L7.74 44.63L7.28 43.53L7.11 42.31L7.18 41.03L7.4 39.76L7.66 38.52L7.85 37.35L7.87 36.25L7.68 35.2L7.28 34.16L6.71 33.1L6.08 32L5.5 30.84L5.08 29.64L4.92 28.44L5.08 27.25L5.54 26.13L6.27 25.11L7.16 24.17L8.11 23.3L8.99 22.47L9.73 21.62L10.28 20.69L10.63 19.66L10.84 18.52L10.97 17.28L11.14 15.99L11.44 14.74L11.93 13.61L12.65 12.65L13.61 11.93L14.74 11.44L15.99 11.14L17.28 10.97L18.52 10.84L19.66 10.63L20.69 10.28L21.62 9.73L22.47 8.99L23.3 8.11L24.17 7.16L25.11 6.27L26.13 5.54L27.25 5.08L28.44 4.92L29.64 5.08L30.84 5.5L32 6.08L33.1 6.71L34.16 7.28L35.2 7.68L36.25 7.87L37.35 7.85L38.52 7.66L39.76 7.4L41.03 7.18L42.31 7.11L43.53 7.28L44.63 7.74L45.58 8.47L46.37 9.44L47.01 10.56L47.55 11.73L48.07 12.85L48.63 13.85L49.31 14.69L50.15 15.37L51.15 15.93" stroke="currentColor" stroke-opacity="1"/>
        <path d="M46.57 44.22L46.22 45.03L45.7 45.7L45.03 46.22L44.22 46.57L43.34 46.78L42.43 46.89L41.55 46.99L40.74 47.14L40.01 47.38L39.35 47.77L38.75 48.3L38.16 48.92L37.55 49.6L36.88 50.23L36.15 50.74L35.36 51.07L34.53 51.18L33.67 51.07L32.82 50.77L32 50.36L31.22 49.91L30.47 49.51L29.73 49.23L28.99 49.09L28.21 49.11L27.38 49.24L26.51 49.43L25.6 49.58L24.7 49.63L23.84 49.51L23.05 49.19L22.38 48.67L21.82 47.98L21.37 47.18L20.98 46.36L20.62 45.56L20.22 44.85L19.74 44.26L19.15 43.78L18.44 43.38L17.64 43.02L16.82 42.63L16.02 42.18L15.33 41.62L14.81 40.95L14.49 40.16L14.37 39.3L14.42 38.4L14.57 37.49L14.76 36.62L14.89 35.79L14.91 35.01L14.77 34.27L14.49 33.53L14.09 32.78L13.64 32L13.23 31.18L12.93 30.33L12.82 29.47L12.93 28.64L13.26 27.85L13.77 27.12L14.4 26.45L15.08 25.84L15.7 25.25L16.23 24.65L16.62 23.99L16.86 23.26L17.01 22.45L17.11 21.57L17.22 20.66L17.43 19.78L17.78 18.97L18.3 18.3L18.97 17.78L19.78 17.43L20.66 17.22L21.57 17.11L22.45 17.01L23.26 16.86L23.99 16.62L24.65 16.23L25.25 15.7L25.84 15.08L26.45 14.4L27.12 13.77L27.85 13.26L28.64 12.93L29.47 12.82L30.33 12.93L31.18 13.23L32 13.64L32.78 14.09L33.53 14.49L34.27 14.77L35.01 14.91L35.79 14.89L36.62 14.76L37.49 14.57L38.4 14.42L39.3 14.37L40.16 14.49L40.95 14.81L41.62 15.33L42.18 16.02L42.63 16.82L43.02 17.64L43.38 18.44L43.78 19.15L44.26 19.74L44.85 20.22L45.56 20.62" stroke="#00BDF1"/>
        <path d="M40.57 39.19L40.36 39.66L40.06 40.06L39.66 40.36L39.19 40.57L38.67 40.69L38.13 40.76L37.62 40.82L37.14 40.9L36.71 41.05L36.33 41.28L35.97 41.59L35.62 41.96L35.26 42.35L34.87 42.72L34.44 43.02L33.98 43.22L33.49 43.28L32.98 43.22L32.48 43.04L32 42.8L31.54 42.54L31.1 42.3L30.67 42.13L30.23 42.05L29.77 42.06L29.28 42.14L28.77 42.25L28.24 42.34L27.7 42.37L27.2 42.3L26.74 42.11L26.34 41.8L26.01 41.4L25.75 40.93L25.52 40.45L25.31 39.98L25.07 39.56L24.79 39.21L24.44 38.93L24.02 38.69L23.55 38.48L23.07 38.25L22.6 37.99L22.2 37.66L21.89 37.26L21.7 36.8L21.63 36.3L21.66 35.76L21.75 35.23L21.86 34.72L21.94 34.23L21.95 33.77L21.87 33.33L21.7 32.9L21.46 32.46L21.2 32L20.96 31.52L20.78 31.02L20.72 30.51L20.78 30.02L20.98 29.56L21.28 29.13L21.65 28.74L22.04 28.38L22.41 28.03L22.72 27.67L22.95 27.29L23.1 26.86L23.18 26.38L23.24 25.87L23.31 25.33L23.43 24.81L23.64 24.34L23.94 23.94L24.34 23.64L24.81 23.43L25.33 23.31L25.87 23.24L26.38 23.18L26.86 23.1L27.29 22.95L27.67 22.72L28.03 22.41L28.38 22.04L28.74 21.65L29.13 21.28L29.56 20.98L30.02 20.78L30.51 20.72L31.02 20.78L31.52 20.96L32 21.2L32.46 21.46L32.9 21.7L33.33 21.87L33.77 21.95L34.23 21.94L34.72 21.86L35.23 21.75L35.76 21.66L36.3 21.63L36.8 21.7L37.26 21.89L37.66 22.2L37.99 22.6L38.25 23.07L38.48 23.55L38.69 24.02L38.93 24.44L39.21 24.79L39.56 25.07L39.98 25.31" stroke="currentColor" stroke-opacity="1"/>
    </g>
    <circle cx="32" cy="32" r="3.4" fill="#00BDF1"/>
  </g>
  <g id="wordmark" fill="currentColor">
    <path d="M83.928 46.95L83.928 46.95Q80.469 46.95 77.84 45.827Q75.212 44.704 73.46 42.659Q71.707 40.615 70.854 37.829Q70 35.044 70 31.674L70 31.674Q70 28.214 70.899 25.339Q71.797 22.463 73.527 20.397Q75.257 18.33 77.818 17.184Q80.379 16.038 83.704 16.038L83.704 16.038Q86.489 16.038 88.646 16.825Q90.802 17.611 92.24 19.049Q93.678 20.486 94.374 22.396Q95.071 24.305 94.981 26.552L94.981 26.552L89.724 27.451Q89.679 25.339 88.915 23.879Q88.152 22.418 86.781 21.632Q85.411 20.846 83.524 20.846L83.524 20.846Q81.951 20.846 80.558 21.475Q79.166 22.104 78.132 23.407Q77.099 24.71 76.515 26.687Q75.931 28.664 75.931 31.404L75.931 31.404Q75.931 34.909 76.897 37.29Q77.863 39.671 79.705 40.907Q81.547 42.143 84.063 42.143L84.063 42.143Q86.444 42.143 87.904 41.132Q89.365 40.121 90.039 38.279Q90.713 36.436 90.668 34.1L90.668 34.1L95.924 34.729Q96.059 37.245 95.408 39.447Q94.756 41.648 93.296 43.333Q91.836 45.018 89.522 45.984Q87.208 46.95 83.928 46.95Z"/>
    <path d="M108.909 46.95L108.909 46.95Q105.539 46.95 102.933 45.557Q100.327 44.164 98.845 41.424Q97.362 38.683 97.362 34.594L97.362 34.594Q97.362 30.416 98.89 27.675Q100.417 24.935 103.023 23.587Q105.629 22.239 108.909 22.239L108.909 22.239Q112.234 22.239 114.84 23.632Q117.446 25.024 118.928 27.765Q120.411 30.506 120.411 34.639L120.411 34.639Q120.411 38.818 118.906 41.558Q117.401 44.299 114.772 45.625Q112.144 46.95 108.909 46.95ZM109.044 42.592L109.044 42.592Q110.841 42.592 112.077 41.693Q113.312 40.795 113.986 39.065Q114.66 37.335 114.66 34.909L114.66 34.909Q114.66 32.348 113.964 30.551Q113.267 28.754 111.942 27.765Q110.616 26.777 108.774 26.777L108.774 26.777Q106.977 26.777 105.719 27.698Q104.461 28.619 103.787 30.349Q103.113 32.078 103.113 34.505L103.113 34.505Q103.113 38.324 104.686 40.458Q106.258 42.592 109.044 42.592Z"/>
    <path d="M128.588 46.321L122.927 46.321L122.927 34.055L122.882 15.05L128.633 15.05L128.633 21.52Q128.633 22.374 128.543 23.699Q128.453 25.024 128.274 26.552Q128.094 28.08 127.914 29.607Q127.735 31.135 127.555 32.438L127.555 32.438L128.139 32.438Q128.588 28.933 129.622 26.664Q130.655 24.395 132.362 23.317Q134.07 22.239 136.451 22.239L136.451 22.239Q140.36 22.239 142.247 25.002Q144.134 27.765 144.134 33.336L144.134 33.336L144.134 46.321L138.428 46.321L138.428 33.786Q138.428 30.371 137.462 28.798Q136.496 27.226 134.474 27.226L134.474 27.226Q132.677 27.226 131.374 28.461Q130.071 29.697 129.352 32.056Q128.633 34.415 128.588 37.829L128.588 37.829L128.588 46.321Z"/>
    <path d="M158.017 46.95L158.017 46.95Q155.007 46.95 152.828 46.051Q150.649 45.153 149.211 43.558Q147.773 41.963 147.077 39.784Q146.38 37.605 146.38 34.999L146.38 34.999Q146.38 32.348 147.077 30.034Q147.773 27.72 149.166 25.968Q150.559 24.216 152.67 23.227Q154.782 22.239 157.613 22.239L157.613 22.239Q160.308 22.239 162.353 23.16Q164.397 24.081 165.7 25.811Q167.003 27.54 167.542 29.922Q168.081 32.303 167.767 35.268L167.767 35.268L149.975 35.493L149.975 32.168L163.768 31.944L162.51 33.875Q162.735 31.584 162.218 30.034Q161.701 28.484 160.533 27.653Q159.365 26.822 157.613 26.822L157.613 26.822Q155.726 26.822 154.445 27.81Q153.165 28.798 152.536 30.573Q151.907 32.348 151.907 34.774L151.907 34.774Q151.907 38.683 153.502 40.637Q155.097 42.592 158.107 42.592L158.107 42.592Q159.5 42.592 160.421 42.187Q161.342 41.783 161.926 41.132Q162.51 40.48 162.78 39.649Q163.049 38.818 163.094 37.964L163.094 37.964L168.261 38.503Q168.171 40.166 167.565 41.693Q166.958 43.221 165.722 44.389Q164.487 45.557 162.577 46.254Q160.668 46.95 158.017 46.95Z"/>
    <path d="M176.214 46.321L170.552 46.321L170.552 34.415L170.507 22.868L175.495 22.868L175.225 32.348L175.764 32.348Q176.034 28.798 176.887 26.597Q177.741 24.395 179.089 23.362Q180.437 22.329 182.279 22.329L182.279 22.329Q182.908 22.329 183.627 22.463Q184.346 22.598 185.065 22.958L185.065 22.958L184.795 29.113Q183.986 28.709 183.178 28.506Q182.369 28.304 181.695 28.304L181.695 28.304Q180.033 28.304 178.842 29.338Q177.651 30.371 177 32.325Q176.348 34.28 176.214 37.065L176.214 37.065L176.214 46.321Z"/>
    <path d="M196.881 46.95L196.881 46.95Q193.871 46.95 191.692 46.051Q189.513 45.153 188.075 43.558Q186.637 41.963 185.941 39.784Q185.244 37.605 185.244 34.999L185.244 34.999Q185.244 32.348 185.941 30.034Q186.637 27.72 188.03 25.968Q189.423 24.216 191.535 23.227Q193.646 22.239 196.477 22.239L196.477 22.239Q199.173 22.239 201.217 23.16Q203.261 24.081 204.564 25.811Q205.867 27.54 206.406 29.922Q206.945 32.303 206.631 35.268L206.631 35.268L188.839 35.493L188.839 32.168L202.632 31.944L201.374 33.875Q201.599 31.584 201.082 30.034Q200.565 28.484 199.397 27.653Q198.229 26.822 196.477 26.822L196.477 26.822Q194.59 26.822 193.309 27.81Q192.029 28.798 191.4 30.573Q190.771 32.348 190.771 34.774L190.771 34.774Q190.771 38.683 192.366 40.637Q193.961 42.592 196.971 42.592L196.971 42.592Q198.364 42.592 199.285 42.187Q200.206 41.783 200.79 41.132Q201.374 40.48 201.644 39.649Q201.913 38.818 201.958 37.964L201.958 37.964L207.125 38.503Q207.035 40.166 206.429 41.693Q205.822 43.221 204.587 44.389Q203.351 45.557 201.441 46.254Q199.532 46.95 196.881 46.95Z"/>
    <path d="M215.078 46.321L209.416 46.321L209.416 33.471L209.372 22.868L214.314 22.868L213.999 32.258L214.538 32.258Q214.898 28.843 215.886 26.642Q216.875 24.44 218.582 23.34Q220.289 22.239 222.761 22.239L222.761 22.239Q226.714 22.239 228.669 24.979Q230.623 27.72 230.623 33.336L230.623 33.336L230.623 46.321L224.917 46.321L224.917 33.875Q224.917 30.461 223.929 28.821Q222.94 27.181 220.829 27.181L220.829 27.181Q219.031 27.181 217.751 28.394Q216.47 29.607 215.796 31.988Q215.123 34.37 215.078 37.919L215.078 37.919L215.078 46.321Z"/>
    <path d="M244.506 46.95L244.506 46.95Q241.541 46.95 239.34 46.029Q237.138 45.108 235.7 43.445Q234.263 41.783 233.566 39.582Q232.87 37.38 232.87 34.819L232.87 34.819Q232.87 32.168 233.589 29.899Q234.307 27.63 235.723 25.9Q237.138 24.171 239.295 23.205Q241.451 22.239 244.327 22.239L244.327 22.239Q247.652 22.239 249.808 23.452Q251.965 24.665 253.043 26.642Q254.121 28.619 254.076 31.045L254.076 31.045L248.955 31.854Q248.955 30.236 248.37 29.113Q247.786 27.99 246.73 27.406Q245.675 26.822 244.237 26.822L244.237 26.822Q242.979 26.822 241.968 27.271Q240.957 27.72 240.193 28.686Q239.429 29.652 239.025 31.09Q238.621 32.528 238.621 34.549L238.621 34.549Q238.621 37.2 239.34 38.975Q240.058 40.75 241.406 41.648Q242.754 42.547 244.596 42.547L244.596 42.547Q246.483 42.547 247.562 41.738Q248.64 40.929 249.134 39.649Q249.628 38.368 249.584 36.976L249.584 36.976L254.795 37.515Q254.84 39.492 254.234 41.199Q253.627 42.906 252.347 44.209Q251.066 45.512 249.112 46.231Q247.157 46.95 244.506 46.95Z"/>
    <path d="M267.555 46.95L267.555 46.95Q264.545 46.95 262.366 46.051Q260.187 45.153 258.749 43.558Q257.311 41.963 256.615 39.784Q255.919 37.605 255.919 34.999L255.919 34.999Q255.919 32.348 256.615 30.034Q257.311 27.72 258.704 25.968Q260.097 24.216 262.209 23.227Q264.32 22.239 267.151 22.239L267.151 22.239Q269.847 22.239 271.891 23.16Q273.935 24.081 275.238 25.811Q276.541 27.54 277.08 29.922Q277.62 32.303 277.305 35.268L277.305 35.268L259.513 35.493L259.513 32.168L273.306 31.944L272.048 33.875Q272.273 31.584 271.756 30.034Q271.24 28.484 270.071 27.653Q268.903 26.822 267.151 26.822L267.151 26.822Q265.264 26.822 263.983 27.81Q262.703 28.798 262.074 30.573Q261.445 32.348 261.445 34.774L261.445 34.774Q261.445 38.683 263.04 40.637Q264.635 42.592 267.645 42.592L267.645 42.592Q269.038 42.592 269.959 42.187Q270.88 41.783 271.464 41.132Q272.048 40.48 272.318 39.649Q272.587 38.818 272.632 37.964L272.632 37.964L277.799 38.503Q277.709 40.166 277.103 41.693Q276.496 43.221 275.261 44.389Q274.025 45.557 272.116 46.254Q270.206 46.95 267.555 46.95Z"/>
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
