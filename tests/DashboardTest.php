<?php

namespace Tests;

class DashboardTest extends TestCase
{
    /**
     * The root route renders the dashboard view.
     */
    public function test_dashboard_page_renders(): void
    {
        $this->get('/');

        $this->assertResponseOk();
        $this->assertStringContainsString('<html', strtolower($this->response->getContent()));
    }
}
