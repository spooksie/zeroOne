{{--
    ZeroOne.com — public landing page.
    Concept: the whole page is a switch. Every section has a binary address,
    the navigation is a bit register, the theme toggle is a light switch.
    Self-contained: inline CSS/JS, Google Fonts only, no Vite build.
    Every fact and contact detail is carried over word-for-word from the
    original zeroone.com holding page. Do not invent prices, dates or owners.
--}}
@php
    $url = 'https://zeroone.com/';
    $email = 'team@coherence.com';
    $mailto = 'mailto:team@coherence.com?subject=Domain%20name:%20zeroone.com';
    $owner = 'https://coherence.com';
    $ogImage = 'https://zeroone.com/og-image.png';
    $ogAlt = 'The zeroone wordmark in cream on near-black, its second o a lime disc carrying a 1, above the line “This is an elite-level .com domain” and the name spelled out in binary.';

    $title = 'ZeroOne.com — an elite-level .com domain';
    $description = 'ZeroOne.com is an elite-level .com domain. It is owned by Coherence.com and may be in development. Contact team@coherence.com.';

    // Sections, addressed in 3-bit binary. The register nav is built from this.
    $sections = [
        ['top', '000', 'Start'],
        ['truth', '001', 'Truth table'],
        ['meaning', '010', 'Meaning'],
        ['industries', '011', 'Industries'],
        ['faq', '100', 'FAQ'],
        ['contact', '101', 'Contact'],
    ];

    // The name, in the only two digits it's named after (ASCII, 8 bits a letter).
    $binary = collect(str_split('zeroone'))->map(fn ($ch) => [$ch, sprintf('%08b', ord($ch))]);

    $truth = [
        ['zeroone.com is a .com domain', 1],
        ['It is an elite-level .com domain', 1],
        ['The name is two everyday English words: zero, one', 1],
        ['It contains a hyphen', 0],
        ['It is written with numerals', 0],
        ['It is owned by Coherence.com', 1],
    ];

    $pairs = [
        ['Nothing', 'Something'],
        ['Off', 'On'],
        ['False', 'True'],
        ['Blank page', 'First draft'],
        ['Idea', 'Launch'],
        ['Silence', 'Signal'],
    ];

    $industries = [
        ['Artificial intelligence', 'AI labs, model builders and agent platforms — products that, underneath, think in zeros and ones.'],
        ['Software & SaaS', 'Developer tools, platforms and apps that want a short, technical, memorable .com.'],
        ['Computing hardware', 'Chip makers, quantum computing and hardware start-ups working at the level of the bit.'],
        ['Cybersecurity', 'Encryption, identity and security firms, where every decision is allow or deny.'],
        ['Fintech & payments', 'Neobanks, payment rails and digital-ledger infrastructure built to be exact.'],
        ['Venture & start-ups', 'Funds, accelerators and venture studios that back companies going from zero to one.'],
        ['Data & analytics', 'Analytics, BI and data-infrastructure companies that turn raw bits into decisions.'],
        ['Education & coding', 'Coding schools, computer-science courses and learning platforms that start from zero.'],
        ['Robotics & IoT', 'Connected devices, smart homes and robotics, where every signal is on or off.'],
        ['Gaming & esports', 'Game studios, esports teams and interactive media with a digital-native name.'],
        ['Design & product studios', 'Agencies and product studios that take ideas from blank page to first release.'],
        ['Energy & smart grids', 'Clean-energy, storage and grid companies switching things from off to on.'],
    ];

    $faqs = [
        ['What is zeroone.com?', 'This is an elite-level .com domain. It is owned by Coherence.com and may be in development.'],
        ['Who owns zeroone.com?', 'zeroone.com is owned by Coherence.com.'],
        ['How do I get in touch about zeroone.com?', 'Email team@coherence.com with the subject “Domain name: zeroone.com”.'],
        ['What does the name mean?', 'Zero and one are the only two digits in binary, the number system computers use to store and process information. “Zero to one” is also shorthand for creating something that did not exist before.'],
        ['Is the name written with digits?', 'No. The domain spells both words out in letters: zeroone.com — no numerals and no hyphen.'],
        ['What kinds of business could use zeroone.com?', 'The name suits artificial intelligence, software, computing hardware, cybersecurity, fintech, venture capital and start-ups, data and analytics, education, robotics and IoT, gaming, design studios and energy.'],
    ];

    $schema = [
        '@context' => 'https://schema.org',
        '@graph' => [
            ['@type' => 'WebSite', '@id' => $url.'#website', 'url' => $url, 'name' => 'ZeroOne.com', 'description' => $description, 'inLanguage' => 'en', 'copyrightHolder' => ['@id' => 'https://coherence.com/#organization'], 'publisher' => ['@id' => 'https://coherence.com/#organization'], 'creator' => ['@id' => 'https://qquantum.ai/#organization']],
            [
                '@type' => 'Organization', '@id' => 'https://coherence.com/#organization', 'name' => 'Coherence', 'legalName' => 'Booth.com Ltd', 'url' => 'https://coherence.com/', 'email' => $email,
                'contactPoint' => ['@type' => 'ContactPoint', 'contactType' => 'customer support', 'email' => $email],
            ],
            ['@type' => 'Organization', '@id' => 'https://qquantum.ai/#organization', 'name' => 'QQuantum.ai', 'url' => 'https://qquantum.ai/', 'description' => 'AI systems engineering studio in Barcelona — brand identity, logo and web design, AI agents and custom AI systems.'],
            ['@type' => 'WebPage', '@id' => $url.'#webpage', 'url' => $url, 'name' => $title, 'description' => $description, 'isPartOf' => ['@id' => $url.'#website'], 'inLanguage' => 'en', 'primaryImageOfPage' => ['@type' => 'ImageObject', 'url' => $ogImage, 'width' => 1200, 'height' => 630]],
            [
                '@type' => 'FAQPage', '@id' => $url.'#faq',
                'mainEntity' => array_map(fn ($f) => ['@type' => 'Question', 'name' => $f[0], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f[1]]], $faqs),
            ],
        ],
    ];

    // The chosen On/Off wordmark. One drawing for every instance (hero, bar,
    // footer); each keeps the intro, idle, hover and click.
    $zo = fn () => '<svg viewBox="-16 50 522 100" aria-hidden="true">'
        .'<path class="oo-s" style="--i: 0" pathLength="1" d="M0 70 H44 L0 130 H44"></path>'
        .'<path class="oo-s" style="--i: 1" pathLength="1" d="M64 100 H124 A30 30 0 1 0 115.2 121.2"></path>'
        .'<path class="oo-s" style="--i: 2" pathLength="1" d="M144 130 V70 M144 100 A30 30 0 0 1 174 70"></path>'
        .'<path class="oo-s oo-o1" style="--i: 3" pathLength="1" d="M188 100 A30 30 0 1 1 248 100 A30 30 0 1 1 188 100"></path>'
        .'<path class="oo-s oo-o2 oo-out" style="--i: 4; --k: 0" pathLength="1" d="M264 100 A30 30 0 1 1 324 100 A30 30 0 1 1 264 100"></path>'
        .'<path class="oo-s oo-out" style="--i: 5; --k: 1" pathLength="1" d="M344 130 V70 M344 100 A30 30 0 0 1 404 100 V130"></path>'
        .'<path class="oo-s oo-out" style="--i: 6; --k: 2" pathLength="1" d="M424 100 H484 A30 30 0 1 0 475.2 121.2"></path>'
        .'<g class="oo-c"><g class="oo-h"><g class="oo-i"><g class="oo-idle">'
        .'<circle class="oo-disc" cx="294" cy="100" r="35.5"></circle>'
        .'<path class="oo-one" d="M284 88 L297 78 V122"></path>'
        .'</g></g></g></g></svg>';

    $sun = '<svg class="i-sun" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" aria-hidden="true"><circle cx="12" cy="12" r="4"></circle><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"></path></svg>';
    $moon = '<svg class="i-moon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 14.5A8 8 0 0 1 9.5 4a8 8 0 1 0 10.5 10.5Z"></path></svg>';

    // A lit knob with its 1, used by every switch on the page.
    $knob = '<svg viewBox="0 0 40 40" aria-hidden="true"><circle cx="20" cy="20" r="20" class="k-disc"></circle><path d="M15.5 14.5 L21 10.5 V29.5" class="k-one"></path></svg>';

    $coherence = <<<'SVG'
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
SVG;
    $qquantum = <<<'SVG'
