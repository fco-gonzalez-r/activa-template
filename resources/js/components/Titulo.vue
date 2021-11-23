<template>
    <div>
        <h1 class="mt-4">{{ titulo }}</h1>
        <ol v-if="breadcrumb" class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>

    </div>
</template>

<script>
    export default {
        props: {
            titulo: {
                type: String,
                default: null
            },
            breadcrumb: {
                type: String,
                default: null
            },
        },
    }
</script>

<style lang="scss" scoped>

</style>