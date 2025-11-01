<?php

namespace App\Services\Api;

class DashboardApi extends BaseApi
{
    public function getData(): array
    {
        return parent::get('/api/dashboard');
    }
}
