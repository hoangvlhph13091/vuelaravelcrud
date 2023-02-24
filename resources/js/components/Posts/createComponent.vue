<template>
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card card-default">
              <div class="card-header" >
                <h1>Create A Post</h1>
              </div>
                    <div class="col-md-6" style="color: red">
                        <p>{{this.error}}</p>
                    </div>
              <div class="card-body">
                <form id="form_data" @submit="addPost">
                <div class="row">
                    
                    <div class="col-md-6">
                    <div class="form-group">
                        <label>Post Title:</label>
                        <input type="text" v-model="post.title" class="form-control" >
                    </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label>Post Body:</label>
                        <textarea v-model="post.content" class="form-control" ></textarea>
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
        name:'createComponent',
        data() {
            return {
                post: {},
                error: ''
            }
        },
        methods: {
            addPost(e) {
                e.preventDefault();
                this.axios
                    .post(this.$baseurl+'create', this.post)
                    .then(response => (
                        response.data.data.status == 'failed' ? this.error = response.data.data.error : this.$router.push({ path: '/' })
                    ))
                    
            },
        },
    }
</script>
