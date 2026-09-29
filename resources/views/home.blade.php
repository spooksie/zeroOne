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
                <a href="https://qquantum.ai/creative-design/brand-identity-logos" target="_blank" rel="noopener" title="QQuantum.ai — brand identity, logo and web design by an AI systems engineering studio in Barcelona">
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
