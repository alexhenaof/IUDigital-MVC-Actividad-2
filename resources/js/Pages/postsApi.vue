<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';


</script>

<template>
    <AuthenticatedLayout>

    <div class="container">
        <div class="row" v-for="post in posts">
            <div class="col-md-12">{{ post.name }}</div>
            <div class="col-md-12">    <img :src="post.image" alt="">
            </div>
            <div class="col-md-12">{{ post.description }}</div>
        </div>
    </div>
    </AuthenticatedLayout>

</template>

<script scoped>
export default {
data() {
    return {
        'posts': [],
    }
},
mounted () {
   axios.get('/api/posts/all')
.then(response => (

    this.posts = response.data,
    console.log(response.data))
)
}
}
</script>
