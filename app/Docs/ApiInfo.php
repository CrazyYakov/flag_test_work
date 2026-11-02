<?php

declare(strict_types=1);

namespace App\Docs;

use OpenApi\Attributes as OA;

/**
 * Root OpenAPI document definition. Picked up by the l5-swagger scan
 * (config/l5-swagger.php scans base_path('app') and base_path('src')).
 */
#[OA\Info(version: '1.0.0', title: 'Marketplace API')]
#[OA\Server(url: 'http://localhost:8000', description: 'Local development server')]
final class ApiInfo {}
