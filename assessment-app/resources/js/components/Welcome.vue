<script>
import NpiQueryForm from './NpiQueryForm.vue'

export default {
    components: {
        NpiQueryForm
    },
    setup: () => ({
        title: 'Alpheus Madsen - Assessment App'
    })
}
</script>:

<template>
    <h1>{{ title }}</h1>

    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 sm:items-center py-4 sm:pt-0">
        <NpiQueryForm />
    </div>
</template>

