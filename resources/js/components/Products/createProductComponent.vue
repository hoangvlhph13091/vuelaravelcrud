<template>
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card card-default">
              <div class="card-header" >
                <h1>Create A Product</h1>
              </div>
                    
              <div class="card-body">
                <form id="form_data" @submit="addPost">
                <div class="row">
                    
                    <div class="col-md-6">
                    <div class="form-group">
                        <label>Product Name :</label>
                        <input type="text" v-model="product.name" class="form-control" >
                        <div class="" style="color: red">
                            <p>{{this.errors.name ? this.errors.name[0] : '' }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Product Price :</label>
                        <input type="number" v-model="product.price" class="form-control" >
                        <div class="" style="color: red">
                            <p>{{this.errors.price ? this.errors.price[0] : '' }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Product PostID :</label>
                        <select v-model="product.postID" class="form-control">
                            <option v-for="post in posts" :key="post.id" :value="post.id">{{post.title}}</option>
                        </select>
                        <div class="" style="color: red">
                            <p>{{this.errors.postID ? this.errors.postID[0] : '' }}</p>
                        </div>
                    </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Product Body:</label>
                            <textarea v-model="product.content" class="form-control" ></textarea>
                            <div class="" style="color: red">
                                <p>{{this.errors.content ? this.errors.content[0] : '' }}</p>
                            </div>
                        </div>
                    </div>
                    </div><br />
                    <div class="form-group">
                    <button class="btn btn-primary">Create</button>
                    </div>
                </form>
              </div>
          </div>
      </div>
  </div>
</template>

<script>
    export default {
        name:'createProductComponent',
        data() {
            return {
                product: {},
                errors: {},
                posts: {}
            }
        },
        methods: {
            async addPost(e) {
                e.preventDefault();
                try {
                    const response = await this.axios.post(this.$baseurl+'prod/create', this.product)
                    console.log(response)
                } catch (e) {
                    this.errors = e.response.data.errors
                    console.log(e.response.data.errors)
                }
                
                
                // this.axios
                //     .post(this.$baseurl+'prod/create', this.product)
                //     .then(response => (
                //         
                //     ))
                    
            },
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
