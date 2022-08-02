<?php

namespace Codetechnl\NovaAwsCloudwatch\Http\Controllers;

use Codetechnl\NovaAwsCloudwatch\Http\Requests\ShowSingleStreamRequest;
use Codetechnl\NovaAwsCloudwatch\Http\Requests\ShowStreamsRequest;
use Codetechnl\NovaAwsCloudwatch\StreamService;
use Illuminate\Routing\Controller;

class IndexController extends Controller
{
    /**
     * @param StreamService $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(StreamService $service)
    {
        $groups = $service->getLogGroups();

        return response()->json([
            'groups' => $groups,
            'status' => 'success'
        ]);
    }

    /**
     * @param ShowStreamsRequest $request
     * @param StreamService $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function showStreams(ShowStreamsRequest $request, StreamService $service)
    {
        if (!$request->allowGroupName()) {
            return response()->json([
                'status' => 'error',
                'message' => __('LogGroupName not allowed')
            ])->setStatusCode(403);
        }

        $streams = $service->getLogStreams($request->getLogGroupName());

        return response()->json([
            'streams' => $streams,
            'log_group_name' => $request->getLogGroupName(),
            'status' => 'success'
        ]);
    }

    /**
     * @param ShowSingleStreamRequest $request
     * @param StreamService $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function showStream(ShowSingleStreamRequest $request, StreamService $service)
    {
        $contents = $service->getLogStreamContents($request->getLogGroupName(), $request->getStream());

        return response()->json([
            'contents' => $contents,
            'status' => 'success'
        ]);
    }
}
