<?php

namespace Codetechnl\NovaAwsCloudwatch\Http\Controllers;

use App\Http\Controllers\Controller;
use Codetechnl\NovaAwsCloudwatch\Http\Requests\InertiaRequest;

class InertiaController extends Controller
{

    /**
     * @param InertiaRequest $request
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function main(InertiaRequest $request)
    {
        return $this->output('NovaAwsCloudwatch');
    }

    /**
     * @param InertiaRequest $request
     * @return \Inertia\Response|\Inertia\ResponseFactory
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function streams(InertiaRequest $request)
    {
        return $this->output('NovaAwsCloudwatchStreams', [
            'log_group_name' => $request->get('log_group_name')
        ]);
    }

    /**
     * @param InertiaRequest $request
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function stream(InertiaRequest $request)
    {
        return $this->output('NovaAwsCloudwatchStream', [
            'stream' => $request->get('stream'),
            'log_group_name' => $request->get('log_group_name')
        ]);
    }

    /**
     * @param $component
     * @param array $output
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    protected function output($component, array $output = [])
    {
        return inertia($component, [
                'config' => config()->get('nova_aws_cloudwatch.interface')
            ] + $output);
    }
}
