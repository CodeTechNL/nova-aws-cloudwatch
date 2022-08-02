<?php

namespace Codetechnl\NovaAwsCloudwatch;

use Aws\CloudWatchLogs\CloudWatchLogsClient;
use Illuminate\Support\Arr;

class StreamService
{
    protected $region;


    public function getClient(): CloudWatchLogsClient
    {
        return new CloudWatchLogsClient([
            'region' => $this->getRegion(),
            'version' => '2014-03-28',
            'credentials' => array(
                'key' => config('nova_aws_cloudwatch.aws.key'),
                'secret' => config('nova_aws_cloudwatch.aws.secret'),
            ),
        ]);
    }

    public function getRegion()
    {
        if ($this->region) {
            return $this->region;
        }

        return $this->getConfig('aws.region');
    }

    /**
     * @return array
     */
    public function getLogGroups()
    {
        $data = $this->getClient()->describeLogGroups();

        $allowOnly = $this->getConfig('groups.only');
        $exclude = $this->getConfig('groups.exclude');

        $groups = Arr::where($data->get('logGroups'), function ($data) use ($allowOnly, $exclude) {

            if (!empty($allowOnly)) {
                return in_array($data['logGroupName'], $allowOnly);
            }

            if (!empty($exclude)) {
                return !in_array($data['logGroupName'], $exclude);
            }

            return true;
        });

        return Arr::pluck($groups, 'logGroupName');
    }

    public function getLogStreams(mixed $logGroupName)
    {
        return Arr::map($this->getClient()->describeLogStreams([
            'logGroupName' => $logGroupName

        ])->get('logStreams'), function (array $stream) {
            return [
                'name' => $stream['logStreamName'],
                'timestamps' => [
                    'firstEventTimestamp' => $stream['firstEventTimestamp'],
                    'lastEventTimestamp' => $stream['lastEventTimestamp'],
                    'lastIngestionTime' => $stream['lastIngestionTime']
                ]
            ];
        });
    }

    public function getLogStreamContents(string $logGroupName, string $stream)
    {
        return $this->getClient()->getLogEvents([
            'logGroupName' => $logGroupName,
            'logStreamName' => $stream
        ])->get('events');
    }

    protected function allowLogGroup(array $group, array $allowOnly)
    {
        return in_array($group['logGroupName'], $allowOnly);
    }

    protected function excludeLogGroup(array $group, array $exclude)
    {
        return !in_array($group['logGroupName'], $exclude);
    }

    protected function getConfig(string $config)
    {
        return config()->get('nova_aws_cloudwatch.' . $config);
    }


}
