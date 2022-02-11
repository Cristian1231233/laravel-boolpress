<template>
<main>
    <div class="container">
    <h1>I miei post</h1>
    <PostItem 
    v-for="post in posts"
    :key="post.id"
    :post = 'post'
    />

    <div class="pagination">
        <button
        @click="getPosts(pagination.current - 1)"
        :disabled = 'pagination.current === 1'
        >  << </button>

        <button
        v-for="i in pagination.last"
        :key="i"
        @click="getPosts(i)"
        :disabled = 'pagination.current === i'
        > {{ i }} </button>

        <button
        @click="getPosts(pagination.current + 1)"
        :disabled = 'pagination.current === pagination.last'
        > >> </button>
    </div>

    </div>
</main>
</template>

<script>

import PostItem from './partials/PostItem';

export default {
    name: 'Posts',
    components:{
        PostItem
    },
    data(){
        return{
            apiUlr: 'http://127.0.0.1:8000/api/posts?page=',
            posts: null,
            pagination: {}
        }
    },
    mounted() {
        this.getPosts();
    },
    methods: {
        getPosts(page = 1){
            axios.get(this.apiUlr + page)
            .then(res => {
                this.posts = res.data.data;
                this.pagination = {
                    current: res.data.current_page,
                    last: res.data.last_page
                }
                console.log(this.pagination);
            })
        }
    }
}
</script>

<style lang="scss" scoped>

main{
    padding: 30px 0;
    margin-bottom: 50px;
    .pagination{
        button{
            cursor: pointer;
            padding: 5px;
        }
    }
}

</style>