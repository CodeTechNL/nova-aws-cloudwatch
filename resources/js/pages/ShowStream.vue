<template>

<!--    <Head title="Show Stream | AWS Cloudwatch" />-->

    <div>

        <back-button :log-group-name="log_group_name"></back-button>

        <div class="bg-white p-4 border-l-4 mb-4">
            <pre class=" p-1" v-text="content.message" v-for="content in contents"></pre>
        </div>

        <back-button :log-group-name="log_group_name" bottom></back-button>

    </div>
</template>

<script>
import BackButton from '../components/BackButton.vue';

export default {
    components: {
        BackButton: BackButton
    },
    props: {
        log_group_name: {},
        stream: {}
    },
    data() {
        return {
            contents: []
        }
    },
    beforeMount() {
        Nova.request()
            .get('/nova-vendor/nova-aws-cloudwatch/stream?log_group_name=' + this.log_group_name + '&stream=' + this.stream)
            .then(response => {
                this.contents = response.data.contents;
            })
    },
}
</script>
