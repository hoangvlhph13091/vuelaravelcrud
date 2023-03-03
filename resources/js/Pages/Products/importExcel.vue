// IndexComponent.vue
<template>
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card card-default">
              <div class="card-header" >
                <h1>Create A Product</h1>
              </div>

              <div class="card-body">
                <form id="form_data" @submit="importExcel" enctype="multipart/form-data">
                <div class="row">

                    <div class="col-md-6">
                    <div class="form-group">
                        <label>Product Price :</label>
                        <input type="file" @change="getFile" class="form-control">
                    </div>

                    </div>
                    </div>
                    <div class="row">
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
      data() {
        return {
          data: {},
        }
      },
      methods: {
        getFile(e){
            this.data.file = e.target.files[0];
        },
        async importExcel(e){
            e.preventDefault();
            const config = {
                headers: {
                    'content-type': 'multipart/form-data',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    }
            }
          try {
                const response = await this.axios.post(this.$baseurl+'prod/import', this.data, config)
                this.$router.push({ path: '/prod/' })
                } catch (e) {
                    this.errors = e.response.data.errors
                }
        },

      },
  }
</script>
