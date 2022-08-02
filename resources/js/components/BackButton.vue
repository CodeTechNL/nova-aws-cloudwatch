<template>
    <div class="flex flex-auto mb-4">
        <Link :href="getUrl()" v-text="returnText"
              class="shadow  rounded  focus:outline-none
            ring-primary-200 dark:ring-gray-600 focus:ring bg-primary-500 hover:bg-primary-400 active:bg-primary-600 text-white
            dark:text-gray-800 inline-flex text-justify items-center font-bold px-4 h-9 text-sm">

        </Link>
    </div>
</template>

<script>
export default {
    props: {
        logGroupName: {
            type: String
        },
        bottom: {
            type: Boolean,
            default: false
        }
    },
    computed: {
        returnText() {
            return 'Return to ' + this.logGroupName;
        }
    },
    methods: {
        getUrl() {
            return '/admin/nova-aws-cloudwatch/streams?log_group_name=' + this.logGroupName;
        }
    },
    mounted() {
        console.log('Mounted comp')
    }
}
</script>
