<?php

if (!function_exists('getModelForResource')) {
    /**
     * @param string $resource
     *
     * @return string|null
     */
    function getModelForResource(string $resource)
    {
        $resources = config('permissionsui.resources');

        $found = array_filter($resources, function ($configResource, $key) use ($resource) {
            if ($key == $resource) {
                return $configResource;
            }
        }, ARRAY_FILTER_USE_BOTH);

        return $found[$resource];
    }
}
