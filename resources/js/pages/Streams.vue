<template>

<!--    <Head title="Streams | AWS Cloudwatch" />-->



    <div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
            <div class="relative"><!---->
                <div class="overflow-hidden overflow-x-auto relative">
                    <table class="w-full table-default" cellpadding="0" cellspacing="0" data-testid="resource-table">
                        <thead class="bg-gray-50 dark:bg-gray-800">
                        <tr>


                            <th class="text-left px-2 whitespace-nowrap uppercase text-gray-500 text-xxs tracking-wide py-2">
                                <button type="button"
                                        class="cursor-pointer inline-flex items-center focus:outline-none focus:ring ring-primary-200 dark:ring-gray-600 rounded"
                                        dusk="sort-email" aria-sort="none"><span
                                    class="inline-flex font-sans font-bold uppercase text-xxs tracking-wide text-gray-500">Stream</span>
                                </button>
                            </th>

                            <th class="text-left px-2 whitespace-nowrap uppercase text-gray-500 text-xxs tracking-wide py-2">
                                <span
                                    class="inline-flex font-sans font-bold uppercase text-xxs tracking-wide text-gray-500">First event</span>
                            </th>


                            <th class="text-left px-2 whitespace-nowrap uppercase text-gray-500 text-xxs tracking-wide py-2">
                                <span
                                    class="inline-flex font-sans font-bold uppercase text-xxs tracking-wide text-gray-500">Last event</span>
                            </th>

                            <th class="text-left px-2 whitespace-nowrap uppercase text-gray-500 text-xxs tracking-wide py-2">
                                <span
                                    class="inline-flex font-sans font-bold uppercase text-xxs tracking-wide text-gray-500">Last ingestion</span>
                            </th>


                            <th class="text-center px-2 whitespace-nowrap uppercase text-gray-500 text-xxs tracking-wide py-2">
                                <span>Show</span></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr dusk="2-row" class="group" v-for="stream in streams">

                            <td class="px-2 py-2 border-t border-gray-100 dark:border-gray-700 whitespace-nowrap cursor-pointer dark:bg-gray-800 group-hover:bg-gray-50 dark:group-hover:bg-gray-900">
                               <span class="text-90 whitespace-nowrap"
                                     v-text="stream.name"></span>

                            </td>

                            <td class="px-2 py-2 border-t border-gray-100 dark:border-gray-700 whitespace-nowrap cursor-pointer dark:bg-gray-800 group-hover:bg-gray-50 dark:group-hover:bg-gray-900">

                                    <span class="text-90 whitespace-nowrap"
                                          v-text="toDateTime(stream.timestamps.firstEventTimestamp)"></span>

                            </td>

                            <td class="px-2 py-2 border-t border-gray-100 dark:border-gray-700 whitespace-nowrap cursor-pointer dark:bg-gray-800 group-hover:bg-gray-50 dark:group-hover:bg-gray-900">
                                <span class="text-90 whitespace-nowrap"
                                      v-text="toDateTime(stream.timestamps.lastEventTimestamp)"></span>
                            </td>

                            <td class="px-2 py-2 border-t border-gray-100 dark:border-gray-700 whitespace-nowrap cursor-pointer dark:bg-gray-800 group-hover:bg-gray-50 dark:group-hover:bg-gray-900">
                                <span class="text-90 whitespace-nowrap"
                                      v-text="toDateTime(stream.timestamps.lastIngestionTime)"></span>
                            </td>


                            <td class="py-2 border-t border-gray-100 dark:border-gray-700 cursor-pointer px-2 td-fit text-right align-middle dark:bg-gray-800 group-hover:bg-gray-50 dark:group-hover:bg-gray-900">
                                <div class="flex items-center justify-end space-x-0 text-gray-400">
                                    <Link :href="getUrl(stream)" aria-label="Bekijken"
                                          class="toolbar-button hover:text-primary-500 px-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke="currentColor" width="24" height="24" class="inline-block"
                                             role="presentation">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </Link>

                                </div>
                            </td>
                        </tr><!---->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import moment from 'moment';

export default {
    props: [
        'log_group_name',
        'config'
    ],
    beforeMount() {
        Nova.request()
            .get('/nova-vendor/nova-aws-cloudwatch/streams?log_group_name=' + this.log_group_name)
            .then(response => {
                this.streams = response.data.streams;
            })
    },
    data() {
        return {
            streams: []
        }
    },
    methods: {
        getUrl(stream) {
            return '/admin/nova-aws-cloudwatch/stream?log_group_name=' + this.log_group_name + '&stream=' + stream.name;
        },
        toDateTime(date) {
            return moment(date).format(this.config.date_time_format);
        }
    }
}
</script>
