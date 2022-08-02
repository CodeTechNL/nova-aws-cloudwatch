# Laravel Nova AWS CloudWatch

A small and simple package to read CloudWatch logs without signing in to AWS.

## Installation

Run the command `composer require codetechnl/nova-aws-cloudwatch`

### Publish config file

`artisan vendor:publish --tag=nova-aws-cloudwatch-config`

## Config explained

`request.middleware` => add a middleware to your own preference

`groups.exclude` => Define which LogGroupNames you don't want to display. They are filtered out with Laravel so they
wont show up in the JSON output.

`groups.only` => Define which LogGroupNames can be retrieved. As an extra layer, all LogGroupNames are extracted and
then filtered on what to exclude and what to hide. If you make a typo, the LogGroupName won't be displayed.

#### USING THE ONLY & EXCLUDE OPTIONS WILL CONFLICT, ONLY USE ONE OF THEM!!! #

`aws.*` => Speaks for themselves

`interface.date_time_format` => Set your display preference. This is based on MomentJS. Read the docs to discover how to format the datetime

## To do
- [ ] Support multiple AWS Regions
- [ ] Make table rows clickable
- [ ] Update log display
  - [ ] Split on start and end of the request
  - [ ] Make execution time and memory used bold
  - [ ] Learn Tailwind for better styling
- [ ] Make logs searchable
