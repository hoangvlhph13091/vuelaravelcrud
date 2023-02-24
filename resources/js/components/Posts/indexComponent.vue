// IndexComponent.vue
<template>
  <div>
      <h1>Posts</h1>
        <div class="row">
          <div class="col-md-10">
            <form @submit="search">
              <input type="text" v-model="searchData.searchData" class="form-controll" />
            </form>
          </div>
          <div class="col-md-2">
            <router-link :to="'/create'" class="btn btn-primary">Create Post</router-link>
          </div>
        </div><br />

        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Item Name</th>
                <th>Item content</th>
                <th colspan='2'>Actions</th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="post in posts" :key="post.id">
                    <td>{{ post.id }}</td>
                    <td>{{ post.title }}</td>
                    <td>{{ post.content }}</td>
                    <td><router-link :to="{name: 'edit', params: { id: post.id }}" class="btn btn-primary">Edit</router-link></td>
                    <td><button class="btn btn-danger" @click="deletePost(post.id)">Delete</button></td>
                </tr>
            </tbody>
        </table>
  </div>
</template>

<script>
  export default {
      data() {
        return {
          posts: [],
          searchData: {},
        }
      },
      methods: {
        deletePost(id) {
          this.axios?.get(this.$baseurl+'delete/'+id).then(response => {
          let i = this.posts.map(item => item.id).indexOf(id); 
          this.posts.splice(i, 1)
          });
        },
        async search(e){
          e.preventDefault();
          const response = await this.axios.post(this.$baseurl, this.searchData);
          this.posts = response.data.data;
        }
      },
      async created() {
        try {
          const response = await this.axios.get(this.$baseurl)
          this.posts = response.data.data;
        } catch (e) {
          this.errors.push(e)
        }
      }
  }
</script>