<svg xmlns="http://www.w3.org/2000/svg" viewBox="-40 -780 5620 1010" role="img" aria-label="QQuantum.ai" fill="none"><title>QQuantum.ai</title><g><path transform="translate(301 0)" d="M338 14Q206 14 128 -58Q50 -131 50 -266V-434Q50 -569 128 -642Q206 -714 338 -714Q470 -714 548 -642Q626 -569 626 -434V-266Q626 -131 548 -58Q470 14 338 14ZM338 -104Q412 -104 453 -147Q494 -190 494 -262V-438Q494 -510 453 -553Q412 -596 338 -596Q265 -596 224 -553Q182 -510 182 -438V-262Q182 -190 224 -147Q265 -104 338 -104ZM384 180Q335 180 304 150Q274 119 274 68V0H402V48Q402 78 430 78H489V180Z" fill="currentColor"/></g><g><path transform="translate(942 0)" d="M259 8Q201 8 158 -18Q114 -45 90 -92Q66 -139 66 -200V-496H192V-210Q192 -154 220 -126Q247 -98 298 -98Q356 -98 388 -136Q420 -175 420 -244V-496H546V0H422V-65H404Q392 -40 359 -16Q326 8 259 8Z" fill="currentColor"/></g><g><path transform="translate(1523 0)" d="M224 14Q171 14 129 -4Q87 -23 62 -58Q38 -94 38 -145Q38 -196 62 -230Q87 -265 130 -282Q174 -300 230 -300H366V-328Q366 -363 344 -386Q322 -408 274 -408Q227 -408 204 -386Q181 -365 174 -331L58 -370Q70 -408 96 -440Q123 -471 168 -490Q212 -510 276 -510Q374 -510 431 -461Q488 -412 488 -319V-134Q488 -104 516 -104H556V0H472Q435 0 411 -18Q387 -36 387 -66V-67H368Q364 -55 350 -36Q336 -16 306 -1Q276 14 224 14ZM246 -88Q299 -88 332 -118Q366 -147 366 -196V-206H239Q204 -206 184 -191Q164 -176 164 -149Q164 -122 185 -105Q206 -88 246 -88Z" fill="currentColor"/></g><g><path transform="translate(2066 0)" d="M70 0V-496H194V-431H212Q224 -457 257 -480Q290 -504 357 -504Q415 -504 458 -478Q502 -451 526 -404Q550 -358 550 -296V0H424V-286Q424 -342 396 -370Q369 -398 318 -398Q260 -398 228 -360Q196 -321 196 -252V0Z" fill="currentColor"/></g><g><path transform="translate(2647 0)" d="M260 0Q211 0 180 -30Q150 -61 150 -112V-392H26V-496H150V-650H276V-496H412V-392H276V-134Q276 -104 304 -104H400V0Z" fill="currentColor"/></g><g><path transform="translate(3068 0)" d="M259 8Q201 8 158 -18Q114 -45 90 -92Q66 -139 66 -200V-496H192V-210Q192 -154 220 -126Q247 -98 298 -98Q356 -98 388 -136Q420 -175 420 -244V-496H546V0H422V-65H404Q392 -40 359 -16Q326 8 259 8Z" fill="currentColor"/></g><g><path transform="translate(3649 0)" d="M70 0V-496H194V-442H212Q225 -467 255 -486Q285 -504 334 -504Q387 -504 419 -484Q451 -463 468 -430H486Q503 -462 534 -483Q565 -504 622 -504Q668 -504 706 -484Q743 -465 766 -426Q788 -386 788 -326V0H662V-317Q662 -358 641 -378Q620 -399 582 -399Q539 -399 516 -372Q492 -344 492 -293V0H366V-317Q366 -358 345 -378Q324 -399 286 -399Q243 -399 220 -372Q196 -344 196 -293V0Z" fill="currentColor"/></g><g><path transform="translate(4468 0)" d="M150 14Q109 14 82 -13Q54 -39 54 -81Q54 -123 82 -150Q109 -176 150 -176Q190 -176 217 -149Q244 -123 244 -81Q244 -39 217 -12Q190 14 150 14Z" fill="#5eb3d6"/></g><g><path transform="translate(4731 0)" d="M224 14Q171 14 129 -4Q87 -23 62 -58Q38 -94 38 -145Q38 -196 62 -230Q87 -265 130 -282Q174 -300 230 -300H366V-328Q366 -363 344 -386Q322 -408 274 -408Q227 -408 204 -386Q181 -365 174 -331L58 -370Q70 -408 96 -440Q123 -471 168 -490Q212 -510 276 -510Q374 -510 431 -461Q488 -412 488 -319V-134Q488 -104 516 -104H556V0H472Q435 0 411 -18Q387 -36 387 -66V-67H368Q364 -55 350 -36Q336 -16 306 -1Q276 14 224 14ZM246 -88Q299 -88 332 -118Q366 -147 366 -196V-206H239Q204 -206 184 -191Q164 -176 164 -149Q164 -122 185 -105Q206 -88 246 -88Z" fill="#5eb3d6"/></g><g><path transform="translate(5274 0)" d="M70 0V-496H196V0ZM133 -554Q99 -554 76 -576Q52 -598 52 -634Q52 -670 76 -692Q99 -714 133 -714Q168 -714 191 -692Q214 -670 214 -634Q214 -598 191 -576Q168 -554 133 -554Z" fill="#5eb3d6"/></g><g><path transform="translate(0 0)" d="M338 14Q206 14 128 -58Q50 -131 50 -266V-434Q50 -569 128 -642Q206 -714 338 -714Q470 -714 548 -642Q626 -569 626 -434V-266Q626 -131 548 -58Q470 14 338 14ZM338 -104Q412 -104 453 -147Q494 -190 494 -262V-438Q494 -510 453 -553Q412 -596 338 -596Q265 -596 224 -553Q182 -510 182 -438V-262Q182 -190 224 -147Q265 -104 338 -104ZM384 180Q335 180 304 150Q274 119 274 68V0H402V48Q402 78 430 78H489V180Z" fill="none" stroke="#c9a75c" stroke-width="55" stroke-linejoin="round"/></g></svg>
SVG;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>{{ $title }}</title>
<meta name="description" content="{{ $description }}">
<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1">
<link rel="canonical" href="{{ $url }}">
<meta property="og:type" content="website">
<meta property="og:site_name" content="ZeroOne.com">
<meta property="og:url" content="{{ $url }}">
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:image" content="{{ $ogImage }}">
<meta property="og:image:type" content="image/png">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="{{ $ogAlt }}">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ $description }}">
<meta name="twitter:image" content="{{ $ogImage }}">
<meta name="twitter:image:alt" content="{{ $ogAlt }}">
<meta name="theme-color" content="#F3EEE4" media="(prefers-color-scheme: light)">
<meta name="theme-color" content="#131210" media="(prefers-color-scheme: dark)">
<meta name="color-scheme" content="light dark">
<link rel="icon" href="/favicon.svg" type="image/svg+xml">
<link rel="icon" href="/favicon.ico" sizes="any">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">
<link rel="alternate" type="text/plain" href="/llms.txt" title="LLM summary">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Literata:ital,opsz,wght@0,7..72,400;0,7..72,500;1,7..72,400&amp;family=Manrope:wght@400;500;600;700;800&amp;display=swap">
<script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) !!}</script>
@verbatim
<script>
(function () {
  var d = document.documentElement, t = null;
  try { t = localStorage.getItem('theme'); } catch (e) {}
  d.dataset.theme = t || (matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
  d.classList.add('js');
})();
</script>
<style>
/* ---------- Tokens: lights on (light) / lights off (dark) ---------- */
:root{
  --bg:#F3EEE4;--bg2:#EAE3D5;--ink:#131210;--muted:#5E594F;--line:rgba(19,18,16,.16);
  --acc:#5C7A00;--acc-ink:#FFFFFF;--glass:rgba(243,238,228,.86);--ring:rgba(19,18,16,.34);
  --sans:'Manrope',system-ui,sans-serif;--serif:'Literata',Georgia,serif;
  --bar:64px;
}
@media (prefers-color-scheme:dark){:root:not([data-theme="light"]){
  --bg:#131210;--bg2:#1D1C19;--ink:#F3EEE4;--muted:#9A948A;--line:rgba(243,238,228,.14);
  --acc:#C8F03C;--acc-ink:#131210;--glass:rgba(19,18,16,.84);--ring:rgba(243,238,228,.34);
}}
:root[data-theme="dark"]{
  --bg:#131210;--bg2:#1D1C19;--ink:#F3EEE4;--muted:#9A948A;--line:rgba(243,238,228,.14);
  --acc:#C8F03C;--acc-ink:#131210;--glass:rgba(19,18,16,.84);--ring:rgba(243,238,228,.34);
}
*{box-sizing:border-box}
html{scroll-behavior:smooth;scroll-padding-top:calc(var(--bar) + 12px);-webkit-text-size-adjust:100%;interpolate-size:allow-keywords}
html,body{overflow-x:clip}
body{margin:0;background:var(--bg);color:var(--ink);font:400 17px/1.6 var(--serif)}
a{color:inherit}
:focus-visible{outline:2px solid var(--acc);outline-offset:3px}
.wrap{width:min(1240px,100%);margin:0 auto;padding:0 20px}
@media (min-width:900px){.wrap{padding:0 40px}}
.sr{position:absolute;width:1px;height:1px;overflow:hidden;clip:rect(0 0 0 0);white-space:nowrap}
.mono{font-family:var(--sans);font-variant-numeric:tabular-nums;letter-spacing:.08em}

/* A rule made of bits: rings, one of them lit. */
.bitrule{height:10px;background:radial-gradient(circle at 5px 5px,transparent 3px,var(--ring) 3.1px,var(--ring) 4.2px,transparent 4.4px) 0 0/16px 10px repeat-x;position:relative}
.bitrule::after{content:"";position:absolute;top:0;left:var(--lit,32px);width:10px;height:10px;border-radius:50%;background:var(--acc)}

/* ---------- The logo (On/Off) ---------- */
.zo-mark{appearance:none;background:none;border:0;padding:0;margin:0;display:block;color:inherit;cursor:pointer;-webkit-tap-highlight-color:transparent;border-radius:14px}
.zo-mark svg{display:block;width:100%;height:auto;overflow:visible}
.zo-mark svg g{transform-box:fill-box;transform-origin:center}
.js .zo-mark:not(.play),.js .zo-mark:not(.play) *{animation-play-state:paused!important}
.oo-s{fill:none;stroke:var(--ink);stroke-width:11px;stroke-linecap:round;stroke-linejoin:round;stroke-dasharray:1 1.2;animation:oo-draw .7s cubic-bezier(.6,0,.3,1) calc(.15s + var(--i)*.1s) backwards;transition:stroke .35s ease}
@keyframes oo-draw{from{stroke-dashoffset:1.1}}
.zo-mark:not(.ca):hover .oo-o1{stroke:var(--acc)}
.oo-disc{fill:var(--acc)}
.oo-one{fill:none;stroke:var(--cut,var(--bg));stroke-width:9px;stroke-linecap:round;stroke-linejoin:round}
.oo-i{animation:oo-pop .6s cubic-bezier(.3,1.7,.5,1) 1.15s backwards}
@keyframes oo-pop{from{transform:scale(0)}}
.oo-idle{animation:oo-breathe 3s ease-in-out 2s infinite}
@keyframes oo-breathe{0%,100%{transform:none}50%{transform:scale(1.05)}}
.oo-h{transition:transform .45s cubic-bezier(.3,1.6,.5,1)}
.zo-mark:hover .oo-h{transform:scale(1.1)}
.ca .oo-c{animation:oo-slide-a .7s cubic-bezier(.55,0,.25,1) forwards}
.cb .oo-c{animation:oo-slide-b .7s cubic-bezier(.55,0,.25,1) forwards}
@keyframes oo-slide-a{0%{transform:translateX(0) scale(1,1)}45%{transform:translateX(-44px) scale(1.3,.84)}100%{transform:translateX(-76px) scale(1,1)}}
@keyframes oo-slide-b{0%{transform:translateX(-76px) scale(1,1)}45%{transform:translateX(-32px) scale(1.3,.84)}100%{transform:translateX(0) scale(1,1)}}
.ca .oo-out{animation:oo-letters-off .45s cubic-bezier(.5,0,.75,0) calc(.12s + var(--k)*.08s) forwards}
.cb .oo-out{animation:oo-letters-on .55s cubic-bezier(.2,.8,.3,1) calc(.3s + var(--k)*.08s) backwards}
@keyframes oo-letters-off{to{opacity:0;transform:translateY(14px)}}
@keyframes oo-letters-on{from{opacity:0;transform:translateY(14px)}}

/* ---------- Knob: the lit disc + 1, reused by every switch ---------- */
.k-disc{fill:var(--acc)}
.k-one{fill:none;stroke:var(--acc-ink);stroke-width:3.4px;stroke-linecap:round;stroke-linejoin:round}

/* ---------- Register bar (navigation) ---------- */
/* The register stays out of the hero and slides in once the hero has scrolled away. */
.bar{position:fixed;inset:0 0 auto;z-index:20;transform:translateY(-100%);visibility:hidden;transition:transform .5s cubic-bezier(.55,0,.25,1),visibility 0s .5s;height:var(--bar);background:var(--glass);backdrop-filter:blur(14px);-webkit-backdrop-filter:blur(14px);border-bottom:1px solid var(--line)}
.bar.shown,html:not(.js) .bar,.bar:focus-within{transform:none;visibility:visible;transition:transform .5s cubic-bezier(.55,0,.25,1),visibility 0s}
.bar .wrap{height:100%;display:flex;align-items:center;gap:20px}
.bar-logo{width:132px;flex:none;--cut:var(--bg)}
.reg{position:relative;display:flex;align-items:center;margin-left:auto}
.reg{--cell:44px}
.cell{position:relative;width:var(--cell);height:44px;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:3px;text-decoration:none;border-radius:10px}
.cell .ring{width:18px;height:18px;border-radius:50%;box-shadow:inset 0 0 0 2px var(--ring);transition:box-shadow .3s}
.cell:hover .ring{box-shadow:inset 0 0 0 2px var(--ink)}
.cell .addr{font:600 9px/1 var(--sans);letter-spacing:.06em;color:var(--muted)}
.cell[aria-current="true"] .addr{color:var(--ink)}
.cell.past .ring{box-shadow:inset 0 0 0 9px var(--ring)}
.reg-knob{position:absolute;left:calc((var(--cell) - 18px)/2);top:7px;width:18px;height:18px;pointer-events:none;transform:translateX(calc(var(--n,0)*var(--cell)));transition:transform calc(.3s + var(--dist,1)*.07s) cubic-bezier(.55,0,.25,1)}
.reg-knob svg{display:block;width:100%;height:100%;transition:scale .2s ease}
.reg-knob.moving svg{scale:1.25 .82}
.readout{min-width:128px;font:600 12px/1 var(--sans);letter-spacing:.08em;text-transform:uppercase;color:var(--muted);white-space:nowrap}
.readout b{color:var(--ink);font-weight:700;margin-right:6px}
.bar-cta{display:inline-flex;align-items:center;gap:10px;min-height:44px;padding:0 6px 0 18px;border-radius:999px;background:var(--ink);color:var(--bg);text-decoration:none;font:700 14px/1 var(--sans)}
.bar-cta i{width:32px;height:32px;display:block}
.bar-cta i svg{display:block;width:100%;height:100%}
.bar-cta i .k-disc{fill:var(--bg)}.bar-cta i .k-one{stroke:var(--ink)}
.bar-cta:hover i .k-disc{fill:var(--acc)}.bar-cta:hover i .k-one{stroke:var(--acc-ink)}

/* Theme switch: sun on the left (light), moon on the right (dark); the knob carries the current mode. */
.th{flex:none;appearance:none;border:0;background:none;padding:0 4px;min-width:44px;height:44px;display:flex;align-items:center;gap:10px;cursor:pointer;color:var(--ink);font:700 13px/1 var(--sans)}
.th .track{position:relative;width:64px;height:34px;flex:none;border-radius:999px;box-shadow:inset 0 0 0 2px var(--ink)}
.th .ic{position:absolute;top:9px;width:16px;height:16px;color:var(--muted)}
.th .ic.i-sun{left:9px}.th .ic.i-moon{right:9px}
.th .k{position:absolute;top:4px;left:4px;width:26px;height:26px;border-radius:50%;background:var(--acc);color:var(--acc-ink);display:grid;place-items:center;transition:transform .5s cubic-bezier(.55,0,.25,1)}
.th .k svg{width:16px;height:16px;grid-area:1/1;transition:opacity .25s,transform .5s cubic-bezier(.55,0,.25,1)}
.th .k .i-moon{opacity:0;transform:rotate(-90deg)}
:root[data-theme="dark"] .th .k{transform:translateX(30px)}
:root[data-theme="dark"] .th .k .i-sun{opacity:0;transform:rotate(90deg)}
:root[data-theme="dark"] .th .k .i-moon{opacity:1;transform:none}
.th .mode .d,:root[data-theme="dark"] .th .mode .l{display:none}
:root[data-theme="dark"] .th .mode .d{display:inline}
@media (max-width:1180px){.th .mode{display:none}}

@media (max-width:1040px){.readout{display:none}}
@media (max-width:760px){
  .reg{--cell:34px}
  .bar-cta{display:none}
  .bar .wrap{gap:4px;padding:0 10px}
  .bar-logo{width:92px}
  .reg{margin-left:auto}
}
@media (max-width:420px){.bar-logo{display:none}.reg{margin-left:0}.bar .wrap{justify-content:space-between;padding:0 12px}}
@media (max-width:370px){.reg{--cell:32px}.th{padding:0}.bar .wrap{padding:0 8px}}

/* CRT power-cut theme transition */
::view-transition{background:#050504}
::view-transition-old(root),::view-transition-new(root){animation:none;mix-blend-mode:normal}

/* ---------- Hero ---------- */
.hero{min-height:100svh;padding:calc(var(--bar) + clamp(24px,5vh,56px)) 0 clamp(28px,5vh,56px);display:flex;align-items:center}
.hero .wrap{display:block;min-width:0}
.hero-row>*{min-width:0}
.hero-row{display:grid;gap:28px;align-items:end}
@media (min-width:980px){.hero-row{grid-template-columns:minmax(0,1.2fr) minmax(0,.9fr) minmax(0,1fr);gap:44px}}
/* The wordmark is the horizon: full width, sized so the row below stays above the fold. */
.hero-logo{width:min(100%,calc((100svh - var(--bar)) * 1.6));margin:0 0 clamp(22px,4vh,44px) -1%;--cut:var(--bg)}
.hero h1{font:800 clamp(34px,3.7vw,54px)/1.02 var(--sans);letter-spacing:-.035em;margin:0;max-width:13ch;text-wrap:balance}
.hero h1 .dot{color:var(--acc)}
.nw{white-space:nowrap}
.lede{font-size:clamp(17px,1.4vw,19px);color:var(--muted);margin:0;max-width:40ch}
.lede a{color:var(--ink);text-decoration-color:var(--acc);text-decoration-thickness:2px;text-underline-offset:3px}
.actions{display:flex;align-items:center;gap:18px 26px;flex-wrap:wrap;margin-top:clamp(20px,3.4vh,32px)}
.hint{font:600 13px/1.4 var(--sans);color:var(--muted)}
.hint .tap{display:none}
@media (hover:none),(pointer:coarse){.hint .tap{display:inline}.hint .click{display:none}}

/* The big switch button. Hover slides the knob on. */
.switch{--w:210px;position:relative;display:inline-flex;align-items:center;height:60px;width:var(--w);padding:0 26px 0 22px;border-radius:999px;background:var(--ink);color:var(--bg);text-decoration:none;font:800 17px/1 var(--sans);letter-spacing:-.01em;overflow:hidden;isolation:isolate}
.switch .t{position:relative;z-index:1;margin-left:auto;transition:transform .5s cubic-bezier(.55,0,.25,1)}
.switch .kn{position:absolute;left:8px;top:8px;width:44px;height:44px;border-radius:50%;box-shadow:inset 0 0 0 3px var(--bg);transition:transform .55s cubic-bezier(.55,0,.25,1),background .3s,box-shadow .3s}
.switch .kn svg{display:block;width:100%;height:100%;opacity:0;transition:opacity .25s .2s}
.switch::before{content:"";position:absolute;inset:0;background:var(--acc);transform:scaleX(0);transform-origin:left;transition:transform .55s cubic-bezier(.55,0,.25,1);z-index:0}
.switch:hover::before,.switch:focus-visible::before{transform:scaleX(1)}
.switch:hover,.switch:focus-visible{color:var(--acc-ink)}
.switch:hover .kn,.switch:focus-visible .kn{transform:translateX(calc(var(--w) - 60px));box-shadow:none}
.switch:hover .kn svg,.switch:focus-visible .kn svg{opacity:1}
.switch:hover .kn .k-disc,.switch:focus-visible .kn .k-disc{fill:var(--acc-ink)}
.switch:hover .kn .k-one,.switch:focus-visible .kn .k-one{stroke:var(--acc)}
.switch:hover .t,.switch:focus-visible .t{transform:translateX(calc(-1 * (var(--w) - 150px)))}

/* The name in binary: 7 letters x 8 bits */
.matrix{margin:0;padding:clamp(16px,2vw,22px);border-radius:28px;background:var(--bg2)}
.matrix figcaption{font:700 12px/1.3 var(--sans);letter-spacing:.1em;text-transform:uppercase;color:var(--muted);display:flex;justify-content:space-between;gap:12px;margin-bottom:14px}
.matrix ol{list-style:none;margin:0;padding:0;display:grid;gap:clamp(4px,.7vh,7px)}
.matrix li{display:grid;grid-template-columns:28px repeat(8,minmax(0,1fr));align-items:center;gap:clamp(4px,.8vw,9px)}
.matrix .ch{font:800 17px/1 var(--sans);text-align:center}
.bit{position:relative;aspect-ratio:1;max-width:24px;width:100%;justify-self:center;border-radius:50%;box-shadow:inset 0 0 0 2px var(--ring)}
.bit::after{content:"";position:absolute;inset:0;border-radius:50%;background:var(--acc);transform:scale(0);transition:transform .38s cubic-bezier(.3,1.5,.5,1) calc(var(--d)*9ms)}
.bit.b1::after{transform:scale(1);animation:bit-idle 4.8s ease-in-out calc(var(--d)*-86ms) infinite}
@keyframes bit-idle{0%,100%{opacity:1}50%{opacity:.55}}
.hero.not .bit.b1::after{transform:scale(0)}
.hero.not .bit.b0::after{transform:scale(1)}
.matrix .note{font:500 14px/1.45 var(--serif);color:var(--muted);margin:12px 0 0}
.matrix .note b{font-family:var(--sans);color:var(--ink)}

/* ---------- Sections ---------- */
.sec{padding:clamp(72px,11vw,140px) 0;border-top:1px solid var(--line)}
.sec-head{display:grid;gap:14px 48px;margin-bottom:clamp(32px,5vw,56px)}
@media (min-width:900px){.sec-head{grid-template-columns:minmax(0,1fr) minmax(0,1fr);align-items:end}}
.address{display:flex;gap:6px;margin-bottom:18px}
.address span{width:30px;height:30px;border-radius:50%;display:grid;place-items:center;font:800 13px/1 var(--sans);box-shadow:inset 0 0 0 2px var(--ring)}
.address span.one{background:var(--acc);color:var(--acc-ink);box-shadow:none}
.sec h2{font:800 clamp(36px,5.2vw,72px)/.98 var(--sans);letter-spacing:-.04em;margin:0;text-wrap:balance}
.sec-head p{margin:0;color:var(--muted);max-width:52ch;font-size:clamp(17px,1.4vw,19px)}

/* 001 Truth table */
.tt{width:100%;border-collapse:collapse;font-family:var(--sans)}
.tt th{font:700 12px/1 var(--sans);letter-spacing:.12em;text-transform:uppercase;color:var(--muted);text-align:left;padding:0 0 14px}
.tt th:last-child,.tt td:last-child{text-align:right}
.tt td{padding:clamp(16px,2.2vw,24px) 0;border-top:1px solid var(--line);font:600 clamp(18px,2vw,26px)/1.25 var(--sans);letter-spacing:-.015em;vertical-align:middle}
.tt tr.f0 td:first-child{color:var(--muted);text-decoration:line-through;text-decoration-thickness:1.5px;text-decoration-color:var(--ring)}
.out{display:inline-flex;align-items:center;gap:14px}
.out .v{font:800 clamp(22px,2.4vw,32px)/1 var(--sans);width:1ch;text-align:center}
.tog{position:relative;width:64px;height:34px;border-radius:999px;box-shadow:inset 0 0 0 2px var(--ink);flex:none}
.tog i{position:absolute;top:4px;left:4px;width:26px;height:26px;border-radius:50%;box-shadow:inset 0 0 0 2px var(--ink);transition:transform .6s cubic-bezier(.55,0,.25,1) calc(var(--r)*110ms + .2s),background .3s calc(var(--r)*110ms + .35s),box-shadow .3s calc(var(--r)*110ms + .35s)}
.tog.is1 i{transform:translateX(30px);background:var(--acc);box-shadow:none}
.js [data-on]:not(.on) .tog.is1 i{transform:none;background:transparent;box-shadow:inset 0 0 0 2px var(--ink)}

/* 010 Meaning: a 0 | 1 diptych */
.dip-head{display:grid;grid-template-columns:minmax(0,1fr) 88px minmax(0,1fr);align-items:end;margin-bottom:8px}
.dip-head .glyph{font:800 clamp(90px,15vw,210px)/.8 var(--sans);letter-spacing:-.06em}
.dip-head .glyph.z{color:transparent;-webkit-text-stroke:2px var(--ink)}
.dip-head .glyph.o{text-align:right;color:var(--acc)}
.dip{list-style:none;margin:0;padding:0}
.dip li{display:grid;grid-template-columns:minmax(0,1fr) 88px minmax(0,1fr);align-items:center;border-top:1px solid var(--line);min-height:76px}
.dip .z,.dip .o{font:700 clamp(20px,2.6vw,34px)/1.1 var(--sans);letter-spacing:-.025em;padding:14px 0}
.dip .z{color:var(--ink);transition:color .4s}
.dip .o{text-align:right;color:var(--muted);transition:color .4s}
.dip .mid{justify-self:center;position:relative;width:64px;height:34px;border-radius:999px;box-shadow:inset 0 0 0 2px var(--ring)}
.dip .mid i{position:absolute;top:4px;left:4px;width:26px;height:26px;border-radius:50%;box-shadow:inset 0 0 0 2px var(--ink);transition:transform .55s cubic-bezier(.55,0,.25,1),background .3s .15s,box-shadow .3s .15s}
.dip li:hover .mid i{transform:translateX(30px);background:var(--acc);box-shadow:none}
.dip li:hover .z{color:var(--muted)}
.dip li:hover .o{color:var(--ink)}
.dip-note{margin:28px 0 0;max-width:62ch;color:var(--muted)}
/* Touch screens have no hover: the rows switch on one by one when the section powers up. */
@media (hover:none),(pointer:coarse){
  .dip li:nth-child(n) .mid i{transition-delay:calc(var(--r)*140ms + .3s)}
  [data-on].on .dip .mid i{transform:translateX(30px);background:var(--acc);box-shadow:none}
  [data-on].on .dip .o{color:var(--ink)}
  .dip-note{display:none}
}

/* 011 Industries: a memory map */
.mem{list-style:none;margin:0;padding:0;display:grid;border-top:1px solid var(--line)}
@media (min-width:900px){.mem{grid-template-columns:repeat(2,minmax(0,1fr));column-gap:56px}}
.mem li{display:grid;grid-template-columns:auto minmax(0,1fr);gap:4px 22px;padding:22px 0;border-bottom:1px solid var(--line)}
.mem .bits{display:flex;gap:5px;grid-row:span 2;padding-top:6px}
.mem .bits i{width:14px;height:14px;border-radius:50%;box-shadow:inset 0 0 0 2px var(--ring);transition:background .25s calc(var(--b)*60ms),box-shadow .25s calc(var(--b)*60ms)}
.mem .bits i.b1{background:var(--ink);box-shadow:none}
.mem li:hover .bits i{background:var(--acc);box-shadow:none}
.mem h3{margin:0;font:800 clamp(20px,1.9vw,24px)/1.2 var(--sans);letter-spacing:-.02em}
.mem p{margin:0;color:var(--muted);font-size:16px}

/* 100 FAQ: each answer is a switch */
.faq{max-width:920px}
.q{border-top:1px solid var(--line)}
.q:last-child{border-bottom:1px solid var(--line)}
.q summary{list-style:none;cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:24px;min-height:84px;padding:14px 0;font:700 clamp(19px,2vw,26px)/1.25 var(--sans);letter-spacing:-.02em}
.q summary::-webkit-details-marker{display:none}
.q .sw{position:relative;width:64px;height:34px;flex:none;border-radius:999px;box-shadow:inset 0 0 0 2px var(--ink)}
.q .sw i{position:absolute;top:4px;left:4px;width:26px;height:26px;border-radius:50%;box-shadow:inset 0 0 0 2px var(--ink);transition:transform .5s cubic-bezier(.55,0,.25,1),background .3s .12s,box-shadow .3s .12s}
.q[open] .sw i{transform:translateX(30px);background:var(--acc);box-shadow:none}
.q summary:hover .sw i{transform:translateX(6px)}
.q[open] summary:hover .sw i{transform:translateX(24px)}
.q .a{padding:0 0 28px;max-width:62ch;color:var(--muted);font-size:18px}
.q .a p{margin:0}
.q::details-content{block-size:0;overflow:hidden;transition:block-size .45s cubic-bezier(.55,0,.25,1),content-visibility .45s allow-discrete}
.q[open]::details-content{block-size:auto}

/* 101 Contact: the power switch */
.power{padding:0;border-top:0}
.power .panel{display:grid;min-height:min(78vh,720px)}
@media (min-width:900px){.power .panel{grid-template-columns:1fr 1fr}}
.power .off,.power .on{padding:clamp(48px,7vw,96px) clamp(20px,5vw,72px);display:flex;flex-direction:column;justify-content:space-between;gap:40px}
.power .off{background:var(--bg2)}
.power .on{background:var(--acc);color:var(--acc-ink);position:relative;overflow:hidden}
.power .state{font:800 clamp(140px,22vw,300px)/.78 var(--sans);letter-spacing:-.07em}
.power .off .state{color:transparent;-webkit-text-stroke:2px var(--ring)}
.power .on .state{text-align:right}
.power h2{font:800 clamp(36px,5vw,68px)/.98 var(--sans);letter-spacing:-.04em;margin:0}
.power .off p{color:var(--muted);margin:14px 0 0;max-width:40ch}
.power .on p{margin:0;font:600 18px/1.4 var(--sans)}
.power .on a.mail{font:800 clamp(22px,2.6vw,34px)/1.1 var(--sans);letter-spacing:-.02em;color:inherit;text-underline-offset:6px;text-decoration-thickness:2px;word-break:break-word}
.bigsw{--w:min(100%,360px);display:flex;align-items:center;justify-content:space-between;width:var(--w);height:84px;padding:0 12px 0 30px;border-radius:999px;background:var(--acc-ink);color:var(--acc);text-decoration:none;font:800 24px/1 var(--sans);letter-spacing:-.02em;transition:transform .4s cubic-bezier(.3,1.6,.5,1)}
.bigsw i{width:62px;height:62px;display:block;transition:transform .55s cubic-bezier(.55,0,.25,1)}
.bigsw i svg{display:block;width:100%;height:100%}
.bigsw i .k-disc{fill:var(--acc)}.bigsw i .k-one{stroke:var(--acc-ink);stroke-width:3px}
.bigsw:hover{transform:scale(1.03)}
.bigsw:hover i{transform:rotate(360deg)}

/* ---------- Footer ---------- */
.foot{padding:clamp(56px,8vw,96px) 0 32px;background:var(--bg)}
.foot-top{display:grid;gap:40px}
@media (min-width:760px){.foot-top{grid-template-columns:minmax(0,1.3fr) minmax(0,.7fr) minmax(0,1fr)}}
@media (min-width:1100px){.foot-top{grid-template-columns:minmax(0,1.3fr) minmax(0,.6fr) minmax(0,.9fr) minmax(0,1.1fr)}}
.foot-logo{width:min(100%,260px);--cut:var(--bg)}
.foot-brand p{margin:18px 0 0;color:var(--muted);max-width:34ch;font-size:16px}
.foot-col h2,.foot-cta h2{font:700 12px/1 var(--sans);letter-spacing:.12em;text-transform:uppercase;color:var(--muted);margin:6px 0 14px}
.foot-col{display:flex;flex-direction:column;align-items:flex-start}
.foot-col a{display:inline-flex;align-items:center;gap:10px;min-height:40px;text-decoration:none;font:600 16px/1.2 var(--sans);word-break:break-word}
.foot-col a::before{content:"";width:10px;height:10px;border-radius:50%;box-shadow:inset 0 0 0 1.5px var(--ring);flex:none;transition:background .25s,box-shadow .25s}
.foot-col a:hover::before{background:var(--acc);box-shadow:none}
.foot-cta p{margin:0 0 18px;font:700 20px/1.3 var(--sans);letter-spacing:-.01em}
@media (min-width:760px) and (max-width:1099px){.foot-cta{grid-column:1/-1}}
.foot .bitrule{margin:clamp(40px,6vw,64px) 0 22px}
.foot-bottom{display:flex;align-items:center;justify-content:space-between;gap:14px 28px;flex-wrap:wrap;font:500 14px/1.4 var(--sans);color:var(--muted)}
.foot-bottom p{margin:0}
.credits{display:flex;align-items:center;gap:10px 22px;flex-wrap:wrap}
.credits a{display:inline-flex;align-items:center;gap:10px;min-height:44px;text-decoration:none;color:var(--ink)}
.credits svg{height:19px;width:auto;display:block}
.credits .coh svg{height:22px}
.credits .sep{width:1px;height:22px;background:var(--line)}
.credits a:hover svg{opacity:.78}

/* ---------- Motion: power-on flicker reveals ---------- */
.js [data-on]{opacity:0}
.js [data-on].on{opacity:1;animation:flick .7s steps(1,end) both}
@keyframes flick{0%{opacity:0}12%{opacity:.85}20%{opacity:.1}34%{opacity:1}44%{opacity:.35}56%,100%{opacity:1}}
.address span{transition:transform .5s cubic-bezier(.3,1.6,.5,1) calc(var(--b)*90ms)}
.js [data-on]:not(.on) .address span{transform:rotateX(90deg)}

/* ---------- Phones ---------- */
@media (max-width:979px){
  .hero{align-items:flex-start;padding-top:clamp(40px,9svh,88px)}
  .hero-logo{margin-bottom:clamp(20px,3.5svh,32px)}
  .hero h1{font-size:clamp(36px,10.4vw,54px);max-width:12ch}
  .hero-row{gap:22px}
  .actions{margin-top:4px;gap:12px 20px}
}
@media (max-width:599px){
  .sec{padding:64px 0}
  .sec-head{margin-bottom:28px}
  .sec h2{font-size:clamp(34px,10vw,44px)}
  .sec-head p{font-size:17px}
  .address{margin-bottom:14px}
  .tt td{padding:14px 0;font-size:17px}
  .tt td:first-child{padding-right:14px}
  .out{gap:10px}
  .out .v{font-size:22px}
  .tog{width:52px;height:30px}.tog i{width:22px;height:22px}.tog.is1 i{transform:translateX(22px)}
  .dip-head,.dip li{grid-template-columns:minmax(0,1fr) 64px minmax(0,1fr)}
  .dip-head .glyph{font-size:clamp(76px,26vw,110px)}
  .dip li{min-height:60px}
  .dip .z,.dip .o{font-size:19px}
  .dip .mid{width:52px;height:30px}.dip .mid i{width:22px;height:22px}
  @media (hover:none),(pointer:coarse){[data-on].on .dip .mid i{transform:translateX(22px)}}
  .mem li{gap:4px 16px;padding:18px 0}
  .mem .bits{gap:4px}.mem .bits i{width:11px;height:11px}
  .mem h3{font-size:19px}
  .mem p{font-size:15.5px}
  .q summary{min-height:68px;gap:16px;font-size:18px}
  .q .sw{width:52px;height:30px}.q .sw i{width:22px;height:22px}
  .q[open] .sw i{transform:translateX(22px)}
  .q .a{font-size:16.5px;padding-bottom:22px}
  .power .panel{min-height:0}
  .power .off,.power .on{padding:44px 20px;gap:24px}
  .power .off{flex-direction:row;align-items:flex-end;justify-content:space-between}
  .power .off .state{order:2}
  .power .state{font-size:clamp(96px,30vw,140px)}
  .power .on{display:grid;grid-template-columns:minmax(0,1fr) auto;align-items:end;gap:28px 16px}
  .power .on .state{grid-column:2;grid-row:1}
  .power .on > div{grid-column:1;grid-row:1}
  .power .on .bigsw{grid-column:1/-1}
  .bigsw{--w:100%;height:72px;padding:0 8px 0 26px;font-size:21px}
  .bigsw i{width:56px;height:56px}
  .foot-top{gap:32px}
  .credits .sep{display:none}
  .credits{flex-direction:column;align-items:flex-start;gap:0}
}

@media (prefers-reduced-motion:reduce){
  html{scroll-behavior:auto}
  *,*::before,*::after{animation-duration:1ms!important;animation-delay:0s!important;animation-iteration-count:1!important;transition-duration:1ms!important;transition-delay:0s!important}
  .js [data-on]{opacity:1}
}
</style>
@endverbatim
</head>
<body>

<header class="bar">
    <div class="wrap">
        <button type="button" class="zo-mark bar-logo" aria-label="ZeroOne.com logo — click to switch">{!! $zo() !!}</button>
        <nav class="reg" aria-label="Sections">
            @foreach ($sections as $i => [$id, $bits, $label])
                <a class="cell" href="#{{ $id }}" data-i="{{ $i }}" data-label="{{ $label }}" data-bits="{{ $bits }}" @if ($i === 0) aria-current="true" @endif>
                    <span class="ring" aria-hidden="true"></span>
                    <span class="addr" aria-hidden="true">{{ $bits }}</span>
                    <span class="sr">{{ $label }}</span>
                </a>
            @endforeach
            <span class="reg-knob" aria-hidden="true">{!! $knob !!}</span>
        </nav>
        <span class="readout" aria-hidden="true"><b>000</b><span>Start</span></span>
        <button class="th" type="button" role="switch" aria-checked="false" aria-label="Dark mode">
            <span class="track" aria-hidden="true">{!! str_replace('class="', 'class="ic ', $sun) !!}{!! str_replace('class="', 'class="ic ', $moon) !!}<span class="k">{!! $sun !!}{!! $moon !!}</span></span>
            <span class="mode" aria-hidden="true"><span class="l">Light</span><span class="d">Dark</span></span>
        </button>
        <a class="bar-cta" href="{{ $mailto }}">Contact us <i>{!! $knob !!}</i></a>
    </div>
</header>

<main>
    <section class="hero" id="top" aria-labelledby="hero-title">
        <div class="wrap">
                <button type="button" class="zo-mark hero-logo" data-hero aria-label="ZeroOne.com logo — click to switch">{!! $zo() !!}</button>
                <div class="hero-row">
                <h1 id="hero-title">This is an <span class="nw">elite-level</span> <span class="dot">.com</span> domain</h1>
                <div>
                <div class="actions">
                    <a class="switch" href="{{ $mailto }}"><span class="kn" aria-hidden="true">{!! $knob !!}</span><span class="t">Contact us</span></a>
                    <span class="hint">Tip: <span class="click">click</span><span class="tap">tap</span> the logo to switch it off.</span>
                </div>
                </div>

            <figure class="matrix" aria-labelledby="matrix-cap">
                <figcaption id="matrix-cap"><span>The name, in binary</span><span aria-hidden="true">ASCII · 8 bits</span></figcaption>
                <ol>
                    @foreach ($binary as $r => [$ch, $bits])
                        <li>
                            <span class="ch" aria-hidden="true">{{ $ch }}</span>
                            @foreach (str_split($bits) as $c => $b)
                                <span class="bit b{{ $b }}" style="--d: {{ $r * 8 + $c }}" aria-hidden="true"></span>
                            @endforeach
                            <span class="sr">{{ $ch }} is {{ $bits }}</span>
                        </li>
                    @endforeach
                </ol>
                <p class="note">Seven letters, fifty-six bits — written in nothing but <b>zero</b> and <b>one</b>.</p>
            </figure>
                </div>
        </div>
    </section>

    <section class="sec" id="truth" aria-labelledby="truth-title">
        <div class="wrap" data-on>
            <div class="sec-head">
                <div>
                    <div class="address" aria-hidden="true">@foreach (str_split('001') as $b => $d)<span class="{{ $d ? 'one' : '' }}" style="--b: {{ $b }}">{{ $d }}</span>@endforeach</div>
                    <h2 id="truth-title">Truth table</h2>
                </div>
                <p>The facts about zeroone.com, reduced to the only two answers a computer understands.</p>
            </div>
            <table class="tt">
                <thead><tr><th scope="col">Input</th><th scope="col">Output</th></tr></thead>
                <tbody>
                    @foreach ($truth as $r => [$fact, $v])
                        <tr class="f{{ $v }}">
                            <td>{{ $fact }}</td>
                            <td><span class="out"><span class="tog {{ $v ? 'is1' : '' }}" style="--r: {{ $r }}" aria-hidden="true"><i></i></span><span class="v">{{ $v }}</span><span class="sr">{{ $v ? 'true' : 'false' }}</span></span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    <section class="sec" id="meaning" aria-labelledby="meaning-title">
        <div class="wrap" data-on>
            <div class="sec-head">
                <div>
                    <div class="address" aria-hidden="true">@foreach (str_split('010') as $b => $d)<span class="{{ $d ? 'one' : '' }}" style="--b: {{ $b }}">{{ $d }}</span>@endforeach</div>
                    <h2 id="meaning-title">Two digits. Every idea.</h2>
                </div>
                <p>Zero and one are the only two digits in binary, the number system computers use to store and process everything. “Zero to one” is also shorthand for making something that did not exist before.</p>
            </div>
            <div class="dip-head" aria-hidden="true"><span class="glyph z">0</span><span></span><span class="glyph o">1</span></div>
            <ul class="dip" aria-label="From zero to one">
                @foreach ($pairs as [$z, $o])
                    <li style="--r: {{ $loop->index }}"><span class="z">{{ $z }}</span><span class="mid" aria-hidden="true"><i></i></span><span class="o">{{ $o }}</span></li>
                @endforeach
            </ul>
            <p class="dip-note">Hover a row to switch it on.</p>
        </div>
    </section>

    <section class="sec" id="industries" aria-labelledby="industries-title">
        <div class="wrap" data-on>
            <div class="sec-head">
                <div>
                    <div class="address" aria-hidden="true">@foreach (str_split('011') as $b => $d)<span class="{{ $d ? 'one' : '' }}" style="--b: {{ $b }}">{{ $d }}</span>@endforeach</div>
                    <h2 id="industries-title">Use cases by industry</h2>
                </div>
                <p>A name made of the digits every computer speaks suits any business built on software, data or a first bold step. Twelve addresses to start from.</p>
            </div>
            <ol class="mem">
                @foreach ($industries as $n => [$name, $text])
                    <li>
                        <span class="bits" aria-hidden="true">@foreach (str_split(sprintf('%04b', $n)) as $b => $d)<i class="b{{ $d }}" style="--b: {{ $b }}"></i>@endforeach</span>
                        <h3><span class="sr">Address {{ sprintf('%04b', $n) }}: </span>{{ $name }}</h3>
                        <p>{{ $text }}</p>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

    <section class="sec" id="faq" aria-labelledby="faq-title">
        <div class="wrap" data-on>
            <div class="sec-head">
                <div>
                    <div class="address" aria-hidden="true">@foreach (str_split('100') as $b => $d)<span class="{{ $d ? 'one' : '' }}" style="--b: {{ $b }}">{{ $d }}</span>@endforeach</div>
                    <h2 id="faq-title">Questions, switched on</h2>
                </div>
                <p>Open a question to flip its switch.</p>
            </div>
            <div class="faq">
                @foreach ($faqs as [$q, $a])
                    <details class="q">
                        <summary>{{ $q }}<span class="sw" aria-hidden="true"><i></i></span></summary>
                        <div class="a"><p>{{ $a }}</p></div>
                    </details>
                @endforeach
            </div>
        </div>
    </section>

    <section class="sec power" id="contact" aria-labelledby="contact-title">
        <div class="panel">
            <div class="off">
                <span class="state" aria-hidden="true">0</span>
                <div>
                    <h2 id="contact-title">Switch it on.</h2>
                    <p>zeroone.com is owned by Coherence.com and may be in development.</p>
                </div>
            </div>
            <div class="on">
                <span class="state" aria-hidden="true">1</span>
                <div>
                    <p>Talk to the team at Coherence</p>
                    <p><a class="mail" href="{{ $mailto }}">{{ $email }}</a></p>
                </div>
                <a class="bigsw" href="{{ $mailto }}">Contact us <i>{!! $knob !!}</i></a>
            </div>
        </div>
    </section>
</main>

<footer class="foot" id="footer">
    <div class="wrap">
        <div class="foot-top">
            <div class="foot-brand">
                <button type="button" class="zo-mark foot-logo" aria-label="ZeroOne.com logo — click to switch">{!! $zo() !!}</button>
                <p>An elite-level .com domain, owned by Coherence.com.</p>
            </div>
            <nav class="foot-col" aria-label="Explore">
                <h2>Explore</h2>
                <a href="#truth">Truth table</a>
                <a href="#meaning">Meaning</a>
                <a href="#industries">Industries</a>
                <a href="#faq">FAQ</a>
            </nav>
            <div class="foot-col">
                <h2>Contact</h2>
                <a href="{{ $mailto }}">{{ $email }}</a>
                <a href="{{ $owner }}" target="_blank" rel="noopener">Coherence.com</a>
                <a href="/llms.txt">llms.txt</a>
            </div>
            <div class="foot-cta">
                <h2>Interested in zeroone.com?</h2>
                <p>Flip the switch and say hello.</p>
                <a class="switch" href="{{ $mailto }}"><span class="kn" aria-hidden="true">{!! $knob !!}</span><span class="t">Contact us</span></a>
            </div>
        </div>
        <div class="bitrule" style="--lit: 64px" aria-hidden="true"></div>
        <div class="foot-bottom">
            <p>&copy;{{ date('Y') }} Booth.com Ltd. All Rights Reserved.</p>
            <div class="credits">
                <a href="https://qquantum.ai/creative-design/domain-landing-pages" target="_blank" rel="noopener" title="QQuantum.ai — domain landing pages designed and built by an AI systems engineering studio">
                    <span>Designed &amp; built by</span>
                    {!! $qquantum !!}
                </a>
                <span class="sep" aria-hidden="true"></span>
                <a class="coh" href="https://coherence.com" target="_blank" rel="noopener" title="Coherence — ethical, human-centred AI across sound, education and consciousness">
                    <span>Part of</span>
                    {!! $coherence !!}
                </a>
            </div>
        </div>
    </div>
</footer>

@verbatim
<script>
(function () {
  var root = document.documentElement;
  var reduced = matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* ---- Register bar appears only after the hero has left the viewport ---- */
  var bar = document.querySelector('.bar');
  if ('IntersectionObserver' in window) {
    new IntersectionObserver(function (es) { bar.classList.toggle('shown', !es[0].isIntersecting); }, { rootMargin: '-64px 0px 0px 0px' }).observe(document.querySelector('.hero'));
  } else { bar.classList.add('shown'); }

  /* ---- Theme: dark-mode switch, with a CRT power-cut transition ---- */
  var th = document.querySelector('.th');
  function label(t) {
    th.setAttribute('aria-checked', t === 'dark' ? 'true' : 'false');
  }
  function applyTheme(t) {
    root.dataset.theme = t;
    try { localStorage.setItem('theme', t); } catch (e) {}
    label(t);
  }
  th.addEventListener('click', function () {
    var next = root.dataset.theme === 'dark' ? 'light' : 'dark';
    if (!document.startViewTransition || reduced) { applyTheme(next); return; }
    document.startViewTransition(function () { applyTheme(next); }).ready.then(function () {
      root.animate({ transform: ['scale(1,1)', 'scale(1,.004)', 'scale(0,.004)'], filter: ['brightness(1)', 'brightness(2.4)', 'brightness(4)'] },
        { duration: 380, easing: 'cubic-bezier(.6,0,.9,.4)', fill: 'forwards', pseudoElement: '::view-transition-old(root)' });
      root.animate({ transform: ['scale(0,.004)', 'scale(1,.004)', 'scale(1,1)'], filter: ['brightness(4)', 'brightness(2)', 'brightness(1)'], opacity: [1, 1, 1] },
        { duration: 520, delay: 360, easing: 'cubic-bezier(.2,.8,.2,1)', fill: 'backwards', pseudoElement: '::view-transition-new(root)' });
    });
  });
  label(root.dataset.theme);
  try {
    if (!localStorage.getItem('theme')) {
      matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function (e) {
        if (!localStorage.getItem('theme')) { root.dataset.theme = e.matches ? 'dark' : 'light'; label(root.dataset.theme); }
      });
    }
  } catch (e) {}

  /* ---- Logos: intro when seen, click toggles ca/cb (off / on) ---- */
  var hero = document.querySelector('.hero');
  var seen = 'IntersectionObserver' in window ? new IntersectionObserver(function (es) {
    es.forEach(function (e) { if (e.isIntersecting) { e.target.classList.add('play'); seen.unobserve(e.target); } });
  }, { threshold: .3 }) : null;
  document.querySelectorAll('.zo-mark').forEach(function (m) {
    seen ? seen.observe(m) : m.classList.add('play');
    var n = 0;
    m.addEventListener('click', function () {
      n++;
      m.classList.remove('ca', 'cb');
      m.classList.add(n % 2 ? 'ca' : 'cb');
      // Switching the hero logo off inverts the name's bits: NOT(zeroone).
      if (m.hasAttribute('data-hero')) hero.classList.toggle('not', n % 2 === 1);
    });
  });

  /* ---- Power-on reveals ---- */
  var on = 'IntersectionObserver' in window ? new IntersectionObserver(function (es) {
    es.forEach(function (e) { if (e.isIntersecting) { e.target.classList.add('on'); on.unobserve(e.target); } });
  }, { threshold: .12 }) : null;
  document.querySelectorAll('[data-on]').forEach(function (el) { on ? on.observe(el) : el.classList.add('on'); });

  /* ---- Register: the knob slides to the current section's address ----
     A click moves the knob once, straight to its target, and the scroll
     tracker waits until the smooth scroll lands, so the knob never hops
     through the sections it passes on the way. */
  var cells = [].slice.call(document.querySelectorAll('.cell'));
  var targets = cells.map(function (c) { return document.querySelector(c.getAttribute('href')); });
  var knob = document.querySelector('.reg-knob');
  var readout = document.querySelector('.readout');
  var current = 0, locked = false, unlockTimer, squashTimer;
  function setActive(i) {
    if (i === current || i < 0) return;
    knob.style.setProperty('--dist', Math.abs(i - current));
    knob.style.setProperty('--n', i);
    current = i;
    knob.classList.add('moving');
    clearTimeout(squashTimer);
    squashTimer = setTimeout(function () { knob.classList.remove('moving'); }, 180);
    cells.forEach(function (c, k) {
      c.classList.toggle('past', k < i);
      if (k === i) c.setAttribute('aria-current', 'true'); else c.removeAttribute('aria-current');
    });
    readout.firstChild.textContent = cells[i].dataset.bits;
    readout.lastChild.textContent = cells[i].dataset.label;
  }
  // The last section whose top has passed 40% of the viewport; the bottom of the page lights the last cell.
  function sectionInView() {
    if (innerHeight + scrollY >= document.documentElement.scrollHeight - 4) return cells.length - 1;
    var line = innerHeight * .4, idx = 0;
    targets.forEach(function (t, k) { if (t && t.getBoundingClientRect().top <= line) idx = k; });
    return idx;
  }
  var ticking = false;
  addEventListener('scroll', function () {
    if (locked || ticking) return;
    ticking = true;
    requestAnimationFrame(function () { ticking = false; if (!locked) setActive(sectionInView()); });
  }, { passive: true });
  function unlock() { clearTimeout(unlockTimer); locked = false; setActive(sectionInView()); }
  if ('onscrollend' in window) addEventListener('scrollend', function () { if (locked) unlock(); });
  cells.forEach(function (c, i) {
    c.addEventListener('click', function () {
      locked = true;
      setActive(i);
      clearTimeout(unlockTimer);
      unlockTimer = setTimeout(unlock, 1500);
    });
  });
  setActive(sectionInView());
})();
</script>
@endverbatim
</body>
</html>
