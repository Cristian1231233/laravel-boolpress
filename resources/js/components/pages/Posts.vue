<template>
<main>
    <div class="container">
        <div v-if="success" >

            <div v-if="posts">
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
        <div v-else>
                Caricamento...
        </div>

        </div>
        <div v-else>
            {{error}}
        </div>
      
        <Sidebar 
        :tags ="tags"
        :categories="categories"
        @getPostCategory="getPostCategory"
        /> 

    </div>
</main>
</template>

<script>

import PostItem from '../partials/PostItem';
import Sidebar from '../partials/Sidebar';

export default {
    name: 'Posts',
    components:{
        PostItem,
        Sidebar
    },
    data(){
        return{
            apiUrl: 'http://127.0.0.1:8000/api/posts',
            posts: null,
            pagination: {},
            tags:[],
            categories:[],
            success: true,
            error: ''
        }
    },
    mounted() {
        this.getPosts();
    },
    methods: {
        getPosts(page = 1){
            this.posts = null;
            axios.get(this.apiUrl + '?page=' + page)
            .then(res => {
                this.posts = res.data.posts.data;
                this.categories = res.data.categories;
                this.tags = res.data.tags;
                this.pagination = {
                    current: res.data.current_page,
                    last: res.data.last_page
                }
                console.log(this.pagination);
            })
        },
        getPostCategory(slug_category){
            console.log("categoria", slug_category);
            axios.get(this.apiUrl + '/postcategory/' + slug_category)
            .then(res => {
                this.posts = res.data.category.posts;
            })
        }
    }
}
</script>

<style lang="scss" scoped>

main{
    .container{
        display: flex;
    }
    background-color: rgb(59, 97, 95);
    padding: 30px 0;
    margin-bottom: 50px;
    .pagination{
        button{
            color: black;
            background-color: white;
            border-radius: 10px;
            margin-right: 5px;
            border: 2px solid white;
            cursor: pointer;
            padding: 5px;
            &:hover{
                color: white;
                background-color: black;
                border: 2px solid violet;
            }
        }
    }
}

</style>