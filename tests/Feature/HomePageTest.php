<?php

it('renders the landing page with the original domain facts and contact details', function () {
    $this->get('/')
        ->assertOk()
        ->assertSee('This is an <span class="nw">elite-level</span> <span class="dot">.com</span> domain', false)
        ->assertSee('It is owned by <a href="https://coherence.com" target="_blank" rel="noopener">Coherence.com</a> and may be in development.', false)
        ->assertSee('mailto:team@coherence.com?subject=Domain%20name:%20zeroone.com', false)
        ->assertSee('Contact us')
        ->assertSee('zeroone.com');
});

it('is indexable and carries structured data for search engines and LLMs', function () {
    $html = $this->get('/')->getContent();

    expect($html)
        ->toContain('<meta name="robots" content="index, follow')
        ->toContain('<link rel="canonical" href="https://zeroone.com/">')
        ->toContain('"@type":"FAQPage"')
        ->toContain('"legalName":"Booth.com Ltd"')
        ->not->toContain('noindex')
        ->not->toContain('"@type":"Product"');
});

it('builds the bit-register navigation and the name in binary', function () {
    $this->get('/')
        ->assertSeeInOrder(['href="#top"', 'href="#truth"', 'href="#meaning"', 'href="#industries"', 'href="#faq"', 'href="#contact"'], false)
        ->assertSee('role="switch" aria-checked="false" aria-label="Dark mode"', false)
        ->assertSee('z is 01111010')
        ->assertSee('e is 01100101');
});

it('renders every logo as a clickable switch with the one letters that switch off', function () {
    $html = $this->get('/')->getContent();

    expect(substr_count($html, 'class="zo-mark'))->toBe(3)
        ->and(substr_count($html, 'oo-out'))->toBeGreaterThanOrEqual(9)
        ->and($html)->toContain("m.classList.add(n % 2 ? 'ca' : 'cb')");
});

it('keeps the private brand review out of public discovery files', function () {
    foreach (['robots.txt', 'sitemap.xml', 'llms.txt'] as $file) {
        expect(file_get_contents(public_path($file)))->not->toContain('brand-review');
    }
});

it('shows the Booth.com Ltd footer with the Coherence and QQuantum credits', function () {
    $this->get('/')
        ->assertSee('Booth.com Ltd. All Rights Reserved.', false)
        ->assertSee('https://qquantum.ai/creative-design/brand-identity-logos', false)
        ->assertSee('Designed &amp; built by', false)
        ->assertSee('https://coherence.com', false);
});

it('moves the register knob once per click instead of hopping through sections', function () {
    $html = $this->get('/')->getContent();

    expect($html)
        ->toContain("addEventListener('scrollend'")
        ->toContain('locked = true;')
        ->toContain('--dist')
        ->not->toContain('class="badge"');
});

it('has a 1200x630 social sharing image for link previews', function () {
    $html = $this->get('/')->getContent();

    expect($html)
        ->toContain('<meta property="og:image" content="https://zeroone.com/og-image.png">')
        ->toContain('<meta property="og:image:width" content="1200">')
        ->toContain('<meta property="og:image:height" content="630">')
        ->toContain('<meta name="twitter:card" content="summary_large_image">')
        ->toContain('<meta name="twitter:image" content="https://zeroone.com/og-image.png">');

    [$w, $h] = getimagesize(public_path('og-image.png'));
    expect([$w, $h])->toBe([1200, 630]);
});
