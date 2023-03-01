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
            <br>
            <br>
            <router-link :to="{name: 'prodImport'}" class="btn btn-primary">Import Products</router-link>
            <br>
            <br>
            <button class="btn btn-primary" @click="exportProduct">Export Products</button>
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
        <paginate :links ="links" @changePage="changePage"></paginate>
  </div>
</template>

<script>
import paginate from '../general/paginate.vue';
  export default {
  components: { paginate },
      data() {
        return {
          products: [],
          searchData: {},
          links: {},
          file: {},
        }
      },
      methods: {
        deletePost(id) {
          // this.axios?.get(this.$baseurl+'delete/'+id).then(response => {
          // let i = this.posts.map(item => item.id).indexOf(id);
          // this.posts.splice(i, 1)
          // });
        },
        async exportProduct(){
            const response = await this.axios.post(this.$baseurl+'prod/export');
        },
        async search(e){
          e.preventDefault();
          const response = await this.axios.post(this.$baseurl, this.searchData);
          // this.posts = response.data.data;
        },
        async changePage(PageUrl){
          const response = await this.axios.get(PageUrl);
          this.products = response.data.data;
          this.links = response.data.meta.links
        },
        async importExcel(e){
          const response = await this.axios.get(this.$baseurl+'prod/import');
          console.log(response);
          // this.products = response.data.data;
          // this.links = response.data.meta.links

        }
      },
      async created() {
      try {
        const response = await this.axios.get(this.$baseurl+'prod/')
        this.products = response.data.data;
        this.links = response.data.meta.links
      } catch (e) {
        this.errors.push(e)
      }
    },
  }
</script>
