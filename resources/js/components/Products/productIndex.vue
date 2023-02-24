// IndexComponent.vue
<template>
  <div>
      <h1>Product</h1>
        <div class="row">
          <div class="col-md-10">
            <form @submit="search">
              <input type="text" v-model="searchData.searchData" class="form-controll" />
            </form>
          </div>
          <div class="col-md-2">
            <router-link :to="{name: 'prodCreate'}" class="btn btn-primary">Create Product</router-link>
          </div>
        </div><br />

        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Item Name</th>
                <th>Item content</th>
                <th>Item cate?? posst ???</th>
                <th colspan='2'>Actions</th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="prod in products" :key="prod.id">
                    <td>{{ prod.id }}</td>
                    <td>{{ prod.name }}</td>
                    <td>{{ prod.price }}</td>
                    <td>{{ prod.postname }}</td>
                    <td><router-link :to="{name: 'edit', params: { id: prod.id }}" class="btn btn-primary">Edit</router-link></td>
                    <td><button class="btn btn-danger" @click="deletePost(prod.id)">Delete</button></td>
                </tr>
            </tbody>
        </table>
  </div>
</template>

<script>
  export default {
      data() {
        return {
          products: [],
          searchData: {},
        }
      },
      methods: {
        deletePost(id) {
          // this.axios?.get(this.$baseurl+'delete/'+id).then(response => {
          // let i = this.posts.map(item => item.id).indexOf(id); 
          // this.posts.splice(i, 1)
          // });
        },
        async search(e){
          e.preventDefault();
          const response = await this.axios.post(this.$baseurl, this.searchData);
          // this.posts = response.data.data;
        }
      },
      async created() {
      try {
        const response = await this.axios.get(this.$baseurl+'prod/')
        this.products = response.data.data;
      } catch (e) {
        this.errors.push(e)
      }
    }
  }
</script>
