<?php

it('renders the brand review page with the four directions', function () {
    $this->get('/brand-review')
        ->assertOk()
        ->assertSee('Four directions for the ZeroOne identity.')
        ->assertSeeInOrder(['Coin', 'Segment', 'Extrude', 'On/Off'])
        ->assertSee('https://qquantum.ai', false)
        ->assertSee('Booth.com Ltd. All Rights Reserved.')
        ->assertSee('https://coherence.com', false);
});

it('keeps the brand review page out of search engines', function () {
    $response = $this->get('/brand-review');

    expect($response->headers->get('X-Robots-Tag'))->toContain('noindex')
        ->and($response->getContent())->toContain('<meta name="robots" content="noindex');
});
