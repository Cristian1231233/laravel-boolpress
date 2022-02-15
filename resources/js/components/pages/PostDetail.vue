<template>
    <main class="container">
        <h1>{{post.title}}</h1>
        <div>{{post.content}}</div>
    </main>
</template>

<script>
export default {
    name: 'PostDetail',
    data(){
        return{
            apiUrl: 'http://127.0.0.1:8000/api/posts/',
            post:{
                title: '',
                content: '',
                category: '',
                tags: []
            }
        }
    },
    methods:{
        getApi(){
            axios.get(this.apiUrl + this.$route.params.slug)
            .then(res => {
                this.post = res.data;
                console.log(this.post);
            })
        }
    },
    mounted(){
        console.log(this.$route.params.slug);
        this.getApi();
    }
}
</script>

<style lang="scss" scoped>

.container{
    margin-top: 30px;
    h1{
        margin-bottom: 20px;
    }
}

</style>