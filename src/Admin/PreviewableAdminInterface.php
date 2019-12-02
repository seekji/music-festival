<?php

namespace App\Admin;

interface PreviewableAdminInterface
{
    public function getPreviewRouteName(): string;

    public function getPreviewRouteParameters($object): array;

    public function getLocale(): string;
}