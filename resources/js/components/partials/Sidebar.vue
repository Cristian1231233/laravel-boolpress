<template>
  <div class="sidebar">
      <div class="box">
          <h3>Categorie</h3>
          <div class="category">
              <span
              v-for="category in categories"
              :key="`cat${category.id}`"
              @click="$emit('getPostCategory', category.slug)"
              >{{category.name}}</span>
          </div>
      </div>
      <div class="box tag">
          <h3>Tags</h3>
          <div class="tag">
              <span
              v-for="(tag, index) in tags"
              :key="index"
              >{{tag.name}}</span>
          </div>
      </div>
  </div>
</template>

<script>
export default {
    name: 'Sidebar',
    props:{
        'categories': Array,
        'tags': Array
    }
}
</script>

<style lang="scss" scoped>

.sidebar{
    max-width: 25%;
    .box{
        border: 2px solid gray;
        border-radius: 10px;
        padding: 30px 15px;
        margin-bottom: 20px;
        h3{
            margin-bottom: 15px;
        }
        span{
            display: inline-block;
            padding: 2px 5px;
            margin: 3px;
            border-radius: 5px;
            color: white;
            cursor: pointer;
        }
        .category{
            span{
                background-color: cadetblue;
            &:hover{
                background-color: rgb(151, 197, 199);
            }
            }
        }
        .tag{
            span{
                background-color: yellowgreen;
                &:hover{
                background-color: rgb(184, 221, 109);
            }
            }
        }
    }
}

</style>