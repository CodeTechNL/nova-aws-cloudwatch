<?php

namespace Codetechnl\NovaAwsCloudwatch\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShowStreamsRequest extends FormRequest
{

    public function rules()
    {
        return [];
    }

    public function getLogGroupName()
    {
        return $this->get('log_group_name');
    }

    public function allowGroupName()
    {
        $exclude = config('nova_aws_cloudwatch.groups.exclude');
        $only = config('nova_aws_cloudwatch.groups.only');

        if (!empty($exclude)) {
            return !in_array($this->getLogGroupName(), $exclude);
        }

        if (!empty($only)) {
            return in_array($this->getLogGroupName(), $only);
        }

        return true;
    }
}
