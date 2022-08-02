<?php

namespace Codetechnl\NovaAwsCloudwatch\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShowSingleStreamRequest extends ShowStreamsRequest
{

    public function rules()
    {
        return [];
    }

    public function getStream()
    {
        return $this->get('stream');
    }
}
