<template>
  <article>
      <h1><a href="#">{{post.title}}</a></h1>
      <div v-if="post.category">{{ post.category.name }}</div>
      <div class="category">  
        <span v-for="tag in post.tags"
        :key="tag.id"
        > {{ tag.name }}</span>
      </div>
      <p class="data">{{formatDate}}</p>
      <p class="testo">{{troncateText}}</p>
  </article>
</template>

<script>



export default {
    name: 'PostItem',
    props:{
      'post': Object
    },
    computed:{
      troncateText(){
        return this.post.content.substr(0, 50) + '...';
      },
      formatDate(){
        const d = new Date(this.post.created_at);
        let day = d.getDate();
        let month = d.getMonth() + 1;
        const year = d.getFullYear();
        if(day < 10) day = '0' + day;
        if(month < 10) month = '0' + month;
        return `${day}/${month}/${year}`
      }
    }
}
</script>

<style lang="scss" scoped>

article{
  margin-bottom: 20px;
  a{
    font-size: 16px;
    color: black;
    text-decoration: none;
    &:hover{
      color: violet;
      text-decoration: underline;
    }
  }
  .data{
    font-size: 12px;
    font-style: italic;
  }
  .testo{
    padding: 5px 0;
  }
  .category{
    margin: 5px 0;
    color: white;
    span{
      margin-right: 10px;
      display: inline-block;
      font-size: 15px;
      background-color: aqua;
      padding: 3px 10px;
      border-radius: 10px;
    }
  }
}

</style>