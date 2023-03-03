<template>
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card card-default">
              <div class="card-header" >
                <h1>Create A Product</h1>
              </div>

              <div class="card-body">
                <form id="form_data" @submit="editProduct" enctype="multipart/form-data">
                <div class="row">

                    <div class="col-md-6">
                    <div class="form-group">
                        <label>Product Name :</label>
                        <input type="text" v-model="product.name" class="form-control" >
                        <div class="" style="color: red">
                            <p>{{this.errors.name != null ? this.errors.name[0] : '' }}</p>
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
                        <label>Product Price :</label>
                        <input type="file" @change="addFileName" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Product PostID :</label>
                        <select class="form-control" v-model="product.postID">
                            <option v-for="post in posts" :key="post.id" :value="post.id" :selected="post.id === product.postID ? true : false" >{{post.title}}</option>
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
        name:'editProductComponent',
        data() {
            return {
                product: [],
                errors: {},
                posts: {},
                file:{}
            }
        },

        methods: {
            editProduct(e) {
                e.preventDefault();
                const postID = this.$route.params.id;
                console.log(postID);
                this.axios
                    .post(this.$baseurl+'prod/edit/'+postID, this.product)
                    .then(response => (
                        response.data.data.status == 'failed' ? this.error = response.data.data.error : this.$router.push({ path: '/prod/' })
                    ))

            },
        },
         async created() {
            const prodID = this.$route.params.id;
            try {
            const response = await this.axios.get(this.$baseurl)
            const response2 = await this.axios.get(this.$baseurl+'prod/edit/'+prodID)
            this.product = response2.data.data;
            console.log(this.product);
            this.posts = response.data.data;
            } catch (e) {
            this.errors.push(e)
            }
        }
    }
</script>
