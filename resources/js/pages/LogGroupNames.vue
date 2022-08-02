

<template>

<!--        <Head title="Log Groups AWS Cloudwatch"></Head>-->


    <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
        <div class="relative">
            <div class="overflow-hidden overflow-x-auto relative">
                <table class="w-full table-default" cellpadding="0" cellspacing="0" data-testid="resource-table">
                    <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        <th class="text-left px-2 whitespace-nowrap uppercase text-gray-500 text-xxs tracking-wide py-2">
                            <button type="button"
                                    class="cursor-pointer inline-flex items-center focus:outline-none focus:ring ring-primary-200 dark:ring-gray-600 rounded"
                                    dusk="sort-email" aria-sort="none"><span
                                class="inline-flex font-sans font-bold uppercase text-xxs tracking-wide text-gray-500">Group</span>
                            </button>
                        </th>
                        <th class="text-center px-2 whitespace-nowrap uppercase text-gray-500 text-xxs tracking-wide py-2">
                            <span>Show</span></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="group" v-for="group in groups">

                        <td class="px-2 py-2 border-t border-gray-100 dark:border-gray-700 whitespace-nowrap cursor-pointer dark:bg-gray-800 group-hover:bg-gray-50 dark:group-hover:bg-gray-900">
                            <div class="text-left" resource="[object Object]"><span class="text-90 whitespace-nowrap"
                                                                                    v-text="group"></span>
                            </div>
                        </td>

                        <td class="py-2 border-t border-gray-100 dark:border-gray-700 cursor-pointer px-2 td-fit text-right align-middle dark:bg-gray-800 group-hover:bg-gray-50 dark:group-hover:bg-gray-900">
                            <div class="flex items-center justify-end space-x-0 text-gray-400">


                                <Link :href="getUrl(group)" aria-label="Show"
                                      class="toolbar-button hover:text-primary-500 px-2 v-popper--has-tooltip"
                                >
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
</template>

<script>


export default {
    beforeMount() {
        Nova.request()
            .get('/nova-vendor/nova-aws-cloudwatch')
            .then(response => {
                this.groups = response.data.groups;
            })
    },
    data() {
        return {
            groups: []
        }
    },
    methods: {
        getUrl(group) {
            return '/admin/nova-aws-cloudwatch/streams?log_group_name=' + group;
        }
    },
}
</script>
