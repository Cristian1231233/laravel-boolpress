<template>
  <header>
       <nav>
           <li><a href="">Home</a></li>
           <li><a class="active" href="">Blog</a></li>
           <li><a href="">Chi siamo</a></li>
           <li><a href="">Contatti</a></li>
       </nav>
  </header>
</template>

<script>
export default {
    name: 'Header'
}
</script>

<style lang="scss" scoped>

header{
    background-color: brown;
    padding: 20px 0;
    text-align: center;
    li{
        list-style: none;
        display: inline-block;
        margin: 0 10px;
        a{
            text-decoration: none;
            color: white;
            font-size: 13px;
            &.active{
                color: violet;
            }
            &:hover{
                color: blue;
            }
        }
    }
}

</style>